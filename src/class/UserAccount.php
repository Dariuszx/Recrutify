<?php

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
                throw new Exception("Niepoprawna nazwa użytkownika lub hasło.");
            } else return $user_id;

        } else {
            throw new Exception("Your ip adress has been blocked due to many attempts to login.");
        }
    }

    function __destruct() {
        // $this->mysql->disconnect();
    }
}