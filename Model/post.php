<?php

class Post {

    private $postId;
    private $postContent;
    private $postTime;
    private $userId;

    public function getPostId() {
        return $this->postId;
    }

    public function getPostContent() {
        return $this->postContent;
    }

    public function getPostTime() {
        return $this->postTime;
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setPostContent($postContent) {
        $this->postContent = $postContent;
    }

    public function setPostTime($postTime) {
        $this->postTime = $postTime;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function __construct($postId, $postContent, $postTime, $userId) {
        $this->postId = $postId;
        $this->postConent = $postContent;
        $this->postTime = $postTime;
        $this->userId = $userId;
    }

    //Extra functionaliteit kan je hier schrijven
}
