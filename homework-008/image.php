<?php
require_once 'functions.php';
require_once 'post_mapper.php';
require_once 'post.php';

if (isset($_GET['id'])) {
    $post_mapper = new PostMapper(connectDb());
    $post = $post_mapper->findByID($_GET['id']);
    if ($post == false || is_null($post->getImageFile())) {
        header("HTTP/1.1 404 Not Found");
        echo "Image Not Found";
    } else {
        header("Content-type: " . $post->getImageType());
        echo $post->getImageFile();
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Image Not Found";
}


