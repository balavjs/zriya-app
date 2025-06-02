<?php
	session_start();
	include('class/class_finance_cl_sv.php');
	$result = new DB_finance_cl_sv();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Invoice deleted successfully";   
        header('location:finance_cl_sv_view.php');
	}
	else{
		$_SESSION['error'] = "Invoice not deleted";   
        header('location:finance_cl_sv_view.php');
	}
?>

