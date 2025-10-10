<?php
    include "database.php";
    session_start();

    $userid = $_SESSION["userid"];

    $sql = "SELECT tu2.name FROM tUser AS tu
            INNER JOIN tFriends AS tf
            ON tu.user_id = tf.user_id
            INNER JOIN tUser AS tu2 ON tf.friend_id = tu2.user_id WHERE tu.user_id = $userid";
    try {
        $data = mysqli_query($conn, $sql);

        if(mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
                
                echo   '<div class="friend">
                            <img src="assets/img/mypicture.png" alt="" width="150px" height="150px">
                            <span class="text-center mt-2 fw-bold">'.$row["name"].'</span>
                        </div>';
            }
        }
    }
    catch(Exception $e) {
        echo $e;
    }
?>