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
                                        <a href="send-message.php" class="btn btn-success btn-sm btn-block"><i
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
                    Panel content
                </div>
            </div>
        </div>
    </div>


</div>

<?php

include_once "src/templates/commons/footer.html";
?>

