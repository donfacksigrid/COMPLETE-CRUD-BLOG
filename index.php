<?php
include 'partial/header.php';
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection,$featured_query);
$featured = mysqli_fetch_assoc($featured_result);

$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 6";
$posts= mysqli_query($connection,$query);

?> 
<?php if(mysqli_num_rows($featured_result) == 1): ?>
    <section class="featured">
        <div class="container featured_container">
        <a href="<?php echo ROOT_URL ?>post.php?id=<?= $featured['id'] ?>">
            <div class="post_thumbnail">
                <img src="./images/<?= $featured['thumbnail'] ?>">
            </div>
        </a>
            <div class="post_info">
                <?php
                $category_id=$featured['category_id'];
                $category_query="SELECT * FROM categories WHERE id=$category_id";
                $category_result=mysqli_query($connection,$category_query);
                $category= mysqli_fetch_assoc($category_result);
                ?>
            <a style="color:black;" href="<?php echo ROOT_URL ?>post.php?id=<?= $featured['id'] ?>">
                    <h2 class="post_title"  style="color: red;">
                        <?= $featured['title']?>
                    </h2>
                    <p class="post_body">
                    <?= substr($featured['body'], 0, 300)?>......
                    </p>
            </a>
            <a href="<?php echo ROOT_URL ?>post.php?id=<?= $featured['id'] ?>" 
                class="category_button" style="padding: 0.2rem;margin-top:0.1rem;">read more</a>
                <div class="post_author">
                    <?php 
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result= mysqli_query($connection,$author_query);
                    $author= mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post_author-avatar">
                        <img src="./images/profile.jpg" alt="">
                    </div>
                    <div class="post_author-info">
                    <h5>By: <?= $author['username'] ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time']))?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif ?>
    <section class="posts"<?php if(mysqli_num_rows($featured_result) == 0): ?>
        style="margin-top: 8rem;"
        <?php endif ?>>
        <div class="container posts_container">
            <?php while($post = mysqli_fetch_assoc($posts)):?>
            <article class="post">
            <a href="<?php echo ROOT_URL ?>post.php?id=<?= $post ['id']?>">
                <div class="post_thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>" alt="">
                </div>
            </a>
                <div class="post_info">
                <?php
                $category_id=$post['category_id'];
                $category_query="SELECT * FROM categories WHERE id=$category_id";
                $category_result=mysqli_query($connection,$category_query);
                $category= mysqli_fetch_assoc($category_result);
                ?>

                     <a style="color:black;" href="<?php echo ROOT_URL ?>post.php?id=<?= $post ['id']?>">

                        <h3 class="post_title">
                        <?= $post['title'] ?>
                        </h3>
                    <p class="post_body">                   
                         <?= substr($post['body'], 0, 150)?>......
                    </p>
                 </a>
                 <a href="<?php echo ROOT_URL ?>post.php?id=<?= $featured['id'] ?>" 
                class="category_button" style="padding: 0.2rem; margin-top:0.1rem;">read more</a>
                        <div class="post_author">
                        <?php 
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result= mysqli_query($connection,$author_query);
                    $author= mysqli_fetch_assoc($author_result);
                    ?>
                            <div class="post_author-avatar">
                                <img src="./images/profile.jpg" alt="">
                            </div>
                            <div class="post_author-info">
                            <h5>By: <?= $author['username'] ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($post['date_time']))?>
                        </small>
                            </div>
                        </div>
                </div>
            </article>
         
            <?php endwhile?>
        </div>
    </section>
    <section class="category_buttons">
            <div class="container category_buttons-container">
                <?php
                $all_categories_query= "SELECT*FROM categories";
                $all_categories= mysqli_query($connection,$all_categories_query)
                ?>
                <?php while($category= mysqli_fetch_assoc($all_categories)): ?>
                <a href="<?php echo ROOT_URL ?>category-post.php?id=<?= $category['id']?>"
                 class="category_button"><?= $category['title']?></a>
                <?php endwhile?>
            </div>
    </section>
<?php
include 'partial/footer.php';
?>