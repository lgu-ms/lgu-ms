<footer class="mt-5">
  <div class="container">
    <div class="row footer-row">
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <h5>Digital Barangay</h5>
        <p>Republic of the Philippines</p>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>contact">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>modules">Modules</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>cookies">Cookies Policy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>privacy">Privacy Policy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $directory; ?>terms">Terms of Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://stats.uptimerobot.com/n0EyAslx3A" target="_blank">Uptime Status</a>
          </li>
          <div>
            <?php
             if (!isLogin()) {
               echo '<div class="mt-2 mb-2">
               <a type="button" class="btn btn-primary shadow px-4" href="' . $directory . 'login">Log in</a>
               <a type="button" class="btn btn-outline-primary px-4" href="' . $directory . 'signup">Sign up</a></div>
               ';
            }
            ?>
          </div>
        </ul>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <!-- HEADS UP 
      
        Most of the government sites are hosted in .gov.ph domain including local government units.
      
      -->
        <h5>About GOVPH</h5>
        <p>Learn more about the Philippine goverment, its structure, how government works and the people behind it.</p>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="//www.gov.ph">Official Gazette</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//data.gov.ph">Open Data Portal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//www.gov.ph/feedback/idulog/">Send us your feedback</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <h5>Government Link</h5>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="//president.gov.ph">Office of the President</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//ovp.gov.ph">Office of the Vice President</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//www.senate.gov.ph">Senate of the Philippines</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//www.congress.gov.ph">House of Representatives</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//sc.judiciary.gov.ph">Supreme Court</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//ca.judiciary.gov.ph">Court of Appeals</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="//sb.judiciary.gov.ph">Sandiganbayan</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <h5>Toggle Theme</h5>
        <div class="form-check form-switch" id="themeswitch">
        </div>
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
    <span>© <?php echo $year; ?> Quezon City LGU</span>
</footer>
<script src="<?php echo $directory; ?>vendor/components/jquery/jquery.min.js"></script>
<script src="<?php echo $directory; ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<?php 
if (isset($hideLoginButton)) {
  echo '<script src="https://www.google.com/recaptcha/api.js?render='.$captcha_site_key.'"></script>';
  echo '<script src="'.$directory.'js/grecaptcha.js"></script>';
}
?>
<script src="<?php echo $directory; ?>js/main.js"></script>
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

  $(document).ready(function() {
    $(document).click(
      function(event) {
        var target = $(event.target);
        var _mobileMenuOpen = $(".navbar-collapse").hasClass("show");
        if (_mobileMenuOpen === true && !target.hasClass("navbar-toggler")) {
          $("button.navbar-toggler").click();
        }
      }
    );
  });
</script> 
