<?php
include('src/reg.php');

if (isset($_SESSION['login_user'])) {
    header("location: profile.php");
}

include "src/templates/commons/header.html";
?>

    <!-- /.preloader -->
    <div id="preloader"></div>
    <div id="top"></div>

    <!-- /.parallax full screen background image -->
    <div class="fullscreen landing parallax" style="background-image:url('src/resources/img/bg3.jpg');"
         data-img-width="2000" data-img-height="1333" data-diff="100">

        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

                        <!-- /.logo -->
                        <div class="logo wow fadeInDown"><a href=""><img src="src/resources/img/logo_white.png"
                                                                         alt="logo"></a></div>

                        <!-- /.main title -->
                        <h1 class="wow fadeInLeft">
                            Witaj w Recrutify!
                        </h1>

                        <!-- /.header paragraph -->
                        <div class="landing-text wow fadeInLeft">
                            <p>Recrutify to przyjazne miejsce, które pomoże ci w szybki i prosty sposób znaleźć
                                wymarzoną pracę. Wystarczy się zarejestrować, wypełnić test wiedzy i czekać na telefon
                                od przyszłego pracodawcy. Proste? A więc do dzieła!</p>
                        </div>

                        <!-- /.header button -->
                        <div class="head-btn wow fadeInLeft">
                            <a href="index.php" class="btn-primary">Zaloguj się</a>
                        </div>
                    </div>

                    <!-- /.signup form -->
                    <div class="col-md-4">

                        <div class="signup-header wow">

                            <h3 class="form-title text-center"><b>Zarejestruj się</b></h3>
                            <p class="error-form"><?php echo $error; ?></p>
                            <form class="form-header" method="post" action="">
                                <div class="form-group">
                                    <input class="form-control input-lg" type="text" name="username"
                                           placeholder="Nazwa użytkownika" required="required"
                                           value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="email" name="email"
                                           placeholder="Adres email" required="required"
                                           value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="password" name="password1"
                                           placeholder="Hasło" required="required"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" type="password" name="password2"
                                           placeholder="Powtórz hasło" required="required"/>
                                </div>
                                <div class="form-group">
                                            <select class="form-control" name="selectStanowisko" id="selectStanowisko">
                                                <option value="-1">Stanowisko</option>
                                                <?php
                                                    for($i=0; $i < count($stanowiska); $i++)
                                                        echo "<option value='".$stanowiska[$i]["position_id"]."'>".$stanowiska[$i]["name"]."</option>";
                                                ?>
                                            </select>
                                </div>

                                <div class="form-group checkbox">
                                    <label><input type="checkbox" name="employer">Pracodwaca</label>
                                </div>

                                <p style="text-align: center; margin: 5px 0px 0px 0px;"><img " id="captcha"
                                    src="src/lib/securimage/securimage_show.php" alt="CAPTCHA" /></p>

                                <p style="margin:0px 0px 5px 0px;" class="privacy text-center">
                                    <a href="#"
                                       onclick="document.getElementById('captcha').src = 'src/lib/securimage/securimage_show.php?' + Math.random(); return false">Inny
                                        obrazek</a>
                                </p>
                                <div class="form-group">

                                    <input class="form-control input-sm captcha-input captcha-input" type="text"
                                           name="captcha_code" size="10" maxlength="6"/>
                                </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-block btn-large"
                                       value="Zarejestruj "/>
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