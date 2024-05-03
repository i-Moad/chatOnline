<?php

class ConversationView extends Conversation
{
    public function getUserConversation($currentUserId)
    {
        $conversations = $this->getConversations($currentUserId);
        return $conversations;
    }

    public function getSecondUserInformation($currentUserId, $conversationId)
    {
        $info = $this->getSecondUserInfo($currentUserId, $conversationId);
        return $info;
    }
}