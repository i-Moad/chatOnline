<?php

class Conversation extends Dbh
{
    protected function createConversation($generatedId, $theCurrentUserId, $theSecondUserId, $createdBy)
    {
        $getGeneratedId = $this->getConversationId($theCurrentUserId, $theSecondUserId);
        if ($getGeneratedId[0])
        {
            $stmt = $this->connect()->prepare('INSERT INTO usersconversations (id_u, id_c, withUser) VALUES (?, ?, ?)');

            if (!$stmt->execute([$theCurrentUserId, $getGeneratedId[1], $theSecondUserId]))
            {
                $stmt = null;
                header("location: ../search?error=stmt2failed");
                exit();
            }
            $stmt = null;
            header("location: ../home?c=".$getGeneratedId[1]);
            exit();
        }

        $stmt = $this->connect()->prepare('INSERT INTO conversations (id_c, createdBy) VALUES (?, ?)');

        if (!$stmt->execute([$generatedId, $createdBy]))
        {
            $stmt = null;
            header("location: ../search?error=stmt1failed");
            exit();
        }
        $stmt = null;

        $stmt = $this->connect()->prepare('INSERT INTO usersconversations (id_u, id_c, withUser) VALUES (?, ?, ?)');

        if (!$stmt->execute([$theCurrentUserId, $generatedId, $theSecondUserId]))
        {
            $stmt = null;
            header("location: ../search?error=stmt2failed");
            exit();
        }
        $stmt = null;

        $stmt = $this->connect()->prepare('INSERT INTO usersconversations (id_u, id_c, withUser) VALUES (?, ?, ?)');

        if (!$stmt->execute([$theSecondUserId, $generatedId, $theCurrentUserId]))
        {
            $stmt = null;
            header("location: ../search?error=stmt2failed");
            exit();
        }
        $stmt = null;
    }

    protected function checkExistConversation($theCurrentUserId, $theSecondUserId)
    {
        $stmt = $this->connect()->prepare('SELECT id_c FROM usersconversations WHERE id_u = ? AND withUser = ?');

        if (!$stmt->execute([$theCurrentUserId, $theSecondUserId]))
        {
            $stmt = null;
            header("location: ../search?error=stmt2failed");
            exit();
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            return array(false, false);
        }

        $id_c = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
        return array(true, $id_c['id_c']);
    }

    protected function getConversationId($theCurrentUserId, $theSecondUserId)
    {
        $stmt = $this->connect()->prepare('SELECT id_c FROM usersconversations WHERE id_u = ? AND withUser = ?');

        if (!$stmt->execute([$theSecondUserId, $theCurrentUserId]))
        {
            $stmt = null;
            header("location: ../search?error=stmt2failed");
            exit();
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            return array(false, false);
        }

        $generatedid = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
        return array(true, $generatedid['id_c']);
    }

    protected function getConversations($theCurrentUserId)
    {
        $stmt = $this->connect()->prepare('SELECT id_c, withUser, users.username FROM usersconversations JOIN users ON users.id = usersconversations.withUser WHERE id_u = ?');

        if (!$stmt->execute([$theCurrentUserId]))
        {
            $stmt = null;
            header("location: ../search?error=stmtfailed");
            exit();
        }

        $conversations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $conversations;
    }

    protected function getSecondUserInfo($theCurrentId ,$theGeneratedId)
    {
        $stmt = $this->connect()->prepare('SELECT withUser, users.username FROM usersconversations JOIN users ON users.id = usersconversations.withUser WHERE id_u = ? and id_c = ?');

        if (!$stmt->execute([$theCurrentId, $theGeneratedId]))
        {
            $stmt = null;
            header("location: ../home?error=stmtfailed");
            exit();
        }

        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;
        return $info;
    }

    protected function dropConversation($currentId, $conversationId)
    {
        $checkConversationUsers = $this->checkConversationUsers($conversationId);
        if ($checkConversationUsers == 2)
        {
            $stmt = $this->connect()->prepare('DELETE FROM usersconversations WHERE id_u = ? AND id_c = ?');

            if (!$stmt->execute([$currentId, $conversationId]))
            {
                $stmt = null;
            }
        }
        elseif ($checkConversationUsers == 1)
        {
            $stmt = $this->connect()->prepare('DELETE FROM usersconversations WHERE id_u = ? AND id_c = ?');

            if (!$stmt->execute([$currentId, $conversationId]))
            {
                $stmt = null;
            }

            $stmt = $this->connect()->prepare('DELETE FROM conversations WHERE id_c = ?');

            if (!$stmt->execute([$conversationId]))
            {
                $stmt = null;
            }
        }
    }

    protected function checkConversationUsers($conversationId)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM usersconversations WHERE id_c = ?');

        if (!$stmt->execute([$conversationId]))
        {
            $stmt = null;
            header("location: ../home?error=cantDeleteUser");
            exit();
        }

        if ($stmt->rowCount() == 2)
        {
            $stmt = null;
            return 2;
        }
        elseif ($stmt->rowCount() == 1)
        {
            $stmt = null;
            return 1;
        }

        header("location: ../home?error=CodeLogicError");
        exit();
    }
}