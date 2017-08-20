<?php
//Check if cookie exists. If so, insert the new Post into the database using the users credentials.
if (isset($_COOKIE['GebruikersId'])) {
    include_once 'DAO/postDAO.php';
    include_once './validatiebibliotheek.php';
    $userId = $_COOKIE['GebruikersId'];

    date_default_timezone_set("Europe/Brussels");

    $postwaarde = new Post(0, getVeldWaarde("postcontent"), date('Y-m-d H:i:s'), $userId);
    PostDAO::insert($postwaarde);
    //Get the PostID of the new Post
    $postwaarde = PostDAO::getByHighestId();
    //The PostID is unique for that post, so the image gets named after the PostID. 
    $postPicName = $postwaarde->getPostId();
    $postPic = $_FILES["postpic"];
    move_uploaded_file($postPic["tmp_name"], "img/postPics/" . $postPicName . ".jpg");

    header("location:index.php");


}