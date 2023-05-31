<?php
    include 'func.inc.php';

if(isset($_POST["submit"])) {

    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $repwd = $_POST["repwd"];
    $roleid = $_POST["role_id"];

    $register = new Register($firstname, $lastname, $email, $pwd, $repwd, $roleid);
    $register->registerUser();

    $_SESSION['register'] = "<p class='text-success'>Registerd Successfully! Please Login</p>";
    header("location:../login.php?error=none");
    exit();        
}