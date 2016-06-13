<?php

class UserData extends User {

    //Function is preparing data to put it into database
    private function finalizeData() {

        if( strlen($this->nickname) > self::maxNicknameLength || strlen($this->nickname) < self::minNicknameLength) {
            throw new Exception("Nazwa użytkownika powinna składać się z minimalnie 5 i maksymalnie 20 znaków.");
        }

        if( strlen($this->password) > self::maxPasswordLength || strlen($this->password) < self::minPasswordLength) {
            throw new Exception("Niepoprawna długość hasła. Hasło powinno posiadać więcej niż 5 i mniej niż 20 znaków.");
        }

        $this->validateInputData($this->nickname);
        $this->validateInputData($this->email);
        $this->validateInputData($this->password);

        $this->validateEmail($this->email);
        $this->validateNickname($this->nickname);

        if($this->entropy($this->password) <= 2.5) throw new Exception("Twoje hasło jest za łatwe.");

        list($this->hash, $this->salt) = $this->saltPassword($this->password);

        if( empty($this->nickname) or empty($this->password) or empty($this->email) ) {
            throw new Exception("Musisz wypełnić wszystkie pola formularza.");
        }
    }

    public function getData() {

        $this->finalizeData();

        $array = array(
            "nickname" => $this->nickname,
            "email" => $this->email,
            "stanowisko" => $this->stanowisko,
            "password" => $this->hash,
            "salt" => $this->salt,
            "password_plain" => $this->password
        );
        return $array;
    }

    public function finalizeLoginData() {

        if( empty($this->nickname) or empty($this->password) )
            throw new Exception("Niepoprawna nazwa użytkownika lub hasło.");

        $this->validateNickname($this->nickname);

        $this->hash = $this->hashPassword($this->password, $this->salt);

    }

    public function changePassword($password) {

        if( strlen($password) > self::maxPasswordLength || strlen($password) < self::minPasswordLength) {
            throw new Exception("Niepoprawna długość hasła. Hasło powinno posiadać więcej niż 5 i mniej niż 20 znaków.");
        }

        if($this->entropy($password) <= 2.5) throw new Exception("Twoje hasło jest za łatwe.");

        list($this->hash, $this->salt) = $this->saltPassword($password);

    }

    public function checkEmail($email) {
        $this->validateEmail($email);
    }

    public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}