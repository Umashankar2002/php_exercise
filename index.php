<?php
  session_start();

  $showLoginPopup = false;
  $message = "";
  if (isset($_SESSION["logout_success"])) {
      $showLoginPopup = true;
      $message = "logout success";
      unset($_SESSION["logout_success"]);
  }
  
  if (isset($_SESSION["register_success"])) {
      $showLoginPopup = true;
      $message = "register success";
      unset($_SESSION["register_success"]);
  }

  if ($_SESSION["userid"]) {
      header("Location: home.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facebook Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="login_register.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="fb-title">Facebook</div>
      <form action="check_login.php" method="POST">
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email or phone number" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary form-control fw-semibold">Log In</button>
        </div>
        <div class="text-center mb-3">
          <a href="#" class="text-decoration-none">Forgotten password?</a>
        </div>
        <hr>
        <div class="text-center">
          <a href="register.php"><button type="button" class="btn btn-success form-control create-button fw-semibold">Create New Account</button></a>
        </div>
      </form>
      
      <div class="error-message">
        <?php 
            echo $_SESSION["login-error"];
        ?>
      </div>

      <?php 
            if($showLoginPopup) { ?>
                <div class="alert alert-success alert-dismissible fade show message-popup" role="alert">
                    <strong><?php echo $message; ?></strong>
                </div>
        <?php   }
        ?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
