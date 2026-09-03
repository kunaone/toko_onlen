<?php
	
if(isset($_POST['edit_category'])){

	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$category = isset($_POST['name']) ? trim($_POST['name']) : '';

	if(empty($category)){

		$error = "Kolom kategori masih kosong!";
	} else {

		$sql = "UPDATE categories SET name = ? WHERE id = ?";
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "si", $category, $id);

		if(!mysqli_stmt_execute($stmt)) {
			die("Gagal menambahkan kategori: " . mysqli_error($conn));
		}
	}

	header("Location: ?page=categories");
	exit;
}
?>