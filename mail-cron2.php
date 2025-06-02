<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>
<?php
	
	include('class/connection.php');

	$month = date('m');
    $year = date('Y');

	$sql2 = "SELECT * FROM time_accounts_detail WHERE MONTH(work_date) = '$month' AND YEAR(work_date) = '$year' GROUP BY emp_id"; 

    //echo $sql2;

    $res2 = mysqli_query($conn,$sql2);                

    if(mysqli_num_rows($res2) > 0) { 
    	while($row1 = mysqli_fetch_assoc($res2)) {          	

          	$emp_id = $row1['emp_id']; 

          	$result1 = new DB_user();
              	$sql1 = $result1->get_emp_id_user($emp_id);
              	foreach ($sql1 as $list1) {
              		//$mess =  $list1['fname'];
              		$email[] = $list1['email'];
            	}
        }
    }

	$message = 'Welcome to Zriya Solutions';
	$message .= $list1['fanme'];
	$subject = 'Zriya Report';
	$headers = 'From: info@zriyasolutions.com';

	foreach ($email as $to) {
		mail($to,$subject,$message,$headers);
	}

	//mail($email, $subject, $message, $headers);

?>