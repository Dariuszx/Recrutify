<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new UserData();


if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    header("Location: index.php");
}

$user_id = $_GET['user_id'];
$data->validateInputData($user_id);

$username = $database->getUsername($user_id);
$stanowisko = $database->getStanowisko($user_id);

$userQuery = "";
$stanowisko_id = -1;

if (isset($_GET['userQuery'])) {
    $userQuery = $_GET['userQuery'];
}

if (isset($_GET['stanowisko'])) {
    $stanowisko_id = $_GET['stanowisko'];
}

if (strlen($userQuery) == 0 && $stanowisko_id == -1)
    $url_revert = false;
else
    $url_revert = "result.php?userQuery=" . $userQuery . "&stanowisko=" . $stanowisko_id;


$categories = $database->getCategories();
$test_results = array();

for ($i = 0; $i < count($categories); $i++) {
    $result = $database->executeSql("SELECT SUM(answers.correct) AS result FROM questions 
                                          JOIN answers ON(answers.question_id=questions.question_id) 
                                          JOIN test ON(test.answer_id=answers.answer_id) 
                                          WHERE test.user_id = " . $user_id . " AND questions.category_id = " . $categories[$i]['category_id']);

    if ($result->num_rows == 0) break;

    $obj = $result->fetch_object();
    $wynik = $obj->result;

    $result = $database->executeSql("SELECT COUNT(*) AS count FROM questions WHERE category_id=" . $categories[$i]['category_id']);
    if ($result->num_rows == 0) break;
    $obj = $result->fetch_object();
    $iloscPytan = $obj->count;


    $tmp = array(
        "name" => $categories[$i]['name'],
        "correct" => $wynik == NULL ? 0 : $wynik,
        "maxScore" => $iloscPytan
    );
    array_push($test_results, $tmp);
}

//var_dump($test_results);


include "src/templates/profile/header.html";


?>

<div class="container wrapper">

    <?php
    if ($url_revert != false) { ?>
        <div style="margin-bottom: 15px; margin-left: 3px;">
            <a href="<?php echo $url_revert; ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo"
                                                                                   aria-hidden="true"></i>
                Powrót</a>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-md-4 col-md-push-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Profil użytkownika</div>
                <div class="panel-body" style="padding: 0px;">
                    <div class="box-info text-center user-profile-2">
                        <div class="header-cover">
                            <img src="src/resources/img/profile-bg.jpg" style="width: 100%;" alt="User cover">
                        </div>
                        <div class="user-profile-inner">
                            <img src="src/resources/img/profile-photo.png" class="img-circle profile-avatar"
                                 alt="User avatar">
                            <h5><b>Nazwa użytkownika:</b> <?php echo $username; ?></h5>
                            <p><b>Stanowisko:</b> <?php echo $stanowisko; ?></p>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6">
                                        <a href="send-message.php?receiver_id=<?php echo $user_id; ?>"
                                           class="btn btn-success btn-sm btn-block"><i
                                                class="fa fa-envelope"></i> Wyślij wiadomość</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-pull-4">

            <div class="panel panel-default">
                <div class="panel-heading">Testy użytkownika</div>
                <div class="panel-body">

                    <?php

                    for ($i = 0; $i < count($test_results); $i++) {
                        $category = $test_results[$i];

                        $correct_percentage = $category['maxScore'] > 0 ? $category['correct'] / $category['maxScore'] * 100 : 100;
                        $wrong_percentage = 100 - $correct_percentage;

                        echo "<h3>" . $category['name'] . "</h3>";
                        echo "<p><b>Poprawnych odpowiedzi:</b> ".$category['correct']." (".intval($correct_percentage)."%)</p>"

                        ?>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo $correct_percentage; ?>%"></div>
                            <div class="progress-bar progress-bar-danger" style="width: <?php echo $wrong_percentage; ?>%"></div>
                        </div>

                        <?php

                        echo "<hr />";
                    }

                    ?>

                    <hr/>

                </div>
            </div>
        </div>
    </div>


</div>

<?php

include_once "src/templates/commons/footer.html";
?>

