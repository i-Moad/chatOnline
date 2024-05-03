<?php
session_start();

if (isset($_GET['c']))
{
    // Grabbing the data
    $conversationId = $_GET['c'];
    $currentId = $_SESSION['id'];

    // Instantiate ConversationContr class
    include "../classes/dbh.classes.php";
    include "../classes/conversation.classes.php";
    include "../classes/conversation-delete.classes.php";

    $conversation = new ConversationDelete();

    $conversation->deleteConversation($currentId, $conversationId);

    header("location: ../home?deletedSuccessfully");
}