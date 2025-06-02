<?php include('class/class_project_rfq.php'); ?>

  <table id="example1" class="table table-bordered table-striped" style="width:100%">
    
  <?php 
    $id = $_GET['id'];
    $result = new DB_project_rfq();
    $sql = $result->get_one_project_rfq($id);   
    $i=0;             
    foreach ($sql as $list) { 
      $i++;               
  ?>

  <?php

  $vExcelFileName="Project-". $list['rfq_no']. ".doc"; //replace your file name from here.

  header("Content-type: application/x-ms-download"); //#-- build header to download the word file 
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
      <th rowspan="3" width="50%"><img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
        <p>Organisation No: 559361-1030<br>
          MOMS Nummer: SE559361103001
        </p>
      </th>                   
      <td><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td> 
    </tr>
    <tr>                    
      <td><b>Signed Off:</b> <?php echo $list['signed'];?></td>
    </tr>
    <tr>                    
      <td>Technical Delivery Document</td>
    </tr>
    <tr>                    
      <td colspan="2">
        <h3 style="text-align: center;padding: 15px 0;"><b><u>Technical Specification Document</u></b></h3>
        <p>
          <h5><b>Aim</b></h5>
          <?php echo $list['aim'];?>
        </p>
        <p>
          <h5><b>Stakeholders</b></h5>
          <table id="example1" class="table table-bordered">
            <thead>
              <th>S.No</th>
              <th>Name of the Person</th>
              <th>Role</th>
            </thead>
            <tbody>                                  
              <?php
              $sql1 = $result->list_project_rfq_role($id);   
              $i=0;             
              foreach ($sql1 as $list1) { 
                $i++;                               
              ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $list1['name'];?></td>
                <td><?php echo $list1['role'];?></td>
              </tr>                                
              <?php
              }                                               
              ?>                       
            </tbody>
          </table>
        </p>
        <p>
          <h5><b>Deliverables</b></h5>
          <?php echo $list['deliverables'];?>
        </p>
        <p>
          <h5><b>Projected Costs</b></h5>
          <?php echo $list['cost'];?>
        </p><br>
        <p>
          <h5><b>Revisions</b></h5>
          <table id="example1" class="table table-bordered">
            <thead>
              <th>S.No</th>
              <th>Version</th>
              <th>Status</th>
              <th>Date</th>
              <th>User</th>                                
            </thead>
            <tbody>                                  
              <?php
              $sql2 = $result->list_project_rfq_revision($id);   
              $i1=0; 
              $i2 = '-1';
              $i3 = '-1';

              foreach ($sql2 as $list2) { 
                $i1++; 
                $i2++; 
                $i3++;                              
              ?>
              <tr>
                <td><?php echo $i1;?></td>
                <td>
                  <?php echo $list['rfq_no'];?> - Rev
                  <?php
                  $chars = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"); 
                  echo $chars[$i2];
                  ?>
                </td>
                <td>
                  <?php
                  if($i3==0){
                    echo "Initial";
                  }
                  else{
                    echo "Revision" .$i3;
                  }
                  ?>
                </td>
                <td><?php $date = strtotime($list2['date']); echo date('Y-m-d', $date); ?></td>
                <td>
                  <?php
                  $cur_user = $list2['user_id'];
                  $sql3 = $result->list_cur_user($cur_user);   
                  $i=0;             
                  foreach ($sql3 as $list3) { ?>
                    <?php echo $list3['fname']; ?> <?php echo $list3['lname']; ?>                            
                                        
                    <?php
                                                   
                    }
                    ?>

                </td>
              </tr>                                
              <?php
              }                                               
              ?>                       
            </tbody>
          </table>
        </p>
        <p>
          Thank you <br>
          Best Regards <br>
          <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/krishna-sign.png"><br>
          Krishna Radhakrishnan<br> 
          Sales Director<br> 
          Zriya Solutions<br>
        </p>
      </td>
    </tr>   
    
    <?php                 
    }
    ?>  
    
    
  </table>