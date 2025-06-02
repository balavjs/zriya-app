

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>



<?php 
$id = $_GET['id'];
$result = new DB_cv();
$sql = $result->get_one_cv($id);   
$i=0;             
foreach ($sql as $list) { 
  $i++;

  $id1      = $list['id'];
  $name     = $list['name'];
  $to_mail  = $list['email'];            
                  

?>
    
  <?php
  $to       = $to_mail; 
  $to1      = "careers@zriyasolutions.com";
  $from     = 'info@zriyasolutions.com'; 
  $fromName = 'Zriya Solutions'; 
   
  $subject  = "Zriya Interview Status"; 
   
  $htmlContent = '       
                  <table style="border: 1px solid #a6a6a6; width: 450px; border-collapse: collapse;" >
                  ';                     

  $htmlContent .= '
                  <tr> 
                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                      </th>
                  </tr>
                  <tr>                      
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">
                      <p>Hi <b>'.$name.'</b>, <br>Congratulations!!<br> 
                      We are  happy to announce that we found your CV very interesting and we would like to invite you for the first round of online interview.<br>
                      Please follow the link below on the prescribed time.<br> 
                      Good Luck<br><br>
                      <a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZTkzNTE3N2YtMGU0Zi00NjkwLTk4MTQtZmJiYWU3MDJiMDQ4%40thread.v2/0?context=%7b%22Tid%22%3a%22e28f33a4-019f-470e-bbd3-cd4c9a20952e%22%2c%22Oid%22%3a%229ab4bb77-726a-482c-89d7-ae50d0a65124%22%7d">Click Here to Meet</a>
                      </p>
                      Thanks,<br>
                      Zriya Solutions AB
                      </td> 
                  </tr> 
                  
                  ';  

  $htmlContent .= '
          </table> 
          '; 
   
  // Set content-type header for sending HTML email 
  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   
  // Additional headers 
  $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
   
  $success = mail($to, $subject, $htmlContent, $headers);
  
  
  $message = '       
                  <table style="border: 1px solid #a6a6a6; width: 450px; border-collapse: collapse;" >
                  ';                     

  $message .= '
                  <tr> 
                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                      </th>
                  </tr>
                  <tr>                      
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">
                      <p>Hi,<br> 
                      Here is the link to the interview with <b>'.$name.'</b>.
                      </p>
                      <p>
                        To see the CV <a href="https://zriyasolutions.com/employee_portal/zriya_app/cv_detail.php?id='.$id1.'" target="_blank">click here</a><br>                       
                      </p>
                      <p>
                      <a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZTkzNTE3N2YtMGU0Zi00NjkwLTk4MTQtZmJiYWU3MDJiMDQ4%40thread.v2/0?context=%7b%22Tid%22%3a%22e28f33a4-019f-470e-bbd3-cd4c9a20952e%22%2c%22Oid%22%3a%229ab4bb77-726a-482c-89d7-ae50d0a65124%22%7d">Click Here to Meet</a>
                      </p>
                      Thanks,<br>
                      Zriya Solutions AB
                      </td> 
                  </tr> 
                  
                  ';  

  $message .= '
          </table> 
          '; 

  $success1 = mail($to1, $subject, $message, $headers);

  // Send email 
  if($success){  
    echo "<script>alert('Email Sent to Sucessfully!');</script>";
    echo "<script>window.location.href='cv_view.php'</script>";
  }else{ 
    echo 'Email sending failed.'; 
  }
  
/*
  if($success1){  
    //echo "<script>if(confirm('Email Sent to adminSucessfully!')){document.location.href='cv_view.php'};</script>";
  }else{ 
    //echo 'Email sending failed.'; 
  }
*/

}

?>