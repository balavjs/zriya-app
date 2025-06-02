<?php
	session_start();
	include('class/class_crm_vendor.php');
	$result = new DB_crm_vendor();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Record deleted successfully";   
        header('location:crm_vendor_view.php');
	}
	else{
		$_SESSION['error'] = "Not deleted";   
        header('location:crm_vendor_view.php');
	}
?>

