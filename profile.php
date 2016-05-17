<?php
    include('src/session.php');
    include('src/userProfile.php');

    include "src/templates/commons/header.html";
?>

    <!-- NAVIGATION -->
    <div id="menu">
        <nav class="navbar-wrapper navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand site-name" href="#top"><img src="src/resources/img/logo_black.png" alt="logo"></a>
                </div>

                <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="#intro">About</a></li>
                        <li><a href="#feature">Features</a></li>
                        <li><a href="#download">Download</a></li>
                        <li><a href="#package">Pricing</a></li>
                        <li><a href="#testi">Reviews</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="logout.php">Wyloguj się</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>




    <!-- /.pricing section -->
    <div id="package">
        <div class="container">
            <div class="text-center">

                <!-- /.pricing title -->
                <h2 class="wow">Dostępne testy</h2>
                <div class="title-line wow fadeInRight"></div>
            </div>
            <div class="row package-option">
                
                <?php
                    for ($i = 0; $i < count($tests); $i++) {
                        echo "<div class=\"col-sm-3\" style='margin-bottom: 10px;'>";
                            echo "<div class=\"price-box wow\">";
                                echo "<div class=\"price-heading text-center\" style='padding: 20px;'>";
                                    echo "<h3>", $tests[$i]["name"], "</h3>";

                                    echo "<div class=\"price-footer text-center\">";
                                        echo "<a class=\"btn btn-price\" href=\"#\">Rozpocznij kurs!</a>";
                                    echo "</div>";

                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </div>
<?php
include_once "src/templates/commons/footer.html";

