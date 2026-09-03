<?php

session_start();

require_once "config/conn.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

/* ===================
	PROCESS POST REQUEST
   ===================*/

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	include_once "./routing/process.php";
}

/* ===================
	USER SESSION
   ===================*/

if(isset($page)){

	if($page == 'logout'){

		session_unset();
		session_destroy();

		header('Location: ?page=login');
		exit;
	}
}

if(isset($_SESSION['user_id'])){

	$user_id = $_SESSION['user_id'];

	$stmt = mysqli_prepare($conn, "SELECT fullname, username, email FROM users WHERE id = ?");

	mysqli_stmt_bind_param($stmt, 'i', $user_id);
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_bind_result($stmt, $fullname, $username, $email);
	mysqli_stmt_fetch($stmt);
}

// if($page != 'login' && $page != 'register'){
// 	if(!isset($_SESSION['user_id'])){
// 		header('Location: ?page=login');
// 		exit;
// 	}
// }

// user info
if(isset($fullname)){
	
    $firstname = explode(' ', trim($fullname))[0];
}

/* ===================
	LAYOUT
   ===================*/

include_once './layouts/header.php';

if($page != 'login' && $page != 'register'){

	include_once './layouts/topbar.php';
	include_once './layouts/sidebar.php';
}

include_once __DIR__ . '/routing/web.php';

if($page != 'login' || $page != 'register'){

	include_once './layouts/footer.php';
}

// mysqli_stmt_close($stmt);
?>

