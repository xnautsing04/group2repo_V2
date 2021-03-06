<!-- Form to Register a New Account -->

<?php

require_once('php_class/Login.php');

//This sets the cookies for username and password, and skips the login page if cookies are already set.
    if(null !== (filter_input(INPUT_POST, "login"))){
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
                
        $userLogin = new Login(filter_input(INPUT_POST, "username"), filter_input(INPUT_POST, "password"));
                
        $userLogin -> checkUserPassword();
    }
    else if (null !== (filter_input(INPUT_COOKIE, "username")) && null !== (filter_input(INPUT_COOKIE, "password"))){
        header("Location: fuelQuoteForm.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bootstrap Simple Registration Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src ="../js/tab.js"></script>
	<link rel="stylesheet" href="../styles.css">
	<script src = "../js/formMover.js"></script>
</head>
<body>
	<!-- Tabs -->
	<header>
		<div class="tab">
			<button class="tablinks" onclick="loginTab()">Login</button>
			<button class="tablinks" onclick="registerTab()">Register</button>
			<button class="tablinks" onclick="profileTab()">Profile</button>
			<button class="tablinks" onclick="quoteTab()">Fuel Quote</button>
			<button class="tablinks" onclick="historyTab()">Fuel Quote History</button>
		</div>
	</header>

	<!-- Body portion to input registration information -->
	<div class="quote-form">
		<form action="../php/registration_confirmation.php" method="POST">
			<h2 class="text-center">Register</h2>
			<div class="form-group">
				<input type="text" id = "Username" name = "Username" class="form-control" placeholder="Username" required="required">
			</div>
			<div class="form-group">
				<input type="password" id = "Password" name = "Password" class="form-control" placeholder="Password" required="required">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Register</button>
			</div>
		</form>
		<p class="text-center"><a href="../php/login.php">Already have an Account?</a></p>
	</div>
</body>
</html>
