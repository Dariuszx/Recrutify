<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new UserData();

try {
    if(!isset($_GET['message_id']))
        throw new Exception();

    $message_id = $_GET['message_id'];

    $data->validateInputData($message_id);
    if(!is_numeric($message_id)) throw new Exception();

    $query = "SELECT * FROM messages JOIN users ON (users.user_id=messages.sender_id) WHERE messages.message_id = ".$message_id." AND (messages.sender_id = ".$_SESSION['user_id']." OR messages.receiver_id = ".$_SESSION['user_id'].")";

    $result = $database->executeSql($query);

    if($result->num_rows == 0) throw new Exception();

    //TODO dopisać reszte widoku
    $message = $result->fetch_object();


} catch (Exception $e) {
    header("Location: index.php");
}






include "src/templates/profile/header.html";

?>


    <div class="container wrapper">

    </div>

<?php

include_once "src/templates/commons/footer.html";

?>