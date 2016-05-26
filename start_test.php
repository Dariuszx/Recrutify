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
    $statCategory = $db->getCategoryAnswerStats($_SESSION['user_id'], $category_id);
    $question = $test->getQuestion();
} catch (Exception $e) {
    header("location: notfound.php?message=" . $e->getMessage());
}


include "src/templates/profile/header.html";

?>

<div class="container" style="margin-top: 5%;">

    <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-success"
             style="width: <?php echo $statCategory->num_answered / $statCategory->num_questions * 100; ?>%">
            <?php echo $statCategory->num_answered / $statCategory->num_questions * 100; ?>%
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $test->getCategoryName(); ?></h3>
        </div>
        <div class="panel-body">

            <h1><?php echo $question->getQuestion(); ?></h1>

            <ul class="nav nav-pills nav-stacked">
                <?php
                for ($i = 0; $i < count($question->getAnswers()); $i++) {
                    echo "<li><a href=\"#\">";
                    echo $question->getAnswers()[$i]['content'];
                    echo "</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

