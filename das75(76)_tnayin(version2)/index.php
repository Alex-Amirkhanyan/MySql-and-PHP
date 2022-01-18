<?php
session_start();
if(count($_SESSION) != 0) {
    header("Location: log/logged.html");
}else {
    header("Location: reg/reg.html");
}