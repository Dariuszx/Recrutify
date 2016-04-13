<?php
include('src/reg.php');

if(isset($_SESSION['login_user']))
{
    header("location: profile.php");
}

include "src/templates/commons/header.html";
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
                            <a href="index.php" class="btn-primary">Zaloguj się</a>
                        </div>

                    </div>

                    <!-- /.signup form -->
                    <div class="col-md-5">

                        <div class="signup-header wow fadeInUp">
                            <h3 class="form-title text-center">Rozpocznij</h3>
                            <p style="color: greenyellow; font-size: 80%;text-align:center;"><?php echo $error; ?></p>

                            <form method="post" action="">
                                <div class="form-group">
                                    <input class="form-control input-lg" type="text" name="username" placeholder="Nazwa użytkownika" required="required" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="email" name="email" placeholder="Adres email" required="required" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="password" name="password1" placeholder="Hasło" required="required" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="password" name="password2" placeholder="Powtórz hasło" required="required" />
                                </div>

                                    <p style="text-align: center; margin: 5px 0px 0px 0px;"><img " id="captcha" src="src/lib/securimage/securimage_show.php" alt="CAPTCHA" /></p>

                                <p style="margin:0px 0px 5px 0px;" class="privacy text-center">
                                    <a href="#" onclick="document.getElementById('captcha').src = 'src/lib/securimage/securimage_show.php?' + Math.random(); return false">Inny obrazek</a>
                                </p>
                                <div class="form-group">
                                    <input class="form-control input-sm" type="text" name="captcha_code" size="10" maxlength="6" />
                                </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-block btn-large" value="Zarejestruj"  />
                            </form>
                            <p></p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once "src/templates/commons/footer.html";