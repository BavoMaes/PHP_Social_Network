<?php

include_once 'DAO/postDAO.php';

?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Home</title>
  <link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>
<body>
      <nav>
    <div class="container">
    <div id="logo_container">
 <img id="nav_logo" alt="Social Network Logo" src="s_logo.png"></div>
        
        <div id="profile_button">
            <h6>Welcome</h6>
             <h5>Bavo</h5>
        <div id="profile_pic"></div>
        
       
        
        </div>
        </div>
  </nav>
    <div id="nav_clear"></div>
    <div class="container">
    <div id="page_container">
    <form id="post" action="doPost.php" method="POST">
        <textarea name="postcontent" placeholder="How was your day, Bavo?" rows="3" maxlength="200"></textarea>
        <input type="submit" value="Submit">
    </form>
        <?php
    foreach (PostDAO::getAll() as $post) {
            echo $post->getPostTime() . "<br>";
            echo $post->getPostContent() . "<br><br>";
            
        }
        
    
        ?>
    </div>
    </div>
</body>
</html>


