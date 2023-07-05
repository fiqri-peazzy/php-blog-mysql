<?php


include(ROOT_PATH . "/app/databases/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");


$table = 'posts';

$topics = selectAll('topics');
$posts = selectAll($table);

$errors = array();

$id = '';
$title = '';
$body = '';
$topic_id = '';
$published = '';

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
}

if (isset($_GET['id_delete'])) {
    adminOnly();
    $count = deleteF($table, $_GET['id_delete']);
    $_SESSION['message'] = "Post Deleted Succesfully";
    $_SESSION['type'] = 'success';
    header('Location:' . BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $publish = $_GET['published'];
    $p_id = $_GET['p_id'];

    $count = update($table, $p_id, ['published' => $publish]);

    $_SESSION['message'] = "Post Published State Succesfully";
    $_SESSION['type'] = 'success';
    header('Location:' . BASE_URL . "/admin/posts/index.php");
    exit();
}



if (isset($_POST['add-post'])) {
    adminOnly();
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image;

        $results = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($results) {
            $_POST['image'] = $image;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
        array_push($errors, 'Post Image Required');
    }

    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] =  htmlentities($_POST['body']);

        $post_id = create($table, $_POST);

        $_SESSION['message'] = "Post Created Succesfully";
        $_SESSION['type'] = 'success';
        header('Location:' . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

if (isset($_POST['update-post'])) {
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image;

        $results = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($results) {
            $_POST['image'] = $image;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
        array_push($errors, 'Post Image Required');
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] =  htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);


        $_SESSION['message'] = "Post Updated Succesfully";
        $_SESSION['type'] = 'success';
        header('Location:' . BASE_URL . "/admin/posts/index.php");
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}