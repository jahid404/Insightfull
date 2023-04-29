<link href='https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap' rel='stylesheet'/>
<link rel="stylesheet" href="styles/header.css">
<link rel="stylesheet" href="styles/cart.css">
<header id="header" >
	<div class="header-container">
		<div class="header-logo">
			<a href="index.php">
				<img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhHhjKJQaEwO_9bmovqQJtH5Sux81lclFAgSMN50S9iBsAxTymruC-qImRoIE2iN4kgm2FkvyC8yj4UmDJqqxbJFtaIl3408em3y7JoCPGYos-5LMd1vSEZsIuw_aTA1Ny-ZPKH27hMKaEnPCMseDX2vjJ3fyhyD-OT9DdYmawEm9cql8_9uELlNIc-" alt="Insightful" >
			</a>
		</div>
		<nav class="header-nav">
			<a href="index.php">Home</a>
			<a href="allProducts.php">Products</a>
			<?php 
				if(isset($_SESSION["email"]) || isset($_SESSION['user_id'])) {
					if($_SESSION['user_id']==1001){
						echo "<a href='adminDashboard.php'>Dashboard</a>";
					} else {
						echo "<a href='userDashboard.php'>Dashboard</a>";
					}
					echo "<a href='update_profile.php'>Profile</a>";
					echo "<a href='php/logout.php'>Logout</a>";
				} else {
					echo "<a href='login.php'>Login</a>";
					echo "<a href='registration.php'>Sign Up</a>";
				}
			?>
		</nav>
		<div class="headerMenu" >
			<!--?php if(isset($_SESSION["email"])){echo "<button class='cart-btn' >Cart</button>";}?-->
			<button class='cart-btn' >Cart</button>
			<div class="menu" id="toggleSideNav" >&#9776;</div>
		</div>
	</div>
	<!--sidenav-->
	<div id="mySidenav" class="sidenav">
	    <a href="index.php">Home</a>
	    <a href="allProducts.php">Products</a>
		<?php 
			if(isset($_SESSION["email"])) {
				if($_SESSION['user_id']==1001){
					echo "<a href='adminDashboard.php'>Dashboard</a>";
				} else {
					echo "<a href='userDashboard.php'>Dashboard</a>";
				}
				echo "<a href='update_profile.php'>Profile</a>";
				echo "<a href='php/logout.php'>Logout</a>";
			} else {
				echo "<a href='login.php'>Login</a>";
				echo "<a href='registration.php'>Sign Up</a>";
			}
		?>
	</div>
	<!--sidenav end-->
</header>

<!-- cart section -->
<div class="cart-section">
  <button class="close-cart-btn">&times;</button>
  <div class="cart-header">
    <h3>Your Cart</h3>
  </div>
  
	<?php
		if(isset($_GET['empty'])){
		    unset($_SESSION['cart']);
		}
		
		if(isset($_GET['remove'])){
		    $id = $_GET['remove'];
		    foreach($_SESSION['cart'] as $k => $item){
		        if($id == $item['id']){
		            unset($_SESSION['cart'][$k]);
		        }
		    }
		}
		
		$total = 0;
	?>
	
	<form class="cart-form" method="POST" action="checkout.php">
	  <?php 
	    $subtotal = 0;
	    if(isset($_SESSION['cart'])) :
	  ?>
	  <div class="all-cart-items">
	    <?php foreach($_SESSION['cart'] as $k => $item) :
	      $subtotal += $item['price'] * $item['quantity'];
	    ?>
	    <div class="cart-items">
	      <div class="item-info">
	        <div>
	          <img src="<?php echo $item['image'];?>" alt="">
	          <h3 class="cart-item-name"><?php echo $item['name'];?></h3>
	        </div>
	        <div>
	          <div>
	            <p class="cart-item-price">$<?php echo $item['price']*$item['quantity'];?></p>
	            <p class="cart-item-quantity">Quantity: <span><?php echo $item['quantity'];?></span></p>
	          </div>
	          <a class="remove-item-btn" href="<?php echo "?id=".$item['id']."&remove=".$item['id']?>">&times;</a>
	        </div>
	      </div>
	    </div>
	    <?php endforeach ?>
	  </div>
	  <?php endif ?>
	  <div class="cart-footer">
	    <div class="cart-subtotal">
	      <span>Subtotal: $</span>
	      <span class="subtotal-value"><?php echo $subtotal; ?></span>
	    </div>
	    <div class="cart-buttons">
	      <a href="<?php echo "?id=".$item['id']."&empty=1";?>" class="clear-cart-btn">Clear</a>
	      
	      <input type="hidden" name="product-ids" value="<?php foreach($_SESSION['cart'] as $k => $item) { echo $item['id'].','; } ?>" />
	      <input type="hidden" name="product-quantities" value="<?php foreach($_SESSION['cart'] as $k => $item) { echo $item['quantity'].','; } ?>" />
	      <input type="submit" name="checkout"  class="checkout-btn" value="Checkout">
	    </div>
	  </div>
	</form>
</div>

<script>
// JavaScript code to handle cart button click event
document.addEventListener("DOMContentLoaded", function() {
  let cartBtn = document.querySelector(".cart-btn");
  let closeCartBtn = document.querySelector(".close-cart-btn");
  let cartSection = document.querySelector(".cart-section");

  // show cart section when cart button is clicked
  cartBtn.addEventListener("click", function() {
    cartSection.classList.toggle("show");
  });

  // hide cart section when close button is clicked
  closeCartBtn.addEventListener("click", function() {
    cartSection.classList.remove("show");
  });
});
/*-----event handlers----*/
	let openMenu = document.getElementById("toggleSideNav");
	let sideNav = document.getElementById("mySidenav");
  // opening menu
  openMenu.addEventListener("click", function() {
    sideNav.classList.toggle("toggleMenu");
  });
</script>