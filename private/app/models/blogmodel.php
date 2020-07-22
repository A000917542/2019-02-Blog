<?php

class BlogModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function DbVersion() {
        $sql = 'SELECT VERSION()';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch();

        return $res;
    }

    function createPost($title, $content) {
        $sql = "INSERT INTO `blog` (title, content) VALUES (:title, :content)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array("title"=>$title, "content"=>$content));
    }

}


?>