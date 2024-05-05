<?php

class MessageContr extends Message
{
    private $conversationId;
    private $currentUserId;
    private $message;

    public function __construct($conversationId, $currentUserId, $message)
    {
        $this->conversationId = $conversationId;
        $this->currentUserId = $currentUserId;
        $this->message = $message;
    }

    public function sendMessage()
    {
        if ($this->checkEmptyMsg())
        {
            header('location: ../home?error=EmptyMessage');
            exit();
        }

        $this->addMessage($this->conversationId, $this->currentUserId, $this->message);
    }

    private function checkEmptyMsg()
    {
        if(empty($this->message))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}