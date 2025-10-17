<?php 
    session_start();
    include "database.php";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    if(strlen($phone) != 10) {
        $_SESSION["user-exist"] = "Invalid phone number";
        header("Location: register.php");
        exit();
    }    
    $query = "SELECT * FROM tUser WHERE email_id = '$email'";
    $sql = "INSERT INTO tUser (user_id, name, email_id, password, address, phone) VALUES (11, '$name', '$email', '$password', '$address', '$phone')";
    $data = "";
    try {
        $row = mysqli_query($conn, $query);
        if(mysqli_num_rows($row) > 0) {
            $_SESSION["user-exist"] = "User already exist";
            header("Location: register.php");
            exit();
        }
        else {
            $data = mysqli_query($conn, $sql);
            if($data) {
                $_SESSION["register_success"] = true;
                $_SESSION["user-exist"] = "";
                header("Location: index.php");
                exit();
            }
            else {
                header("Location: register.php");
                $_SESSION["user-exist"] = "something wrong";
                exit();
            }
        }
    }
    catch(Exception $e) {
        echo $e;
    }
?>