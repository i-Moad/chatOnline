<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    // Grabbing the data
    $fname = htmlspecialchars($_POST['Fname'], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST['Lname'], ENT_QUOTES, 'UTF-8');
    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $cpwd = htmlspecialchars($_POST['cpassword'], ENT_QUOTES, 'UTF-8');

    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signUp = new SignupContr($fname, $lname, $uid, $email, $pwd, $cpwd);

    // Running error handlers and user signup
    $signUp->signUpUser();

    $userID = $signUp->fetchID($uid);

    // Instantiate ProfileInfoContr class
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";

    $profileInfo = new ProfileInfoContr($userID, $uid, $fname, $lname);

    $profileInfo->defaultProfileInfo();

    // Session
    session_start();
    $_SESSION["signup"] = true;

    // Going to back to front page
    header("location: ../login");
}