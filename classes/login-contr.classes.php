<?php

class LoginContr extends Login
{
    private $email;
    private $pwd;

    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        if ($this->emptyInput() === false)
        {
            session_start();
            $_SESSION['emptyInputL'] = true;
            header('location: ../login?empty');
            exit();
        }

        $this->getUser($this->email, $this->pwd);
    }

    private function emptyInput()
    {
        $result = null;
        if (empty($this->email) || empty($this->pwd))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }
}