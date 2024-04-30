<?php

class ProfileInfo extends Dbh
{
    protected function getProfileInfo($id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM profiles WHERE id_u = ?;');

        if (!$stmt->execute([$id]))
        {
            $stmt = null;
            header("location: ../profile?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: login");
            exit();
        }

        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $profileData;
    }

    protected function updateProfileInfo($uid, $fname, $lname, $about, $id)
    {
        $stmt1 = $this->connect()->prepare('UPDATE profiles SET firstName = ?, lastName = ?, about = ? WHERE id_u = ?;');
        $stmt2 = $this->connect()->prepare('UPDATE users SET username = ? WHERE id = ?;');

        if (!$stmt1->execute([$fname, $lname, $about, $id]))
        {
            $stmt1 = null;
            header("location: ../profile?error=stmt1failed");
            exit();
        }
        if (!$stmt2->execute([$uid, $id]))
        {
            $stmt1 = null;
            header("location: ../profile?error=stmt2failed");
            exit();
        }

        $stmt1 = null;
        $stmt2 = null;
    }

    protected function updateProfileImg($id)
    {
        $stmt = $this->connect()->prepare('UPDATE profiles SET status = ? WHERE id_u = ?;');

        if (!$stmt->execute([1, $id]))
        {
            $stmt = null;
            header("location: ../profile?error=stmt1failed");
            exit();
        }

        $stmt = null;
    }

    protected function setProfileInfo($id, $fname, $lname, $about)
    {
        $stmt = $this->connect()->prepare('INSERT INTO profiles (firstName, lastName, about, id_u) VALUES (?, ?, ?, ?);');

        if (!$stmt->execute([$fname, $lname, $about, $id]))
        {
            $stmt = null;
            header("location: ../login?error=stmt2failed");
            exit();
        }

        $stmt = null;
    }
}