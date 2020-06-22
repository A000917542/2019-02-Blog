<?php

class Main extends Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * http://localhost/
     */
    function Index () {
        $data = Array("title" => "Index Page");
        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("main/index");
        $this->view("template/footer");
        
    }

    function ListBlogs () {
        $data = Array("title" => "Blog Listing");
        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("blog/list/index");
        $this->view("template/footer");
    }

    function ReadBlog () {
        $data = Array("title" => "Blog Entry");
        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("blog/item/index");
        $this->view("template/footer");
    }

}

?>