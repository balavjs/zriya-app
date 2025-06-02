<?php
	session_start();
	require_once('class/class_consulting_rfq.php');	
	$result = new DB_consulting_rfq();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "RFQ deleted successfully";   
        header('location:consulting_rfq_view.php');
		//echo "<script>alert('Record deleted successfully');</script>";
		//echo "<script>window.location.href='consulting_rfq_view.php'</script>";
	}
	else{
		$_SESSION['error'] = "RFQ not deleted";   
        header('location:consulting_rfq_view.php');
		//echo "<script>alert('Not deleted');</script>";
		//echo "<script>window.location.href='consulting_rfq_view.php'</script>";
	}
?>

