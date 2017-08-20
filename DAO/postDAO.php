<?php

include_once 'Model/post.php';
include_once 'DAO/Verbinding/databaseFactory.php';

class PostDAO {
    private static function getVerbinding() {
        return databaseFactory::getDatabase();
    }

public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Posts ORDER BY PostTime DESC");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    
        public static function getByHighestId() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Posts ORDER BY PostID DESC LIMIT 1");
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
    public static function getByUserId($user) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Posts WHERE UserID='?' ORDER BY PostID DESC", array($user));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    
    protected static function converteerRijNaarObject($databaseRij) {
        return new Post($databaseRij['PostID'], $databaseRij['PostContent'], $databaseRij['PostTime'], $databaseRij['UserID']);
    }
    
    public static function insert($post) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Posts(PostID, PostContent, PostTime, UserID) VALUES ('?','?','?','?')", array($post->getPostid(), $post->getPostContent(), $post->getPostTime(), $post->getUserId()));
    }
    
    }

?>

