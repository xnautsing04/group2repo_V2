<?php

//This ensures that if a user is not logged in, it will direct them to the login page.
if(null !== (filter_input(INPUT_COOKIE, "username"))){
    $user = filter_input(INPUT_COOKIE, "username");
}
else{
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<!-- Fuel Quote History Page -->
<html lang = "en">
    <meta charset="UTF-8">
    <title>Fuel Quote Form</title>
    <link rel="stylesheet" href="../styles.css">
    <script src = "../js/formMover.js"></script>
    <script src ="../js/tab.js"></script>
    <link rel="stylesheet" href="../bootstrap.min.css" type="text/css">
    <body>
        <header>
            <!-- Tab links -->
            <div class="tab">
                <button class="tablinks" onclick="loginTab()">Login</button>
                <button class="tablinks" onclick="registerTab()">Register</button>
                <button class="tablinks" onclick="profileTab()">Profile</button>
                <button class="tablinks" onclick="quoteTab()">Fuel Quote</button>
                <button class="tablinks" onclick="historyTab()">Fuel Quote History</button>
                <button class ="tablinks" onclick ="logoutTab()" style = "float: right;">Log Out</button>
            </div>
  </header>
        <div class = "quote-form">
        <h2 class = "text-center">Fuel Quote History</h2>

        <?php
            
            require_once('php_class/FuelQuote.php');
            require_once('php_class/FuelHistory.php');
            
            echo FuelHistory::generateHistory("cooldude9");
        ?>
        
        <button type = "button" onclick="formLoader()" class = "btn btn-primary btn-block">Submit New Quote</button>
    </div>
    </body>
</html>
