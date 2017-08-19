<?php

if (isset($_COOKIE['GebruikersId'])) {
    include_once 'DAO/postDAO.php';
    include_once './validatiebibliotheek.php';
    $userId = $_COOKIE['GebruikersId'];

    date_default_timezone_set("Europe/Brussels");

    $postwaarde = new Post(0, getVeldWaarde("postcontent"), date('Y-m-d H:i:s'), $userId);
    PostDAO::insert($postwaarde);
    $postwaarde = PostDAO::getByHighestId();
    $postPicName = $postwaarde->getPostId();
    $postPic = $_FILES["postpic"];
    move_uploaded_file($postPic["tmp_name"], "img/postPics/" . $postPicName . ".jpg");

    header("location:index.php");


}