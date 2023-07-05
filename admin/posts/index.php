<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");

adminOnly();
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
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <!-- Google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Candal|Lora">

    <title>Admin section - Manage Post</title>
</head>

<body>
    <!-- Admin Header start -->
    <?php include(ROOT_PATH . "/includes/admin_header.php"); ?>
    <!--admin page wrapper -->
    <div class="admin-wrapper">
        <!-- left sidebar -->
        <?php include(ROOT_PATH . "/includes/adminSidebar.php"); ?>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add Post</a>
                <a href="index.php" class="btn btn-big">Manage Post</a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Post</h2>

                <?php include(ROOT_PATH . "/includes/messages.php"); ?>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($posts as $post) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?php echo $post['title']; ?></td>
                            <td>Peazzy</td>
                            <td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                            <td><a href="index.php?id_delete=<?php echo $post['id']; ?>" class="delete">delete</a></td>

                            <?php if ($post['published']) : ?>
                            <td><a href="edit.php?published=0&p_id=<?php echo $post['id']; ?>"
                                    class="unpublish">unpublish</a>
                            </td>
                            <?php else : ?>
                            <td><a href="edit.php?published=1&p_id=<?php echo $post['id']; ?>"
                                    class="publish">publish</a></td>
                            <?php endif; ?>

                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  end left sidebar -->
    </div>
    <!--  end left sidebar -->
    </div>
    <!-- page wrapper end -->
    <!-- jquery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <!-- custom js -->
    <script src="../../assets/js/scripts.js"></script>

</body>

</html>