<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <meta property="og:type" content="website" />
    <meta charset="utf-8">
    <link rel="preload" href="../assets/MavenPro.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="../assets/SourceCodePro-Regular.ttf" as="font" type="font/ttf" crossorigin>
    <meta property="article:publisher" content="https://www.facebook.com/melvinjonesrepol">
    <meta property="article:modified_time" content="2023-10-25T23:37:36+00:00">

    <meta property="og:title" content="Chat Support - Digital Barangay">
    <meta property="og:url" content="http://localhost/lgu-ms/support">
    <meta property="og:site_name" content="Chat Support - Digital Barangay">
    <link rel="canonical" href="http://localhost/lgu-ms/support">
    <meta property="og:description" content="">
    <meta property="og:image" content="http://localhost/lgu-ms/images/cover.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Melvin Jones Repol">
    <!-- TODO: server maintenance 

    http://52.253.118.57
    -->
    <link rel="dns-prefetch" href="https://project-orion.mrepol742.repl.co" />

    <link rel="stylesheet" href="../assets/bootstrap-5.3.0-alpha1.min.css">
    <link rel="stylesheet" href="https://mrepol742.github.io/css/chat.css">
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="apple-touch-icon" href="../favicon.png">
    <title>Chat Support - Digital Barangay</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-light">
            <div class="container-fluid">

                <div class="navbar-brand">
                    <img src="../favicon.png" alt="Logo" width="22" class="d-inline-block align-text-top">
                    Support
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="qwe111">
                    <span class="navbar-toggler-icon" id="qwe"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <div class="container">
                                <div class="row footer-row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <h5>Digital Barangay</h5>
                                        <p>Republic of the Philippines</p>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../about">About</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Contact Us</a>
                                            </li>
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
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="#" class="px-1" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <br>
                                <?php
                                $currentDate = new DateTime();
                                $year = $currentDate->format("Y");
                                ?>
                                <span>© <?php echo $year; ?> LGU Management System</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="toast" id="notif" style="position: fixed; top: 0; left: 0; z-index: 9999; float: right; margin: 3%;" data-bs-autohide="true" data-bs-delay="3000">
        </div>
        <noscript>
            <div class="nojs">
                An error occurred. Try reloading this page, or enable JavaScript if it is disabled in your browser.
            </div>
        </noscript>
        <div id="root" class="root">
            <div class="text-center" id="welcome">
                <h1>Hello, welcome!</h1>
                <h4>Start conversation by entering your message.</h4>
            </div>
            <ul id="chats" class="chats">
            </ul>
            <div class="edittxt">
                <div class="input-group">
                    <button class="navb" id="newchat">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M463.5 224H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5z" />
                        </svg>
                    </button>
                    <input type="text" class="form-control" id="txt">
                    <button class="navb" id="voice">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M192 0C139 0 96 43 96 96V256c0 53 43 96 96 96s96-43 96-96V96c0-53-43-96-96-96zM64 216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 89.1 66.2 162.7 152 174.4V464H120c-13.3 0-24 10.7-24 24s10.7 24 24 24h72 72c13.3 0 24-10.7 24-24s-10.7-24-24-24H216V430.4c85.8-11.7 152-85.3 152-174.4V216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 70.7-57.3 128-128 128s-128-57.3-128-128V216z" />
                        </svg>
                    </button>
                    <button class="navb" id="send">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376V479.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/jquery-3.7.1.min.js"></script>
    <script src="../assets/bootstrap-5.3.0-alpha1.min.js"></script>
    <script src="https://mrepol742.github.io/js/chat.js"></script>
</body>

</html>