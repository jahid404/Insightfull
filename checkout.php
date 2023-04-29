<?php
	session_start();
	// Check if user is logged in
	if (!isset($_SESSION["email"])) {
		header("Location: login.php");
		exit();
	}
	
	if(isset($_POST['checkout'])){
		$_SESSION['product-ids'] = $_POST['product-ids'];
		$_SESSION['product-quantities'] = $_POST['product-quantities'];
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles/checkout.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" >
  </head>
  <body>
	<?php include 'header.php';?>
    <section id="checkout">
	    <?php include 'message.php';?>
	    <h2>Fill Up Billing Informations</h2>
	    <form class="checkoutForm" action="php/process_order.php" method="POST">
	      <div class="user-info" >
		      <label for="name">Name:</label>
		      <input type="text" id="name" name="name" required>
		
		      <label for="email">Email:</label>
		      <input type="email" id="email" name="email" required>
		
		      <label for="address">Address:</label>
		      <input type="text" id="address" name="address" required>
		
		      <label for="city">City:</label>
		      <input type="text" id="city" name="city" required>
		
		      <label for="state">State:</label>
		      <input type="text" id="state" name="state" required>
		
		      <label for="zip">Zip Code:</label>
		      <input type="number" id="zip" name="zip" required>
	      </div>
	      <div class="payment" >
		      <h2>Payment Information</h2>
		      <label for="card">Card Number:</label>
		      <input type="number" id="card" name="card" required>
		      
		      <div class="payment-info" >
		      	<div class="exp-date" >
		      		<label for="exp">Expiration Date:</label>
		      		<input type="text" id="exp" name="exp" required>
				</div>
				<div class="cvv" >
		      		<label for="cvv">CVV:</label>
		      		<input type="number" id="cvv" name="cvv" required>
		      	</div>
		      </div>
	      </div>
	      
	      <?php if(isset($_SESSION['product-ids']) && isset($_SESSION['product-quantities'])): ?>
	      	<input type="hidden" name="product-ids" value="<?php echo $_SESSION['product-ids']; ?>" />
	      	<input type="hidden" name="product-quantities" value="<?php echo $_SESSION['product-quantities']; ?>" />
	      <?php endif; ?>
	      <input type="submit" name="order-place"  value="Place Order">
	    </form>
    </section>
    <?php include 'footer.php';?>
  </body>
</html>