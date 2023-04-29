<?php
session_start();
// connect to the database
include 'database.php';
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sign out
if (isset($_POST["signout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order-place'])) {

	// retrieve user data and product information from form submission
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$zip = mysqli_real_escape_string($conn, $_POST['zip']);
	$card = mysqli_real_escape_string($conn, $_POST['card']);
	$exp = mysqli_real_escape_string($conn, $_POST['exp']);
	$cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
	$product_ids = explode(',', $_POST['product-ids']);
	$product_quantities = explode(',', $_POST['product-quantities']);
	
	// Check if user email exists in the users table
	$sql = "SELECT id FROM user WHERE email = '$email'";
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		die("Query failed: " . mysqli_error($conn));
	}
	
	if (mysqli_num_rows($result) > 0) {
		// Update user information in the users table
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['id'];
		$sql = "UPDATE user SET name='$name', address='$address', city='$city', state='$state', zip='$zip', card='$card', exp='$exp', cvv='$cvv' WHERE id=$user_id";
		if (!mysqli_query($conn, $sql)) {
			die("Query failed: " . mysqli_error($conn));
		}
	} else {
		// Insert user information into the users table
		$sql = "INSERT INTO user (name, email, address, city, state, zip, card, exp, cvv) VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$card', '$exp', '$cvv')";
		mysqli_query($conn, $sql);
		$user_id = mysqli_insert_id($conn);
	}
	
	// Generate 6-digit random order ID
	$order_id = mt_rand(100000, 999999);
	
	// Get current date and time
	$order_date = date("Y-m-d h:i:s A");
	
	// Insert order information into the orders table for each product
	foreach ($_SESSION['cart'] as $k => $item) {
	  $product_id = $item['id'];
	  $quantity = $item['quantity'];
	  $sql = "INSERT INTO orders (order_id, user_id, product_id, quantity, email, order_date) VALUES ($order_id, $user_id, $product_id, $quantity, '$email', '$order_date')";
	  mysqli_query($conn, $sql);
	}
	
	// Clear the cart
	unset($_SESSION['cart']);
	
	// Redirect to confirmation page with order ID
	header("Location: ../welcome.php?order_id=$order_id");
	exit();
	
	// close the database connection
	mysqli_close($conn);
}
?>