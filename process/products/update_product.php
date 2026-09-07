<?php

if(isset($_POST['update_product'])){

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    $prod_code =  isset($_POST['prod_code']) ? trim($_POST['prod_code']) : '';

    $name =  isset($_POST['name']) ? trim($_POST['name']) : '';

    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    $selling_price = isset($_POST['selling_price']) ? intval($_POST['selling_price']) : 0;

    $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 0;

    $satuan = isset($_POST['satuan']) ? trim($_POST['satuan']) : '';

    if (!$product_id) {
        die("Product ID tidak valid.");
    }

    $sql = "UPDATE products SET prod_code = ?, name = ?, category_id = ?, selling_price = ?, qty = ?, satuan = ?, img_prod = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssiiissi",
        $prod_code,
        $name,
        $category_id,
        $selling_price,
        $qty,
        $satuan,
        $image_name,
        $product_id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ?page=products");
        exit;
    } else {
        die("Gagal mengupdate produk.");
    }
}

?>