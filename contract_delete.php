<?php

	include('class/class_contract.php');
	$result = new DB_contract();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		echo "<script>alert('Record deleted successfully');</script>";
		echo "<script>window.location.href='contract_view.php'</script>";
	}
	else{
		echo "<script>alert('Not deleted');</script>";
		echo "<script>window.location.href='contract_view.php'</script>";
	}
?>

