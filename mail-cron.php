<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>
<?php
	
	include('class/connection.php');

	$month = date('m');
  $year = date('Y');

	$sql2 = "SELECT * FROM time_accounts_detail WHERE MONTH(work_date) = '$month' AND YEAR(work_date) = '$year' GROUP BY emp_id"; 

    //echo $sql2;
	

    $htmlContent = '  
                  <div style="margin-bottom:20px;">                   
                  ';

    $res2 = mysqli_query($conn,$sql2);                

    if(mysqli_num_rows($res2) > 0) { 
    	while($row1 = mysqli_fetch_assoc($res2)) {          	

        $emp_id = $row1['emp_id']; 
        $id 	= $row1['time_acc_id'];

        $result1 = new DB_user();
      		$sql1 = $result1->get_emp_id_user($emp_id);
      			foreach ($sql1 as $list1) {
      			//$id 		= $list1['id'];
      			$emp_id1 	= $list1['emp_id'];
      			$fname1 	= $list1['fname'];
      			$lname1 	= $list1['lname'];

    $htmlContent .= '
    				<table style="border: 1px solid #a6a6a6; width: 850px; border-collapse: collapse; margin-bottom:20px;" >
                      <tr> 
                          <th colspan="7" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                            <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                          </th>
                      </tr>
                      <tr> 
                          <th colspan="7" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                            Hi! Here the Time Accounts details for you.
                          </th>
                      </tr>
                      <tr> 
                          <th colspan="3" style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee ID</th>
                          <td colspan="4" style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$emp_id1.'</td> 
                      </tr> 
                      <tr> 
                          <th colspan="3" style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee Name</th>
                          <td colspan="4" style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname1." ".$lname1.'</td> 
                      </tr>
                      <tr>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">S.No</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Project Name</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Customer</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Date</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Worked Time</th>
                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Total Hours</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Off Day</th>
	                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Status</th>
	                  </tr>';

	                  $id 	= $row1['time_acc_id'];
	                  $result2 = new DB_time_accounts();                        
    			          $sql2 = $result2->get_one_user_my($emp_id,$month,$year);  

    			              
    			          $i=0;   
    			          if (is_array($sql2) || is_object($sql2)){          
    			          foreach ($sql2 as $list2) { 
    				          $i++;
    				          $project_name = $list2['project_name'];
                      $acc_cust     = $list2['acc_cust'];

                      $date         = strtotime($list2['work_date']); 

                      $in_time      = $list2['in_time'];
                      $out_time     = $list2['out_time'];

                      $in_time1     = date('h:i a', strtotime($in_time)); 
                      $out_time1    = date('h:i a', strtotime($out_time));


                              
                              $time1 = new DateTime($list2['in_time']);
                              $time2 = new DateTime($list2['out_time']);
                              $timediff = $time1->diff($time2);
                              $tot_time = $timediff->format('%h:%i Hours')."<br/>";                     

                      
	$htmlContent .= '
						        <tr>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$i.'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$project_name.'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_cust.'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.date('Y-m-d', $date).'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$in_time1.' - '.$out_time1.'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$tot_time.'</td>
                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">
                                  ';

                                  $off_day = $list2['off_day'];
                                  if($off_day == 1){ 

                          $htmlContent .= '
                                    <p>0001_ Leave of Absence</p>  
                                  ';                            
                                  }
                                  else if($off_day == 2){ 
                          $htmlContent .= '
                                    <p>0002_Parental Leave (25%)</p>                              
                                  ';                            
                                  }
                                  else if($off_day == 3){
                          $htmlContent .= '
                                    <p>0003_Parental Leave(50%)</p>                              
                                  ';
                                  }
                                  else if($off_day == 4){ 
                          $htmlContent .= '
                                    <p>0004_Parental Leave</p>                              
                                  ';                              
                                  }
                                  else if($off_day == 5){ 
                          $htmlContent .= '
                                    <p>0005_Sick Leave 50%</p> 
                                  '; 
                                  }
                                  else if($off_day == 6){ 
                          $htmlContent .= '
                                    <p>0006_Sick Leave( 100%)</p>                              
                                  ';
                                  }
                                  else if($off_day == 7){ 
                          $htmlContent .= '
                                    <p>0007_Vacation</p>                              
                                  ';
                                  }
                                  else{
                          $htmlContent .= '
                                    <p>None</p>                              
                                  ';                  
                                  }
                          $htmlContent .= '
                                  </td>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;"> 
                                  ';
                                  $dep_status = $list2['dstatus'];
                                  if($dep_status == 1){
                          $htmlContent .= '
                                    <p class="text-success">
                                      <i class="fas fa-check-circle"></i> Approved
                                    </p>
                                  ';
                                  }
                                  else{
                          $htmlContent .= ' 
                                    <p class="text-danger">
                                      <i class="fas fa-clock"></i> Pending
                                    </p>  
                                  '; 
                                  }
                          $htmlContent .= '
                                  </td>
                    </tr>';
                    }
                	}

    $htmlContent .= '
                    </table>
                    ';			
      			
    		}

    		
            
        }
    }   

    $htmlContent .= '                    
                    </div><br>
                    ';

    $to      	= 'krishna@zriyasolutions.com';
	  $subject	= "Zriya Report";
	
    $headers 	= "MIME-Version: 1.0" . "\r\n"; 
    $headers 	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers 	.= 'From: krishna@zriyasolutions.com';    
	
	  mail($to,$subject,$htmlContent,$headers);	

?>