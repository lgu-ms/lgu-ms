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
            <span class="navbar-brand-name default-light">
                <?php echo $getString["site_name"]; ?>
            </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (!isset($hideSearchBar)) {
                    echo '
                <li class="nav-item">
                        <div class="search-container">
                            <input id="search" placeholder="' . $getString["search_placeholder"] . '" type="text" name="gsc.q">
                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                </li>
                ';
                }
                ?>

                <script>
                    if (typeof search !== "undefined") {
                        function g_search() {
                            window.location.href = '<?php echo $directory; ?>search#gsc.q=' + escapeHtml(search.value);
                        }

                        search.addEventListener("keyup", ({key}) => {
                            if (key === "Enter") {
                                g_search();
                            }
                        });

                        but.onclick = function () {
                            g_search();
                        };
                    }

                </script>

                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>">
                        <?php echo $getString["home"]; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>modules">
                        <?php echo $getString["modules"]; ?>
                    </a>
                </li>
                <?php
                if (!isset($home)) {
                    echo '
                     <li class="nav-item">
                    <a class="nav-link default-light" href="' . $directory . 'milestone">' . $getString["milestone"] . '</a>
                </li>
                     ';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link default-light" href="<?php echo $directory; ?>contact">
                        <?php echo $getString["contact_us"]; ?>
                    </a>
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
                            <a class="nav-link  default-light" href="#' . $dec_user_name . '">';

                            $filename = $directory . "avatar/" . $_SESSION["user_id"] . '.png';
                            if (file_exists($filename)) {
                                $ff .= ' <img class="rounded" src="' . $filename . '"
                                width="20" height="20" alt="User Avatar" />';
                            } else {
                                $ff .= ' <i class="fa-solid fa-circle-user  default-light"></i>';
                            }

                            $ff .= ' &nbsp;' . $row["user_name"] . '
                            </a>
                        </li>
                            ';
                        }
                    }
                } else {

                    if (!isset($hideLoginButton)) {
                        $ff = '
                <li class="nav-item prim">
                <a class="nav-link default-light" href="' . $directory . 'signup?ref=signup_button">
                   ' . $getString["sign_up"] . '
                </a>
            </li>
            <li class="nav-item prim">
            <a class="nav-link  btn btn-primary px-4" href="' . $directory . 'login?ref=login_button">
            ' . $getString["log_in"] . '
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
                            <span class="text sec px-2">' . $dec_user_name . '</span>';

                    $filename = $directory . "avatar/" . $_SESSION["user_id"] . '.png';
                    if (file_exists($filename)) {
                        $ff .= ' <img class="rounded" src="' . $filename . '"
                                width="20" height="20" alt="User Avatar" />';
                    } else {
                        $ff .= ' <i class="fa-solid fa-circle-user  default-light"></i>';
                    }

                    $ff .= '  </a>
                        </li>
                            ';

                } else {

                    if (!isset($hideLoginButton)) {
                        $ff = '
                    <li class="nav-item seco">
                    <a class="nav-link default-light" href="' . $directory . 'login?ref=login_button">
                    <span class="text sec px-2"> ' . $getString["log_in"] . '</span>
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