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
                <li class="nav-item dropdown">
                    <a class="nav-link btn dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Modules
                    </a>
                    <div class="dropdown-menu dropdown-multicol2" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-col">
                            <a class="dropdown-item" href="#"> <i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 1</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 2</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 3</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 4</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 5</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 6</a>
                        </div>
                        <div class="dropdown-col">
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 7</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 8</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 9</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 10</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 11</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 12</a>
                        </div>
                        <div class="dropdown-col">
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 13</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 14</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 15</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 16</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 17</a>
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 18</a>
                        </div>
                        <div class="dropdown-col">
                            <a class="dropdown-item" href="#"><i class="fa-solid fa-book" style="color: #213454; padding: 10px;"></i> Module 19</a>
                        </div>
                    </div>
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