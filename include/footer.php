<footer class="mt-5">
    <div class="container">
        <div class="row footer-row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <h5>
                    <?php echo $getString["site_name"] ?>
                </h5>
                <p>
                    <?php echo $getString["republic_phil"] ?>
                </p>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>">
                            <?php echo $getString["home"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>contact">
                            <?php echo $getString["contact_us"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>modules">
                            <?php echo $getString["modules"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>cookies">
                            <?php echo $getString["cookies_policy"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>privacy">
                            <?php echo $getString["privacy_policy"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $directory; ?>terms">
                            <?php echo $getString["terms_of_service"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://stats.uptimerobot.com/n0EyAslx3A" target="_blank">
                            <?php echo $getString["uptime_status"] ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <!-- HEADS UP 
      
        Most of the government sites are hosted in .gov.ph domain including local government units.
      
      -->
                <h5>
                    <?php echo $getString["about_govph"] ?>
                </h5>
                <p>
                    <?php echo $getString["learn_govph"] ?>
                    </< /p>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="//www.gov.ph">
                            <?php echo $getString["official_gazette"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//data.gov.ph">
                            <?php echo $getString["data_portal"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//www.gov.ph/feedback/idulog/">
                            <?php echo $getString["feedback_govph"] ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <h5>
                    <?php echo $getString["gov_link"] ?>
                </h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="//president.gov.ph">
                            <?php echo $getString["office_of_president"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//ovp.gov.ph">
                            <?php echo $getString["office_of_vice_president"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//www.senate.gov.ph">
                            <?php echo $getString["senate_of_philppines"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//www.congress.gov.ph">
                            <?php echo $getString["house_of_representatives"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//sc.judiciary.gov.ph">
                            <?php echo $getString["supreme_court"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//ca.judiciary.gov.ph">
                            <?php echo $getString["court_of_appeals"] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="//sb.judiciary.gov.ph">
                            <?php echo $getString["sandiganbayan"] ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <h5>
                    <?php echo $getString["toggle_theme"] ?>
                </h5>
                <div class="form-check form-switch" id="themeswitch">
                </div>

                <?php
                if (!isLogin()) {
                    echo '<div class="mt-5 mb-2">
               <h5 class="mt-2">' . $getString["account"] . '</h5>
               <a type="button" class="btn btn-primary shadow px-4" href="' . $directory . 'login">' . $getString["log_in"] . '</a>
               <a type="button" class="btn btn-outline-primary px-4" href="' . $directory . 'signup">' . $getString["sign_up"] . '</a></div>
              
               <a href="' . $directory . 'forgotpassword">' . $getString["forgot_password"] . '</a></div>
               ';
                }
                ?><br>
                <h5>
                    Language
                </h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="?hl=en">
                            English
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?hl=fil">
                            Filipino
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-x-twitter"></i>
        </a>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-youtube"></i>
        </a>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-github"></i>
        </a>
        <a href="#" class="px-1" target="_blank">
            <i class="fa-brands fa-linkedin"></i>
        </a>
        <br>
        <?php
        $currentDate = new DateTime();
        $year = $currentDate->format("Y");
        ?>
        <span>©
            <?php echo sprintf($getString["copyright"], $year); ?>
        </span>
</footer>
<script src="<?php echo $directory; ?>vendor/components/jquery/jquery.min.js"></script>
<script src="<?php echo $directory; ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<?php
if (isset($masonry)) {
    echo ' <script src="' . $directory . 'vendor/components/masonry/masonry.pkgd.min.js"></script>';
}
if (isset($recaptcha)) {
    echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $captcha_site_key . '"></script>';
    echo '<script src="' . $directory . 'js/grecaptcha.js"></script>';
}
?>
<script src="<?php echo $directory; ?>js/main.js"></script>
<?php
if (isset($loadCustomJS)) {
    echo $loadCustomJS;
}
?>
<script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker
            .register("<?php echo $directory; ?>sw.js")
            .then((reg) => {
                if (reg.installing) {
                    console.log("Service worker installing");
                } else if (reg.waiting) {
                    console.log("Service worker installed");
                } else if (reg.active) {
                    console.log("Service worker active");
                }
            })
            .catch((err) => {
                console.error("Service worker failed: ", err);
            });
    }

    $(document).ready(function () {
        $(document).click(
            function (event) {
                var target = $(event.target);
                var _mobileMenuOpen = $(".navbar-collapse").hasClass("show");
                if (_mobileMenuOpen === true && !target.hasClass("navbar-toggler")) {
                    $("button.navbar-toggler").click();
                }
            }
        );
    });
</script>