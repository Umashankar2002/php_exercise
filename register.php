<?php 
  session_start();
  if($_SESSION["userid"]) {
      header("Location: home.php");
      exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Facebook - Sign Up</title>
  <link rel="stylesheet" href="login_register.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="ajax.js"></script>
</head>
<body class="body">

  <div class="container">
    <div class="register-box">
      <div class="fb-title">Sign Up</div>

      <form action="insert-user.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label fw-bold">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-bold">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label fw-bold">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required />
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label fw-bold">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required />

          <span id="phone-error"></span>
        </div>

        <div>
          <button type="submit" class="btn btn-success form-control fw-semibold">Sign Up</button>
        </div>

        <div class="text-center mt-3">
          <a href="index.php">Already have an account?</a>
        </div>

        <div class="registration-error">
          <span><?php echo $_SESSION["user-exist"]; ?></span>
        </div>

      </form>
    </div>
  </div>

</body>
</html>
