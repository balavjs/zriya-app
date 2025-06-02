<?php include('class/class_users.php'); ?>
<?php
	$result = new DB_user();
	$sql = $result->list_user_only();   
	$i=0;             
	foreach ($sql as $list) { 
	  $i++; 
	  $email[] = $list['email'];		
    }
	
	$message = 'Welcome to Zriya Solutions';
	$subject = 'Zriya Report';
	$headers = 'From: info@zriyasolutions.com';

	foreach ($email as $to) {
		mail($to,$subject,$message,$headers);
	}

	//mail($email, $subject, $message, $headers);

?>