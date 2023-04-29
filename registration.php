<?php include 'server.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<meta name="viewport" content="width=device-width,initial-scale=1" >
	<link rel="stylesheet" href="styles/RegLog.css">
</head>
<body>
	<?php include 'header.php';?>
	<section class="signupForm" >
		<form class="userForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<?php include('message.php');?>
			<fieldset>
				<legend>Create a customer account</legend>
				<div>
					<label>Name:</label>
					<input type="text" name="name" required><br><br>
				</div>
				<div>
					<label>Email:</label>
					<input type="email" name="email" required><br><br>
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" required><br><br>
				</div>
				<div>
					<label>Confirm Password:</label>
					<input type="password" name="confirmPassword" required><br><br>
				</div>
				<input type="submit" name="signup" value="Sign Up">
			</fieldset>
			<p>Have an account? <a href="login.php" >Login</a></p>
		</form>
	</section>
	<?php include 'footer.php';?>
</body>
</html>