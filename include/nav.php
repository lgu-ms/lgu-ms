<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THF33NQG" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>

<?php
$dec_user_name = null;

?>

<div class="progress-container fixed-top">
    <span class="progress-bar"></span>
</div>
<nav class="autohide navbar navbar-expand-lg fixed-top scrolled-up scrolled-up-tr">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="qwe111">
            <span class="navbar-toggler-icon" id="qwe"></span>
        </button>

        <a class="navbar-brand " href="<?php echo $directory; ?>">
            <img src="<?php echo $directory; ?>favicon.ico" alt="Icon" height="20" class="navbar-brand-icon">
            <span class="navbar-brand-name default-light"> Digital Barangay </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (!isset($hideSearchBar)) {
                    echo '
                <li class="nav-item">
                    <form action="<?php echo $directory; ?>search" method="get">
                        <div class="search-container">
                            <input id="search" placeholder="What are you looking for?" type="text" name="q">
                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                    </form>
                </li>
                ';
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>contact">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>modules">Modules</a>
                </li>

                <?php
                $ff = null;
                if (isLogin()) {
                    $user_id = $_SESSION["user_id"];
                    $getUserName = mysqli_query($conn, "SELECT * FROM account WHERE _id = $user_id");

                    if (mysqli_num_rows($getUserName) > 0) {
                        while ($row = mysqli_fetch_assoc($getUserName)) {
                            $dec_user_name = $row["user_name"];
                            $ff = '
                            <li class="nav-item prim" onclick="openProfile()">
                            <a class="nav-link  default-light" href="#' . $dec_user_name . '">
                            <i class="fa-solid fa-circle-user  default-light"></i> &nbsp;' . $row["user_name"] . '
                            </a>
                        </li>
                            ';
                        }
                    }
                } else {

                    if (!isset($hideLoginButton)) {
                        $ff = '
                    <li class="nav-item prim">
                    <a class="nav-link default-light" href="' . $directory . 'login?ref=login_button">
                        Login
                    </a>
                </li>
                    ';
                    }
                }
                echo $ff;

                ?>

            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav" style="flex-direction: row;">
                <?php
                $ff = null;
                if (isLogin()) {
                    $ff = '
                            <li class="nav-item seco" onclick="openProfile()">
                            <a class="nav-link" href="#' . $dec_user_name . '">
                            <span class="text sec px-2">' . $dec_user_name . '</span>
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                            ';

                } else {

                    if (!isset($hideLoginButton)) {
                        $ff = '
                    <li class="nav-item seco">
                    <a class="nav-link default-light" href="' . $directory . 'login?ref=login_button">
                    <span class="text sec px-2">Log in</span>
                    <i class="fa-solid fa-user"></i>
                    </a>
                </li>
                    ';
                    }
                }
                echo $ff;

                ?>
            </ul>
        </div>
    </div>
</nav>

<?php
include("popups.php");
?>