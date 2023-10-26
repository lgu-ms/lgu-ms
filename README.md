# lgu-ms

A proposed Local Government Unit Management System Project

<img src="animated-roped-off-construction-barracades.gif">

## Required Software
- XAMPP

## Configure `/include/config.php`
Do not attempt adding this file to git i will deny your PR request since most of us might have different configurations.
```php
<?php

    // replace the following mysql address if you didn't use port 3306
    $mysql_address = "localhost";

    // replace the default user if you have set a new one
    $mysql_user = "root";

    // replace the default password if you have set a new one
    $mysql_password = "";

    // the default LGU-MS database name change if you use other names
    $mysql_db = "lgu-ms";

    // this controls weather to show php & mysql error, must be off in production & deployment
    $debug = true;
?>
```

## Install
- Forked this repository to your own Github Account
- Clone this repository to xampp/htdocs
```bash
git clone git@github.com:{username}/lgu-ms.git
```

## Run
- Open XAMPP
- Start Apache and MySQL server.
- Open this link http://localhost/lgu-ms

## Live Demo
May not be up to date
https://lgu.mrepol742.repl.co

## Note
Please avoid doing the following
- renaming the project folder to other name other than `lgu-ms`
- moving the project to other folder other than `htdocs` in xampp.
- do not add & commit without formating the document in VSCode Format Document is `Ctrl+Shift+I`