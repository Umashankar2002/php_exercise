
<?php 
    session_start();
    // session_unset();
    // session_destroy();
    $_SESSION["userid"] = "";
    $_SESSION["logged"] = "";
    $_SESSION["userid"] = "";
    $_SESSION["login-error"] = "";
    $_SESSION["user-exist"] = "";
    $_SESSION["logout_success"] = true;
    
    header("Location: index.php");
    exit();
?>