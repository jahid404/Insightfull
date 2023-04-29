<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
// sign out
if (isset($_SESSION['email']) && isset($_POST["signout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// make database connection
include 'php/database.php';
$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

//GET USER DATA
if(isset($_SESSION['email'])) { // check if session variable exists

    $query = "SELECT * FROM user WHERE email='".$_SESSION['email']."'";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if the form was submitted

    if(isset($_SESSION['email'])) { // check if session variable exists
        
        $new_password = mysqli_real_escape_string($db, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

        if ($new_password !== $confirm_password) {
            // passwords don't match, show error message
            $errors = "Passwords do not match";
        } else {
            $email = $_SESSION['email'];
            //$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $password = md5($new_password);

            // Check if email matches with admin table
            $query = "SELECT * FROM admin WHERE email='$email'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                // email matches with admin, update password
                $query = "UPDATE admin SET password='$password' WHERE email='$email'";
                $result = mysqli_query($db, $query);

                if ($result) {
                    // password updated successfully
                    $success = "Password updated successfully";
                } else {
                    // error updating password
                    $errors = "Error updating password";
                }
            } else {
                // Check if email matches with user table
                $query = "SELECT * FROM user WHERE email='$email'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    // email matches with user, update password
                    $query = "UPDATE user SET password='$password' WHERE email='$email'";
                    $result = mysqli_query($db, $query);

                    if ($result) {
                        // password updated successfully
                        $success = "Password updated successfully";
                    } else {
                        // error updating password
                        $errors = "Error updating password";
                    }
                } else {
                    // email does not match with either admin or user table
                    $errors = "Email does not exist";
                }
            }
        }
    }
}

mysqli_close($db); // close the database connection
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<link rel="stylesheet" href="styles/profile.css">
	<meta name="viewport" content="width=device-width,initial-scale=1" >
</head>
<body>
<?php include 'header.php';?>
<main class="profile" >
	<section class="profile-info">
	    <h2>Your Profile</h2>
		<form class="profile-info-form" >
		    <fieldset>
		    <legend>Profile Information</legend>
			    <!-- ID -->
			    <label for="name">User ID:</label>
			    <input class="display"  value="<?php echo $_SESSION['user_id']; ?>" readonly="readonly" >
			    
			    <!-- Name -->
			    <label for="name">Name:</label>
			    <input class="display"  value="<?php echo $name; ?>" readonly="readonly" >
			
			    <!-- Email -->
			    <label for="email">Email:</label>
			    <input class="display"  value="<?php echo $_SESSION['email']; ?>" readonly="readonly" >
			</fieldset>
		</form>
	</section>
	<section class="profile-update" >
	    <form class="profile-info-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<?php include 'message.php';?>
			<fieldset>
			<legend>Update Profile Information</legend>
		        <!-- Password -->
		        <label for="password">New Password:</label>
		        <input type="password" id="password" name="password">
		
		        <!-- Confirm Password -->
		        <label for="confirm_password">Confirm New Password:</label>
		        <input type="password" id="confirm_password" name="confirm_password">
		
		        <!-- Submit Button -->
		        <input type="submit" value="Update Profile">
	    	</fieldset>
	    </form>
	</section>
</main>
<?php include 'footer.php';?>
</body>
</html>