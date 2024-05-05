<?php

class Message extends Dbh
{
    protected function addMessage($conversationId, $currentUserId, $message)
    {
        $stmt = $this->connect()->prepare('INSERT INTO messages (id_c, id_u, message) VALUES (?, ?, ?)');

        if (!$stmt->execute([$conversationId, $currentUserId, $message]))
        {
            $stmt = null;
            header("location: ../search?error=stmt1failed");
            exit();
        }
        $stmt = null;
    }

    protected function getMessages($conversationId)
    {
        $stmt = $this->connect()->prepare("SELECT id_m, id_u, message, TIME_FORMAT(msgTime, '%H:%i') AS time FROM messages WHERE id_c = ?");

        if (!$stmt->execute([$conversationId]))
        {
            $stmt = null;
            header("location: ../home?error=stmtfailed");
            exit();
        }

        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $messages;
    }
}