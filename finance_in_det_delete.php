<?php

	include('class/class_finance_in.php');
	$result = new DB_finance_in();
	
	$id = $_GET['id'];
	$row_id =$_GET['row_id'];

	$sql = $result->finance_in_det_delete($id);

	if($sql){
		echo "<script>alert('Record deleted successfully');</script>";
		echo "<script>window.location.href='finance_in_edit.php?id=".$row_id."'</script>";
	}
	else{
		echo "<script>alert('Not deleted');</script>";
		echo "<script>window.location.href='finance_in_edit.php?id=<?php echo $row_id;?>'</script>";
	}
?>

