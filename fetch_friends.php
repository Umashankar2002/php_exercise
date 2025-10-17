<?php
    include "database.php";
    session_start();

    $userid = $_SESSION["backuserid"];
    $sql = "SELECT tu2.user_id, tu2.name FROM tUser AS tu
            INNER JOIN tFriends AS tf
            ON tu.user_id = tf.user_id
            INNER JOIN tUser AS tu2 ON tf.friend_id = tu2.user_id WHERE tu.user_id = $userid";
            
    $response = [
        'count' => 0,
        'html' => ''
    ];
    try {
        $data = mysqli_query($conn, $sql);
        if(mysqli_num_rows($data) > 0) {
            $count = mysqli_num_rows($data);
            $response['count'] = $count;
            while ($row = mysqli_fetch_assoc($data)) {

                $html .= '<a href="home.php?friendid=' . $row["user_id"] . '&friendname=' .$row["name"] . '"" class="friend-link"><div class="friend">
                            <img src="assets/img/friends.png" alt="" class="friend-list-images">
                            <span class="fw-bold friend-name">'.$row["name"].'</span>
                        </div></a>';
            }
            $response['html'] = $html;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    catch(Exception $e) {
        echo $e;
    }
?>