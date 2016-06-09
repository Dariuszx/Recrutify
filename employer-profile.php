<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();

if ($database->getUserRole($_SESSION['user_id']) == 0) {
    header("Location: profile.php");
}

$username = $database->getUsername($_SESSION['user_id']);
$stanowisko = $database->getStanowisko($_SESSION['user_id']);
$tests = $database->getCategories();
$stanowiska = $database->parseRows($database->executeSql("SELECT * FROM positions"));

if(isset($_POST['userSearch'])) {

    if($_POST['selectStanowisko'] != -1 || strlen($_POST['userQuery']) > 0) {
        $url = "result.php?userQuery=".$_POST['userQuery']."&stanowisko=".$_POST['selectStanowisko'];
        header("Location: ".$url);
    }
}


include "src/templates/profile/header.html";

?>

    <div class="container wrapper">

        <div class="row">
            <div class="col-md-4 col-md-push-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Panel użytkownika</div>
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
                                        <div class="col-md-6">
                                            <a href="inbox.php" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Skrzynka odbiorcza</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="send-message.php" class="btn btn-default btn-sm btn-block"><i
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
                    <div class="panel-heading">Wyszukaj użytkowników</div>
                    <div class="panel-body" style="text-align: center;">
                        <form method="POST" action="">
                            <div class="form-group col-md-5">
                                <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"
                                                                           aria-hidden="true"></i></span>
                                    <input type="text" name="userQuery" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <select class="form-control" name="selectStanowisko" id="selectStanowisko">
                                    <option value="-1">Wybierz stanowisko</option>
                                    <?php
                                    for ($i = 0; $i < count($stanowiska); $i++)
                                        echo "<option value='" . $stanowiska[$i]["position_id"] . "'>" . $stanowiska[$i]["name"] . "</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2" style="text-align: right;">
                                <button type="submit" name="userSearch" class="btn btn-success">Wyszukaj</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Dostępne testy</div>
                    <div class="list-group">
                        <?php

                        for ($i = 0; $i < count($tests); $i++) {
                            $test = $tests[$i];
                            echo "<a href=\"#\" class=\"list-group-item\">";
                            echo "<h4 class=\"list-group-item-heading\">" . $test["name"] . "</h4>";
                            echo "<p class=\"list-group-item-text\">" . $test['description'] . "</p>";
                            echo "</a>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php

include_once "src/templates/commons/footer.html";

?>