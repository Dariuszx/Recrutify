<?php

class DataPreferences {

    const maxNicknameLength = 20;
    const maxPasswordLength = 20;

    const minNicknameLength = 5;
    const minPasswordLength = 5;

    const numberOfHash = 128;

    //Function counts entropy for input string
    protected function entropy($string) {

        $h=0;
        $size = strlen($string);

        foreach (count_chars($string, 1) as $v) {
            $p = $v/$size;
            $h -= $p*log($p)/log(2);
        }
        return $h;
    }

    //Function returns hash and salt from password
    protected function saltPassword($password) {

        $salt = randStrGen(64);
        $salt = bin2hex($salt);

        $hash = $password.$salt;

        foreach(range(0,self::numberOfHash) as $i) {
            $hash = hash('sha512', $hash);
        }

        return array($hash, $salt);
    }

    //Function validate data from HTML form
    public function validateInputData(&$data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    protected function validateEmail(&$email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Wrong email format!");
        }
    }

    protected function validateNickname(&$nickname) {
        $regex  = '/[^a-zA-Z0-9_-]|admin|root|administrator/';

        if (preg_match($regex, $nickname)) {
            throw new Exception("Nickname format is wrong, retype your nickname again!");
        }
    }

    protected function hashPassword($form_password, $salt) {

        $hash = $form_password.$salt;

        foreach(range(0,self::numberOfHash) as $i) {
            $hash = hash('sha512', $hash);
        }

        return $hash;
    }
}