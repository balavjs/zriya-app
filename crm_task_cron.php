<?php include('class/db_config.php'); ?>
<?php include('class/class_crm_task.php'); ?>
<?php 
    

    $result = new DB_crm_task();
    $today = date('Y-m-d');
    $sql = $result->list_crm_task_today($today);
    
    
    foreach ($sql as $list) {

        $date       = strtotime($list['due_date']); 
        $task_date  = date('d-m-Y', $date);
        $cont_id    = $list['contact']; 
        $task_owner = $list['task_owner'];
        $subject    = $list['subject'];  
        $tstatus    = $list['tstatus'];
        $priority   = $list['priority'];
        $description= $list['description'];

        $sql1 = $result->list_crm_contact_user($cont_id);
        foreach ($sql1 as $list1) {  
            $fname  = $list1['fname'];
            $lname  = $list1['lname'];
            $email  = $list1['email'];
            $phone  = $list1['phone']; 

            $to = 'krishna@zriyasolutions.com'; 
            $from = 'krishna@zriyasolutions.com'; 
            $fromName = 'Zriya Solutions'; 
            $subject = 'Task - '.$subject; 
               
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
                                            Hi! Here the Task details for you.
                                          </th>
                                      </tr>
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Date</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$task_date.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Task Owner</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$task_owner.'</td> 
                                      </tr>
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Name</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname." ".$lname.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Task Status</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$tstatus.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Priority</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$priority.'</td> 
                                      </tr> 
                                      <tr> 
                                          <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                          <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                                      </tr> 
                                  </table> 
                              </body> 
                              </html><br>
                            ';
                
            $headers  = "MIME-Version: 1.0" . "\r\n"; 
            $headers  .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers  .= 'From: info@zriyasolutions.com';         
           
            // Send email 
            if(mail($to, $subject, $htmlContent, $headers)){ 
                echo 'Email has sent successfully.'; 
            }else{ 
                //echo 'Email sending failed.'; 
            }
        }       
    }

    //echo $date;


    
?>
