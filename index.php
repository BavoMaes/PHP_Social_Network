<?php
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

  <title>Home</title>
  <link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>
<body>
      <nav>
    <div class="container">
    <div id="logo_container">
 <img id="nav_logo" alt="Social Network Logo" src="img/s_logo.png"></div>
        
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
    <form id="post" action="doPost.php" method="POST">
        <textarea name="postcontent" placeholder="How was your day, <?php echo $firstname ?>?" rows="3" maxlength="200"></textarea>
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


