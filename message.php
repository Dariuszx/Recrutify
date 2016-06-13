<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new UserData();

try {
    if (!isset($_GET['message_id']))
        throw new Exception();

    $message_id = $_GET['message_id'];

    $data->validateInputData($message_id);
    if (!is_numeric($message_id)) throw new Exception();

    $query = "SELECT * FROM messages JOIN users ON (users.user_id=messages.sender_id) WHERE messages.message_id = " . $message_id . " AND (messages.sender_id = " . $_SESSION['user_id'] . " OR messages.receiver_id = " . $_SESSION['user_id'] . ")";

    $result = $database->executeSql($query);

    if ($result->num_rows == 0) throw new Exception();

    //TODO dopisać reszte widoku
    $message = $result->fetch_object();

    if(strlen($message->subject) == 0) $message->subject = "Brak tytułu";


} catch (Exception $e) {
    header("Location: index.php");
}


include "src/templates/profile/header.html";

?>
    <div class="container wrapper">o



        <div class="well well-sm">
            <h4><b>Tytuł:</b> <?php echo $message->subject; ?></h4>
        </div>

        <div class="col-md-4 col-md-push-8">
            <div class="panel panel-default">
                <div class="panel-heading">Informacje</div>
                <div class="panel-body">
                    <p><b>Nadawca:</b> <?php echo $message->username; ?></p>
                    <p><b>Data:</b> <?php echo $message->date; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-pull-4">
            <div class="panel panel-default">
                <div class="panel-heading">Treść wiadomości</div>
                <div class="panel-body">
                    <p><?php echo $message->content; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php

include_once "src/templates/commons/footer.html";

?>