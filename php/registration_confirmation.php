<!-- Registration Confirmation Page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Confirmation</title>
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

    <!-- Body portion to display Registration Confirmation -->
    <div class="quote-form">
      <form action="/examples/actions/confirmation.php">
      <h2>
        <?php
          require_once('php_class/Registration.php');
          $clientRegistration = new ClientRegistration($_POST["Username"], $_POST["Password"]);
        ?>
      </h2>
      </form>
      <p class="text-center"><a href = "../php/login.php">Login</a></p>
    </div>
  </body>
</html>
