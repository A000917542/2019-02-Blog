<?php

class Main extends Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * http://localhost/
     */
    function Index () {
        
        $this->model('blogmodel');

        $version = $this->blogmodel->DBVersion();

        $data = Array("title" => "Index Page", "version" => $version);

        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("main/index", $data);
        $this->view("template/footer");
        
    }

    

}

?>