<?php
require_once '../../config/conn.php';

$product_id = $_GET['id'];

$query = "SELECT products.*, categories.name AS category_name
		  FROM products
		  LEFT JOIN categories
    	  ON products.category_id = categories.id
		  WHERE products.id = '$product_id'";

$result = mysqli_query($conn, $query);

$product = mysqli_fetch_assoc($result);

echo json_encode($product);
?>