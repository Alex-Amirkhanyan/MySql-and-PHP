<?php
    $username = $_POST['username'];
    $pass = $_POST['psw'];

    function validate_data($us, $pw) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "db_forhw";
        $mysql = new mysqli($host, $user, $pass, $db);

        $obj = $mysql->query("SELECT `login`,`password` FROM `users` WHERE `login` = '$us' and `password` = md5('$pw')");
        $result = $obj->fetch_all();

        if (count($result) > 0) {
            echo 'Logged in successfully! <a href="../index.html">Press here to go to the main page.</a>';
        }else {
            echo "Invalid username or password, <a href='login.html'>try again.</a>";
        }
    }
    validate_data($username, $pass);