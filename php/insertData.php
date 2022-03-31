<!-- General PHP file to insert data -->

<?php

//This ensures that if a user is not logged in, it will direct them to the login page.
if(isset($_COOKIE["username"])){
    $user = $_COOKIE["username"];
    
}
else{
    header("Location: login.php");
}

?>


<?php
require_once('php_class/FuelQuote.php');
$userQuote = new FuelQuote($_POST["GallonNumberConf"], $_POST["DelDateConf"], $user);

$userQuote->insertData();

