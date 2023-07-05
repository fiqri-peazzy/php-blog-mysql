<?php

function validateTopic($topic)

{

    $errors = array();
    if (empty($topic['name'])) {
        array_push($errors, 'Name is required');
    }

    // $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    // if ($existingTopic) {
    //     array_push($errors, 'Name Already Exist');
    // }
    $existingtopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingtopic) {

        if (isset($topic['update-topic']) && $existingtopic['id'] != $topic['id']) {
            array_push($errors, 'Name Already Exist');
        }

        if (isset($topic['add-topic'])) {
            array_push($errors, 'Name Already Exist');
        }
    }
    return $errors;
}