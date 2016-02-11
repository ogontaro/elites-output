<?php
require_once 'functions.php';
require_once 'user_mapper.php';
require_once 'user.php';

if (isset($_GET['id'])) {
    $user_mapper = new UserMapper(connectDatabase());
    $user = $user_mapper->findByID($_GET['id']);
    if ($user == false || is_null($user->getImageFile())) {
        header("Content-type: image/jpeg");
        readfile('dummy.jpg');
    } else {
        header("Content-type: " . $user->getImageType());
        echo $user->getImageFile();
    }
} else {
    header("Content-type: image/jpeg");
    readfile('dummy.jpg');
}


