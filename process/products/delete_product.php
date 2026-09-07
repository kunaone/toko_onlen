<?php

if(isset($_POST['delete_product'])){

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if($id <= 0) {
        die("ID produk tidak valid");
    }

    $sql = "DELETE FROM products WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if(!mysqli_stmt_execute($stmt)) {
        die("Gagal menghapus produk: " . mysqli_error($conn));
    }

    header("Location: ?page=products");
    exit;
}
?>