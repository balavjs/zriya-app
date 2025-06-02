<?php
	session_start();
	require_once('class/class_quotation.php');	
	$result = new DB_quotation();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Quotation deleted successfully";   
        header('location:quotation_view.php');
		//echo "<script>alert('Record deleted successfully');</script>";
		//echo "<script>window.location.href='quotation_view.php'</script>";
	}
	else{
		$_SESSION['error'] = "Quotation not deleted";   
        header('location:quotation_view.php');
		//echo "<script>alert('Not deleted');</script>";
		//echo "<script>window.location.href='quotation_view.php'</script>";
	}
?>

