<?php

function validatePost($post)

{

    $errors = array();
    if (empty($post['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Body is required');
    }

    if (empty($post['topic_id'])) {
        array_push($errors, 'Please Select a Topic First');
    }



    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost) {

        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Post with this title is Already Exist');
        }

        if (isset($post['add-post'])) {
            array_push($errors, 'Post with this title is Already Exist');
        }
    }

    return $errors;
}