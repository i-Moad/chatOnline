<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Grabbing the data
    $generatedId = md5(uniqid(rand(), true));
    $id = $_SESSION['id'];
    $createdBy = $_SESSION['uid'];
    $otherId = $_POST['id'];

    // Instantiate ConversationContr class
    include "../classes/dbh.classes.php";
    include "../classes/conversation.classes.php";
    include "../classes/conversation-contr.classes.php";

    $conversation = new ConversationContr($generatedId, $id, $otherId, $createdBy);

    // Create new conversation
    $conversation->startNewConversation();

    header("location: ../home?c=".$generatedId);
}