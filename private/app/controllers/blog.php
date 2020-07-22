<?php

class Blog extends Controller {
    function Index () {
        
        $this->model('blogmodel');

        $version = $this->blogmodel->DBVersion();

        $data = Array("title" => "Index Page", "version" => $version);

        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("main/index", $data);
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

    function CreateBlog() {
            echo($_SERVER["REQUEST_METHOD"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = htmlentities($_POST["title"]);
            $content = htmlentities($_POST["content"]);

            $this->model("blogmodel");
            $this->blogmodel->createPost($title, $content);
        } else {
            $data = Array("title" => "Blog Entry");
            $this->view("template/header", $data);
            $this->view("template/menu", $data);
            $this->view("blog/create/index");
            $this->view("template/footer");
        }
    }
}


?>