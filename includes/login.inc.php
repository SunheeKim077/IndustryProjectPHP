<?php
    include 'func.inc.php';

if(isset($_POST["submit"])) {

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    $login = new Login($email, $pwd);
    $login->loginUser();

}