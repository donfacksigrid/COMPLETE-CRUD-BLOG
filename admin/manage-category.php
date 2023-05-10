<?php
include 'partial/header.php';

$query= "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection,$query);
?>
<section class="dashboard">
    <?php if(isset($_SESSION['add-category-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['add-category'])) :?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-category'])) :?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['edit-category-success'])) :?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-succes']);
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
                    <a href="manage-post.php"><i class="uil uil-postcard"></i>
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
                    <a href="manage-category.php" class="active"><i class="uil uil-list-ul"></i>
                <h5>Manage Categories</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2 style="color: #6f6af8;">Manage category-post</h2>
            <?php if (mysqli_num_rows($categories)>0): ?>
            <table>
                <thead>
                    <th style="background-color: white; color:green">Title</th>
                    <th style="background-color: white; color:green">Update</th>
                    <th style="background-color: white; color:green">Delete</th>
                </thead>
                <tbody style="background-color: #6f6af8; color:white;">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                    <tr>
                        <td><?= $category['title'] ?> </td>
                        <td><a href="<?= ROOT_URL?>admin/edit-category.php?id=<?= $category['id']?>" class="btn sm">Update</a></td>
                        <td><a href="<?= ROOT_URL?>admin/delete-category.php?id=<?= $category['id']?>" class="btn sm danger">Delete</a></td>
                    </tr>

                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert_message error"><?= "No category found"?>  </div>
                <?php endif?>
        </main>
    </div>
</section>
<?php
include '../partial/footer.php';
?>