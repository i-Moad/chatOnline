<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $currentUserId = $_POST['id'];
    $conversationId = $_POST['id_c'];

    // Instantiate ConversationContr class
    include "../classes/dbh.classes.php";
    include "../classes/message.classes.php";
    include "../classes/message-view.classes.php";

    $msg = new MessageView();

    // get messages
    $messages = $msg->fetchMessages($conversationId);

    foreach ($messages as $message)
    {
        if ($message['id_u'] == $currentUserId)
        {
            echo '<div class="flex justify-end mb-4">';
                echo '<div class="flex flex-col items-start bg-indigo-500 text-white p-3 rounded-lg max-w-xs">';
                    echo '<span class="overflow-ellipsis">'.$message["message"].'</span>';
                    echo '<span class="text-xs text-gray-200 mt-1">'.$message["time"].'</span>';
                echo '</div>';
            echo '</div>';
        }
        else
        {
            echo '<div class="flex mb-4">';
                echo '<div class="flex flex-col items-start bg-gray-200 text-black p-3 rounded-lg max-w-xs">';
                    echo '<span class="overflow-ellipsis">'.$message["message"].'</span>';
                    echo '<span class="text-xs text-gray-500 mt-1">'.$message["time"].'</span>';
                echo '</div>';
            echo '</div>';
        }
    }
}