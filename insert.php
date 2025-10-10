
<?php 
    include "database.php";
    
    session_start();
    $data = $_POST["comment"];
    $user_id = $_SESSION["userid"];
    $sql = "INSERT INTO tWall (user_id, post) VALUES ($user_id, '$data')";
    try
    {
        mysqli_query($conn, $sql);
    }
    catch(Exception $e) {
        echo $e;
    }
?>