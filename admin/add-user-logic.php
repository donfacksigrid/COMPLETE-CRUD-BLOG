<?php 
require 'config/database.php';
if(!isset($_POST['submit'])){
    header('location:'. ROOT_URL. 'signup.php');
    die();
}
if (!isset($_POST['username'], $_POST['createpassword'], $_POST['confirmpassword'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please enter all fields');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
if (!filter_var($_POST['createpassword'], FILTER_SANITIZE_SPECIAL_CHARS)) {
	exit('Password is not valid!');
}
if (!filter_var($_POST['confirmpassword'], FILTER_SANITIZE_SPECIAL_CHARS)) {
	exit('Password is not valid!');
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['firstname']) == 0) {
    exit('firstname is not valid!');
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['lastname']) == 0) {
    exit('lastname is not valid!');
}
if (strlen($_POST['createpassword']) > 20 || strlen($_POST['createpassword']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
if ($_POST['createpassword'] !== $_POST['confirmpassword']) {
	exit('characters must match!');
}
if ($stmt = $connection->prepare('SELECT id FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'email exists, please choose another!';
	} else {
		if ($stmt = $connection->prepare('INSERT INTO users (firstname, lastname, username, password, email, is_admin) VALUES (?, ?, ?, ?, ?, 0)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['createpassword'], PASSWORD_DEFAULT);
            $stmt->bind_param('sssss', $_POST['firstname'],$_POST['lastname'],$_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            echo 'You have successfully registered! You can now login!';
			header('loction:'.ROOT_URL.'admin/index.php');
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
            echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
	
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$connection->close();
?>