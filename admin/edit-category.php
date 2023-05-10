<?php
include 'partial/header.php';
if($_GET['id']){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id =$id";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result)==1){
        $category = mysqli_fetch_assoc(($result));
    }


}
else{
    header('location:'.ROOT_URL.'admin/manage-categories');
    die();
}
?>
   <section class="form_section" style="background-color:hsl(242, 91%, 69%, 18%);">
    <div class="container form_section-container">
        <h2>Edit Category</h2>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="post">
        <input type="hidden" name="id" value="<?= $category['id'] ?>" >
            <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title" style="color: black;">
            <textarea  rows="4" name="description" placeholder="Description" style="color: black;"><?= $category['description'] ?> </textarea>
            <button type="submit" name="submit" class="btn">Update category</button>
        </form>
    </div>
</section>
<?php
include '../partial/footer.php';
?>