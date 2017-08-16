<?php

include_once 'DAO/postDAO.php';
include_once './validatiebibliotheek.php';

date_default_timezone_set("Europe/Brussels");

$postwaarde = new Post(0, getVeldWaarde("postcontent"), date('Y-m-d H:i:s'), 1);
PostDAO::insert($postwaarde);

header("location:index.php");
