<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Login</title>

<link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>

<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
  <label>Username:</label><br>
  <input type="text" name="username"><br>
  <label>Password:</label><br>
  <input type="password" name="password"><br>
        <input type="submit" value="Login">
</form>
    <a href="register.php"><p>Create an account</p></a>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html>

