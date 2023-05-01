<?php
session_start();
// sign out
if (isset($_SESSION['email']) && isset($_POST["signout"])){
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Insightful | Home</title>
    <link rel="stylesheet" href="styles/main.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" >
  </head>
  <body>
	<?php include 'header.php';?>
    <main id="mainContainer" >
    	<section id="featured-products">
		<h2 class="sectionTitle">Hot Product</h2>
		<?php
		  include 'php/database.php';
		  
		  // Create connection
		  $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
		  
		  // Check connection
		  if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		  }
		  
		  // Retrieve a random product
		  $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 1";
		  $result = mysqli_query($conn, $sql);
		  
		  // Display the product information
		  if (mysqli_num_rows($result) > 0) {
		    while ($row = mysqli_fetch_assoc($result)) {
		      $product_name = $row['product_name'];
		      $product_description = $row['product_description'];
		      $product_price = $row['product_price'];
		      $product_image = $row['product_image'];
		      echo '<div class="hot-product">';
		      echo '<form method="GET" action="product.php">';
		      echo '<div class="hot-product-img">';
		      echo '<img src="' . $product_image . '" alt="' . $product_name . '">';
		      echo '</div>';
		      echo '<div class="hot-product-details">';
		      echo '<div>';
		      echo '<h3 class="hot-product-name">' . $product_name . '</h3>';
		      echo '<p class="hot-product-description">' . $product_description . '</p>';
		      echo '<p class="hot-product-price">$' . $product_price . '</p>';
		      echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		      echo '</div>';
		      echo '<button class="view-product" type="submit">View Product</button>';
		      echo '</div>';
		      echo '</form>';
		      echo '</div>';
		    }
		  } else {
		    echo '<p style="text-align:center;font-size:1rem;">No products found.</p>';
		  }
		  
		  // Close the database connection
		  mysqli_close($conn);
		?>
		</section>

		<section id="product-categories">
		  <h2 class="sectionTitle" >Product Categories</h2>
		  <!--div class="category-grid"-->
		    <?php
		      include 'php/database.php';
		      
		      // Create connection
		      $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
		      
		      // Check connection
		      if ($conn->connect_error) {
		      	die("Connection failed: " . $conn->connect_error);
		      }
		      
		      // Retrieve list of categories from database
		      $sql = "SELECT DISTINCT product_category FROM products ORDER BY product_category ASC";
		      $result = mysqli_query($conn, $sql);
		
		      // Generate HTML cards for each category
		      $num_categories = mysqli_num_rows($result);
		      $num_rows = ceil($num_categories / 5);
		      $categories = array();
		      while ($row = mysqli_fetch_assoc($result)) {
		        array_push($categories, $row['product_category']);
		      }
		      $category_index = 0;
		      for ($i = 1; $i <= $num_rows; $i++) {
		        echo '<div class="category-grid">';
		        for ($j = 1; $j <= 5; $j++) {
		          if ($category_index < $num_categories) {
		            $category = $categories[$category_index];
		            echo '<div class="category-card">';
		            echo '<a href="category.php?category=' . urlencode($category) . '">';
		            echo '<img src="https://source.unsplash.com/random/350x350/?'.$category.'">';
		            echo '<h3>' . ucfirst($category) . '</h3>';
		            echo '</a>';
		            echo '</div>';
		            $category_index++;
		          }
		        }
		        echo '</div>';
		      }
		      
		      // Close the database connection
		      $conn->close();
		    ?>
		  <!--/div-->
		</section>
		
		<section id="recent-products">
		  <div class="section-header">
		    <h2 class="sectionTitle">Recent Products</h2>
		  </div>
		  <div class="product-grid" id="product-grid" >
			<?php
			  include 'php/database.php';
			  
			  // Create connection
			  $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
			  
			  // Check connection
			  if ($conn->connect_error) {
			  	die("Connection failed: " . $conn->connect_error);
			  }
			  
			  // Retrieve 8 most recently uploaded products
			  $sql2 = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
			  $result = mysqli_query($conn, $sql2);
			
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
			    echo '<p style="text-align:center;font-size:1rem;">No products found.</p>';
			  }
			
			  // Close the database connection
			  mysqli_close($conn);
			?>
		  </div>
		  <div class="view-more-btn" >
		  	<button class="view-more" data-offset="8">View More</button>
		  </div>
		</section>
    </main>
	<?php include 'footer.php';?>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
		  $(".view-more").click(function() {
		    var offset = $(this).data("offset");
		    $.ajax({
		      url: "php/get-products.php",
		      type: "POST",
		      data: {offset: offset},
		      success: function(data) {
		        $("#product-grid").append(data);
		        $(".view-more").data("offset", offset + 8);
		      }
		    });
		  });
		});
    </script>
  </body>
</html>
