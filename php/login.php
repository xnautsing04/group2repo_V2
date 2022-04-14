<?php

require_once('php_class/Login.php');

//This sets the cookies for username and password, and skips the login page if cookies are already set.
    if(null !== (filter_input(INPUT_POST, "login"))){
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
                
        $userLogin = new Login($username, $password);

        if ($userLogin){
          setcookie("username",$username,time() + 60*60*24*30);
          setcookie("password",$password,time() + 60*60*24*30);
        }

        if ($userLogin->getUsername == NULL){
          header("Location: ../pages/login_err.html");
        }
                
        if($userLogin -> checkUserPassword()){
          header("Location: ../php/fuelQuoteForm.php");
        }
        else{
          header("Location: ../pages/login_err.html");
        }
    }
    else if (null !== (filter_input(INPUT_COOKIE, "username")) && null !== (filter_input(INPUT_COOKIE, "password"))){
        header("Location: fuelQuoteForm.php");
    }
?>

<!DOCTYPE html>
<!-- Login Page -->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Fuel Quote Login</title>
<link rel="stylesheet" href="../bootstrap.min.css" type="text/css">
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
<p class="text-center"><a href="../php/registration.php">Create an Account</a></p>
</div>
</body>
</html>
