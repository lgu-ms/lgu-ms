<nav class="autohide navbar navbar-expand-lg fixed-top scrolled-up scrolled-up-tr">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="qwe111">
            <span class="navbar-toggler-icon" id="qwe"></span>
        </button>
        <a class="navbar-brand " href="<?php echo $directory; ?>">
            <img class="img-responsive" id="toplink" width="60">
        </a>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $directory; ?>about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#modulesModal" data-bs-toggle="modal" data-bs-target="#modulesModal" onmouseover="modulesModal()">Modules</a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav" style="flex-direction: row;">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="text sec px-2">Search</span>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </li>
                <?php

                if (!$isForm) {
                    $ff = '
                    <li class="nav-item">
                    <a class="nav-link" href="' . $directory . 'login?utm_source=login_button">
                        <span class="text sec px-2">Log in</span>
                        <i class="fa-solid fa-user"></i>
                    </a>
                </li>
                    ';
                    echo $ff;
                }

                ?>

            </ul>
        </div>
    </div>
</nav>
<noscript>
    <div class="nojs">
        An error occurred. Try reloading this page, or enable JavaScript if it is disabled in your browser.
    </div>
</noscript>
<div class="modal fade" id="modulesModal" tabindex="-1" aria-labelledby="modulesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 1</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 2</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 3</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 4</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 5</a>
                           

                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 6</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 7</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 8</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 9</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 10</a>
                     

                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 11</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 12</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 13</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 14</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 15</a>
                        

                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 16</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 17</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 18</a>
                            <a class="" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 19</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>