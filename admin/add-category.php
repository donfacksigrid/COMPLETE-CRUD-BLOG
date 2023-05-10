<?php
include 'partial/header.php';
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>
<section class="form_section" style="background-color:hsl(242, 91%, 69%, 18%);">
    <div class="container form_section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION['add-category'])) :?>
        <div class="alert_message error">
            <p><?= $_SESSION['add-category'];
            unset($_SESSION['add-category'])?></p>
        </div>
        <?php endif?>
        <form action="<?= ROOT_URL?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title?>" name="title" placeholder="Title" style="color: black;" >
            <textarea  rows="4" name="description" value="<?= $description?>" placeholder="Description" style="color: black;"></textarea>
            <button type="submit" name="submit" class="btn">Add category</button>
        </form>
    </div>
</section>
<?php
include '../partial/footer.php';
?>