<?php

require_once('php_class/Login.php');

//This ensures that if a user is not logged in, it will direct them to the login page.
if(null !== (filter_input(INPUT_COOKIE, "username"))){
    $user = filter_input(INPUT_COOKIE, "username");
}
else{
    header("Location: login.php");
}


?>


<!DOCTYPE html>
<!-- Fuel Quote Form -->
<html lang = "en">
    <meta charset="UTF-8">
    <title>Fuel Quote Form</title>
    <link rel="stylesheet" href="../styles.css">
    <script src = "../js/formMover.js"></script>
    <script src ="../js/tab.js"></script>
    <link rel="stylesheet" href="../bootstrap.min.css" type="text/css">
    <body>
        <?php
        require_once('php_class/PriceCalculator.php');
        ?>
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
            <h2 class = "text-center">Fuel Quote Form</h2>

            <form id = "fuelForm" action = "../php/fuel_quote_result.php" method = "POST">
                <div>
                    <span>Suggested Price/Gallon: </span>
                    <span id = "defaultPrice"><?php echo PriceCalculator::suggestedPrice() ?></span>
                </div>
                <div class = "form-group">
                    <label for = "GallonNumber">Number of Gallons:</label>
                    <input type = "number" id = "GallonNumber" name = "GallonNumber" class = "form-control" min = "0" required>
                </div>
                <div class = "form-group">
                    <label>Delivery Address:</label>
                    <span id = "profileAddress"><?php echo Login::userAddr($user) ?></span><br>
                </div>
                <div class = "form-group">
                    <label for = "DelDate">Delivery Date:</label>
                    <input type = "date" id = "DelDate" name = "DelDate" class = "form-control" min = "2022-03-07" required>
                </div>
                
                <div class = "form-group">
                    <input type = "submit" id = "submitForm" value="Submit" class = "btn btn-primary btn-block">
                </div>
                <div class = "form-group">
                    <button type = "button" onclick="historyLoader()" class = "btn btn-primary btn-block">View History</button>
                </div>
            </form>
            <br>
            </div>
        <script src ="../js/currentDate.js"></script>
    </body>
</html>
