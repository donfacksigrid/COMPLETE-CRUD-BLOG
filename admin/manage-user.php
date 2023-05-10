<?php
include 'partial/header.php';

$current_admin_id = $_SESSION['id'];
$query= "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection,$query);
?>
<section class="dashboard">
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
                    <a href="manage-user.php"class="active"><i class="uil uil-user-alt"></i>
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
            <h2 style="color: #6f6af8;">Manage Users</h2>
            <table>
                <thead>
                    <th style="color: green; background-color:white">Uername</th>
                    <th style="color: green; background-color:white">Admin</th>
                </thead>
                <tbody style="color: white; background-color:#6f6af8">
                    <?php while($user = mysqli_fetch_assoc($users)):?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['is_admin']? 'Yes' : 'No' ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
    </div>
</section>
<?php
include '../partial/footer.php';
?>