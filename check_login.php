<?php 
include "database.php";
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM tUser WHERE email_id = '$email'";
try {
    $result = mysqli_query($conn, $sql);
} catch (Exception $e) {
    echo $e;
}

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
    if ($row["password"] == $password) {
        $_SESSION["userid"] = $row["user_id"];
        $_SESSION["username"] = $row["name"];
        $_SESSION["login_success"] = true;

        header("Location: home.php");
        exit();
    } else {
        $_SESSION["login-error"] = "Incorrect password.";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>
