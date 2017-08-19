<?php

if (isset($_COOKIE['GebruikersId'])) {
    include_once 'DAO/postDAO.php';
    include_once './validatiebibliotheek.php';
    $userId = $_COOKIE['GebruikersId'];

    date_default_timezone_set("Europe/Brussels");

    $postwaarde = new Post(0, getVeldWaarde("postcontent"), date('Y-m-d H:i:s'), $userId);
    PostDAO::insert($postwaarde);

    header("location:index.php");


}