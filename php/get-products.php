<?php
include 'database.php';
// Create connection
$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$offset = $_POST['offset'];

// Retrieve 8 most recently uploaded products starting from the given offset
$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8 OFFSET $offset";
$result = mysqli_query($conn, $sql);

// Display each product as a card
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '<div class="product-card-container">';
        echo '<div class="product-card-description">';
        echo '<img src="' . $row['product_image'] . '" alt="' . $row['product_name'] . '">';
        echo '<h3>' . $row['product_name'] . '</h3>';
        echo '</div>';
        echo '<div class="product-card-btn">';
        echo '<p>$' . $row['product_price'] . '</p>';
		echo '<a href="product.php?id=' . $row['id'] . '">';
		echo '<button class="product-view">View</button>';
		echo '</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
} else {
echo "<p style='text-align:center;margin-top:15px;'>No products found</p>";
}

// Close the database connection
mysqli_close($conn);
?>