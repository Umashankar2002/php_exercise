<?php 
include "database.php";
session_start();

$name     = $_POST["name"];
$email    = $_POST["email"];
$password = $_POST["password"];
$address  = $_POST["address"];
$phone    = $_POST["phone"];
$user_id  = $_SESSION["userid"];

try {
    $sql = "UPDATE tUser SET name = ?, email_id = ?, password = ?, address = ?, phone = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $password, $address, $phone, $user_id);
    echo "hello";
    $stmt->execute();
    $_SESSION["update_success"] = true;
    header("Location: home.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
