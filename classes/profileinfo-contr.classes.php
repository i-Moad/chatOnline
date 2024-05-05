<?php

class ProfileInfoContr extends ProfileInfo
{
    private $id;
    private $uid;
    private $fname;
    private $lname;
    private $imageName;
    private $imageTmpName;
    private $imageError;
    private $imageSize;
    private $imageExt;
    private $imageActualExt;

    public function __construct($id, $uid, $fname, $lname, $imageName, $imageTmpName, $imageError, $imageSize)
    {
        $this->id = $id;
        $this->uid = $uid;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->imageName = $imageName;
        $this->imageTmpName = $imageTmpName;
        $this->imageError = $imageError;
        $this->imageSize = $imageSize;
        $this->imageExt = explode('.', $this->imageName);
        $this->imageActualExt = strtolower(end($this->imageExt));
    }

    public function defaultProfileInfo()
    {
        $profileAbout = "Hello Chat! I am " . $this->uid;
        $this->setProfileInfo($this->id, $this->fname, $this->lname, $profileAbout);
    }

    public function updatedProfileInfo($uid, $fname, $lname, $about)
    {
        // Error handlers
        if ($this->emptyInput($uid, $fname, $lname, $about)) 
        {
            header("location: ../profile?error=emptyinput");
            exit();
        }
        if ($this->invalidName()) 
        {
            header("location: ../profile?error=invalidName");
            exit();
        }
        if ($this->imageHandler($this->imageName, $this->imageError, $this->imageSize, $this->imageActualExt))
        {
            $this->deleteProfileImage();
            $imageNameNew = "Profile" . $this->id . "." . $this->imageActualExt;
            $imageDestination = '../assets/uploads/' . $imageNameNew;
            move_uploaded_file($this->imageTmpName, $imageDestination);
            $this->updateProfileImg($this->id);
        }

        // Update Profile Info
        $this->updateProfileInfo($uid, $fname, $lname, $about, $this->id);
    }

    private function emptyInput($uid, $fname, $lname, $about)
    {
        $result = null;
        if (empty($uid) || empty($fname) || empty($lname) || empty($about))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        return $result;
    }

    private function invalidName()
    {
        $result = null;
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $this->uid) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->fname) || !preg_match("/^[a-zA-Z0-9 ]*$/", $this->lname))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        return $result;
    }

    private function imageHandler($imageName, $imageError, $imageSize, $imageActualExt)
    {
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($imageActualExt, $allowed))
        {
            if ($imageError === 0)
            {
                if ($imageSize < 5000000)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function deleteProfileImage()
    {
        $imagePath = "../assets/uploads/Profile".$this->id . "*";
        $imageInfo = glob($imagePath);
        $imageExt = explode(".", $imageInfo[0]);
        $imageActualExt = $imageExt[3];

        $image = "../assets/uploads/Profile" . $this->id . "." . $imageActualExt;
        
        if (!unlink($image))
        {
            return false;
        }
        else
        {
            $this->deleteProfileImg($this->id);
        }

    }
}