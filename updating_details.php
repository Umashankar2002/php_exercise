<?php 
include "database.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $address  = $_POST["address"];
    $phone    = $_POST["phone"];
    $user_id  = $_SESSION['original_userid'];

    $_SESSION["username"] = $name;

    try {
        $sql = "UPDATE tUser SET name = ?, email_id = ?, password = ?, address = ?, phone = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $email, $password, $address, $phone, $user_id);
        $stmt->execute();
         $_SESSION["update_success"] = true;
        echo json_encode(["success" => true, "message" => "Profile updated successfully."]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>
