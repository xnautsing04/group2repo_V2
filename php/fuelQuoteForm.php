<!-- Fuel Quote Form -->

<?php

require_once('php_class/Login.php');

//This ensures that if a user is not logged in, it will direct them to the login page.
if(isset($_COOKIE["username"])){
    $user = $_COOKIE["username"];
}
else{
    header("Location: login.php");
}


?>


<!DOCTYPE html>
<html lang = "en">
    <meta charset="UTF-8">
    <title>Fuel Quote Form</title>
    <head>
        <link rel="stylesheet" href="../styles.css">
        <script src = "../js/formMover.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src ="../js/tab.js"></script>
    </head>
    <body>
        <?php
        require_once('php_class/PriceCalculator.php');
        ?>
        <header>
            <!----- Tab links ----->
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
                    <label for = "DelAddr">Delivery Address:</label>
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
