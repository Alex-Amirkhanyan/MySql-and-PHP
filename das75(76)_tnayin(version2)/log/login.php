<?php
    $username = $_POST['username'];
    $pass = $_POST['psw'];

    function validate_username($arg1, $arg2) {
        $allowed = array(".", "-", "_");
        if (ctype_alnum(str_replace($allowed, '', $arg1))) {
            check_sql($arg1, $arg2);
        }else {
            echo 'Invalid username, <a href="reg.html">try again.</a>';
        }
    }

    function check_sql($us, $pw) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "db_forhw";
        $mysql = new mysqli($host, $user, $pass, $db);

        $obj = $mysql->query("SELECT `id`, `login`,`password` FROM `users` WHERE `login` = '$us' and `password` = md5('$pw')");
        $result = $obj->fetch_all();
        $res = $result[0];
        $usern = $res[1];
        $psw = $res[2];

        if ($us === $usern && md5($pw) === $psw) {
            $id = $res[0];
            session_start();
            $_SESSION['id'] = $id;
            header("Location: logged.html");
        }else {
            header("Location: error.php");
        }
    }
validate_username($username, $pass);