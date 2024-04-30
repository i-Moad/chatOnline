<?php

class Signup extends Dbh
{
    protected function setUser($fname, $lname, $uid, $email, $pwd)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute([$uid, $email, $hashedPwd]))
        {
            $stmt = null;
            header("location: ../login?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($uid, $email)
    {
        $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?');

        if (!$stmt->execute([$uid, $email]))
        {
            $stmt = null;
            header("location: ../login?error=stmtfailed");
            exit();
        }

        $resultCheck = null;
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) > 0)
        {
            $resultCheck = false;
        }
        else
        {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function getID($uid)
    {
        $stmt = $this->connect()->prepare('SELECT id FROM users WHERE username = ?;');

        if (!$stmt->execute([$uid]))
        {
            $stmt = null;
            header("location: ../profile?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../profile?error=ProfileNotFound");
            exit();
        }

        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $profileData;
    }
}