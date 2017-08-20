<?php
//Check if the cookie exists. If so, get the users information.
if (isset($_COOKIE['GebruikersId'])){
    include_once 'DAO/userDAO.php';
    $cookie = $_COOKIE['GebruikersId'];
    if(UserDAO::getById($cookie) != false){
        $user = UserDAO::getById($cookie);
        $username = $user->getUserName();
        $firstname = $user->getFirstName();
        $userId = $user->getUserId();
        include_once 'DAO/postDAO.php';
        date_default_timezone_set("Europe/Brussels");
        } else {
            header("location:login.php");
        }
} else {
    header("location:login.php");
}


?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Shareclub</title>
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
             <h5><?php echo $firstname ?></h5>
            <img id="profile_pic" src="img/profilePics/<?php echo $username; ?>.jpg">
        </div></a> 
        </div>
  </nav>
    <div id="nav_clear"></div>
    <div class="container">
    <div id="page_container">
    <form id="post" action="doPost.php" method="POST" enctype="multipart/form-data">
        <textarea name="postcontent" placeholder="How was your day, <?php echo $firstname ?>?" rows="3" maxlength="200"></textarea>
        <input type="file" name="postpic"/>
        <input type="submit" value="Submit">
        <div style="clear: both;"></div>
    </form>
        <?php
        //Get each post and load it in one by one.
    foreach (PostDAO::getAll() as $post) { 
        
        $postUserId = $post->getUserId();
            $postUser = UserDAO::getById($postUserId);
?>
        <div class="post">
        <div class="postinfo">
            <img class="post_profile_pic" src="img/profilePics/<?php
        echo $postUser->getUserName();
        ?>.jpg">
            <h3><?php
            echo $post->getPostTime();
            ?>
            </h3></div> 
        <div class="text">        
                    <?php echo '<h4><a href="profile.php?ProfileId=' . $postUser->getUserId() . '">';
            echo $postUser->getUserName();
            ?>
                </a></h4>
        <p>
        <?php
        echo $post->getPostContent();
        ?>
        </p>
        <?php
        if(file_exists('img/postPics/' . $post->getPostId() . '.jpg')){
            echo '<img src="img/postPics/' . $post->getPostId() . '.jpg">';
                    }
        
        ?>
        </div>
            <div style="clear:both"></div>
        </div>
            
        <?php   
        }
        ?>
    </div>
    </div>
</body>
</html>


