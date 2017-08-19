<?php

include_once 'Model/user.php';
include_once 'DAO/Verbinding/databaseFactory.php';

class UserDAO {
    private static function getVerbinding() {
        return databaseFactory::getDatabase();
    }

public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Users");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    
        public static function getByUserName($username) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Users WHERE UserName='?'", array($username));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
        public static function getById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Users WHERE UserID='?'", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
        public static function getByHighestId() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Users ORDER BY UserID DESC LIMIT 1");
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
    protected static function converteerRijNaarObject($databaseRij) {
        return new User($databaseRij['UserID'], $databaseRij['FirstName'], $databaseRij['LastName'], $databaseRij['UserName'], $databaseRij['Password'], $databaseRij['Day'], $databaseRij['Month'], $databaseRij['Year'], $databaseRij['Gender'], $databaseRij['Bio']);
    }
    
    public static function insert($post) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Users(UserID, FirstName, LastName, UserName, Password, Day, Month, Year, Gender, Bio) VALUES ('?','?','?','?','?','?','?','?','?','?')", array($post->getUserId(), $post->getFirstName(), $post->getLastName(), $post->getUserName(), $post->getPassword(), $post->getDay(), $post->getMonth(), $post->getYear(), $post->getGender(), $post->getBio()));
    }
    
    }

?>

