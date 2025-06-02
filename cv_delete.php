<?php
	session_start();
	include('class/class_cv.php');
	$result = new DB_cv();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "CV deleted successfully";   
        header('location:cv_view.php');
	}
	else{
		$_SESSION['error'] = "Not deleted";   
        header('location:cv_view.php');
	}
?>

