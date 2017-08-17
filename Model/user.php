<?php

class User {

    private $userId;
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $day;
    private $month;
    private $year;
    private $gender;

    public function getUserId() {
        return $this->userId;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }
    
    public function getUserName() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getDay() {
        return $this->day;
    }
    
    public function getMonth() {
        return $this->month;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function getGender() {
        return $this->gender;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setFirstName($firstname) {
        $this->firstname = $firstname;
    }
    
    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }
    
    public function setUserName($username) {
        $this->username = $username;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDay($day) {
        $this->day = $day;
    }
    
    public function setMonth($month) {
        $this->month = $month;
    }
    
    public function setYear($year) {
        $this->year = $year;
    }
    
    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function __construct($userId, $firstname, $lastname, $username, $password, $day, $month, $year, $gender) {
        $this->userId = $userId;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->gender = $gender;
    }

    //Extra functionaliteit kan je hier schrijven
}
