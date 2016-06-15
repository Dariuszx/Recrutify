<?php
include('src/session.php');
include('src/userProfile.php');

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
                                        <div class="col-md-offset-3 col-md-6">
                                            <a href="inbox.php" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Skrzynka odbiorcza</a>
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
                    <div class="panel-heading">Dostępne testy</div>
                    <div class="list-group">
                        <?php

                        for ($i = 0; $i < count($tests); $i++) {
                            $test = $tests[$i];
                            echo "<a href=\"test.php?test_id=" . $test[0] . "\" class=\"list-group-item\">";
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
include_once "src/templates/profile/footer.html";

