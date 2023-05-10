<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body =$_POST['body'];
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ?: 0;
    if(!$title){
        $_SESSION['edit-post']="Enter post title";
    }elseif(!$category_id){
        $_SESSION['edit-post'] = "Select post category";
    }elseif(!$body){
        $_SESSION['edit-post']="Enter post body";
    }else{
        if($thumbnail['name']){
            $previous_path = '../images/'.$previous_thumbnail_name;
            if($previous_path){
                unlink($previous_path);
        
            }
            $time= time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name= $thumbnail['tmp_name'];
            $thumbnail_destination_path= '../images/'.$thumbnail_name;
            $allowed_files=['png','jpg','jpeg'];
            $extension = explode('.',$thumbnail_name);
            $extension= end($extension);

            if(in_array($extension, $allowed_files)){
                if($thumbnail['size'] < 2_000_000){
                    move_uploaded_file($thumbnail_tmp_name,$thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post']="File size too big";
                }
            }else{
                $_SESSION['edit-post'] ="file should be png...";
            }
        
        }
}
if(isset($_SESSION['edit-post'])){
    $_SESSION['edit-post-data'] = $_POST;
    header('location:'.ROOT_URL.'admin/manage-post.php');
    die();
}else{
    if($is_featured==1){
        $zero_all_query = "UPDATE posts SET is_featured=0";
        $zero_all_result = mysqli_query($connection,$zero_all_query);
    }
    $thumbnail_to_insert= $thumbnail_name?? $previous_thumbnail_name;
    $query="UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert',
    category_id=$category_id, is_featured = $is_featured WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection,$query);
}
if(!mysqli_errno($connection)){
    $_SESSION['edit-post-success'] = "Post updated successfully";
    header('location:'.ROOT_URL.'admin/manage-post.php');
    die();
}
}
header('location:'.ROOT_URL.'admin/manage-post.php');
die();