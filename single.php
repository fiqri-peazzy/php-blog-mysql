<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");



if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
}

$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/4f34e4c75f.js" crossorigin="anonymous"></script>

    <!-- styling -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Candal|Lora">


    <title><?php echo $post['title']; ?> | PeazzyBlog</title>

</head>

<body>
    <!-- facebook page plugin js -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v15.0"
        nonce="ksNx1y6o"></script>
    <!-- facebook page plugin js end -->

    <?php include("includes/header.php"); ?>

    <!-- page wrapper -->
    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="main-content-wrapper">
                <div class="main-content single">
                    <h1 class="post-title"><?php echo $post['title']; ?></h1>
                    <div class="post-content">
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <!-- sidebar -->
            <div class="sidebar single">
                <div class="fb-page fb embedfb" data-href="https://www.facebook.com/fiqriawann/" data-tabs="timeline"
                    data-width="500" data-height="" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/fiqriawann/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/fiqriawann/">Peazzy FF</a>
                    </blockquote>
                </div>
                <div class="section popular">
                    <h2 class="section-title"> Popular </h2>

                    <?php foreach ($posts as $p) : ?>
                    <div class="post clearfix">
                        <img src="<?php echo BASE_URL . "/assets/images/" . $p['image']; ?>" alt="">
                        <a href="single.php?id=<?php echo $p['id']; ?>" class="title">
                            <h4><?php echo $p['title']; ?></h4>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $topic) : ?>
                        <li><a
                                href="<?php echo BASE_URL . "/index.php?t_id=" . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include("includes/footer.php"); ?>

</body>

</html>