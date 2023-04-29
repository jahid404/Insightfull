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
    <title>All Products | Insightful</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/category.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main>
      <section id="all-products">
        <h2 class="sectionTitle" >All Products <b><?php echo strtoupper($_GET['category']); ?></b></h2>
        <div class="product-grid" id="product-grid" >
		<?php
			include 'php/database.php';
			// Create connection
			$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			
			// Retrieve 18 random products from the database
			$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 18"; //18
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
					echo '<a href="product.php?id=' . $row['id'] .'">';
			        echo '<button class="product-view">View</button>';
			        echo '</a>';
			        echo '</div>';
			        echo '</div>';
			        echo '</div>';
			    }
			} else {
			    echo "<p style='text-align:center'>No Products Found</p>";
			}
		    
		    // Close the database connection
		    mysqli_close($conn);
		?>
        </div>
        <div class="view-more-btn" >
        	<button class="view-more" data-offset="14">View More</button>
        </div>
      </section>
    </main>
    <?php include 'footer.php'; ?>
    
	<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
	<script type='text/javascript'>
		$(document).ready(function() {
		  $('.view-more').click(function() {
		    var offset = $(this).data('offset');
		    $.ajax({
		      url: 'php/get-products.php',
		      type: 'POST',
		      data: {offset: offset},
		      success: function(data) {
		        $('#product-grid').append(data);
		        $('.view-more').data('offset', offset + 8);
		      }
		    });
		  });
		});
	</script>
  </body>
</html>