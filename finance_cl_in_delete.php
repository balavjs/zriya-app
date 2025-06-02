<?php
	session_start();
	include('class/class_finance_cl_in.php');
	$result = new DB_finance_cl_in();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Invoice deleted successfully";   
        header('location:finance_cl_in_view.php');
	}
	else{
		$_SESSION['error'] = "Invoice not deleted";   
        header('location:finance_cl_in_view.php');
	}
?>

