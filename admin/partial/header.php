<?php
require 'config/database.php';
if(!isset($_SESSION['id'])){
    header('location:'.ROOT_URL.'signin.php');
    die();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog website</title>
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--Google fonts montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="<?php echo ROOT_URL ?>admin/index.php" class="nav_logo">camercoder</a>
            <ul class="nav_items">
                <li><a href="<?php echo ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?php echo ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?php echo ROOT_URL ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['id'])): ?>
                <li class="nav_profile">
                <div class="avatar">
                    <img src="../images/profiles.jfif">
                    </div>
                    <ul>
                        <li><a href="<?php echo  ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?php echo  ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php else:?>          
                    <a href="<?php echo ROOT_URL ?>signin.php">Signin</a></li>
                    <?php endif?>    
            </ul>
            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>