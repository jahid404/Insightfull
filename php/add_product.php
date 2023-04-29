<?php
if (isset($_POST['add_product'])) {
    include 'database.php';
    // Connect to the database
    $db = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Get product name, price, description, and category from the form
    $add_product_name = mysqli_real_escape_string($db, $_POST['add_product_name']);
    $add_product_price = mysqli_real_escape_string($db, $_POST['add_product_price']);
    $add_product_description = mysqli_real_escape_string($db, $_POST['add_product_description']);
    $add_product_category = mysqli_real_escape_string($db, $_POST['add_product_category']);

    // Check if an image was uploaded
    if ($_FILES["image"]["name"]) {
        //IMAGE UPLOAD
        $target_dir = "upload/"; // Directory where the file will be uploaded
        $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path to the file
        $uploadOk = 1; // Flag to determine if the file was uploaded successfully
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $errors = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors = "Image not uploaded.";
            // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $target_file;
            } else {
                $errors = "Image upload failed.";
            }
        }
    } else {
        // Generate a random image from unsplash
		$image_size = 500;
		$category_query = urlencode($add_product_category);
		$url = "https://source.unsplash.com/random/{$image_size}x{$image_size}/?{$category_query}";
		$headers = get_headers($url, 1);
		
		if (!empty($headers['Location'])) {
		    $image_url = $headers['Location'];
		    
		    // Modify the URL to include specific width and height
		    $image_url = strtok($image_url, '?');
		    $params = '?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h='.$image_size.'&w='.$image_size;
		    $image_url.=$params;
		} else {
		    $errors = "Failed to get random image from Unsplash.";
		}
    }

    //if image upload complete or random image fetched from unsplash, then upload product to database
    if (!isset($errors)) {
        // Generate a random 5-digit product ID
        $product_id = rand(10000, 99999);

        // Insert product into database
        $sql = "INSERT INTO products (id, product_name, product_price, product_description, product_category, product_image) 
                VALUES ('$product_id', '$add_product_name', '$add_product_price', '$add_product_description', '$add_product_category', '$image_url')";

        $results = mysqli_query($db, $sql);

        if ($results) {
            $success = "Product added successfully";
        } else {
            $errors = "Error adding product: " . mysqli_error($db);
        }
    }

    // Close database connection
    mysqli_close($db);
}
?>