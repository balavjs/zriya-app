<?php

	include('class/class_time_accounts.php');
	$result = new DB_time_accounts();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		echo "<script>alert('Record deleted successfully');</script>";
		echo "<script>window.location.href='time_accounts_view.php'</script>";
	}
	else{
		echo "<script>alert('Not deleted');</script>";
		echo "<script>window.location.href='time_accounts_view.php'</script>";
	}
?>

