<?php 
    include "database.php";
    session_start();
    $userid = $_SESSION["backuserid"];
    $sql = "";

    if($_SESSION['original_userid'] == $userid) {
        $sql = "SELECT * FROM tUser AS tu 
            INNER JOIN tWall AS tw ON tu.user_id = tw.user_id  
            ORDER BY tw.posting_date DESC";
    }
    else {
    $sql = "SELECT * FROM tUser AS tu 
        INNER JOIN tWall AS tw ON tu.user_id = tw.user_id 
        WHERE tu.user_id = $userid 
        ORDER BY tw.posting_date DESC";
    }
    $data = "";

    try {
        $data = mysqli_query($conn, $sql);
        if(mysqli_num_rows($data) > 0)
        {
            echo '<html>
                        <header>
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                            <link rel="stylesheet" href="style.css">
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
                        </header>
                        <body>';
            while($post = mysqli_fetch_assoc($data))
            {
                $name = $post["name"];
                $comment = $post["post"];

                $posting_time = strtotime($post['posting_date']);
                $diff = time() - $posting_time;
                if($diff < 60) $time_text = "Just now";
                elseif($diff < 3600) $time_text = floor($diff/60)." min ago";
                elseif($diff < 86400) $time_text = floor($diff/3600)." hr ago";
                else $time_text = date("d M Y H:i", $posting_time);
                $likes = rand(100,1000);
                $comments = rand(10,100);
                $shares = rand(1,50);
                echo    '<div class="post-comments">  
                            <div class="post-details">
                                <div class="post-profile-name">
                                    <div>
                                        <img src="assets/img/mark-zuckerberg.jpg" alt="" width="40px" height="40px" class="rounded-circle">
                                    </div>
                                    <div>
                                        <div class="user-name-of-post">
                                            <span >'.$name.'</span>
                                        </div>
                                        <div class="date-of-post">
                                            <span>'.$time_text.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="post-three-dots">
                                    <img src="assets/img/three-dots.svg" alt="">
                                </div>
                            </div>

                            <div class="text-comment">
                                '.$comment.'
                            </div>

                            <div class="post-likes-section">
                                <div>
                                    <img src="assets/img/thumbsup.svg" alt="" height="18px" width="18px" class="thumbsup-symbol">
                                    <img src="assets/img/heart.svg" alt="" height="18px" width="18px" class="heart-symbol">
                                    <span class="post-like-count">'.$likes.'K</span>
                                </div>

                                <div class="comments-shares-container">
                                    <span class="comments-count">'.$comments.'K comments</span>
                                    <span class="shares-count">'.$shares.'k shares</span>
                                </div>
                            </div>
                            <div class="post-footer-container">
                                <hr>
                                <div class="row">
                                    <div class="col-4 post-like">
                                        <img src="assets/img/like (1).png" alt="" height="20px" width="20px">
                                        <span class="post-footer">Like</span>
                                    </div>
                                    <div class="col-4 post-like">
                                        <img src="assets/img/chat.png" alt="" height="20px" width="20px">
                                        <span class="post-footer">Comment</span>
                                    </div>
                                    <div class="col-4 post-like">
                                        <img src="assets/img/share.png" alt="" height="20px" width="20px">
                                        <span class="post-footer">Shere</span>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>';      
            }
            echo '</body></html>';
        }
    }
    catch(Exception $e)
    {
        echo $e;
    }
?>