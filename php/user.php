<?php


class user
{
    public $login = null;
    public $password = null;
    public $email = null;
    public $name = null;

    public function GetLogin()
    {
        return $this->login;
    }

    public function SetLogin($data)
    {
        return $this->login = $data;
    }

    public function GetPassword()
    {
        return $this->password;
    }

    public function SetPassword($data)
    {
        return $this->password = $data;
    }

    public function GetEmail()
    {
        return $this->email;
    }

    public function SetEmail($data)
    {
        return $this->email = $data;
    }

    public function GetName()
    {
        return $this->name;
    }

    public function SetName($data)
    {
        return $this->name = $data;
    }


}