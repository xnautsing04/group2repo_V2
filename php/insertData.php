<!-- General PHP file to insert data -->

<?php

//This ensures that if a user is not logged in, it will direct them to the login page.
if(null !== (filter_input(INPUT_COOKIE, "username"))){
    $user = filter_input(INPUT_COOKIE, "username");
}
else{
    header("Location: login.php");
}

?>


<?php
require_once('php_class/FuelQuote.php');
$userQuote = new FuelQuote(filter_input(INPUT_POST, "GallonNumberConf"), filter_input(INPUT_POST, "DelDateConf"), $user);

$userQuote->insertData();

