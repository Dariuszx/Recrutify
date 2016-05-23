<?php

include_once "src/session.php";
include_once "src/class/Database.php";
include_once "src/class/DataPreferences.php";
include_once "src/class/Test.php";

$db = new Database();
$data = new DataPreferences();

$category_id = $_GET['test_id'];
$data->validateInputData($category_id);

$test = new Test($_SESSION['user_id'], $category_id, $db);


include "src/templates/profile/header.html";

?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $test->getCategoryName(); ?></h3>
        </div>
        <div class="panel-body">
            


            <div class="next-prev-buttons">
                <div class="btn-group btn-group-justified">
                    <a href="#" class="btn btn-danger">Poprzednie</a>
                    <a href="#" class="btn btn-success">Następne</a>
                </div>
            </div>
        </div>
    </div>
</div>

