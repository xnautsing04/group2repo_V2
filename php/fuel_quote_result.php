<?php

require_once("php_class/Login.php");

//This ensures that if a user is not logged in, it will direct them to the login page.
if(null !== (filter_input(INPUT_COOKIE, "username"))){
    $user = filter_input(INPUT_COOKIE, "username");
}
else{
    header("Location: login.php");
}

?>



<!DOCTYPE html>
<!-- Fuel Quote Result Page -->
<html>
    <title>Fuel Quote Result</title>
    <link rel="stylesheet" href="../styles.css">
    <script src = "../js/formMover.js"></script>
    <link rel="stylesheet" href="../bootstrap.min.css" type="text/css">
    <script src ="../js/tab.js"></script>

    <body>
        <?php
            require_once('php_class/FuelQuote.php');
            require_once('php_class/PriceCalculator.php');
            $userQuote = new FuelQuote(filter_input(INPUT_POST, "GallonNumber"), filter_input(INPUT_POST, "DelDate"), $user);
            if ($userQuote -> getGallons() == -1){
                header("Location: ../pages/fuel_quote_err.html");
            }

        ?>
        <header>
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
        <h2 class = "text-center">Fuel Quote Form</h2>

        <form id = "fuelConf" action = "../php/insertData.php" method = "POST">
            <h2 class = "text-center">Please confirm the following information:</h2>
            <br>
        
            <div class = "form-group">
                <span>Suggested Price/Gallon:</span> <span id = "defaultPrice"><?php echo PriceCalculator::suggestedPrice($user, filter_input(INPUT_POST, "GallonNumber")) ?></span> <br>
            </div>

            <div class = "form-group">
                <label for ="GallonNumberConf">Gallon Number: </label><input id = "GallonNumberConf" name ="GallonNumberConf" value = "<?php echo $userQuote -> getGallons(); ?>" readonly> <br>
            </div>

            <div class = "form-group">
                <label>Delivery Address:</label>
                <span id = "profileAddress"><?php echo Login::userAddr($user) ?></span>
            </div>

            <div class = "form-group">
            <label for ="DelDateConf">Delivery Date: </label><input id = "DelDateConf" name ="DelDateConf" value = "<?php echo $userQuote -> getDate(); ?>" readonly> <br>
            </div>

            <div class = "form-group">
                <span>Total Cost: </span> <span id = "costAmount"><?php echo FuelQuote::calculatePrice($user, filter_input(INPUT_POST, "GallonNumber"))?></span> <br>
            </div>

            <div class = "form-group">
                <input type = "submit" class = "btn btn-primary btn-block" value = "Confirm">
            </div>
            
            <div class = "form-group">
                <button type = "button" onClick = "denyInfo()" class = "btn btn-primary btn-block">Deny</button>
            </div>
        </form>
    </div>

    </body>
</html> 
