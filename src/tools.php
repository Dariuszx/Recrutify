<?php

function randStrGen($len){
    $result = "";
    $chars = 'abcdefghijklmnopqrstuvwxyz$_?!-0123456789';
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
        $randItem = array_rand($charArray);
        $result .= "".$charArray[$randItem];
    }
    return $result;
}

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

class User extends DataPreferences {

    protected $nickname = "";
    protected $password = "";
    protected $email = "";
    protected $hash;
    protected $salt;

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

class UserData extends User {

    //Function is preparing data to put it into database
    private function finalizeData() {

        if( strlen($this->nickname) > self::maxNicknameLength || strlen($this->nickname) < self::minNicknameLength) {
            throw new Exception("Wrong length of nickname input field!");
        }

        if( strlen($this->password) > self::maxPasswordLength || strlen($this->password) < self::minPasswordLength) {
            throw new Exception("Wrong length of password input field!");
        }

        $this->validateInputData($this->nickname);
        $this->validateInputData($this->email);
        $this->validateInputData($this->password);

        $this->validateEmail($this->email);
        $this->validateNickname($this->nickname);

        if($this->entropy($this->password) <= 2.5) throw new Exception("Your password is too easy!");

        list($this->hash, $this->salt) = $this->saltPassword($this->password);

        if( empty($this->nickname) or empty($this->password) or empty($this->email) ) {
            throw new Exception("You have to set every field of form!");
        }
    }

    public function getData() {

        $this->finalizeData();

        $array = array(
            "nickname" => $this->nickname,
            "email" => $this->email,
            "password" => $this->hash,
            "salt" => $this->salt,
            "password_plain" => $this->password
        );
        return $array;
    }

    public function finalizeLoginData() {

        if( empty($this->nickname) or empty($this->password) )
            throw new Exception("Wrong nickname or password!");

        $this->validateNickname($this->nickname);

        $this->hash = $this->hashPassword($this->password, $this->salt);
        
    }

    public function changePassword($password) {

        if( strlen($password) > self::maxPasswordLength || strlen($password) < self::minPasswordLength) {
            throw new Exception("Wrong length of password input field!");
        }

        if($this->entropy($password) <= 2.5) throw new Exception("Your new password is too easy!");

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

class Database {

    private $db;

    public function getDb()
    {
        return $this->db;
    }

    public function connect() {
//        $this->db = new mysqli('localhost', 'recrutify', 'poziom9', 'recrutify');
        $this->db = new mysqli('178.32.219.12', '1115718_SgQ', '1115718_SgQ', 'MhjOs4JJOJbhIq');

        if (mysqli_connect_errno()) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function disconnect() {
        $this->db->close();
    }

    public function insertUser($array) {

        $this->connect();

        $nickname = $this->db->real_escape_string($array['nickname']);
        $email = $this->db->real_escape_string($array['email']);
        $password = $array['password'];
        $salt = $array['salt'];
        $password_plain = $array['password_plain'];

        if( self::isUserExist($nickname) )
            throw new Exception("Type another nickname, this one is already in use!");

        if( self::checkEmail($email) != -1 )
            throw new Exception("Email is already in use!");

        //dev
        $query = "INSERT INTO users (username, email, salt, password, password_plain) VALUES ('$nickname', '$email', '$salt', '$password', '$password_plain')";
        //prod
//        $query = "INSERT INTO users (username, email, salt, password, password_plain) VALUES ('$nickname', '$email', '$salt', '$password')";

        $result = $this->db->query($query);

        if( $result == false) {
            throw new Exception("Problem with putting user data to database!");
        }

        $query = "SELECT user_id FROM users WHERE username='$nickname'";
        $result = $this->db->query($query);

        if($result->num_rows == 0) throw new Exception("Problem with database!");

        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        self::disconnect();

        return $user_id;
    }

    public function isUserExist($nickname) {
        $query = "SELECT 1 FROM users WHERE username='$nickname'";
        $result = $this->db->query($query);

        if( $result->num_rows == 0 ) {
            return false;
        }
        return true;
    }

    public function updatePassword($user_id, $hash, $salt) {

        self::connect();

        $this->db->query("UPDATE users SET password='$hash', salt='$salt' WHERE user_id='$user_id'");

        self::disconnect();
    }

    public function userAuthentication($nickname, $hash) {

        self::connect();
        $query = "SELECT user_id FROM users WHERE username='$nickname' and password='$hash'";
        $result = $this->db->query($query);

        if( $result->num_rows == 0) {
            self::disconnect();
            return -1;
        }

        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        self::disconnect();
        return $user_id;
    }

    public function getSalt($nickname) {

        self::connect();

        $query = "SELECT salt FROM users WHERE username='$nickname'";
        $result = $this->db->query($query);

        if( $result->num_rows == 0 ) {
            self::disconnect();
            return randStrGen(64);
        }

        $row = $result->fetch_assoc();
        $salt = $row['salt'];
        self::disconnect();

        return $salt;
    }

    public function addNote($user_id, $note) {

        self::connect();

        $this->db->query("INSERT INTO notes (user_id, note) VALUES ('$user_id', '$note')");

        self::disconnect();
    }

    public function getNotes($user_id) {

        self::connect();

        $result = $this->db->query("SELECT * FROM notes WHERE user_id='$user_id' ORDER BY date_added DESC");
        $rows = array();

        for( $i=0; $i< $result->num_rows; $i++)
            $rows[$i] = $result->fetch_assoc();

        self::disconnect();

        return $rows;
    }

    public function deleteNote($user_id, $note_id) {

        self::connect();

        @$this->db->query("DELETE FROM notes WHERE user_id='$user_id' AND note_id='$note_id'");

        self::disconnect();
    }

    public function checkEmail($email) {

        self::connect();

        $res = $this->db->query("SELECT user_id FROM users WHERE email='$email'");


        if($res->num_rows == 0) return -1;
        else {
            $row = $res->fetch_assoc();
            return $row['user_id'];
        }
    }

    public function sendPassword($email, $password) {

        $to = $email;
        $subject = "Zapomniane haslo!";
        $message = "Twoje nowe hasło to: ".$password;
        $from = "dariusz@dybka.pl";
        $headers = "From:" . $from;
        mail($to,$subject,$message,$headers);

    }

    public function addDevice($user_id) {

        self::connect();

        $ip = $_SERVER['REMOTE_ADDR'];
        $device = $_SERVER['HTTP_USER_AGENT'];
        $result = $this->db->query("SELECT 1 FROM connected_devices WHERE ip_address='$ip' and user_id='$user_id'");

        if($result->num_rows == 0) {
            $this->db->query("INSERT INTO connected_devices (user_id, ip_address, device_name) VALUES ('$user_id', '$ip', '$device')");
        }

        self::disconnect();
    }

    public function removeDevice($user_id) {

        self::connect();
        $ip = $_SERVER['REMOTE_ADDR'];

        $result = $this->db->query("SELECT 1 FROM connected_devices WHERE ip_address='$ip' and user_id='$user_id'");

        if($result->num_rows != 0) {
            $this->db->query("DELETE FROM connected_devices WHERE user_id='$user_id' and ip_address='$ip'");
        }
        self::disconnect();
    }

    public function getDevice($user_id) {

        self::connect();

        $result = $this->db->query("SELECT * FROM connected_devices WHERE user_id='$user_id'");

        $rows = array();

        if($result->num_rows != 0) {
            $rows = array();
            for( $i=0; $i< $result->num_rows; $i++)
                $rows[$i] = $result->fetch_assoc();
        }
        self::disconnect();
        return $rows;
    }

}

class UserAccount {

    const MAX_ATTEMPTS = 3;
    const BLOCK_TIME = 900;
    const delayTime = 1;

    private $mysql;
    private $ip;

    private $attempts;

    function __construct() {
        $this->mysql = new Database();
        $this->mysql->connect();
        $this->ip = dechex(crc32($_SERVER['REMOTE_ADDR']));
    }

    public function canLogIn() {

        $db = $this->mysql->getDb();
        $result = $db->query("SELECT * FROM login WHERE ip='$this->ip'");

        //Dodaje nowy rekord do bazy
        if($result->num_rows == 0) {
            $db->query("INSERT INTO login (ip, login_attempts,last_date) VALUES ('$this->ip',0,".time().")");
            $this->attempts = 0;
            return true;
        } else { //Jeżeli jest już rekord w bazie
            $row = $result->fetch_assoc();
            $this->attempts = $row['login_attempts'];

            if($row['login_attempts'] >= self::MAX_ATTEMPTS and time() - $row['last_date'] < self::BLOCK_TIME) {
                return false;
            } else if(time() - $row['last_date'] >= self::BLOCK_TIME) {
                $this->attempts = 0;
                $db->query("DELETE FROM login WHERE ip='$this->ip'");
                return true;
            }
            return true;
        }
    }

    public function addLoginAttempt() {

        $this->attempts++;
        $db = $this->mysql->getDb();

        $time = time();
        $db->query("UPDATE login SET login_attempts='$this->attempts', last_date='$time' WHERE ip='$this->ip'");
        $this->mysql->disconnect();
    }

    public function logIn($username, $password) {

//        if( $this->canLogIn() ) { //TODO zamienić jak będzie baza
        if(true) {
            sleep(self::delayTime);
            $user_id = $this->mysql->userAuthentication($username, $password);
            $this->mysql->connect(); //Odnawiam zerwane połączenie

            if( $user_id == -1 ) { //Wrong username
                $this->addLoginAttempt(); //TODO
                throw new Exception("Wrong username or password!");
            } else return $user_id;

        } else {
            throw new Exception("Your ip adress has been blocked due to many attempts to login.");
        }
    }

    function __destruct() {
        // $this->mysql->disconnect();
    }
}