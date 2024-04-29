<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    // Grabbing the data   
    $email = $_POST['email'];    
    $pwd = $_POST['password'];    
    
    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new LoginContr($email, $pwd);

    // Running error handlers and user signup
    $login->loginUser();

    // Session
    session_start();
    $_SESSION["login"] = true;

    // Going to back to front page
    header("location: ../home");
}