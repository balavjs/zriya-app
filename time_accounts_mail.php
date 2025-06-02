<?php
  $title = "Time Accounts Mail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>

<?php
  $to = 'krishna@zriyasolutions.com'; 
  $from = 'krishna@zriyasolutions.com'; 
  $fromName = 'Zriya Solutions'; 
   
  $subject = "Zriya Report"; 
   
  $htmlContent = ' 
       
          <table style="border: 1px solid #a6a6a6; width: 450px; border-collapse: collapse;" > 
          ';
  		$id = $_GET['id'];
                
        $result = new DB_time_accounts();
        $sql = $result->get_one_time_accounts($id);   
        $i=0;             
        foreach ($sql as $list) { 
          $i++;
          $emp_id = $list['emp_id'];  

          $result1 = new DB_user();
            $sql1 = $result1->get_emp_id_user($emp_id);

            if (is_array($sql1) || is_object($sql1)){
              foreach ($sql1 as $list1) {

              	$emp_id1 = $list1['emp_id'];

    $htmlContent .= '

              <tr> 
                  <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                    <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                  </th>
              </tr>
              <tr> 
                  <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                    Hi! Here the meeting details for you.
                  </th>
              </tr>
              <tr> 
                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee Name</th>
                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$emp_id1.'</td> 
              </tr> 
              
              ';
          }
      }
  }

      $htmlContent .= '
          </table> 
      '; 
   
  // Set content-type header for sending HTML email 
  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   
  // Additional headers 
  $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
  //$headers .= 'Cc:'.$participants . "\r\n";  
   
  $success = mail($to, $subject, $htmlContent, $headers);
  // Send email 
  if($success){  
 	 echo "<script>if(confirm('Email Sent Sucessfully!')){document.location.href='time_accounts_view.php'};</script>";
  }else{ 
     echo 'Email sending failed.'; 
  }
?>

<?php include('footer.php'); ?>

