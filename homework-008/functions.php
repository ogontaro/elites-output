<?php

// エスケープ処理
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

// DB接続の処理
function connectDb()
{
    define('DSN', 'mysql:host=localhost;dbname=impression_homework_8;charset=utf8');
    define('USER', 'testuser');
    define('PASSWORD', '9999');

    try
    {
        return new PDO(DSN, USER, PASSWORD);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        exit;
    }
}