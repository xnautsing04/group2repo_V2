<!-- General PHP file to initiate logging out -->

<?php

require_once("php_class/Login.php");

Login::logOut();
header("Location: ../php/login.php");
