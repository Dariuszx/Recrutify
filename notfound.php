<?php

include('src/session.php');

include_once 'src/tools.php';

$data = new UserData();

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $data->validateInputData($message);
}


include "src/templates/profile/header.html";

?>

<div class="container wrapper">

    <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-dismissible alert-danger" style="text-align: center;">
            <h4><?php
                if(isset($message)) {
                    echo $message." <i class=\"fa fa-meh-o\" aria-hidden=\"true\"></i>";
                } else echo "Nie znaleziono zasobów! <i class=\"fa fa-meh-o\" aria-hidden=\"true\"></i>"
                ?></h4>
        </div>
    </div>

</div>

<?php

include_once "src/templates/commons/footer.html";

?>
