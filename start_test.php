<?php

include_once "src/session.php";
include_once "src/class/Database.php";
include_once "src/class/DataPreferences.php";
include_once "src/class/Test.php";

$db = new Database();
$data = new DataPreferences();

$category_id = $_GET['test_id'];
$data->validateInputData($category_id);
try {
    $test = new Test($_SESSION['user_id'], $category_id, $db);

    if(isset($_GET['answer_id']) and is_numeric($_GET['answer_id'])) {
        $answer_id = $_GET['answer_id'];
        $data->validateInputData($answer_id);
        $test->answer($answer_id);
    }

    $question = $test->getQuestion();
    $statCategory = $db->getCategoryAnswerStats($_SESSION['user_id'], $category_id);


} catch (Exception $e) {
    header("location: notfound.php?message=" . $e->getMessage());
}

include "src/templates/profile/header.html";

?>

<div class="container wrapper">

    <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-success"
             style="width: <?php echo $statCategory->num_answered / $statCategory->num_questions * 100; ?>%">
            <?php echo intval($statCategory->num_answered / $statCategory->num_questions * 100); ?>%
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $test->getCategoryName(); ?></h3>
        </div>
        <div class="panel-body">

            <?php
                if ($question != null) {
                    ?>

                    <h1><?php echo $question->getQuestion(); ?></h1>

                    <ul class="nav nav-pills nav-stacked">
                        <?php
                        foreach($question->getAnswers() as $answer) {
                            echo "<li><a href='start_test.php?test_id=" . $category_id . "&answer_id=".$answer['answer_id']."'>";
                            echo $answer['content'];
                            echo "</a></li>";
                        }
                        ?>
                    </ul>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-dismissible alert-danger" style="width: 70%; margin: 20px auto 20px auto;">
                        Udzielono odpowiedzi na wszystkie pytania dla tego testu!
                        <p style="margin: 5px; text-align: center;">
                            <a href="profile.php" class="btn btn-sm btn-danger">
                                <i class="fa fa-undo" aria-hidden="true"></i> Powrót</a>
                        </p>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

