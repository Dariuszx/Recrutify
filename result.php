<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new DataPreferences();

if ($database->getUserRole($_SESSION['user_id']) == 0) {
    header("Location: profile.php");
}

$username = $database->getUsername($_SESSION['user_id']);
$stanowisko = $database->getStanowisko($_SESSION['user_id']);
$stanowiska = $database->parseRows($database->executeSql("SELECT * FROM positions"));

$stanowisko_id = $_GET['stanowisko'];
$userQuery = $_GET['userQuery'];

$users = [];

if (isset($_POST['userSearch'])) {
    $stanowisko_id = $_POST['selectStanowisko'];
    $userQuery = $_POST['userQuery'];
}

$data->validateInputData($stanowisko_id);
$data->validateInputData($userQuery);

if (is_numeric($stanowisko_id) && $database->executeSql("SELECT 1 FROM positions WHERE position_id=$stanowisko_id")->num_rows != 0)
    $query = "SELECT * FROM users JOIN positions ON(users.position_id=positions.position_id) WHERE username LIKE '%$userQuery%' AND position_id = $stanowisko_id";
else if (strlen($userQuery) > 0)
    $query = "SELECT * FROM users JOIN positions ON(users.position_id=positions.position_id) WHERE username LIKE '%$userQuery%'";


if (isset($query))
    $users = $database->parseRows($database->executeSql($query));


include "src/templates/profile/header.html";

?>

<div class="container wrapper">

        <div style="margin-bottom: 15px; margin-left: 3px;">
            <a href="employer-profile.php" class="btn btn-primary btn-sm"><i class="fa fa-undo"
                                                                             aria-hidden="true"></i> Powrót</a>
        </div>

    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Wyszukaj użytkowników</div>
            <div class="panel-body" style="text-align: center;">
                <form method="POST" action="">
                    <div class="form-group col-md-5">
                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"
                                                                           aria-hidden="true"></i></span>
                            <input type="text" name="userQuery" class="form-control" value="<?php echo $userQuery; ?>"/>
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
    </div>

    <?php
    if (count($users) > 0) {
        ?>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Wyniki wyszukiwania</div>
                <div class="panel-body" style="padding: 0px;">
                    <table class="table table-striped table-hover" style="margin-top: 15px; margin-bottom: 0px;">
                        <tbody>
                        <?php
                        for ($i = 0; $i < count($users); $i++) {
                            $url = "user-profile.php?user_id=" . $users[$i]['user_id'] . "&userQuery=" . $userQuery . "&stanowisko=" . $stanowisko_id;
                            echo "<tr>";
                            echo "<td style='width: 5%;'>#" . ($i + 1) . "</td>";
                            echo "<td style='width: 75%;'><a href='$url' class='btn btn-xs btn-link'>" . $users[$i]['username'] . "</a></td>";
                            echo "<td>".$users[$i]['name']."</td>";
                            echo "<td><a href='send-message.php?receiver_id=".$users[$i]['user_id']."'><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i></a></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="alert alert-dismissible alert-danger" style="text-align: center; margin: 20px 10px;">
                        <h4><i class="fa fa-search" aria-hidden="true"></i> Nie znaleziono żadnego użytkownika.</h4>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>


</div>

<?php

include_once "src/templates/commons/footer.html";

?>
