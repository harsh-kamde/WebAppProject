<?php
// logout.php

foreach ($_COOKIE as $cookieName => $cookieValue) {
    setcookie($cookieName, '', time() - (86400 * 30), '/');
    // Set the cookie with an expiration time in the past, which effectively deletes the cookie
}

$_COOKIE = array();

// Start a session
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

//clear cookies


// Redirect to login page or any other desired page
header("Location: login.php");
exit;
?>