<?php
session_start();
// sign out
if (isset($_SESSION['email']) && isset($_POST["signout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Insightful | <?php echo $_GET['category']; ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/category.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main>
      <section id="category-products">
        <h2 class="sectionTitle" >Category: <b><?php echo strtoupper($_GET['category']); ?></b></h2>
        <div class="product-grid">
          <?php
			include 'php/database.php';
			// Create connection
			$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
            // Retrieve products in the selected category
            $category = mysqli_real_escape_string($conn, $_GET['category']);
            $sql = "SELECT * FROM products WHERE product_category = '$category'";
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
              echo "<p style='margin-top:15px'>No products found in this category.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
          ?>
        </div>
      </section>
    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>