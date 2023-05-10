<?php

include 'partial/header.php';
$current_user_id=$_SESSION['id'];
$query="SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection,$query);
?>
<section class="dashboard">
<?php if(isset($_SESSION['add-post-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
        <?php endif ?>
<?php if(isset($_SESSION['edit-post-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
<?php elseif(isset($_SESSION['edit-post'])) :?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-post-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['delete-category-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
        </div>
        <?php endif?>
    <div class="container dashboard_container">
        <button class="sidebar_toggle" id="show_sidebar-btn"><i class="uil uil-angle-right-b"></i></button>
        <button class="sidebar_toggle" id="hide_sidebar-btn"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
            <li>
                    <a href="index.php"><i class="uil uil-pen"></i>
                <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-post.php" class="active"><i class="uil uil-postcard"></i>
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
            </ul>
        </aside> 
        <main>
            <h2 style="color: #6f6af8;" >Manage Posts</h2>
            <?php if(mysqli_num_rows($posts)>0):?>
            <table>
                <thead>
                    <th style="color: green; background-color:white;">Title</th>
                    <th style="color: green; background-color:white;">Category</th>
                    <th style="color: green; background-color:white;">Edit</th>
                    <th style="color: green; background-color:white;">Delete</th>
                </thead>
                <tbody style="color: white;background-color:#6f6af8;">
                    <?php while($post = mysqli_fetch_assoc($posts)) :?>
                        <?php
                            $category_id= $post['category_id'];
                            $category_query="SELECT title FROM categories WHERE id=$category_id";
                            $category_result= mysqli_query($connection,$category_query);
                            $category= mysqli_fetch_assoc($category_result);?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title']?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?=$post['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?=ROOT_URL?>admin/delete-post.php?id=<?=$post['id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else:?>
                <div class="alert_message error"><?= "No posts found"?></div>
                <?php endif ?>
        </main>
    </div>
</section>
<?php
include '../partial/footer.php';
?>