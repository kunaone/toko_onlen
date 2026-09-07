<?php

if (!isset($_GET['id'])) {
    die("Product ID tidak ditemukan.");
}

$product_id = intval($_GET['id']);

if ($product_id <= 0) {
    die("Product ID tidak valid.");
}

$sql = "SELECT id, prod_code, name, category_id, selling_price, qty, satuan, img_prod FROM products WHERE id = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$product = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$product) {
    die("Produk tidak ditemukan.");
}

?>