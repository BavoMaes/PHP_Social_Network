<!doctype html>

<?php
    
    $uitgelezenFirstName = $uitgelezenLastName = $uitgelezenUserName = $uitgelezenPassword = $uitgelezenPassword2 = $uitgelezenDag = $uitgelezenMaand = $uitgelezenJaar = "";
    $errFirstName = $errLastName = $errUserName = $errPassword = $errPassword2 = $errDag = $errMaand = $errJaar = "";
    
    include_once './validatiebibliotheek.php';
    include_once 'DAO/userDAO.php';
    
    if(isFormulierIngediend()){
        $errFirstName = errRequiredVeld("firstname");
        $errLastName = errRequiredVeld("lastname");
        $errUserName = errRequiredVeld("username");
        $errPassword = errRequiredVeld("password");
        $errPassword2 = errWachtwoordenNietGelijk("password", "password2");
        $errDag = errVoegMeldingToe(errVeldIsNumeriek("day"), errVeldMoetGroterDanWaarde("day", 0));
        $errDag = errVoegMeldingToe($errDag, errVeldMoetKleinerDanOfGelijkAanWaarde("day", 31));
        $errMaand = errVoegMeldingToe(errVeldIsNumeriek("month"), errVeldMoetGroterDanWaarde("month", 0));
        $errMaand = errVoegMeldingToe($errMaand, errVeldMoetKleinerDanOfGelijkAanWaarde("month", 12));
        $errJaar = errVoegMeldingToe(errVeldIsNumeriek("year"), errVeldMoetKleinerDanOfGelijkAanWaarde("year", date("Y")));
        $errJaar = errVoegMeldingToe($errJaar, errVeldMoetGroterDanWaarde("year", 1850));
        
    if(isFormulierValid()){
        slaWaardenOp();
        header("location:index.php");
    }
    else {
      $uitgelezenFirstName = getVeldWaarde("firstname");
    $uitgelezenLastName = getVeldWaarde("lastname");
    $uitgelezenUserName = getVeldWaarde("username");
    $uitgelezenPassword = getVeldWaarde("password");
    $uitgelezenPassword2 = getVeldWaarde("password2");
    $uitgelezenDag = getVeldWaarde("day");
    $uitgelezenMaand = getVeldWaarde("month");
    $uitgelezenJaar = getVeldWaarde("year");
    $uitgelezenGender = getVeldWaarde("gender"); 
    }
}

    function isFormulierIngediend() {
   return isset($_POST['postcheck']);
}

    function isFormulierValid() {
    global $errFirstName, $errLastName, $errUserName, $errPassword, $errPassword2, $errGender;
    $allErr = $errFirstName . $errLastName . $errUserName . $errPassword . $errPassword2 . $errGender;
    if (empty($allErr)) {
        //Formulier is valid
        return true;
    } else {
        return false;
    }
}

    function slaWaardenOp(){
        $newUser = new User(0, getVeldWaarde("firstname"), getVeldWaarde("lastname"), getVeldWaarde("username"), getVeldWaarde("password"), getVeldWaarde("day"), getVeldWaarde("month"), getVeldWaarde("year"), getVeldWaarde("gender"));
        UserDAO::insert($newUser);
        $user = UserDAO::getByHighestId();
        $profilePicName = $user->getUserId();
        $profilePic = $_FILES["profilepic"];
        move_uploaded_file($profilePic["tmp_name"], "img/profilePics/" . $profilePicName . ".jpg");
        setcookie('GebruikersId', $user->getUserId(), time() + 60 * 60 * 24);
    }
    
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
  <input type="text" name="firstname" value="<?php echo $uitgelezenFirstName; ?>"><br>
  <mark><?php echo $errFirstName; ?></mark>
                <br>
  Last name* :<br>
  <input type="text" name="lastname" value="<?php echo $uitgelezenLastName; ?>"><br>
  <mark><?php echo $errLastName; ?></mark>
                <br>
        Username* :<br>
  <input type="text" name="username" value="<?php echo $uitgelezenUserName; ?>"><br>
  <mark><?php echo $errUserName; ?></mark>
                <br>
        Password* :<br>
  <input type="password" name="password" value="<?php echo $uitgelezenPassword; ?>"><br>
  <mark><?php echo $errPassword; ?></mark>
                <br>
        Password again* :<br>
  <input type="password" name="password2" value="<?php echo $uitgelezenPassword2; ?>"><br>
  <mark><?php echo $errPassword2; ?></mark>
                <br>
        Date of Birth:<br>
        Day (1-31):
  <input type="text" name="day" value="<?php echo $uitgelezenDag; ?>"><br>
  <mark><?php echo $errDag; ?></mark>
                <br>
        Month (1-12):
  <input type="text" name="month" value="<?php echo $uitgelezenMaand; ?>"><br>
  <mark><?php echo $errMaand; ?></mark>
                <br>
        Year:
  <input type="text" name="year"  value="<?php echo $uitgelezenJaar; ?>"><br>
   <mark><?php echo $errJaar; ?></mark>
                <br>
        Gender* :<br>
          <input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other<br>
  <label for="bestand">Profile picture:
                <input type="file" name="profilepic"/>
  </label><br>
  <input type="hidden" name="postcheck" value="true"/>
        <input type="submit" value="Submit">
</form>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html>

<?php



?>

    
