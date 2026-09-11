<?php

if($page == 'categories'){

    if(isset($_POST['add_category'])) {
        include_once "./process/categories/add_category.php";
    }

    if(isset($_POST['edit_category'])) {
        include_once "./process/categories/edit_category.php";
    }

    if(isset($_POST['delete_category'])) {
        include_once "./process/categories/delete_category.php";
    }
}

if($page == 'products'){

    if(isset($_POST['add_product'])) {
        include_once "./process/products/upload_file_img.php";
        include_once "./process/products/add_product.php";
    }

    // if(isset($_POST['edit_product'])) {
    //     include_once "./process/products/edit_product.php";
    // }

    if (isset($_POST['update_product'])) {
        include_once "./process/products/upload_file_img.php";
        include_once "./process/products/update_product.php";
    }

    if(isset($_POST['delete_product'])) {
        include_once "./process/products/delete_product.php";
    }
}
?>