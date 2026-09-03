<?php

// require_once "../../config/conn.php";

if(isset($_POST['add_category'])){

	$category = isset($_POST['name']) ? trim($_POST['name']) : '' ;

	if(empty($category)){
	
		$error = "Kolom kategori masih kosong!";
	
	} else{

		$sql = "INSERT INTO categories (name) VALUES (?)";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, 's', $category);

		if(!mysqli_stmt_execute($stmt)){
			die("Gagal menambahkan kategori produk " . mysqli_error($conn));
		}		
	}
	
	header("Location: ?page=categories");
	exit;
}


?>