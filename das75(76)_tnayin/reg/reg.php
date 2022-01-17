<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    function check_inputs($nm, $em, $us, $psw) {
        $val_1 = check_name($nm);
        $val_2 = check_email($em);
        $val_3 = check_username($us);
        if ($val_1 and $val_2 and $val_3) {
            add_in_db($nm, $em, $us, $psw);
        }
    }
    function check_name($arg) {
        if (!ctype_alpha($arg)) {
            echo 'Name can only contain letters, <a href="reg.html">try again.</a>';
            return false;
            die();
        }else if (strlen($arg) < 2 ) {
            echo 'Name is too short, <a href="reg.html">try again.</a>';
            return false;
        }else {
            return true;
        }
    }
    function check_email($arg) {
        if (!filter_var($arg, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email, <a href="reg.html">try again.</a>';
            return false;
        }else {
            return true;
        }
    }
    function check_username($arg){
        $allowed = array(".", "-", "_");
        if (ctype_alnum(str_replace($allowed, '', $arg))) {
            return true;
        }else {
            echo 'Invalid username, <a href="reg.html">try again.</a>';
            return false;
        }
    }
    check_inputs($name, $email, $username, $password);

    function add_in_db($nm, $em, $us, $psw) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "db_forhw";
        $mysql = new mysqli($host, $user, $pass, $db);

        $mysql->query("CREATE TABLE IF NOT EXISTS `users` (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(25) NOT NULL,
            email VARCHAR(30) NOT NULL,
            login VARCHAR(200) NOT NULL,
            password VARCHAR(200) NOT NULL,
            PRIMARY KEY(id)
        )");

        $mysql->query("INSERT INTO `users` (`name`, `email`, `login`, `password`) VALUES('$nm', '$em', '$us', '$psw')");
        $mysql->close();
        header("Location: finish_reg.html");
    }