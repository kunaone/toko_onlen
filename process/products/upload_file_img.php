<?php

if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] != UPLOAD_ERR_NO_FILE) {

    $image = $_FILES['img_prod'];

    // 2 MB
    $max_size = 2 * 1024 * 1024;

    if ($image['error'] != UPLOAD_ERR_OK) {
        die('Gagal mengupload gambar.');
    }

    if ($image['size'] > $max_size) {
        die('Ukuran gambar maksimal 2 MB.');
    }

    // Check actual MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $image['tmp_name']);
    finfo_close($finfo);

    $allowed = array(
        'image/jpeg',
        'image/png'
    );

    if (!in_array($mime, $allowed)) {
        die('Format gambar harus JPG atau PNG.');
    }

    // Generate extension
    if ($mime == 'image/jpeg') {
        $extension = 'jpg';
    } else {
        $extension = 'png';
    }

    // Example:
    // prd_003_64a91f.jpg
    $image_name = uniqid('prd_') . '.' . $extension;

    $upload_dir = __DIR__ . "/../../uploads/products/";

    if (!is_dir($upload_dir)) {
        $errors['img_prod'] = "Folder uploads tidak ditemukan";
    }

    if (!move_uploaded_file($image['tmp_name'], $upload_dir . $image_name)) {
        die('Gagal menyimpan gambar.');
    }
}

?>