<?php
session_start();
// sign out
if (isset($_SESSION['email']) && isset($_POST["signout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


if(isset($_POST['add-to-cart'])) {
    // Retrieve product information from the form
    $product_id = $_POST['id'];
    $product_image = $_POST['image'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_quantity = $_POST['quantity'];
    
    // Create an array to store product information
    $product = array(
        'id' => $product_id,
        'image' => $product_image,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $product_quantity,
    );
    
    // Check if the session array already exists
    if(isset($_SESSION['cart'])) {
        // If the product is already in the cart, increment the quantity
        if(array_key_exists($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
            $success = "Product already in cart. Added ".$product_quantity." more!";
        } else {
            // If the product is not in the cart, add it to the cart
            $_SESSION['cart'][$product_id] = $product;
            $success = $product_quantity." Product added to cart!";
        }
    } else {
        // If the session array does not exist, create it and add the product to the cart
        $_SESSION['cart'] = array($product_id => $product);
        $success = $product_quantity." Product added to cart!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $product_name; ?> | Insightful</title>
  <link rel="stylesheet" href="styles/product.css">
  <link rel="stylesheet" href="styles/category.css">
  <link rel="stylesheet" href="styles/main.css">
  <meta name="viewport" content="width=device-width,initial-scale=1" >
</head>
<body>
	<?php include 'header.php';?>
	<main class="viewProduct" >
		<section id="product-details">		
			<?php
				include 'php/database.php';
				// receive product ID from URL parameter
				$product_id = $_GET['id'];
				
				// Create connection
				$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
				
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				// Query the database for the product information
				$sql = "SELECT * FROM products WHERE id = $product_id";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					// Fetch the product data
					$row = $result->fetch_assoc();
					$product_name = $row['product_name'];
					$product_category = $row['product_category'];
					$product_description = $row['product_description'];
					$product_image = $row['product_image'];
					$product_price = $row['product_price'];
					$product_id = $row['id'];
				} else {
					// Handle error case where product ID is not found in database
					$errors = 'Product not found.';
				}
				
				// Close the database connection
				$conn->close();
			?>
			
			<div class="product-details">
			  <div class="product-img">
			    <img class="main-product-img" src="<?php echo $product_image;?>" alt="<?php echo $product_name;?>">
			    <div class="more-product-img">
			      <img src="https://source.unsplash.com/random/301x301/?<?php echo $product_category;?>" alt="<?php echo $product_name;?>">
			      <img src="https://source.unsplash.com/random/302x302/?<?php echo $product_category;?>" alt="<?php echo $product_name;?>">
			      <img src="https://source.unsplash.com/random/303x303/?<?php echo $product_category;?>" alt="<?php echo $product_name;?>">
			    </div>
			  </div>
			  <div class="product-info">
			    <div class="product-basic-info">
			      <h2 class="product-name"><?php echo $product_name;?></h2>
			      <p class="product-category-label">in - <a class="product-category" href="category.php?category=<?php echo $product_category;?>"><?php echo $product_category;?></a></p>
			    </div>
			    <div class="product-price-info">
			      <div class="product-price-label"><span>$</span><span class="product-price"><?php echo $product_price;?></span></div>
			      <div class="product-id-label">Product ID: <span class="product-id"><?php echo $product_id;?></span></div>
			    </div>
			    <div class="product-desc-info">
			      <p class="product-description"><?php echo $product_description;?></p>
			    </div>
			    <form method="POST" action="">	    
				    <div class="product-buy-info">
				      <div class="product-quantity">
				        <span>Quantity: </span><input type="number" name="quantity" id="quantity" min="1" step="1" value="1">
				      </div>
				      <div class="product-add-to-cart">    
				        <input type="hidden" name="id" value="<?php echo $product_id?>">
				        <input type="hidden" name="image" value="<?php echo $product_image?>">
				        <input type="hidden" name="name" value="<?php echo $product_name?>">
				        <input type="hidden" name="price" value="<?php echo $product_price?>">
				        <input type="submit" name="add-to-cart"  class="add-to-cart-btn" value="Add to Cart">
				      </div>
				    </div>
			    </form>
			  </div>
			</div>
		</section>
		<?php include 'message.php';?>
		<br>
		
		<section id="category-products">
		  <h2 class="sectionTitle" >Similar Product<b><?php echo strtoupper($_GET['category']); ?></b></h2>
		  <div class="product-grid">
			<?php
			include 'php/database.php';
			// Create connection
			$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			
			// Retrieve category based on product ID
			$product_id = mysqli_real_escape_string($conn, $_GET['id']);
			$sql = "SELECT product_category FROM products WHERE id = '$product_id'";
			$result = mysqli_query($conn, $sql);
			
			if ($result && mysqli_num_rows($result) > 0) {
			    $row = mysqli_fetch_assoc($result);
			    $category = mysqli_real_escape_string($conn, $row['product_category']);
			    // Retrieve 8 products in the selected category
			    $sql = "SELECT * FROM products WHERE product_category = '$category' LIMIT 8";
			    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); // Check for errors and print them out
			    
			    //$result = mysqli_query($conn, $sql);
			
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
			        echo "<p style='text-align:center'>No products found in this category.</p>";
			    }
			} else {
			    echo "<p style='text-align:center'>Product not found.</p>";
			}
			
			// Close the database connection
			mysqli_close($conn);
			?>
		  </div>
		</section>
		
		<section id="random-products">
		  <h2 class="sectionTitle" >You May Like<b><?php echo strtoupper($_GET['category']); ?></b></h2>
		  <div class="product-grid">
			<?php
			include 'php/database.php';
			// Create connection
			$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			
			// Retrieve 8 random products from the database
			$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 8";
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
			    echo "<p style='text-align:center'>No Products Found</p>";
			    }
			    
			    // Close the database connection
			    mysqli_close($conn);
			?>
		  </div>
		</section>
	</main>
	<?php include 'footer.php';?>
</body>
</html>