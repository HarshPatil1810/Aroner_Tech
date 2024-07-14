<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

unset($_COOKIE['ltp_login_token']); 
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: auth-login.php");
exit;
?>