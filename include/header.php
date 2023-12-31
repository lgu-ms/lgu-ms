<?php
if ((!file_exists($directory . 'vendor/autoload.php'))) {
    die('You must have Composer installed and must run the composer install CLI command.' . PHP_EOL .
        'Download Composer from the website: https://getcomposer.org/download/' . PHP_EOL .
        'Then, run the "composer install" command.' . PHP_EOL);
}

include("localization.php"); ?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-THF33NQG');</script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta property="article:publisher" content="<?php echo $page_publisher; ?>">
    <meta property="article:modified_time" content="<?php echo $page_modified_time; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="theme-color" content="#ffffff">
    <link rel="preload" href="<?php echo $directory; ?>fonts/SourceCodePro-Regular.ttf" as="font" type="font/ttf"
        crossorigin>
    <link rel="preload" href="<?php echo $directory; ?>fonts/MavenPro.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="preload" href="<?php echo $directory; ?>images/hamburger-light.svg" as="image" type="image/svg+xml">
    <link rel="preload" href="<?php echo $directory; ?>images/hamburger-dark.svg" as="image" type="image/svg+xml">

    <style>
        @font-face {
            font-family: 'Source Code Pro';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url("<?php echo $directory; ?>fonts/SourceCodePro-Regular.ttf");
        }

        @font-face {
            font-family: 'Maven Pro';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url("<?php echo $directory; ?>fonts/MavenPro.woff2");
        }

        body.light-mode {
            --menu: url("<?php echo $directory_img; ?>images/hamburger-light.svg");
        }

        body {
            --menu: url("<?php echo $directory_img; ?>images/hamburger-dark.svg");
        }
    </style>
    <link href="<?php echo $directory; ?>vendor/components/font-awesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $directory; ?>vendor/components/font-awesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $directory; ?>vendor/components/font-awesome/css/solid.min.css" rel="stylesheet">
    <link href="<?php echo $directory; ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $directory; ?>css/main.css" rel="stylesheet">

    <link rel="icon" href="<?php echo $directory; ?>favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $directory; ?>favicon.png">
    <link rel="apple-touch-icon" href="<?php echo $directory; ?>favicon.png">
    <link rel="manifest" href="<?php echo $directory; ?>site.webmanifest">

    <link rel="license" href="https://digitalbarangay.com/LICENSE">
    <link rel="sitemap" type="application/xml" title="Digital Barangay » Sitemap"
        href="<?php echo $directory; ?>sitemap.xml">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta property="og:url" content="<?php echo $page_url; ?>">
    <meta property="og:site_name" content="<?php echo $page_title; ?>">
    <meta property="og:description" content="<?php echo $page_description; ?>">
    <meta property="og:image" content="<?php echo $page_image; ?>">
    <meta property="twitter:image:src" content="<?php echo $page_image; ?>" />
    <meta property="twitter:title" content="<?php echo $page_title; ?>" />
    <meta property="twitter:description" content="<?php echo $page_description; ?>" />

    <meta name="keywords" content="<?php echo $page_keywords; ?>">
    <meta name="description" content="<?php echo $page_description; ?>" />

    <meta name="author" content="<?php echo $page_author; ?>">

    <link rel="canonical" href="<?php echo $page_canonical; ?>">
    <title>
        <?php echo $page_title; ?>
    </title>

    <?php

    if (isset($customCodeHeader)) {
        echo $customCodeHeader;
    }

    include("update_profile.php");
    ?>
</head>