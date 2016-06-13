<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();

$query = "SELECT * FROM messages JOIN users ON (messages.sender_id = users.user_id) WHERE messages.receiver_id = " . $_SESSION['user_id'] . " ORDER BY date DESC";
$messages = $database->parseRows($database->executeSql($query));


include "src/templates/profile/header.html";

?>


<div class="container wrapper">

    <div style="margin-bottom: 15px; margin-left: 3px;">
        <a href="index.php" class="btn btn-primary btn-sm"><i class="fa fa-undo"
                                                              aria-hidden="true"></i> Powrót</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-envelope" aria-hidden="true"></i> Skrzynka odbiorcza</div>
        <div class="panel-body" style="padding: 0;">

            <table class="table table-hover" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <td style="width: 5%;">Lp.</td>
                        <td style="width: 65%;">Tytuł</td>
                        <td>Nadawca</td>
                        <td style="width: 15%;">Data</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < count($messages); $i++) {
                    $message = $messages[$i];
                    $url_sender = "user-profile.php?user_id=".$message['user_id'];
                    $url_message = "message.php?message_id=".$message['message_id'];
                    $subject = strlen($message['subject']) > 0 ? $message['subject'] : "brak tytułu";
                    echo "<tr>";
                    echo "<td>#" . ($i + 1) . "</td>";
                    echo "<td><a href='$url_message' class='btn btn-link btn-xs'>" .$subject. "</a></td>";
                    echo "<td><a href='$url_sender' class='btn btn-link btn-xs'>" . $message['username'] . "<a/></td>";
                    echo "<td>" . $message['date'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?php

include_once "src/templates/commons/footer.html";

?>
