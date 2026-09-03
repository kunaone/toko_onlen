<?php

$stmt = mysqli_query($conn, "SELECT prod_code FROM products ORDER BY id DESC LIMIT 1");

$row = mysqli_fetch_assoc($stmt);

if($row){

    $last_code = $row['prod_code'];
    $num = intval(substr($last_code, 4));
    $num++;

} else {

    $num = 1;
}

$product_code = 'PRD-' . str_pad($num, 3, '0', STR_PAD_LEFT);

?>