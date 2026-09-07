<?php

if (isset($_POST['add_product'])) {

    $errors = array();

    $code_prod     = isset($_POST['code_prod']) ? trim($_POST['code_prod']) : '';
    $prod_name     = isset($_POST['prod_name']) ? trim($_POST['prod_name']) : '';
    $category_id   = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $satuan        = isset($_POST['satuan']) ? trim($_POST['satuan']) : '';
    $stok_input    = isset($_POST['stok']) ? trim($_POST['stok']) : '';
    $selling_input = isset($_POST['selling_price']) ? trim($_POST['selling_price']) : '';

    $stok = ($stok_input !== '') ? intval($stok_input) : 0;
    $selling_price = ($selling_input !== '') ? (float) $selling_input : 0;

    /* Validasi */

    if ($code_prod === '') {
        $errors['code_prod'] = 'Kode Produk wajib diisi!';
    }

    if ($prod_name === '') {
        $errors['prod_name'] = 'Nama Produk wajib diisi!';
    }

    if ($category_id <= 0) {
        $errors['category_id'] = 'Kategori Produk wajib dipilih!';
    }

    if ($satuan === '') {
        $errors['satuan'] = 'Satuan Produk wajib diisi!';
    }

    /* Stok 0 diperbolehkan */
    if ($stok_input === '') {
        $errors['stok'] = 'Stok wajib diisi!';
    } elseif (!is_numeric($stok_input) || $stok < 0) {
        $errors['stok'] = 'Stok harus berupa angka 0 atau lebih!';
    }

    if ($selling_input === '') {
        $errors['selling_price'] = 'Harga Jual wajib diisi!';
    } elseif (!is_numeric($selling_input) || $selling_price <= 0) {
        $errors['selling_price'] = 'Harga Jual harus lebih dari 0!';
    }

    /* Pastikan kategori benar-benar ada */
    if (!isset($errors['category_id'])) {

        $check_category = mysqli_prepare(
            $conn,
            "SELECT id FROM categories WHERE id = ? LIMIT 1"
        );

        if ($check_category === false) {
            die('SQL Error : ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($check_category, "i", $category_id);
        mysqli_stmt_execute($check_category);
        mysqli_stmt_store_result($check_category);

        if (mysqli_stmt_num_rows($check_category) == 0) {
            $errors['category_id'] = 'Kategori yang dipilih tidak ditemukan!';
        }

        mysqli_stmt_close($check_category);
    }

    /* Pastikan kode produk tidak duplikat */
    if (!isset($errors['code_prod'])) {

        $check_code = mysqli_prepare(
            $conn,
            "SELECT id FROM products WHERE prod_code = ? LIMIT 1"
        );

        if ($check_code === false) {
            die('SQL Error : ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($check_code, "s", $code_prod);
        mysqli_stmt_execute($check_code);
        mysqli_stmt_store_result($check_code);

        if (mysqli_stmt_num_rows($check_code) > 0) {
            $errors['code_prod'] = 'Kode Produk sudah digunakan!';
        }

        mysqli_stmt_close($check_code);
    }



    /* Simpan jika semua validasi lolos */
    
    if (empty($errors)) {

        /*
         * purchase_selling TIDAK lagi menjadi bagian dari Product.
         * Harga beli akan dicatat ketika transaksi Pembelian Supplier.
         */

        $sql = "INSERT INTO products
                (prod_code, name, category_id, selling_price, qty, satuan, img_prod, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('SQL Error : ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssidiss",
            $code_prod,
            $prod_name,
            $category_id,
            $selling_price,
            $stok,
            $satuan,
            $image_name
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);

            header("Location: ?page=products");
            exit;
        }

        $error_message = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);

        die('Gagal menambahkan produk: ' . $error_message);
    }
}

?>
