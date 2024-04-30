<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_SESSION['id'];
    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $fname = htmlspecialchars($_POST['Fname'], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST['Lname'], ENT_QUOTES, 'UTF-8');
    $about = htmlspecialchars($_POST['about'], ENT_QUOTES, 'UTF-8');
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageError = $_FILES['image']['error'];
    $imageSize = $_FILES['image']['size'];

    include "../classes/dbh.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";

    $profileInfo = new ProfileInfoContr($id, $uid, $fname, $lname, $imageName, $imageTmpName, $imageError, $imageSize);

    $profileInfo->updatedProfileInfo($uid, $fname, $lname, $about);

    $_SESSION['uid'] = $uid;

    header("location: ../home?error=none?".$imageName);
}