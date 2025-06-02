<?php include('class/db_config.php'); ?>
<?php include('class/class_crm_meeting.php'); ?>

<?php     

    $result = new DB_crm_meeting();
    $today = date('Y-m-d');
    $sql = $result->list_crm_meeting_today($today);
    
    
    foreach ($sql as $list) {

        $host = $list['host'];
        $host         = $list['host'];
        $host_email   = $list['host_email'];
        $from_date    = $list['from_date'];
        $from_time    = $list['from_time'];
        $to_date      = $list['to_date'];
        $to_time      = $list['to_time'];
        $participants = $list['participants'];
        $subject      = $list['subject'];
        $description  = $list['description'];
        $status       = $list['status'];    
        $check_mail   = $list['check_mail'];


        $to = 'krishna@zriyasolutions.com'; 
        $from = 'krishna@zriyasolutions.com'; 
        $fromName = 'Zriya Solutions'; 
        $subject = 'Meeting - ' .$subject; 
           
        $htmlContent = '
                        <html> 
                          <head> 
                              <title>Welcome to Zriya Solutions</title> 
                          </head> 
                          <body> 
                              <table style="border: 1px solid #a6a6a6; width: 600px; border-collapse: collapse;" > 
                                  <tr> 
                                      <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                      </th>
                                  </tr>
                                  <tr> 
                                      <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                        Hi, you have a meeting today. This is a remainder and details are as follows
                                      </th>
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">From Date</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$from_date.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">To Date</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$to_date.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Host</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$host.'</td> 
                                  </tr> 
                                  '; 
                  if($description != ""){

                  $htmlContent .= '           
                              <tr> 
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                              </tr>
                              ';
                  }

                  $htmlContent .= '
                          </table> 
                      </body> 
                      </html>'; 
            
                  // Set content-type header for sending HTML email 
                  $headers = "MIME-Version: 1.0" . "\r\n"; 
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                   
                  // Additional headers 
                  $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

                  if($check_mail == 1){
                    $headers .= 'Cc:'.$participants . "\r\n";  
                  }
                   /*
                  // Send email 
                  if(mail($to, $subject, $htmlContent, $headers)){ 
                      //echo 'Email has sent successfully.'; 
                  }else{ 
                     //echo 'Email sending failed.'; 
                  }
                  */
               
    }

    
?>
