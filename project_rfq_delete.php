<?php
	session_start();
	require_once('class/class_project_rfq.php');	
	$result = new DB_project_rfq();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "RFQ deleted successfully";   
        header('location:project_rfq_view.php');
	}
	else{
		$_SESSION['error'] = "RFQ not deleted";   
        header('location:project_rfq_view.php');
	}
?>

