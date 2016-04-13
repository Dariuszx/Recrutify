<?php

session_start();
include_once "src/tools.php";

//If user is logged in
if(isset($_SESSION['user_id'])) {
    header("location: profile.php");
}
//If user is not logged in
else {
    include "src/login.php";

    include "src/templates/commons/header.html";
}
?>
    <!-- /.preloader -->
    <div id="preloader"></div>
    <div id="top"></div>

    <!-- /.parallax full screen background image -->
    <div class="fullscreen landing parallax" style="background-image:url('src/resources/img/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">

        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">

                        <!-- /.logo -->
                        <div class="logo wow fadeInDown"> <a href=""><img src="src/resources/img/logo.png" alt="logo"></a></div>

                        <!-- /.main title -->
                        <h1 class="wow fadeInLeft">
                            Beautiful High Converting Landing Page
                        </h1>

                        <!-- /.header paragraph -->
                        <div class="landing-text wow fadeInUp">
                            <p>Backyard is a modern and customizable landing page template designed to increase conversion of your product. Backyard is flexible to suit any kind of your business. Try now and join with our happy customers!</p>
                        </div>

                        <!-- /.header button -->
                        <div class="head-btn wow fadeInLeft">
                            <a href="register.php" class="btn-primary">Zarejestruj się</a>
                        </div>

                    </div>

                    <!-- /.signup form -->
                    <div class="col-md-5">

                        <div class="signup-header wow fadeInUp">
                            <h3 class="form-title text-center">Rozpocznij</h3>
                            <p style="color: greenyellow; font-size: 80%;text-align:center;"><?php echo $error; ?></p>
                            <form class="form-header" action="" role="form" method="POST" id="#">
                                <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                                <input type="hidden" name="id" value="bfdba52708">
                                <div class="form-group">
                                    <input class="form-control input-lg" name="username" id="name" type="text" placeholder="Nazwa użytkownika" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" name="password" id="password" type="password" placeholder="Hasło" required>
                                </div>
                                <div class="form-group last">
                                    <input type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="Zaloguj się">
                                </div>
                                <p></p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once "src/templates/commons/footer.html";