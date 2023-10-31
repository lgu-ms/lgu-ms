<?php
if (!$isForm) {
    include("dbcon.php");
}
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
            <span class="navbar-brand-name"> Digital Barangay </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $directory; ?>">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Search
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $directory; ?>contact">Contact Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $directory; ?>modules">Modules</a>
                </li>

                <?php
                $ff = null;
                if (isLogin()) {
                    $user_id = $_SESSION["user_id"];
                    $getUserName = mysqli_query($conn, "SELECT * FROM account WHERE _id = $user_id");

                    if (mysqli_num_rows($getUserName) > 0) {
                        while ($row = mysqli_fetch_assoc($getUserName)) {
                            $ff = '
                            <li class="nav-item prim">
                            <a class="nav-link" href="' . $directory . 'profile">
                           @' . $row["user_name"] . '
                            </a>
                        </li>
                            ';
                        }
                    }
                } else {
                    if (!$isForm) {
                        $ff = '
                    <li class="nav-item prim">
                    <a class="nav-link" href="' . $directory . 'login?utm_source=login_button">
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
                    $user_id = $_SESSION["user_id"];
                    $getUserName = mysqli_query($conn, "SELECT * FROM account WHERE _id = $user_id");

                    if (mysqli_num_rows($getUserName) > 0) {
                        while ($row = mysqli_fetch_assoc($getUserName)) {
                            $ff = '
                            <li class="nav-item seco">
                            <a class="nav-link" href="' . $directory . 'profile">
                            <span class="text sec px-2">@' . $row["user_name"] . '</span>
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                            ';
                        }
                    }

                } else {
                    if (!$isForm) {
                        $ff = '
                    <li class="nav-item seco">
                    <a class="nav-link" href="' . $directory . 'login?utm_source=login_button">
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
<noscript>
    <div class="nojs">
        An error occurred. Try reloading this page, or enable JavaScript if it is disabled in your browser.
    </div>
</noscript>
<div class="toast" id="error-toast"
    style="position: fixed; bottom: 0; right: 0; z-index: 9999; float: right; margin: 3%;" data-bs-autohide="true">
    <div class="toast-header">
        <strong class="me-auto"><i class="fa-solid fa-circle-exclamation"></i> &nbsp; Houston!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <p id="error"></p>
    </div>
</div>
<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popupModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="popupModalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>