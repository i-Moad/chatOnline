<?php

class SignupContr extends Signup
{
    private $fname;
    private $lname;
    private $uid;
    private $email;
    private $pwd;
    private $cpwd;

    public function __construct($fname, $lname, $uid, $email, $pwd, $cpwd)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->uid = $uid;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->cpwd = $cpwd;
    }

    public function signUpUser()
    {
        if ($this->emptyInput() === false)
        {
            session_start();
            $_SESSION['emptyInput'] = true;
            header('location: ../login');
            exit();
        }
        if ($this->invalidName() === false)
        {
            session_start();
            $_SESSION['invalidName'] = true;
            header('location: ../login');
            exit();
        }
        if ($this->invalidEmail() === false)
        {
            session_start();
            $_SESSION['invalidEmail'] = true;
            header('location: ../login');
            exit();
        }
        if ($this->pwdMatch() === false)
        {
            session_start();
            $_SESSION['pwdMatch'] = true;
            header('location: ../login');
            exit();
        }
        if ($this->userCheck() === false)
        {
            session_start();
            $_SESSION['userCheck'] = true;
            header('location: ../login');
            exit();
        }

        $this->setUser($this->fname, $this->lname, $this->uid, $this->email, $this->pwd);
    }

    private function emptyInput()
    {
        $result = null;
        if (empty($this->fname) || empty($this->lname) || empty($this->uid) || empty($this->email) || empty($this->pwd) || empty($this->cpwd))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidName()
    {
        $result = null;
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $this->uid) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->fname) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->lname))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result = null;
        if ($this->pwd !== $this->cpwd)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function userCheck()
    {
        $result = null;
        if (!$this->checkUser($this->uid, $this->email))
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