<?php

include_once './validatiebibliotheek.php';
include_once 'DAO/userDAO.php';
//Check if cookie exists. If it exists, the user doesn't have to login.
if (isset($_COOKIE["GebruikersId"])){
    
    if (UserDAO::getById($_COOKIE['GebruikersId']) != false) {
        header("Location:index.php");
    }
}

$usernameVal = $passwordVal = $matchingPassword = "";
$errUser = $errPassword = "";

$msgUser = "This user doesn't exist.";
$msgPassword = "The password is incorrect.";

if(isFormulierIngediend()){
    $usernameVal = getVeldWaarde("username");
    $passwordVal = getVeldWaarde("password");
    //Check if the user exists. If so, fetch his password.
    if($resultaat = UserDAO::getByUserName($usernameVal)){
    $matchingPassword = $resultaat->getPassword();
    //Check if the password is correct and not empty. If so, set a new cookie.
    if($matchingPassword === $passwordVal && !empty($passwordVal)){
        setcookie('GebruikersId', $resultaat->getUserId(),time()+60*60*24);
        header("location:index.php");
    }else{
       $errPassword = $msgPassword;
    }
    }else{
        $errUser = $msgUser;
    }
}
    
function isFormulierIngediend() {
   return isset($_POST['postcheck']);
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Login - Shareclub</title>
  <link rel="icon" href="img/favincon.png" type="image/gif" sizes="128x128">
<link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>

<body>
    <div class="background" id="login_background">
    <div id="white_banner">
    <div class="container">
    <h2>Login</h2>
    <form id="login_form" action="login.php" method="POST">
  <label>Username:</label><br>
  <input type="text" name="username" value="<?php echo $usernameVal; ?>"><br>
  <h8><?php echo $errUser; ?></h8><br>
  <label>Password:</label><br>
  <input type="password" name="password"><br>
  <h8><?php echo $errPassword; ?></h8><br>
  <input type="hidden" name="postcheck" value="true"/>
        <input type="submit" value="Login">
</form>
    <a href="register.php"><h7>Create an account</h7></a>
    </div>
        </div>
        <img id="logo" src="img/shareclub.png">
        </div>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html>

