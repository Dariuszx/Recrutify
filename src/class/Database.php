<?php

class Database {

    private $db;

    public function getDb()
    {
        return $this->db;
    }

    public function connect() {
        $this->db = new mysqli('localhost', 'recrutify', 'poziom9', 'recrutify');
//        $this->db = new mysqli('mysql9.000webhost.com', 'a3787787_db', 'poziom9', 'a3787787_db');

        $this->db->set_charset("utf8");

        if (mysqli_connect_errno()) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function disconnect() {
        $this->db->close();
    }

    public function executeSql($query) {
        self::connect();
        $result = $this->db->query($query);
        self::disconnect();
        return $result;
    }

    public function getUserRole($user_id) {
        $result = self::executeSql("SELECT positions.name AS position FROM users JOIN positions ON (users.position_id = positions.position_id) WHERE users.user_id = ".$user_id);

        if($result->num_rows != 0) {
            $obj = $result->fetch_object();
            return $obj->position == "Pracodawca" ? 1 : 0;
        }
        return -1;
    }

    public function insertUser($array) {

        $this->connect();

        $nickname = $this->db->real_escape_string($array['nickname']);
        $email = $this->db->real_escape_string($array['email']);
        $password = $array['password'];
        $salt = $array['salt'];
        $stanowisko = $array['stanowisko'];

        if( self::isUserExist($nickname) )
            throw new Exception("Wybrana nazwa użytkownika jest już w użyciu.");

        if( self::checkEmail($email) != -1 )
            throw new Exception("Na podany adres email zarejestrowano już konto.");

        //dev
        $query = "INSERT INTO users (username, position_id, email, salt, password) VALUES ('$nickname', '$stanowisko', '$email', '$salt', '$password')";
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

    public function getCategories() {
        $this->connect();

        $query = "SELECT * FROM categories";
        $result = $this->db->query($query);

        if($result->num_rows == 0) {
            self::disconnect();
            throw new Exception("Nie można pobrać listy kategorii");
        }

        $rows = array();

        for( $i=0; $i< $result->num_rows; $i++)
            $rows[$i] = $result->fetch_array(MYSQL_BOTH);

        self::disconnect();

        return $rows;
    }

    public function parseRows($result) {
        $rows = array();

        for( $i=0; $i< $result->num_rows; $i++)
            $rows[$i] = $result->fetch_array(MYSQL_BOTH);

        return $rows;
    }

//    public function getQuestions($user_id, $test_id) {
//
//        self::connect();
//        $query = "SELECT question_id FROM questions
//                    WHERE questions.question_id
//                    NOT IN (
//                      SELECT answers.question_id
//                      FROM answers
//                      JOIN test ON (answers.answer_id = test.answer_id)
//                      WHERE test.user_id = $user_id)
//                    AND questions.category_id = $test_id";
//        $result = $this->db->query($query);
//        $rows = $this->parseRows($result);
//        self::disconnect();
//        return $rows;
//    }
    
    public function getCategoryAnswerStats($user_id, $category_id) {
        self::connect();
        $query = "SELECT * FROM (SELECT COUNT(*) as num_questions FROM questions WHERE category_id = $category_id) as t_num_questions
            JOIN (SELECT COUNT(*) as num_answered FROM test JOIN answers ON(test.answer_id = answers.answer_id) 
                  							JOIN questions ON(questions.question_id = answers.question_id AND questions.category_id = $category_id)
                  									WHERE test.user_id = $user_id) as t_num_answered";
        $result = $this->db->query($query);
        self::disconnect();
        
        if($result->num_rows > 0) {
            return $result->fetch_object();
        } else {
            throw new Exception("Nie ma pytań dla tego testu!");
        }
    }

    public function getStanowisko($user_id) {
        $result = self::executeSql("SELECT positions.name AS name FROM users JOIN positions ON(users.position_id=positions.position_id) WHERE users.user_id = $user_id");

        if($result->num_rows > 0) {
            $obj = $result->fetch_object();
            return $obj->name;
        }
        return "undefined";
    }

    public function getUsername($user_id) {

        $result = $this->executeSql("SELECT username FROM users WHERE user_id=".$user_id." LIMIT 1");
        
        if($result->num_rows != 0) {
            return $result->fetch_object()->username;
        }
        
        return false;
    }

    public function getNumQuestions($category_id) {

        self::connect();
        $query = "SELECT COUNT(*) as num FROM questions WHERE questions.category_id = $category_id";
        $result = $this->db->query($query);

        if ($result->num_rows == 0)
            throw new Exception("Database error!");

        $data = $result->fetch_object();
        self::disconnect();
        return $data->num;
    }

    public function getCategoryName($category_id) {

        self::connect();
        $query = "SELECT name FROM categories WHERE category_id = $category_id";
        $result = $this->db->query($query);
        if ($result->num_rows == 0) throw new Exception("Błędny parametr test_id");
        self::disconnect();
        return $result->fetch_object()->name;
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
}