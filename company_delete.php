<?php
	session_start();
	include('class/class_company.php');
	$result = new DB_company();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Company deleted successfully";   
        header('location:company_view.php');
	}
	else{
		$_SESSION['error'] = "Company not deleted";   
        header('location:company_view.php');
	}
?>

