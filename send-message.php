<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new UserData();
$username = false;
$error = false;
$is_send = false;

if (isset($_GET['receiver_id']) && is_numeric($_GET['receiver_id'])) {
    $receiver_id = $_GET['receiver_id'];
    $data->validateInputData($receiver_id);
    $username = $database->getUsername($receiver_id);
}

if (isset($_POST['submit'])) {

    try {
        $username = $_POST['inputUsername'];
        $subject = $_POST['inputSubject'];
        $content = $_POST['inputContent'];

        $data->validateInputData($username);
        $data->validateInputData($subject);
        $data->validateInputData($content);

        $result = $database->executeSql("SELECT user_id FROM users WHERE username = '" . $username . "'");

        if ($result->num_rows == 0) throw new Exception("Nie znaleziono użytkownika o podanym nicku.");
        if (strlen($subject) == 0 && strlen($content) == 0) throw new Exception("Nie wpisano niczego w pole tytułu i treści wiadomośći.");

        $obj = $result->fetch_object();
        $receiver_id = $obj->user_id;

        $result = $database->executeSql("INSERT INTO messages (sender_id, receiver_id, subject, content) VALUES (" . $_SESSION['user_id'] . ", " . $receiver_id . ", '" . $subject . "', '" . $content . "')");

        $is_send = $result;


    } catch (Exception $e) {
        $error = $e->getMessage();
    }


}


include "src/templates/profile/header.html";

?>

<div class="container wrapper">

    <div class="col-md-8 col-md-offset-2">

        <?php
        if ($error) {
            ?>
            <div class="alert alert-dismissible alert-danger">
                <?php echo $error; ?>
            </div>
            <?php
        }

        if ($is_send) {
            ?>
            <div class="alert alert-dismissible alert-success">
                Wiadomość zostało pomyślnie wysłana.
            </div>
            <?php
        } else {
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">Wyślij wiadomość</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputUsername" class="col-lg-2 control-label">Odbiorca</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputUsername" name="inputUsername"
                                           placeholder="Nazwa użytkownika"
                                           value="<?php if ($username) echo $username; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSubject" class="col-lg-2 control-label">Temat</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="inputSubject" id="inputSubject"
                                           placeholder="Temat wiadomości" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                <textarea class="form-control" rows="3" name="inputContent"
                                          id="inputContent"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="submit" class="btn btn-success"><i
                                            class="fa fa-paper-plane"
                                            aria-hidden="true"></i>
                                        Wyślij
                                        wiadomość
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</div>

<?php

include_once "src/templates/commons/footer.html";

?>
