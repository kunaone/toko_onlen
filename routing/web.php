<?php

switch ($page) {
	case "products":
		include_once "./pages/products/view-product.php";
		break;
	case "edit-product":
		include_once "./pages/products/view-edit-product.php";
		break;
	case "categories":
		include_once "./pages/view-category.php";
		break;
	case "suppliers":
		include_once "./pages/view-supplier.php";
		break;
	case "penjualan":
		include_once "./pages/view-penjualan.php";
		break;
	case "pembelian":
		include_once "./pages/view-pembelian.php";
		break;
	case "login":
		include_once "./pages/login.php";
		break;
	case "home":
		include_once "./pages/home.php";
		break;
	// case $page:
	// 	include_once "./pages/".$page.".php";
	// 	break;
	// case 'login':
	// 	include_once "./pages/login.php";
	// 	break;
	// case 'register':
	// 	include_once "./pages/register.php";
	// 	break;
	default:
		include_once "./pages/404page.php";
		break;
}

?>