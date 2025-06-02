<?php
	session_start();
	include('class/class_cv_rating.php');
	$result = new DB_cv_rating();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "CV rating deleted successfully";   
        header('location:cv_view.php');
	}
	else{
		$_SESSION['error'] = "Not deleted";   
        header('location:cv_view.php');
	}
?>

