<?php

class Question {
    private $question_id;
    private $question;
    private $answers;
    private $is_answered;
    private $selected_answer;


    public function getQuestionId()
    {
        return $this->question_id;
    }

    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    public function getIsAnswered()
    {
        return $this->is_answered;
    }

    public function setIsAnswered($is_answered)
    {
        $this->is_answered = $is_answered;
    }

    public function getSelectedAnswer()
    {
        return $this->selected_answer;
    }

    public function setSelectedAnswer($selected_answer)
    {
        $this->selected_answer = $selected_answer;
    }


}

class Test {

    private $user_id;
    private $category_id;
    private $db;
    private $questions = array();

    function __construct($user_id, $category_id, $db) {
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->db = $db;

        $this->getQuestions();
    }

    private function getQuestions() {
        $q_tmp = array();
        $questions = $this->db->parseRows(
            $this->db->executeSql("SELECT questions.*, IF(questions.question_id IN ( SELECT answers.question_id 
                                                                                          FROM answers 
                                                                                          JOIN test ON (answers.answer_id = test.answer_id) 
                                                                                         WHERE test.user_id = $this->user_id
                                                                                   ), 'true', 'false') as is_answered 
                                      FROM questions 
                                      WHERE questions.category_id=".$this->category_id));


        for ($i=0; $i < count($questions); $i++) {
            $q = new Question();
            $q->setQuestion($questions[$i]["content"]);
            $q->setQuestionId($questions[$i]["question_id"]);
            $q->setIsAnswered($questions[$i]["is_answered"]);

            $answers = $this->db->parseRows(
                $this->db->executeSql("SELECT answers.* FROM answers WHERE question_id =".$q->getQuestionId())
            );
            $q->setAnswers($answers);

            $result = $this->db->executeSql("SELECT test.answer_id AS id
                                                            FROM test JOIN answers ON (answers.answer_id = test.answer_id) 
                                                            WHERE answers.question_id = ".$q->getQuestionId()." AND test.user_id = $this->user_id LIMIT 1");
            if ($result->num_rows != 0)
                $q->setSelectedAnswer($result->fetch_object()->id);

            $q_tmp[$i] = $q;
        }

        $this->questions = $q_tmp;
    }

    public function getQuestion($question_id=0) {

        $query = "SELECT content FROM questions WHERE category_id = $this->category_id";
        $category_name = $this->db->executeSql($query)->fetch_object()->content;
        echo $category_name;
    }
    
    public function getCategoryName() {
        return $this->db->getCategoryName($this->category_id);
    }

}