<?php
session_start();
include 'php/add_product.php';
include 'php/delete_product.php';
include 'php/update_product.php';

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
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard | Insightful</title>
    <link rel="stylesheet" href="styles/adminDashboard.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" >
  </head>
  <body>
  <?php include 'header.php';?>
    <main class="adminMainPanel" >
      <?php include 'message.php';?>
      <section class="adminSection"  id="add-product">
        <h2>Add Product</h2>
        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SESSION['PHP_SELF']);?>">
          <!-- Product Name -->
          <label for="add_product_name">Product Name:</label>
          <input type="text" id="add_product_name" name="add_product_name" required="required" >

          <!-- Product Price -->
          <label for="add_product_price">Product Price:</label>
          <input type="number" id="add_product_price" name="add_product_price" min="0" step="0.01" required="required" >

          <!-- Product Description -->
          <label for="add_product_description">Product Description:</label>
          <textarea id="add_product_description" name="add_product_description"></textarea>
          
          <!-- Product Category -->
          <label for="add_product_category">Product Category:</label>
          <select id="add_product_category" name="add_product_category">
			  <option value=""></option>
			  <option value="T-Shirts">T-Shirts</option>
			  <option value="Shirts">Shirts</option>
			  <option value="Pants">Pants</option>
			  <option value="Jeans">Jeans</option>
			  <option value="Shoes">Shoes</option>
			  <option value="Dresses">Dresses</option>
			  <option value="Jackets">Jackets</option>
			  <option value="Skirts">Skirts</option>
			  <option value="Shorts">Shorts</option>
			  <option value="Sweaters">Sweaters</option>
			  <option value="Suits">Suits</option>
          </select>
          

          <!-- Product Image -->
          <label for="add_product_image">Product Image:</label>
          <input type="file" id="add_product_image" name="image">
          
          <!-- Submit Button -->
          <input type="submit" name="add_product" value="Add Product">
        </form>
      </section>
      
      <section class="adminSection"  id="delete-product">
	      <h2>Delete Product</h2>
	      <form action="<?php echo htmlspecialchars($_SESSION['PHP_SELF']); ?>" method="GET">
		      <label for="del_product_id">Product ID:</label>
		      <input type="text" id="del_product_id" name="del_product_id" required="required" >
		      <input type="submit" name="del_product"  value="Delete Product">
	      </form>
      </section>
      
      
      <section class="adminSection"  id="update-product">
        <h2>Update Product Information</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SESSION['PHP_SELF']); ?>">
          <!-- Product ID -->
          <label for="update_product_id">Product ID:</label>
          <input type="text" id="update_product_id" name="update_product_id" required>

          <!-- Product Name -->
          <label for="update_product_name">Product Name:</label>
          <input type="text" id="update_product_noame" name="update_product_name">

          <!-- Product Price -->
          <label for="update_product_price">Product Price:</label>
          <input type="number" id="update_product_price" name="update_product_price" min="0" step="0.01">

          <!-- Product Description -->
          <label for="update_product_description">Product Description:</label>
          <textarea id="update_product_description" name="update_product_description"></textarea>

          <!-- Submit Button -->
          <input type="submit" name="update_product"  value="Update Product">
        </form>
      </section>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
<!--section class="adminSection"  id="manage-orders">
  <h2>Manage Orders</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Order Date</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Customer Address</th>
      </tr>
    </thead>
    <tbody>
			<?php
			include 'php/database.php';
			
			// Retrieve order data from database
			$sql = "SELECT * FROM orders";
			$result = $conn->query($sql);
			
			// Generate table rows for order data
			if ($result->num_rows > 0) {
			  while ($row = $result->fetch_assoc()) {
			    echo "<tr>";
			    echo "<td>" . $row["order_id"] . "</td>";
			    echo "<td>" . $row["customer_name"] . "</td>";
			    echo "<td>" . $row["order_date"] . "</td>";
			    echo "<td>" . $row["total_amount"] . "</td>";
			    echo "<td>" . $row["status"] . "</td>";
			    echo "</tr>";
			  }
			} else {
			  echo "<tr><td colspan='5'>No orders found.</td></tr>";
			}
			
			// Close database connection
			$conn->close();
			?>
    </tbody>
  </table>
</section-->