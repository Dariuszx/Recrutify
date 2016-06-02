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
                                <img src="src/resources/img/profile-photo.png" class="img-circle profile-avatar" alt="User avatar">
                                <h5><?php echo $username; ?></h5>
<!--                                <div class="user-button">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-md-6">-->
<!--                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>-->
<!--                                        </div>-->
<!--                                        <div class="col-md-6">-->
<!--                                            <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-user"></i> Add as friend</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
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

