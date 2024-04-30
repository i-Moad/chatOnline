<?php

class Login extends Dbh
{
    protected function getUser($email, $pwd)
    {
        // Fetching the user based on email
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');

        if (!$stmt->execute([$email])) {
            // Handle SQL statement failure
            header("location: ../login?error=stmtfailed");
            exit();
        }

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single record

        if (!$user) {
            // Handle user not found
            session_start();
            $_SESSION['usernotFound'] = true;
            header("location: ../login");
            exit();
        }

        // Verify the password
        $checkPwd = password_verify($pwd, $user['password']); 

        if (!$checkPwd) {
            // Handle incorrect password
            session_start();
            $_SESSION['wrongPassword'] = true;
            header("location: ../login");
            exit();
        }

        // Start the session and set session variables
        session_start();
        $_SESSION["id"] = $user['id'];
        $_SESSION["uid"] = $user['username'];
        $_SESSION["Djoin"] = $user['dateJoin'];

        // Clean up the statement
        $stmt = null;
    }
}
