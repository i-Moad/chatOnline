<?php

class ConversationContr extends Conversation
{
    private $generatedId;
    private $theCurrentUserId;
    private $theSecondUserId;
    private $createdBy;

    public function __construct($generatedId, $theCurrentUserId, $theSecondUserId, $createdBy)
    {
        $this->generatedId = $generatedId;
        $this->theCurrentUserId = $theCurrentUserId;
        $this->theSecondUserId = $theSecondUserId;
        $this->createdBy = $createdBy;
    }

    public function startNewConversation()
    {
        if (!$this->checkGeneratedId())
        {
            header('location: ../search?error=generatedIdWrong');
            exit();
        }
        $checkExistConversation = $this->checkExistConversation($this->theCurrentUserId, $this->theSecondUserId);
        if ($checkExistConversation[0])
        {
            header('location: ../home?c='.$checkExistConversation[1]);
            exit();
        }
        
        $this->createConversation($this->generatedId, $this->theCurrentUserId, $this->theSecondUserId, $this->createdBy);
    }

    private function checkGeneratedId()
    {
        if(strlen($this->generatedId) != 32)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}