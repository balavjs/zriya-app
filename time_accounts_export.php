<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>

  <table id="example1" class="table table-bordered table-striped" style="width:100%">
    
<?php 
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


$vExcelFileName="Time Accounts-".$list1['emp_id']."-".$list1['fname']." ".$list1['lname'].".xls"; //replace your file name from here.
    }
    }

header('Content-Type: application/xls'); //#-- build header to download the word file 
header("Content-Disposition: attachment; filename=$vExcelFileName"); 
header('Cache-Control: public'); 

$content = '<style>
        @page
        {
          font-family: Courier New;
          size:215.9mm 279.4mm;  /* A4 */            
          margin: 0.5mm !important;
        }
        
        h3 { 
          font-size: 24px; 
          text-align:center; 
          padding:20px 0;
        }
        h5{
          font-size: 20px;
        }
        p {
          font-family: Courier New; 
          font-size: 16px; 
          padding: 10px;
        }
        table{
          width:100% !important;
        }
        table, th, td{
          border:1px solid #000 !important;
          border-collapse: collapse;
          font-family: Courier New;
        }
        th, td{
          padding:10px !important;
        }
        
        </style>';

echo $content;

?>
    <tr> 
      <th rowspan="7" colspan="0" style="border: 1px solid #000;"><img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png"></th>              
      <td colspan="3" style="padding: 15px 10px !important;"><b>Employee No:</b> <?php echo $list1['emp_id'];?></td> 
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"></td>
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"><b>Employee Name:</b> <?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"></td>
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"><b>Date:</b> <?php echo date('Y-m-d'); ?></td>
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"></td>
    </tr>
    <tr>                    
      <td colspan="3" style="padding: 15px 10px !important;"></td>
    </tr>
    <tr>                    
      <td colspan="4">
        <h3 style="text-align: center;padding: 15px 0;"><b><u>Time Accounts</u></b></h3>  
          <table id="example1" class="table table-bordered">
            <thead>
              <th style="background-color: #17353d; color: #fff;">S.No</th>
              <th style="background-color: #17353d; color: #fff;">Project Name</th>
              <th style="background-color: #17353d; color: #fff;">Account Customer</th>
              <th style="background-color: #17353d; color: #fff;">Date</th>
              <th style="background-color: #17353d; color: #fff;">Worked Time</th>
              <th style="background-color: #17353d; color: #fff;">Total Hours</th>
              <th style="background-color: #17353d; color: #fff;">Off Day</th>
              <th style="background-color: #17353d; color: #fff;">Status</th>
            </thead>
            <tbody>
                
              <?php
              $sql2 = $result->list_time_accounts_my($id);   
              $i=0;             
              foreach ($sql2 as $list2) { 
                $i++;
             
              ?>

              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $list2['project_name'];?></td>
                <td><?php echo $list2['acc_cust'];?></td>
                <td><?php $date = strtotime($list2['work_date']); echo date('Y-m-d', $date); ?></td>
                <td>
                <?php
                  $in_time  = $list2['in_time'];
                  $out_time = $list2['out_time'];
                  $hour     = $list2['hour'];

                  if($in_time != "00:00:00" && $out_time != "00:00:00"){

                    $in_time1 = date('h:i a', strtotime($in_time)); 
                    $out_time1 = date('h:i a', strtotime($out_time));

                    echo $in_time1. " - " .$out_time1;
                  }
                  else{
                    $in_time = "08:00:00";
                    
                    $in_time1 = date('h:i a', strtotime($in_time));
                    $out_time1 = date('h:i a', strtotime($in_time.'+'.$hour.'hours'));
                    echo $in_time1. " - " .$out_time1;
                  }
                ?>
                </td>  
                <td align="center"> 
                  <?php   
                    $hour     = $list2['hour'];
                    if($hour == "0" || $hour == ""){
                      $time1 = new DateTime($list2['in_time']);
                      $time2 = new DateTime($list2['out_time']);
                      $timediff = $time1->diff($time2);
                      echo $timediff->format('%h:%i')."<br/>";
                      }
                      else{
                        echo $hour;
                      }                                                   
                  ?>
                </td> 
                <td>
                  <?php 

                  $dep_status = $list2['off_day'];
                  if($dep_status == 1){   ?>
                    <p>0001_ Leave of Absence</p>                              
                  <?php
                  }
                  else if($dep_status == 2){ ?>
                    <p>0007_Vacation</p>                              
                  <?php
                  }
                  else if($dep_status == 3){ ?>
                    <p>0007_Vacation</p>                              
                  <?php
                  }
                  else if($dep_status == 4){ ?>
                    <p>0007_Vacation</p>                              
                  <?php
                  }
                  else if($dep_status == 5){ ?>
                    <p>0004_ Parental Leave</p>                              
                  <?php
                  }
                  else if($dep_status == 6){ ?>
                    <p>0007_Vacation</p>                              
                  <?php
                  }
                  else if($dep_status == 7){ ?>
                    <p>0007_Vacation</p>                              
                  <?php
                  }
                  else{ ?>
                    <p>None</p>                              
                  <?php                    
                  }
                  ?>
                </td>
                <td>
                  <?php 

                  $dep_status = $list2['dstatus'];
                  if($dep_status == 1){
                    //echo "Active"; 
                    ?>
                    <p class="text-success">
                      <i class="fas fa-check-circle"></i> Approved
                    </p>
                    
                  <?php
                  }
                  else{
                     //echo "Inactive";
                    ?>
                    <p class="text-danger">
                      <i class="fas fa-clock"></i> Pending
                    </p>
                    
                  <?php                    
                  }
                  ?>
              </td> 
            </tr>
            <?php
            }                           
            ?>  
            <tr>
              <td colspan="4"></td>
              <td align="center">Total Hours</td>
              <td align="center">
                <?php
                $id = $_GET['id'];
                $sql3 = $result->list_time_accounts_my_sum($id); 
              
                $i=0;   
                if (is_array($sql3) || is_object($sql3)){          
                foreach ($sql3 as $list3) { 
                  $i++; 
                  //echo $list3['tothour'];  
                  $tothour = $list3['tothour'];
                  echo $tothour;
                  }
                }                
                ?>
              </td>
              <td colspan="2"></td>
            </tr> 
            <tr>
              <td colspan="4"></td>
              <td align="center">Sales Cost</td>
              <td align="center">
                <?php
                  $emp_id = $list['emp_id']; 
                  $result = new DB_time_accounts();
                  $sql = $result->get_one_time_accounts($id);   
                  $i=0;             
                  foreach ($sql as $list) { 
                    $i++;
                    $emp_id1 = $list['emp_id'];
                    //echo $emp_id1;
                  }

                  $result1 = new DB_user();
                  $sql1 = $result1->get_emp_id_user($emp_id);
                  foreach ($sql1 as $list1) {
                    $emp_id = $list1['emp_id'];
                    $id = $list1['id'];
                    //echo $emp_id;
                  }
                  $result = new DB_user();
                  $sql4 = $result->get_one_user($id);   
                  $i=0;             
                  foreach ($sql4 as $list4) { 
                    $cost = $list4['cost'];
                    $sales = $list4['sales'];
                    echo $sales;
                  }                
                ?>
              </td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="4"></td>
              <td align="center">Total Cost</td>
              <td align="center">
                <?php
                  $totcost = (int)$tothour * (int)$sales;  
                  echo $totcost;              
                ?>
              </td>
              <td colspan="2"></td>
            </tr>            
          </tbody>
        </table>        
      </td>
    </tr>     
    
    <?php                 
          }
        ?>
      </td>      
    </tr>      
  </table>