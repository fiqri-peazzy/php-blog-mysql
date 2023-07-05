<?php
include("path.php");
// include(ROOT_PATH . "/app/databases/db.php");
include(ROOT_PATH . "/app/controllers/topics.php");


$posts = array();

$postTitle = 'Recent Posts';

if (isset($_GET['t_id'])) {
    $posts = getPostByTopicID($_GET['t_id']);
    $postTitle = "Hasil Pencarian untuk topic '" . $_GET['name'] . "'";
} else if (isset($_POST['search-term'])) {
    $postTitle = "Hasil Pencarian untuk '" . $_POST['search-term'] . "'";
    $posts = searchPost($_POST['search-term']);
} else {
    $posts = getPublishedPost();
}




?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- styling -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Candal|Lora">


    <title>blog</title>

</head>

<body>

    <?php include("includes/header.php"); ?>

    <?php include(ROOT_PATH . "/includes/messages.php"); ?>

    <!-- page wrapper -->
    <div class="page-wrapper">
        <!-- page slider -->
        <div class="post-slider">
            <h1 class="slider-title">Trending Post</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>
            <div class="post-wrapper">

                <?php foreach ($posts as $post) :  ?>
                <div class="post clear">
                    <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="slider-image" alt="">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></h4>
                        <i class="far fa-user"></i> <?php echo $post['username'] ?>
                        &nbsp;
                        <i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($post['created_at'])); ?>

                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- page slider end -->
        <div class="content clearfix">

            <div class="main-content">
                <h1 class="recent-post-title"><?php echo $postTitle; ?></h1>
                <?php foreach ($posts as $post) :  ?>
                <div class="post clearfix">
                    <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="post-image" alt="">
                    <div class="post-preview">
                        <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></h2>
                        <i class="far fa-user"></i> <?php echo $post['username'] ?>
                        &nbsp;
                        |
                        &nbsp;
                        <i class="far fa-calendar"></i>
                        <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...') ?>
                        </p>
                        <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read more</a>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
            <!-- Main content -->

            <!-- sidebar -->
            <div class="sidebar">

                <div class="section search">
                    <h2 class="section-title">Search</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Search" id="">
                    </form>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $key) : ?>
                        <li><a
                                href="<?php echo BASE_URL . "/index.php?t_id=" . $key['id'] . '&name=' . $key['name'] ?>"><?= $key['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- footer -->

    </div>
    <?php include("includes/footer.php"); ?>
</body>

</html>