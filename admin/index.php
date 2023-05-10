<?php

include 'partial/header.php';
?>
<section class="dashboard">
<div class="container dashboard_container">
        <button class="sidebar_toggle" id="show_sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
        <button class="sidebar_toggle" id="hide_sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-pen"></i>
                <h5>Profile</h5>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_is_admin'])) :?>                
                    <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-post.php" ><i class="uil uil-postcard"></i>
                <h5>Manage Post</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-user.php"><i class="uil uil-user-alt"></i>
                <h5>Manage User</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php"><i class="uil uil-edit"></i>
                <h5>Add Category</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-category.php" ><i class="uil uil-list-ul"></i>
                <h5>Manage Categories</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside> 
        <main>
            <h2 style="color: #6f6af8;" >Profile</h2>
           <?php
           $id=$_SESSION['id'];
            $query="SELECT * FROM users WHERE id= $id";
            $users = mysqli_query($connection, $query);
            if(mysqli_num_rows($users)==1){
                $user = mysqli_fetch_assoc(($users));
            }
            ?>
            <p style="color: orange;font-size:2rem;">Welcome <?= $user['username'] ?> ! </p>
            <p style="color: white;">You have no notification.</p>
        <br>
        <p style="color: orange;font-size:1rem;">Your email is: <?= $user['email'] ?></p>

        </main>
    </div>
</section>
    <?php
include '../partial/footer.php';
?>