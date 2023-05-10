<?php
include 'partial/header.php';
$category_query= "SELECT * FROM categories";
$categories = mysqli_query($connection,$category_query);
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);

}else{
    header('location:'.ROOT_URL.'admin/');
    die();
}
?>
<section class="form_section" style="background-color:hsl(242, 91%, 69%, 18%);">
    <div class="container form_section-container">
        <h2>Edit Post</h2>
        <form action="<?= ROOT_URL?>admin/edit-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?= $post['id']?>">
            <input type="hidden" name="previous_thumbnail_name"value="<?= $post['thumbnail']?>">
            <input type="text" name="title" style="color: black;"  value="<?= $post['title']?>" placeholder="Title">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id']?>"><?= $category['title']?> </option>
                <?php endwhile ?>
            </select>
           <p> <textarea style="width:100%;" rows="10" name="body"  style="color: black;" placeholder="Body"> <?= $post['body']?></textarea></p>
            <div class="form_control inline">
                <input name="is_featured" type="checkbox" id="is_featured" value="1" checked>
                <lable for="is_featured">Featured</lable>
            </div>
            <div class="form_control">
                <label for="thumbnail" >Change Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>
<?php
include '../partial/footer.php';
?>