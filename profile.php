<?php

//Check if the cookie exists. If so, check if the cookie is correct.

$cookie = $_COOKIE['GebruikersId'];

if (isset($cookie)) {

    include_once 'DAO/userDAO.php';
    include_once 'DAO/postDAO.php';
    
    if (UserDAO::getById($cookie) != false) {
        $user = UserDAO::getById($cookie);
    } else {
        header("location:login.php");
    }
    
    //Check if the ProfileId is given. If not, show the current user's profile.
    
    if (isset($_GET['ProfileId'])) {
        $profileGet = $_GET['ProfileId'];
        if (UserDAO::getById($profileGet) != false) { 
            $profile = UserDAO::getById($profileGet);
            
        } else {
            $profile = $user;
        }
    } else {
        $profile = $user;
    }
    
} else {
    header("location:login.php");
}

//Save the profile values locally.
$username = $profile->getUserName();
$firstname = $profile->getFirstName();
$lastname = $profile->getLastName();
$userId = $profile->getUserId();
$gender = $profile->getGender();
$bio = $profile->getBio();
$day = $profile->getDay();
$month = $profile->getMonth();
$year = $profile->getYear();
?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title><?php echo $username . ' - Shareclub' ?></title>
  <link rel="icon" href="img/favincon.png" type="image/gif" sizes="128x128">
  <link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>
<body>
      <nav>
    <div class="container">
    <div id="logo_container">
        <a href="index.php"><img id="nav_logo" alt="Social Network Logo" src="img/s_logo.png"></a></div>
        <a href="logout.php"><div class="profile_button">
        <h6>Log Out</h6></div></a> 
        <a href="profile.php"><div class="profile_button">
            <h6>Welcome</h6>
            <h5><?php echo $user->getFirstName(); ?></h5>
             <img id="profile_pic" src="img/profilePics/<?php echo $user->getUserName(); ?>.jpg">
        </div></a> 
        
        </div>
  </nav>
    <div id="nav_clear"></div>
    <div class="container">
    <div id="page_container">
        <div class="profile">
        <div class="profileinfo">
        <img class="post_profile_pic" src="img/profilePics/<?php echo $username;?>.jpg">
            <h3 style="font-size:1em"><?php echo $day . '-' . $month . '-' . $year;?></h3></div> 
        <div class="profiletext">        
            <h4><?php echo $username; ?></h4><h3><i><?php echo $gender; ?></i></h3><h3><?php echo $firstname . ' ' . $lastname;?></h3>
        <p><?php echo $bio; ?></p>
        
        </div>
        </div>
         <div style="clear:both"></div>
        
        <?php
        //Only show the posts of the user wich profile where on.
    foreach (PostDAO::getByUserId($userId) as $post) { 
        $postUserId = $post->getUserId();
        $postUser = UserDAO::getById($postUserId);
?>
        <div class="post">
        <div class="postinfo">
            <img class="post_profile_pic" src="img/profilePics/<?php echo $postUser->getUserName();?>.jpg">
            <h3><?php echo $post->getPostTime();?>
            </h3></div> 
        <div class="text">        
        <?php echo '<h4><a href="profile.php?ProfileId=' . $postUser->getUserId() . '">' . $postUser->getUserName() . '</a></h4>';
            echo '<p>' . $post->getPostContent() . '</p>';
        if(file_exists('img/postPics/' . $post->getPostId() . '.jpg')){
            echo '<img src="img/postPics/' . $post->getPostId() . '.jpg">';
            }
            
          echo '</div></div>';
    }
?>
        
        </div>
    </div>
</body>
</html>