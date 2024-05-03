<?php

class ConversationDelete extends Conversation
{
    public function deleteConversation($currentId, $conversationId)
    {
        $this->dropConversation($currentId, $conversationId);
    }
}