<?php
require 'database.php';
// Connect to the database
$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    // Retrieve form data
    $update_product_id = mysqli_real_escape_string($db, $_POST["update_product_id"]);
    $update_product_name = mysqli_real_escape_string($db, $_POST["update_product_name"]);
    $update_product_price = mysqli_real_escape_string($db, $_POST["update_product_price"]);
    $update_product_description = mysqli_real_escape_string($db, $_POST["update_product_description"]);

    // Update product in database
    $sql = "UPDATE products SET ";

    if (!empty($update_product_name)) {
        $sql .= "product_name='$update_product_name', ";
    }

    if (!empty($update_product_price)) {
        $sql .= "product_price=$update_product_price, ";
    }

    if (!empty($update_product_description)) {
        $sql .= "product_description='$update_product_description', ";
    }

    // Remove trailing comma and space
    $sql = rtrim($sql, ", ");

    $sql .= " WHERE id=$update_product_id";

    if ($db->query($sql) === TRUE) {
        $success .= "Product updated successfully.";
    } else {
		$errors .= "Error updating product.";
	}
}
mysqli_close($db);
?>