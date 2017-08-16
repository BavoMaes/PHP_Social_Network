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
    <form action="doPost.php" method="POST">
  <label>What's on your mind?</label><br>
  <input type="text" name="postcontent"><br>
        <input type="submit" value="Post">
</form>
    <?php
    foreach (PostDAO::getAll() as $post) {
            echo $post->getPostTime() . "<br>";
            echo $post->getPostContent() . "<br><br>";
            
        }
        
    
        ?>
</body>
</html>


