<?php
	session_start();
	include('class/class_crm_task.php');
	$result = new DB_crm_task();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Record deleted successfully";   
        header('location:crm_task_view.php');
	}
	else{
		$_SESSION['error'] = "Not deleted";   
        header('location:crm_task_view.php');
	}
?>

