<?php
    include "database.php";
    session_start();

    $userid = $_SESSION["backuserid"];

    $sql = "SELECT tu2.user_id, tu2.name FROM tUser AS tu
            INNER JOIN tFriends AS tf
            ON tu.user_id = tf.user_id
            INNER JOIN tUser AS tu2 ON tf.friend_id = tu2.user_id WHERE tu.user_id = $userid";
    try {
        $data = mysqli_query($conn, $sql);

        if(mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {

                echo   '<a href="home.php?friendid=' . $row["user_id"] . '&friendname=' .$row["name"] . '"" class="friend-link"><div class="friend">
                            <img src="assets/img/mypicture.png" alt="" class="friend-list-images">
                            <span class="text-center mt-2 fw-bold friend-name">'.$row["name"].'</span>
                        </div></a>';
            }
        }
    }
    catch(Exception $e) {
        echo $e;
    }
?>