<?php
if (isset($success)) {
	echo "
		<div class='success'>
		  <p>$success</p>
		</div>
	";
}
if (isset($errors)) {
	echo "
		<div class='errors'>
		  <p>$errors</p>
		</div>
	";
}
?>