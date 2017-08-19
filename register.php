<!doctype html>

<?php
    
    $uitgelezenFirstName = $uitgelezenLastName = $uitgelezenUserName = $uitgelezenPassword = $uitgelezenPassword2 = $uitgelezenDag = $uitgelezenMaand = $uitgelezenJaar = "";
    $uitgelezenPicture;
    $errFirstName = $errLastName = $errUserName = $errPassword = $errPassword2 = $errDag = $errMaand = $errJaar = $errPicture = "";
    
    include_once './validatiebibliotheek.php';
    include_once 'DAO/userDAO.php';
    
    if(isFormulierIngediend()){
        $errFirstName = errRequiredVeld("firstname");
        $errLastName = errRequiredVeld("lastname");
        $errUserName = errRequiredVeld("username");
        $errUserName = errVoegMeldingToe(errRequiredVeld("username"), errUserExists("username"));
        $errPassword = errRequiredVeld("password");
        $errPassword2 = errWachtwoordenNietGelijk("password", "password2");
        $errDag = errVoegMeldingToe(errVeldIsNumeriek("day"), errVeldMoetGroterDanWaarde("day", 0));
        $errDag = errVoegMeldingToe($errDag, errVeldMoetKleinerDanOfGelijkAanWaarde("day", 31));
        $errMaand = errVoegMeldingToe(errVeldIsNumeriek("month"), errVeldMoetGroterDanWaarde("month", 0));
        $errMaand = errVoegMeldingToe($errMaand, errVeldMoetKleinerDanOfGelijkAanWaarde("month", 12));
        $errJaar = errVoegMeldingToe(errVeldIsNumeriek("year"), errVeldMoetKleinerDanOfGelijkAanWaarde("year", date("Y")));
        $errJaar = errVoegMeldingToe($errJaar, errVeldMoetGroterDanWaarde("year", 1850));
        $errPicture = errFileType("profilepic");
        
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
    $uitgelezenBio = getVeldWaarde("bio");
    $uitgelezenPicture = $_FILES['profilepic'];
    }
}

    function isFormulierIngediend() {
   return isset($_POST['postcheck']);
}

    function isFormulierValid() {
    global $errFirstName, $errLastName, $errUserName, $errPassword, $errPassword2, $errGender, $errPicture;
    $allErr = $errFirstName . $errLastName . $errUserName . $errPassword . $errPassword2 . $errGender . $errPicture;
    if (empty($allErr)) {
        //Formulier is valid
        return true;
    } else {
        return false;
    }
}

    function slaWaardenOp(){
        $newUser = new User(0, getVeldWaarde("firstname"), getVeldWaarde("lastname"), getVeldWaarde("username"), getVeldWaarde("password"), getVeldWaarde("day"), getVeldWaarde("month"), getVeldWaarde("year"), getVeldWaarde("gender"), getVeldWaarde("bio"));
        UserDAO::insert($newUser);
        $user = UserDAO::getByHighestId();
        $profilePicName = $user->getUserName();
        $profilePic = $_FILES["profilepic"];
        move_uploaded_file($profilePic["tmp_name"], "img/profilePics/" . $profilePicName . ".jpg");
        setcookie('GebruikersId', $user->getUserId(), time() + 60 * 60 * 24);
    }
    
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Register - Shareclub</title>
  <link rel="icon" href="img/favincon.png" type="image/gif" sizes="128x128">
<link rel="stylesheet" href="style.css"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">

</head>

<body>
    <div class="background" id="register_background">
    <div id="white_banner">
    <div class="container">
    <h2>Register</h2>
    
    <form id="register_form" action="register.php" method="POST" enctype="multipart/form-data">
        <div class="nameblock">
  <label>First name* :</label><br>
  <input type="text" name="firstname" value="<?php echo $uitgelezenFirstName; ?>"><br>
  <h8><?php echo $errFirstName; ?></h8>
                </div><div class="nameblock">
  <label>Last name* :</label><br>
  <input type="text" name="lastname" value="<?php echo $uitgelezenLastName; ?>"><br>
  <h8><?php echo $errLastName; ?></h8>
                </div><div class="thirdblock">
        <label>Username* :</label><br>
  <input type="text" name="username" value="<?php echo $uitgelezenUserName; ?>"><br>
  <h8><?php echo $errUserName; ?></h8>
               </div><div class="thirdblock">
        <label>Password* :</label><br>
  <input type="password" name="password" value="<?php echo $uitgelezenPassword; ?>"><br>
  <h8><?php echo $errPassword; ?></h8>
                </div><div class="thirdblock">
        <label>Password again* :</label><br>
  <input type="password" name="password2" value="<?php echo $uitgelezenPassword2; ?>"><br>
  <h8><?php echo $errPassword2; ?></h8>
                </div><br>
        <label style="font-size: 0.8em;padding-top:5em">Date of Birth* :</label><br>
        <div class="thirdblock">
        <label>Day* (1-31) :</label><br>
  <input type="text" name="day" value="<?php echo $uitgelezenDag; ?>"><br>
  <h8><?php echo $errDag; ?></h8>
                </div><div class="thirdblock">
        <label>Month* (1-12) :</label><br>
  <input type="text" name="month" value="<?php echo $uitgelezenMaand; ?>"><br>
  <h8><?php echo $errMaand; ?></h8>
                </div><div class="thirdblock">
        <label>Year* (1850 - now) :</label><br>
  <input type="text" name="year"  value="<?php echo $uitgelezenJaar; ?>"><br>
   <h8><?php echo $errJaar; ?></h8><br>
                </div><br>
        <label>Gender* :</label><br>
          <input type="radio" name="gender" value="male" checked><h9>Male</h9>
  <input type="radio" name="gender" value="female"><h9>Female</h9>
  <input type="radio" name="gender" value="other"><h9>Other</h9><br>
  <div class="nameblock"><br>
  <label>Profile picture* :</label>
                <input type="file" name="profilepic"/></div>
        <div class="nameblock">
            <label>Bio :</label><br>
            <input type="text" name="bio" maxlength="100" value="<?php echo $uitgelezenBio ?>"></div>
  <input type="hidden" name="postcheck" value="true"/>
        <input type="submit" value="Submit">
</form>
    <a href="login.php"><h7>I already have an account.</h7></a>
        </div>
        </div>
        </div>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html>

<?php



?>

    
