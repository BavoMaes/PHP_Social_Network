<?php

function getVeldWaarde($naamVeld) {
    return $_POST[$naamVeld];
}

//Logische tests
function isVeldLeeg($naamVeld) {
    $waarde = getVeldWaarde($naamVeld);
    return empty($waarde);
}

function isEenVanDezeVeldenIngevuld($naamVeld1, $naamVeld2){
    return (!isVeldLeeg($naamVeld1) || !isVeldLeeg($naamVeld2));
}

function isVeldGroterDan($naamVeld, $waarde) {
    return (getVeldWaarde($naamVeld) > $waarde);
}

function isVeldKleinerDanOfGelijkAan($naamVeld, $waarde) {
    return (getVeldWaarde($naamVeld) <= $waarde);
}

function isVeldNumeriek($naamVeld) {
    return is_numeric(getVeldWaarde($naamVeld));
}

function isFirstNameValid($naamVeld){
    $uitgelezenFirstName = getVeldWaarde("firstname");
}

function zijnWachtwoordenGelijk($naamveld1, $naamveld2){
    $wachtwoord1 = getVeldWaarde($naamveld1);
    $wachtwoord2 = getVeldWaarde($naamveld2);
    if($wachtwoord1 === $wachtwoord2){
        return true;
    }
    else{
        return false;
    }
}

function bestaatGebruiker($naamVeld){
    include_once 'DAO/userDAO.php';
    if(UserDAO::getByUserName(getVeldWaarde($naamVeld))){
        return true;
    }else{
        return false;
    }
}

function pictureType($picture){
    if(isset($_FILES[$picture])){ 
    $photo = $_FILES[$picture];
    $file_ext = strtolower(end(explode('.',$photo['name'])));
    return ($file_ext == 'jpg');
    }else{
        return false;
    }
}

//Error message generatie
function errRequiredVeld($naamVeld) {
    if (isVeldLeeg($naamVeld)) {
        return "Gelieve een waarde in te geven";
    } else {
        return "";
    }
}

function errFileType($picture){
    if(pictureType($picture)){
        return "";
    }else{
        return "Please upload a .jpg image.";
    }
}

function errUserExists($naamveld){
    if(bestaatGebruiker($naamveld)) {
        return "Username is already in use.";
    } else{
        return "";
    }
}

function errEenVanDezeVeldenIsIngevuld($naamVeld1, $naamVeld2){
    if (!isEenVanDezeVeldenIngevuld($naamVeld1, $naamVeld2)){
        return "Gelieve een van deze velden in te vullen aub.";
    }
    return "";
}

function errVeldMoetGroterDanWaarde($naamVeld, $waarde) {
    if (isVeldGroterDan($naamVeld, $waarde)) {
        return "";
    } else {
        return "Waarde moet groter zijn dan " . $waarde . ".";
    }
}

function errVeldMoetKleinerDanOfGelijkAanWaarde($naamVeld, $waarde) {
    if (isVeldKleinerDanOfGelijkAan($naamVeld, $waarde)) {
        return "";
    } else {
        return "Waarde moet kleiner dan of gelijk zijn aan " . $waarde . ".";
    }
}


function errWachtwoordenNietGelijk($naamVeld1, $naamVeld2){
    if(!zijnWachtwoordenGelijk($naamVeld1, $naamVeld2)){
        return "De wachtwoorden zijn niet gelijk";
    }
      else{
        return "";  
      }
}

function errVeldIsNumeriek($naamVeld) {
    if (isVeldNumeriek($naamVeld)) {
        return "";
    } else {
        return "Waarde moet numeriek zijn";
    }
}

function errVoegMeldingToe($huidigeErrMelding, $toeTeVoegenErrMelding) {
    if (empty($huidigeErrMelding)) {
        return $toeTeVoegenErrMelding;
    } else {
        if (empty($toeTeVoegenErrMelding)) {
            return $huidigeErrMelding;
        } else {
            return $huidigeErrMelding . "<br>" . $toeTeVoegenErrMelding;
        }
    }
}

?>
