<?php

require_once('php_class/Login.php');

    if(isset($_POST['login'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
                
        $userLogin = new Login($_POST["username"], $_POST["password"]);
                
        $userLogin -> checkUserPassword();
    }
    else if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
        header("Location: fuelQuoteForm.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Fuel Quote Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src ="../js/tab.js"></script>
<link rel="stylesheet" href="../styles.css">
</head>
  <header>
  <!-- Tab links -->
  <div class="tab">
    <button class="tablinks" onclick="loginTab()">Login</button>
    <button class="tablinks" onclick="registerTab()">Register</button>
    <button class="tablinks" onclick="profileTab()">Profile</button>
    <button class="tablinks" onclick="quoteTab()">Fuel Quote</button>
    <button class="tablinks" onclick="historyTab()">Fuel Quote History</button>
  </div>
  </header>
<body>
<div class="quote-form">
<form  method="post">
<h2 class="text-center">Log in</h2>
<div class="form-group">
<input type="text" name = "username" id = "username" class="form-control" placeholder="Username" required="required">
</div>
<div class="form-group">
<input type="password" name = "password" id = "password" class="form-control" placeholder="Password" required="required">
</div>
<div class="form-group">
<input type="submit" id= "login" name = "login" class="btn btn-primary btn-block" value = "Log in">
</div>
</form>
<p class="text-center"><a href="client_registration.html">Create an Account</a></p>
</div>
</body>
</html>
