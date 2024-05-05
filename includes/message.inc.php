<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $msg = $_POST['msg'];
    $currentUserId = $_POST['id'];
    $conversationId = $_POST['id_c'];

    // Instantiate ConversationContr class
    include "../classes/dbh.classes.php";
    include "../classes/message.classes.php";
    include "../classes/message-contr.classes.php";

    $message = new MessageContr($conversationId, $currentUserId, $msg);

    // send message
    $message->sendMessage();

    echo 'done';
}