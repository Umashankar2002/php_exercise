<?php 
    include "database.php";
    session_start();

    /*=======================
       popup section
    ========================= */
    $showLoginPopup = false;
    $message = "";
    if (isset($_SESSION["login_success"])) {
        $showLoginPopup = true;
        $message = "Successfully login";
        unset($_SESSION["login_success"]);
    }

    if(!$_SESSION["userid"]) {
        header("Location: index.php");
        exit();
    }

    $log_message = "";
    if($_SESSION["userid"]) {   
        $log_message = "Logout";
    }
    else {
        $log_message = "Login";
    }
    
    /*=======================
        login user id and name
    ========================= */
    if (!isset($_SESSION['original_userid'])) {
        $_SESSION['original_userid'] = $_SESSION['userid'];
    }
    $userenteredid = $_SESSION["userid"];
    if(isset($_GET['friendid'])) {
        $userenteredid = $_GET['friendid'];
    }
    $_SESSION["backuserid"] = $userenteredid;

    $friend_name = $_SESSION["username"];
    if(isset($_GET['friendname'])) {
        $friend_name = $_GET['friendname'];
    }

    $userid = $_SESSION['original_userid'];
    $sql = "SELECT * FROM tUser WHERE user_id = $userid";

    try {
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $person = mysqli_fetch_assoc($result);
            $name = htmlspecialchars($person['name']);
            $email = htmlspecialchars($person['email_id']);
            $password = htmlspecialchars($person['password']);
            $address = htmlspecialchars($person['address']);
            $phone = htmlspecialchars($person['phone']);

        } else {
            echo "No user found.";
            exit;
        }
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">

</head>
<body>
    <div class="facebook-root-container">
        <!--*******************
            navbar section
          ***********************-->
        <div class="row navbar-container">
            <div class="col-xxl-3 col-xl-4 col-md-3 col-sm-5 col-2 navbar-left-content">
                <img src="assets/img/facebook.svg" alt="not found">
                <label for="search" class="rounded-pill navbar-left-search">
                    <span class="left-nav-search-symbol"><img src="assets/img/search.svg" alt=""></span>
                    <input type="text" id="left-nav-input" placeholder="Search Facebook">
                </label>
            </div>
            <div class="col-md-6 navbar-center-content d-none d-sm-flex">
                <div class="nav-bar-img-container">
                    <img src="assets/img/home.svg" alt="" class="nav-center-img" data-bs-toggle="tooltip" title="Home">
                </div>
                <div class="nav-bar-img-container">
                    <img src="assets/img/friends.svg" alt="" class="nav-center-img" data-bs-toggle="tooltip" title="Friends">
                </div>
                <div class="nav-bar-img-container">
                    <img src="assets/img/watch.svg" alt="" class="nav-center-img" data-bs-toggle="tooltip" title="Video">
                </div>
                <div class="nav-bar-img-container">
                    <img src="assets/img/account.svg" alt="" class="nav-center-img" data-bs-toggle="tooltip" title="Groups">
                </div>
            </div>
            <div class="col-xxl-3 col-xl-2 col-md-3 col-sm-7 col-10 navbar-right-content">
                <div class="navbar-right-symbols"><img src="assets/img/list.svg" alt=""></div>
                <div class="navbar-right-symbols"><img src="assets/img/messanger.svg" alt=""></div>
                <div class="navbar-right-symbols"><img src="assets/img/notification.svg" alt=""></div>
                <div class="navbar-right-symbols" id="profile-logout"><img src="assets/img/mypicture.png" alt="" width="40px" height="40px" class="rounded-circle profile">
                    <img src="assets/img/downarrow.svg" alt="" class="downarrow">
                </div>
            </div>
        </div>
        
        <!-- ********************
            popup code
         *********************** -->
        <?php 
            if($showLoginPopup) { ?>
                <div class="alert alert-success alert-dismissible fade show message-popup" role="alert">
                    <strong><?php echo $message; ?></strong>
                </div>
        <?php   }
        ?>
        <!--*******************
            cover image section
          ***********************-->
        <div class="facebook-container">
            <div id="profile-details-container">
                <span class="profile-name"><div class="d-flex align-items-center gap-2"><img src="assets/img/mypicture.png" alt="" width="40px" height="40px" class="rounded-circle profile"><span class="fw-bold"><?php echo $name; ?></span></div></span>
                <hr class="detail-line">
                <form action="logout.php" method="post">
                    <button class="logout"><?php echo $log_message; ?></button>
                </form>
            </div>
            <div class="body-container">
                <div id="cover-image-container">
                    <div class="img-container">
                        <img src="assets/img/cover-img.jpg" alt="" class="cover-img">
                    </div>
                    <div id="followers-container">
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <img src="assets/img/mark-zuckerberg.jpg" alt="" height="175px" width="175px" class="rounded-circle p-1 mark-image">
                            <div class="followers-content">
                                <h1 class="mark-zuckerberg-text"><?php echo $friend_name; ?>
                                    <img src="assets/img/verified-account.svg" alt="">
                                </h1>
                                <span class="followers-count">120M followers</span>
                                <div class="followers-image-container">
                                    <img src="assets/img/profile1.jpg" alt="" class="rounded-circle">
                                    <img src="assets/img/profile1 (1).jpg" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1 (2).jpg" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1 (3).jpg" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1 (4).jpg" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1.png" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1.png" alt="" class="follower-images rounded-circle">
                                    <img src="assets/img/profile1 (5).jpg" alt="" class="follower-images rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="follower-buttons-container">
                            <button class="follow-button"><i class="fa-solid fa-folder-plus" style="color: white;"></i> Follow</button>
                            <button class="follow-search-button"><img src="assets/img/search.svg" alt=""> Search</button>
                            <span class="arrowdown-button"><img src="assets/img/downarrow.svg" alt=""></span>
                        </div>
                    </div>
                </div>
                
                <!-- straight line -->
                <div class="line"></div>

                <div class="more-details-container">
                    <div class="more-details">
                        <div class="information posts">Posts</div>
                        <div class="information about-details">About</div>
                        <div class="information d-none d-md-block">Channels</div>
                        <div class="information d-none d-md-block">Reels</div>
                        <div class="information d-none d-md-block">Photos</div>
                        <div class="information d-none d-md-block">Events</div>
                        <div class="information">More <img src="assets/img/dropdown.svg" alt=""></div>
                    </div>
                    <span class="three-dots-button"><img src="assets/img/three-dots.svg" alt=""></span>
                </div>
            </div>
        </div>

        <!-- ********************
            inro section 
         ***********************-->
        <div id="comments-main-container">
            <div class="row" id="comment-container">
                <div class="col-lg-5 col-12" id="intro-container">
                    <div class="intro">
                        <span class="comment-section-intro">Intro</span>
                        <div class="d-flex justify-content-center">
                            <span class="intro-top-text">Bringing the world closer together.</span>
                        </div>
                        <hr>
                        <div class="intro-content-container">
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/profile.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text"><strong>Profile</strong> · Public figure</span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/work.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text">Founder and CEO at <strong>Meta</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/work.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text">Works at <strong>Chan Zuckerberg Initiative</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/study.png" alt=""- class="intro-img">
                                </div>
                                <div class="intro-study-content">
                                    <span class="intro-text">Studied Computer Science and Psychology at <strong>Harvard University</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/live.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text">Lives in <strong>Palo Alto, California</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/location.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text">From <strong>Dobbs Ferry, New York</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/like.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text">Married to <strong>Priscilla Chan</strong></span>
                                </div>
                            </div>
                            <div class="intro-content">
                                <div>
                                    <img src="assets/img/message.png" alt="" class="intro-img">
                                </div>
                                <div>
                                    <span class="intro-text"><a href="#" id="meta-channel-link">Meta Channel</a></span><br>
                                    <span class="intro-followers-count">Channel . 789K members</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- *********************
                        friends list 
                    *************************-->
                    <div class="friends-container">
                        <div>
                            <div class="d-flex justify-content-between">
                                <h5 class="fw-bold">Friends</h5>
                                <a href="#" class="friend-see-all-friends-link d-flex justify-content-center align-items-center">See all friends</a>
                            </div>
                            <span id="friend-count" class="text-secondary fs-6"></span>
                        </div>
                
                        <div id="friends"></div>
                    </div> 
                </div>

                <div class="col-lg-7 col-12" id="post-container">
                    <div class="post">
                        <span class="comment-section-post">Posts</span>
                        <span class="filter-button"><img src="assets/img/filter.svg" alt="" height="18px" width="18px"> <span id="filter-bustton-text">Filters</span></span>
                    </div>
                    <div class="comment-root-container">
                        <div class="comment-container <?php if (isset($_GET['friendname'])) echo 'd-none'; ?>">
                            <form method="post" id="commentform">
                                <textarea class="comment-input-flied" id="comment" placeholder="Enter the comment..."></textarea>
                                <button class="comment-post-button">Post</button>
                            </form>
                        </div>
                    
                        <!-- ********************
                            comments section 
                         ***************************-->
                        <div id="printing-comments-section"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- *************************
                logout 
            **************************-->
    <div id="popupContainer"></div>
    
    <!-- *************************
                Edit form section
            **************************-->
    <div class="edit-details-container">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="edit-details">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title mb-4 position-relative text-center">
                            <h3 class="fs-5 fw-bold">Edit profile</h3>
                            <span class="cross-img position-absolute top-0 end-0">
                                <img src="assets/img/cross1.png" alt="">
                            </span>
                            <hr class="edit-hr-line">
                        </div>
                        <form id="editProfileForm">
                            <div class="edit-profile-form-field">
                                <div class="mb-3">
                                    <div class="edit-container">
                                        <label for="name" class="form-label fw-bold">Name</label>
                                        <button class="edit-button">Edit</button>
                                    </div>
                                    <div class="edit-input-field">
                                        <input type="text" class="edit-form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="edit-container">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <button class="edit-button">Edit</button>
                                    </div>
                                    <div class="edit-input-field">
                                        <input type="email" class="edit-form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="edit-container">
                                        <label for="password" class="form-label fw-bold">Password</label>
                                        <button class="edit-button">Edit</button>
                                    </div>
                                    <div class="edit-input-field">
                                        <input type="password" class="edit-form-control" id="password" name="password" placeholder="Enter new password" value="<?php echo $password; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="edit-container">
                                        <label for="address" class="form-label fw-bold">Address</label>
                                        <button class="edit-button">Edit</button>
                                    </div>
                                    <div class="edit-input-field">
                                        <input type="text" class="edit-form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $address; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="edit-container">
                                        <label for="phone" class="form-label fw-bold">Phone</label>
                                        <button class="edit-button">Edit</button>
                                    </div>
                                    <div class="edit-input-field">
                                        <input type="tel" class="edit-form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $phone; ?>" required>
                                    </div>
                                    <span class="fw-bold" id="phone-error"></span>
                                </div>
                                <div class="d-flex justify-content-end gap-3">
                                    <span type="submit" class="btn details-cancel-button">Cancel</span>
                                    <button type="submit" class="btn btn-primary details-save-button">Save</button>
                                </div>
                            </div>
                        </form>
                        <!-- *****************
                            update popup
                            **************** -->
                        <div id="responseMessage" class="mt-3 text-center fw-bold text-success" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ajax.js"></script>
</body>
</html>