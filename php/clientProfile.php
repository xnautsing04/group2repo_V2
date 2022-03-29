<!-- Profile Page -->

<?php

if(isset($_COOKIE["username"])){
    $user = $_COOKIE["username"];
    
}
else{
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

	<!-- DBconnection to Retrieve Client Information -->
	<?php
		// Gets DB info from the database.json file
		$JSONcontents = file_get_contents("../json/database.json");
		$databaseObj = json_decode($JSONcontents);
		$connectionString = "host=".$databaseObj->host." port=".$databaseObj->port." dbname=".$databaseObj->dbname." user=".$databaseObj->user." password=".$databaseObj->password;
		$dbconnect = pg_connect($connectionString);
	?>

	<head>
		<link rel="stylesheet" href="../styles.css">
		<script src = "../js/formMover.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src ="../js/tab.js"></script>
		<script src = "../js/tempProfileInfo.js"></script>
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

	<!-- Body portion that shows Client information -->
	<div class="quote-form-p">
		<form id = "profileForm" action = "../pages/client_profile_management.html" method="POST">
			<h2 class="text-center">Profile</h2>
			<div class="form-group">
			<?php
				// SQL to get Client information from DB (Currently fetches 'cooldude9's user info)
				$sql = "SELECT * FROM ClientInformation WHERE Username = '$user';";
				// If able to query sql
				if($result = pg_query($dbconnect, $sql))
				{
					while($row = pg_fetch_array($result)){
						// Display Client information
						echo "<h4>Name</h4>";
						echo "<p>" . $row['full_name'] . "</p>";
						echo "<h4>Address #1</h4>";
						echo "<p>" . $row['address_1'] . "</p>";
						echo "<h4>Address #2</h4>";
						echo "<p>" . $row['address_2'] . "</p>";
						echo "<h4>City</h4>";
						echo "<p>" . $row['city'] . "</p>";
						echo "<h4>State</h4>";
						echo "<p>" . $row['state'] . "</p>";
						echo "<h4>Zipcode</h4>";
						echo "<p>" . $row['zipcode'] . "</p>";
					}
					pg_free_result($result);
				}
				// Otherwise
				else{
					// Send error
					echo "ERROR: Could not able to execute $sql. " . pg_error($dbconnect);
				}
			?>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Edit</button>
			</div>
		</form>
	</div>
	</body>
</html>
