
<?php 
    $DB_SERVER = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_DATABASE = "testing";
    $conn = "";

    try {
        $conn = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    }
    catch(Exception $e) {
        echo "not connected";
    }

?>