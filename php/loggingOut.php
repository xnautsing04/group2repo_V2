<!-- General PHP file to initiate logging out -->

<?php

require_once("php_class/Login.php");

setcookie("username","",time() - 3600);
setcookie("password","",time() -3600);

header("Location: ../php/login.php");
