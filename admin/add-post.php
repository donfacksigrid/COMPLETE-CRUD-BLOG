<?php
include 'partial/header.php';

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection,$query);
?>
<section class="form_section" style="background-color:hsl(242, 91%, 69%, 18%);">
    <div class="container form_section-container">
        <h2>Add Post</h2>
        <?php if(isset($_SESSION['add-post'])) :?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" placeholder="Title" style="color: black;">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) :?>
                <option value="<?= $category['id']?>"><?= $category['title']?></option>
                <?php endwhile ?>
            </select>
          <p><textarea style="width: 100%;"  rows="10" name="body" placeholder="Body"></textarea></p>
            <div class="form_control inline">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                <lable for="is_featured">Featured</lable>
            </div>
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>
<script src="<?php echo ROOT_URL ?>js/main.js"></script>
</body>
</html>