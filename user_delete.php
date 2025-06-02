<?php
	session_start();
	require_once('class/class_users.php');	
	$result = new DB_user();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Company deleted successfully";   
        header('location:user_view.php');
	}
	else{
		$_SESSION['error'] = "Company not deleted";   
        header('location:user_view.php');
	}

?>

