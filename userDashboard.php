<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// sign out
if (isset($_POST["signout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if the 'delete' parameter is set in the URL
if (isset($_GET['delete'])) {
// Retrieve the order ID from the 'delete' parameter
$product_id = $_GET['delete'];

// Query the database to retrieve the user ID associated with this order ID
include 'php/database.php';
$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
$sql = "SELECT user_id FROM orders WHERE product_id = '$product_id'";
$result = mysqli_query($db, $sql);

// Check if the order ID is associated with the current user
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];
  if ($_SESSION['user_id'] == $user_id) {
    // Delete the order from the database
    $sql = "DELETE FROM orders WHERE product_id = '$product_id'";
    mysqli_query($db, $sql);
    mysqli_close($db);

    // Redirect to the user dashboard
    header("Location: userDashboard.php");
    exit();
  } else {
    $errors = "You do not have permission to delete this order";
  }
} else {
  $errors = "Invalid order ID".$_SESSION['user_id'];
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Dashboard | Insightful</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/userDashboard.css">
</head>
<body>
	<?php include 'header.php';?>
	<main>
		<section id="orders">
			<h2>Manage Orders</h2>
			<?php include 'message.php';?>
			<div class="view-orders" >
				<table>
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Product ID</th>
							<th>Quantity</th>
							<th>Order Date</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// Start a session
							session_start();
							// Retrieve the customer ID from your database based on the login credentials
							$email = $_SESSION['email'];
							$password = $_POST["password"];
							
							// Query the database to retrieve the customer ID associated with this username
							include 'php/database.php';
							$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
							
							// Retrieve the customer ID from the session variable
							$user_id = $_SESSION["user_id"];
							
							$sql = "SELECT order_id, product_id, quantity, order_date FROM orders WHERE user_id = '$user_id'";
							$result = mysqli_query($db, $sql);
							// Check if there are any orders
							if (mysqli_num_rows($result) > 0) {
							  // Output the order data as HTML
							  while ($row = mysqli_fetch_assoc($result)) {
							    echo "<tr>";
							    echo "<td>" . $row["order_id"] . "</td>";
							    echo "<td><a href='product.php?id=" . $row["product_id"] . "' style='color:#3d5afe'>" . $row["product_id"] . "</td>";
							    echo "<td>" . $row["quantity"] . "</td>";
							    echo "<td>" . $row["order_date"] . "</td>";
							    echo "<td><a href='userDashboard.php?delete=" . $row['product_id'] . "' style='color:red'>&times;</a></td";
							    echo "</tr>";
							  }
							} else {
							  $msg = "No orders yet";
							}
							mysqli_close($db);
						?>
					</tbody>
				</table>
			</div>
			<p><?php echo $msg;?></p>
		</section>
	</main>
	<?php include 'footer.php';?>
</body>
</html>