<?php

class User extends DataPreferences {

    protected $nickname = "";
    protected $password = "";
    protected $email = "";
    protected $stanowisko;
    protected $hash;
    protected $salt;


    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
}