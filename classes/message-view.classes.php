<?php

class MessageView extends Message
{
    public function fetchMessages($conversationId)
    {
        $messages = $this->getMessages($conversationId);
        return $messages;
    }
}