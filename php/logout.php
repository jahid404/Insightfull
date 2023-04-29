<?php
session_start(); // start the session

if(isset($_SESSION['email'])) { // check if session variable exists
    unset($_SESSION['email']); // unset the session variable
    session_destroy(); // destroy the session

    // redirect to the login page
    header("Location: ../login.php");
    exit;
}
?>