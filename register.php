<!doctype html>

<?php
    
    $uitgelezenFirstName = $uitgelezenLastName = $uitgelezenUserName = $uitgelezenPassword = $uitgelezenPassword2 = $uitgelezenGender = "";
    
    $uitgelezenFirstName = $_POST["firstname"];
    $uitgelezenLastName = $_POST["lastname"];
    $uitgelezenUserName = $_POST["username"];
    $uitgelezenPassword = $_POST["password"];
    $uitgelezenPassword2 = $_POST["password2"];
    $uitgelezenGender = $_POST["gender"];
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Register</title>

<link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>

<body>
    <h2>Register</h2>
    <b>* = required field</b>
    <form action="register.php" method="POST">
  First name* :<br>
  <input type="text" name="firstname"><br>
  Last name* :<br>
  <input type="text" name="lastname"><br>
        Username* :<br>
  <input type="text" name="username"><br>
        Password* :<br>
  <input type="password" name="password"><br>
        Password again* :<br>
  <input type="password" name="password2"><br>
        Date of Birth:<br>
        Day (1-31):
  <input type="text" name="day"><br>
        Month (1-12):
  <input type="text" name="month"><br>
        Year:
  <input type="text" name="year"><br>
        Gender* :<br>
          <input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other<br>
        <input type="submit" value="Submit">
</form>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html>

<?php



?>

    
