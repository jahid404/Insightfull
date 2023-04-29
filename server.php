<?php
session_start();

// Connect to the database
require 'php/database.php';
$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

// Register user
if (isset($_POST['signup'])) {
    // Sanitize input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $password_2 = mysqli_real_escape_string($db, $_POST['confirmPassword']);
    
    // Check if email already exists in the database
    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // If user exists, set error message
        $errors = "Email already exists";
    } else {
        // Check if passwords match
        if ($password_1 === $password_2) {
            // Encrypt the password before saving in the database
            $password = md5($password_1);

            $user_id = mt_rand(1000, 9999);
            // Insert user into database
            $query = "INSERT INTO user (id, name, email, password) VALUES ('$user_id','$name','$email','$password')";
            mysqli_query($db, $query);

            // Set session variable and success message
            $_SESSION['email'] = $email;
            $success = "Registration Success. Please Login.";
            
            // Redirect to login page
            header('location: login.php');
            exit;
        } else {
            // If passwords don't match, set error message
            $errors = "Passwords do not match!";
        }
    }
}

//LOGIN User
// Check if the form has been submitted
if (isset($_POST['signin'])) {

    // Sanitize the user input
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Hash the password
    $password = md5($password);
    
    // Query the database for the admin
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password' LIMIT 1";
    $results = mysqli_query($db, $query);
    $admin = mysqli_fetch_assoc($results);
    
    // If the admin is found, set the session variables and redirect to adminDashboard.php
    if ($admin) {
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $admin['id'];
        header('location: adminDashboard.php');
        exit;
    }

    // Query the database for the user
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
    $results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
    
    // If the user is found, set the session variables and redirect to userDashboard.php
    if ($user) {
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user['id'];
        header('location: userDashboard.php');
        exit;
    }
    
    // If neither the admin nor the user is found, add an error message
    $errors = "Wrong Email/Password input";
}

mysqli_close($db);
?>