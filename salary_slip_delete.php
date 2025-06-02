<?php
	session_start();
	include('class/class_salary_slip.php');
	$result = new DB_salary_slip();
	
	$id = $_GET['id'];

	$sql = $result->delete($id);

	if($sql){
		$_SESSION['success'] = "Salary Slip deleted successfully";   
        header('location:salary_slip_view.php');
		//echo "<script>alert('Salary Slip deleted successfully');</script>";
		//echo "<script>window.location.href='salary_slip_view.php'</script>";
	}
	else{
		$_SESSION['error'] = "Salary Slip not deleted";   
        header('location:salary_slip_view.php');
		//echo "<script>alert('Not deleted');</script>";
		//echo "<script>window.location.href='salary_slip_view.php'</script>";
	}
?>

