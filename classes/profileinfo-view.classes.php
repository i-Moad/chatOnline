<?php

class ProfileInfoView extends ProfileInfo
{
    public function fetchAbout($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo['about'];
    }
    public function fetchFirstName($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo['firstName'];
    }
    public function fetchLastName($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        echo $profileInfo['lastName'];
    }
    public function fetchProfileImgStatus($id)
    {
        $profileInfo = $this->getProfileInfo($id);
        return $profileInfo['status'];
    }
}