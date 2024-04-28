<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    // Grabbing the data
    $fname = $_POST['Fname'];    
    $lname = $_POST['Lname'];    
    $uid = $_POST['uid'];    
    $email = $_POST['email'];    
    $pwd = $_POST['password'];    
    $cpwd = $_POST['cpassword'];  
    
    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signUp = new SignupContr($fname, $lname, $uid, $email, $pwd, $cpwd);

    // Running error handlers and user signup
    $signUp->signUpUser();

    // Going to back to front page
    header("location: ../Pages/login.php?error=none");
}