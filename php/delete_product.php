<?php
require 'database.php';
$db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

// Check if a product ID has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["del_product"])) {
  $product_id = mysqli_real_escape_string($db, $_GET["del_product_id"]);

  // Delete product from database using prepared statement
  $stmt = mysqli_prepare($db, "DELETE FROM products WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $product_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $success = "Product deleted successfully.";
  } else {
    $errors = "Product not found with this ID";
  }
  mysqli_stmt_close($stmt);
}
mysqli_close($db);
?>