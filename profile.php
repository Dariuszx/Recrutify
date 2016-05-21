<?php
    include('src/session.php');
    include('src/userProfile.php');

    include "src/templates/profile/header.html";
?>


    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-push-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Panel użytkownika</div>
                    <div class="panel-body">
                        Panel content
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-pull-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Dostępne testy</div>
                    <div class="panel-body" style="text-align: center;">

                        <?php
                            for ($i = 0; $i < count($tests); $i++) {

                                echo "<a href=\"test.php?test_id=".$tests[$i][0]."\" class=\"btn btn-primary btn-test\">".$tests[$i][1]."</a>";
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>




    </div>


<?php
include_once "src/templates/profile/footer.html";

