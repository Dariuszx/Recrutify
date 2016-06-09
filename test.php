<?php
include_once "src/session.php";
include_once "src/class/Database.php";
include_once "src/class/DataPreferences.php";

$db = new Database();
$data = new DataPreferences();


$category_id = $_GET['test_id'];
$data->validateInputData($category_id);

    $statCategory = $db->getCategoryAnswerStats($_SESSION['user_id'], $category_id);

if ($statCategory->num_questions > 0) {
    $num_answered_percentage = intval($statCategory->num_answered / $statCategory->num_questions * 100);
    $num_questions_percentage = 100 - $num_answered_percentage;
} else {
    $num_answered_percentage = 0;
    $num_questions_percentage = 100;
}

try {
    $test_title = $db->getCategoryName($category_id);
} catch (Exception $e) {
    header("location: notfound.php?message=".$e->getMessage());
}

include "src/templates/profile/header.html";
?>

<!--<img class="test-image" src="src/resources/img/tester.png" />-->
<div class="container wrapper">
    <div class="panel panel-default">
        <div class="panel-heading"> <?php echo $test_title; ?></div>
        <div class="panel-body">

            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: <?php echo $num_answered_percentage."%"; ?>">
                    <?php echo $num_answered_percentage."% zrobione"; ?>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: <?php echo $num_questions_percentage."%"; ?>">
                    <?php echo $num_questions_percentage."% nie zrobione"; ?>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dolor magna, malesuada quis dapibus nec, condimentum eget lorem. Morbi nec ornare leo, et molestie ante. Sed laoreet nisi nec nisi varius sagittis. Nullam id dolor ut ligula commodo pellentesque. Maecenas a convallis ipsum. Integer quis facilisis nisi. Etiam scelerisque diam id nulla blandit lacinia. Mauris tempus fermentum risus, vitae maximus nunc commodo a.</p>

            <div style="text-align: center;">
                <a href="start_test.php?test_id=<?php echo $category_id; ?>" class="btn btn-primary <?php if($num_answered_percentage == 100) echo "disabled"; ?>">Rozpocznij test</a>
            </div>
        </div>
    </div>
</div>

