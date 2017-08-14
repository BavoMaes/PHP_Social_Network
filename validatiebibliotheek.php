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

function isRijksregisternummerValid($naamVeld){
    //Bijvoorbeeld: 93051822361
   $rijksregisternummer = getVeldWaarde($naamVeld);
   $eersteDeel = substr($rijksregisternummer, 0,9);
   $restEersteDeel = $eersteDeel % 97;
   $berekendControleGetal = 97 - $restEersteDeel;
   $gelezenControleGetal = substr($rijksregisternummer, 9, 2);
   return ($berekendControleGetal == $gelezenControleGetal);
}

function isBankrekeningnummerValid($naamVeld){
    //Bijvoorbeeld: 57000340641970 
   $bankrekeningnummer = getVeldWaarde($naamVeld);
   $eersteDeel = substr($bankrekeningnummer, 2,10);
   $berekendControleGetal = $eersteDeel % 97;
   //Indien je problemen hebt met het valideren van je rekeningnummer => PHP_INT_MAX staat te laag ingesteld op jouw server
   //Volgende manier om de modulo te berekenen omzeilt dan het probleem:
   //$berekendControleGetal = fmod($eersteDeel, 97);
   $gelezenControleGetal = substr($bankrekeningnummer, 12, 2);
   return ($berekendControleGetal == $gelezenControleGetal && strlen($bankrekeningnummer) == 14);
}

//Error message generatie
function errRequiredVeld($naamVeld) {
    if (isVeldLeeg($naamVeld)) {
        return "Gelieve een waarde in te geven";
    } else {
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

function errVeldIsRijksregisternummer($naamVeld) {
    if (isRijksregisternummerValid($naamVeld)) {
        return "";
    } else {
        return "Geef een geldig rijksregisternummer in.";
    }
}

function errVeldIsBankrekeningnummer($naamVeld) {
    if (isBankrekeningnummerValid($naamVeld)) {
        return "";
    } else {
        return "Geef een geldig bankrekeningnummer in.";
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
