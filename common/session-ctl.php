<?php 
session_start();
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    $_SESSION["Alive"] = '';
    $_SESSION["Role"] = ''; // use to control permission
    session_unset();
    session_destroy();
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
?>