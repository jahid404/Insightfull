<?php
	session_start();
	
	// Check if user is logged in
	if (!isset($_SESSION["email"])) {
		header("Location: login.php");
		exit();
	}
	
	// sign out
	if (isset($_SESSION['email']) && isset($_POST["signout"])){
	    session_destroy();
	    header("Location: login.php");
	    exit();
	}
	
	if(isset($_GET['order_id'])){
		$success = "Your Order ID: ".$_GET['order_id'];
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Insightful</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" >
    <style type="text/css">
		*{
			margin:0;
			padding:0;
			box-sizing:border-box;
		}
		#confirmation {
			height:40vh;
			margin-top:100px;
			display:flex;
			justify-content:center;
			align-items:center;
		}
		.msg {
		  border-top: 2px solid #333;
		  border-bottom: 2px solid #333;
		  width: 75%;
		  font-size:0.9rem;
		  font-size: 1rem;
		  margin: 0 auto;
		  margin-bottom:0;
		  text-align: center;
		  padding:15px 0;
		}
		.msg h2{
			font-size:1.4rem;
		}
		.buy-btn {
			padding: 0.5rem 1rem;
			font-size: 0.8rem;
			text-transform: uppercase;
			color: #fff;
			background-color: #333;
			border: none;
			outline:none;
			border-radius: 0.5rem;
			cursor: pointer;
			transition: all 0.3s ease;
		}
		.buy-btn:hover {
			background:#0062cc;
		}
    </style>
  </head>
  <body>
  	<?php include 'header.php';?>
    <main id="confirmation" >
	    <div class="msg">
	    	<h2>Order Has Placed!</h2>
	    	<?php include 'message.php';?>
	    	<p>Thank you for placing an order with us. We appreciate your choices!</p>
	    	<p>Buy more products... <a href="index.php" ><button class="buy-btn">Buy Now</button></a></p>
	  	</div>
  	</main>
  	<?php include 'footer.php';?>
  </body>
</html>