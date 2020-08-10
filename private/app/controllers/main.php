<?php

class Main extends Controller {

    function __construct() {
        parent::__construct();
    }

    function Logout () {
        $_SESSION["isLoggedIn"] = false;
        unset($_SESSION["isLoggedIn"]);
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie("PHPSESSID", '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("Location: /");
    }

    function Login () {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"])) {
            $verify = password_hash("password", PASSWORD_DEFAULT);
            $password = htmlentities($_POST["password"]);
            $email = htmlentities($_POST["email"]);
            // Query password based on email.
            // If password Exists, verify it.
            $isVerified = password_verify($password, $verify);
            $_SESSION["isLoggedIn"] = $isVerified;
            
            header("Location: /");
        } else {
            // display form
            if (empty($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"]) {
                $this->view("users/login");
            } else {
                header("Location: /");
            }
            
        }
    }

    /*
     * http://localhost/
     */
    function Index () {
        
        $this->model('blogmodel');

        $version = $this->blogmodel->DBVersion();

        $data = Array("title" => "Index Page", "version" => $version, "isLoggedIn" => $_SESSION["isLoggedIn"]);

        $this->view("template/header", $data);
        $this->view("template/menu", $data);
        $this->view("main/index", $data);
        $this->view("template/footer");

        // $now = time();
        // $session_id = $_COOKIE["PHPSESSID"];
        // $rNum = random_bytes(128);

        // $csrf_key = password_hash($now . $rNum . $session_id, PASSWORD_DEFAULT);

        // $isTrusted = $this->checkCSRF();

        // if ($isTrusted && $_SESSION["isLoggedIn"] && $_GET["account"] != ""){
        //     echo("We transferred $" . $_GET["amount"] . " to " . $_GET["account"]);
        // }  else {
        //     $_SESSION["CSRF"] = $csrf_key;
        //     //setcookie("CSRF", $csrf_key);
        //     $data = Array("CSRF" => $csrf_key);
        //     $this->view("other/form", $data);
        // }

        // if ($isTrusted) {
        //         echo("true");
        // } else {
        //     echo("false");
        // }
        

        // if ($_SESSION["isLoggedIn"]) {
        //     echo("Logged In<br>");
        // }
        
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