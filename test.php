<?php
include_once "src/session.php";
include_once "src/class/Database.php";
include_once "src/class/DataPreferences.php";

$db = new Database();
$data = new DataPreferences();


$category_id = $_GET['test_id'];
$data->validateInputData($category_id);
$questions = $db->getQuestions($_SESSION['user_id'], $category_id);
$num_questions = $db->getNumQuestions($category_id);
$answered_questions = $num_questions - count($questions);

try {
    $test_title = $db->getCategoryName($category_id);
} catch (Exception $e) {
    header("location: notfound.php?message=".$e->getMessage());
}

include "src/templates/profile/header.html";
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $test_title; ?></div>
        <div class="panel-body">

            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: <?php echo ($answered_questions / $num_questions * 100)."%"; ?>">
                    <?php echo ($answered_questions / $num_questions * 100)."% zrobione"; ?>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: <?php echo (($num_questions - $answered_questions) / $num_questions * 100)."%"; ?>">
                    <?php echo (($num_questions - $answered_questions) / $num_questions * 100)."% nie zrobione"; ?>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dolor magna, malesuada quis dapibus nec, condimentum eget lorem. Morbi nec ornare leo, et molestie ante. Sed laoreet nisi nec nisi varius sagittis. Nullam id dolor ut ligula commodo pellentesque. Maecenas a convallis ipsum. Integer quis facilisis nisi. Etiam scelerisque diam id nulla blandit lacinia. Mauris tempus fermentum risus, vitae maximus nunc commodo a.</p>

            <div style="text-align: center;">
                <a href="#" class="btn btn-primary">Rozpocznij test</a>
            </div>
        </div>
    </div>
</div>

