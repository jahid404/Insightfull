<?php include 'server.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" >
    <link rel="stylesheet" href="styles/RegLog.css">
</head>
<body>
    <?php include 'header.php';?>
	<section class="loginForm" >
		<form class="userForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<?php include('message.php');?>
			<fieldset>
				<legend>Login to Dashboard</legend>
				<div>
					<label>Email:</label>
					<input type="email" name="email" required><br><br>
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" required><br><br>
				</div>
				<input type="submit" name="signin" value="Sign In">
			</fieldset>
			<p>Don't have an account? <a href="registration.php" >Sign Up</a></p>
		</form>
	</section>
    <?php include 'footer.php';?>
</body>
</html>