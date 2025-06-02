<?php
	session_start();
	include('class/class_time_accounts.php');
	$result = new DB_time_accounts();
	
	$id = $_GET['id'];
	$row_id =$_GET['row_id'];

	$sql = $result->time_acc_det_delete($id);
	
	if($sql){
		echo "<script>alert('Record deleted successfully');</script>";
		echo "<script>window.location.href='time_accounts_admin_edit.php?id=".$row_id."'</script>";
	}
	else{
		echo "<script>alert('Not deleted');</script>";
		echo "<script>window.location.href='time_accounts_admin_edit.php?id=".$row_id."'</script>";
	}
?>

