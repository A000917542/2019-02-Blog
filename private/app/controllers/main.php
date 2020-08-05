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

        // $this->view("template/header", $data);
        // $this->view("template/menu", $data);
        // $this->view("main/index", $data);
        // $this->view("template/footer");

        $now = time();
        $session_id = $_COOKIE["PHPSESSID"];
        $rNum = random_bytes(128);

        $csrf_key = password_hash($now . $rNum . $session_id, PASSWORD_DEFAULT);

        $isTrusted = $this->checkCSRF();

        if ($isTrusted && $_SESSION["isLoggedIn"] && $_GET["account"] != ""){
            echo("We transferred $" . $_GET["amount"] . " to " . $_GET["account"]);
        }  else {
            $_SESSION["CSRF"] = $csrf_key;
            setcookie("CSRF", $csrf_key);
            $data = Array("CSRF" => $csrf_key);
            $this->view("other/form", $data);
        }

        if ($isTrusted) {
                echo("true");
        } else {
            echo("false");
        }
        

        if ($_SESSION["isLoggedIn"]) {
            echo("Logged In<br>");
        }
        
    }

    public function checkCSRF() {
        $csrf = $_SESSION["CSRF"];
        $trusted = false;

        echo("Session: " . $csrf . "<br>");
        echo("Cookie: " . $_COOKIE["CSRF"] . "<br>");
        echo("Form: " . $_GET["CSRF"] . "<br>");

        if ($_COOKIE["CSRF"] == $csrf && $_GET["CSRF"] == $csrf) {
            $trusted = true;
        }

        return $trusted;
    }

    

}

?>