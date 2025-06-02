<?php
  $title = "Time Accounts | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Time Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Time Accounts List</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <?php 
 
    $result_usr = new User();      
    $sql_usr = $result_usr->getonerecord($id);

    foreach ($sql_usr as $list_data) {  
      $id = $list_data['id'];                  
      $name1 = $list_data['fullname'];
      $role = $list_data['role'];
    
      if($role == 1){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <?php

              include('class/connection.php');              
                
                $month = date('m');
                $year = date('Y');  

                $sql2 = "SELECT * FROM time_accounts_detail WHERE MONTH(work_date) = '$month' AND YEAR(work_date) = '$year' GROUP BY emp_id"; 

                //echo $sql2;

                $res2 = mysqli_query($conn,$sql2);                

                if(mysqli_num_rows($res2) > 0) { 

                  if($month == 1){
                    $month_name = "January";
                  }
                  elseif($month == 2){
                    $month_name = "February";
                  }
                  elseif($month == 3){
                    $month_name = "March";
                  }
                  elseif($month == 4){
                    $month_name = "April";
                  }
                  elseif($month == 5){
                    $month_name = "May";
                  }
                  elseif($month == 6){
                    $month_name = "June";
                  }
                  elseif($month == 7){
                    $month_name = "July";
                  }
                  elseif($month == 8){
                    $month_name = "August";
                  }
                  elseif($month == 9){
                    $month_name = "September";
                  }
                  elseif($month == 10){
                    $month_name = "October";
                  }
                  elseif($month == 11){
                    $month_name = "November";
                  }
                  elseif($month == 12){
                    $month_name = "December";
                  }
                  ?>

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Searched Time Accounts List for <b><?php echo $month_name; ?>-<?php echo $year; ?></b></h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th width="125px">Action</th>                    
                    <th>Send Mail</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                $i=0;
                while($row1 = mysqli_fetch_assoc($res2)) {
                  $i++;  

                  $emp_id = $row1['emp_id'];  
                  $time_acc_id = $row1['time_acc_id'];                 
                ?>               

                  <tr>
                    <td><?php echo $i;?></td>
                    
                    <?php 
                    
                      $result1 = new DB_user();
                      $sql1 = $result1->get_emp_id_user($emp_id);
                      foreach ($sql1 as $list1) { 
                        
                    ?>
                    <td><?php echo $list1['emp_id'];?></td>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    <?php                    
                    }
                    ?>                           
                    
                    <td>              
                      <a href="time_accounts_detail.php?id=<?php echo $time_acc_id;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="time_accounts_edit.php?id=<?php echo $time_acc_id;?>&month=<?php echo $month;?>&year=<?php echo $year;?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      
                      <!--
                      <a href="time_accounts_delete.php?id=<?php echo $row1['id'];?>" onClick="return confirm('Do you really want to delete?');"><button class="btn btn-danger"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    -->
                    </td>
                    
                    <td>
                      <?php
                      if(isset($_POST['send_'.$i])){
                        
  
   
                      $htmlContent = ' 
                           
                              <table style="border: 1px solid #a6a6a6; width: 850px; border-collapse: collapse;" > 
                              ';

                            $id = $_POST['id'];
                                    
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
                                    $fname1 = $list1['fname'];
                                    $lname1 = $list1['lname'];
                                    $email1 = $list1['email'];

                        $htmlContent .= '

                                  <tr> 
                                      <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                      </th>
                                  </tr>
                                  <tr> 
                                      <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                        Hi! Here the Time Accounts details for you.
                                      </th>
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left; width:50%;">Employee ID</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$emp_id1.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee Name</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname1." ".$lname1.'</td> 
                                  </tr>
                                  
                                  ';
                                  }
                              }
                      }
                          
                          $htmlContent .= ' 
                              </table> 
                              <table style="border: 1px solid #a6a6a6; width: 850px; border-collapse: collapse;" >
                                <tr>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">S.No</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Project Name</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Customer</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Date</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Worked Time</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Off Day</th>
                                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Status</th>
                                </tr>
                              
                              ';

                            $time_acc_id = $_GET['id'];
                            $result2 = new DB_time_accounts();                        
                            $sql2 = $result2->list_time_accounts_my($id);  

                              
                            $i=0;   
                            if (is_array($sql2) || is_object($sql2)){          
                            foreach ($sql2 as $list2) { 
                              $i++;
                              $project_name = $list2['project_name'];
                              $acc_cust     = $list2['acc_cust'];

                              $date = strtotime($list2['work_date']); 

                              $in_time = $list2['in_time'];
                              $out_time = $list2['out_time'];

                              $in_time1 = date('h:i a', strtotime($in_time)); 
                              $out_time1 = date('h:i a', strtotime($out_time));

                              

                          $htmlContent .= ' 
                                <tr>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$i.'</td>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$project_name.'</td>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_cust.'</td>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.date('Y-m-d', $date).'</td>
                                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$in_time1.' - '.$out_time1.'</td>
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
                                </tr>
                                
                                  ';

                            }
                            }
                          $htmlContent .= ' 
                              </table> 
                                  ';
                       
                          //$to = $email1; 
                          $to = 'krishna@zriyasolutions.com';
                          $from = 'krishna@zriyasolutions.com'; 
                          $fromName = 'Zriya Solutions'; 
                           
                          $subject = "Zriya Report for - ".$emp_id1; 

                          // Set content-type header for sending HTML email 
                          $headers = "MIME-Version: 1.0" . "\r\n"; 
                          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                           
                          // Additional headers 
                          $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                          $headers .= 'Cc:'.$participants . "\r\n";  
                           
                          $success = mail($to, $subject, $htmlContent, $headers);
                          // Send email 
                          if($success){  
                           echo "<script>if(confirm('Email Sent Sucessfully!'));</script>";
                          }else{ 
                             echo 'Email sending failed.'; 
                          }
                        }
                        ?>
                      
                      <form method="post" class="<?php echo $i; ?>">
                        <input type="hidden" name="id" value="<?php echo $time_acc_id;?>">
                        <button class="btn btn-zg" name="send_<?php echo $i; ?>" data-toggle="tooltip" data-placement="top" title="Send Mail"><i class="nav-icon fas fa-envelope"></i>&nbsp; Mail</button>
                      </form>
                    </td>
                  
                  </tr>
                  <?php
                  }
                
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th width="125px">Action</th>  
                    <th>Send Mail</th>   
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>

          <?php
          }             
          else{
            if($month == 1){
              $month_name = "January";
            }
            elseif($month == 2){
              $month_name = "February";
            }
            elseif($month == 3){
              $month_name = "March";
            }
            elseif($month == 4){
              $month_name = "April";
            }
            elseif($month == 5){
              $month_name = "May";
            }
            elseif($month == 6){
              $month_name = "June";
            }
            elseif($month == 7){
              $month_name = "July";
            }
            elseif($month == 8){
              $month_name = "August";
            }
            elseif($month == 9){
              $month_name = "September";
            }
            elseif($month == 10){
              $month_name = "October";
            }
            elseif($month == 11){
              $month_name = "November";
            }
            elseif($month == 12){
              $month_name = "December";
            }

          ?>
          <div class="card">
            <div class="card-header card-zg">
              <h3 class="card-title">Searched Time Accounts List for <b><?php echo $month_name; ?>-<?php echo $year; ?></b></h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> No records found.                    
                </div><hr>
                <a href="time_accounts_add.php">
                  <button class="btn btn-zo">Add New Time Account</button>
                </a>
            </div>
          </div>
          <?php
          }
          
          ?>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <?php
    }
    else{
      ?>
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Time Accounts List</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                  $emp_id = $list_data['id'];
                  $month = date('m');
                  $year = date('Y');

                  $result = new DB_time_accounts();
                  $sql = $result->list_time_accounts_user_status_my($emp_id,$month,$year);   
                  $i=0;     

                  $row_cnt = $sql->num_rows;

                  //printf("Result set has %d rows.\n", $row_cnt);

                  if( $row_cnt!=0){

                  foreach ($sql as $list) { 
                    $i++;
                    $emp_id = $list['emp_id'];     
                    $before =rand(10000, 90000);
                    $after = rand(10000, 90000);       
                ?>

                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th width="125px">Action</th>
                  </tr>
                  </thead>
                  <tbody>                    

                  <tr>
                    <td><?php echo $i;?></td>
                    <?php 
                    
                      $result1 = new DB_user();
                      $sql1 = $result1->get_emp_id_user($emp_id);
                      foreach ($sql1 as $list1) { 
                        
                    ?>
                    <td><?php echo $list1['emp_id'];?></td>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    <?php
                    
                    }

                    ?>                   
                    
                    <td>
                      
                      <a href="time_accounts_detail.php?id=<?php echo $before.$list['id'].$after;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="time_accounts_edit.php?id=<?php echo $before.$list['id'].$after;?>&month=<?php echo $month;?>&year=<?php echo $year;?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Add More"><i class="nav-icon fas fa-edit"></i></button></a> 
                      
                    </td>
                    
                  </tr>
                  
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th width="125px">Action</th>
                  </tr>
                  </tfoot>
                </table>

                <?php
                }
                }
                else{ ?>                
                    <a href="time_accounts_add.php">
                      <button class="btn btn-zo">Add New Time Account</button>
                    </a>
                <?php 
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php    
    }
    }
    ?>
    <!-- /.content -->
  </div>



<?php include('footer.php'); ?>

<script type="text/javascript">

</script>

<!-- Page specific script -->
<script>  

  $(function () {
    $('#example1').DataTable({
    dom: 'Blfrtip',
    buttons: [

    {
        extend: 'excelHtml5',
        text: '<i class="far fa-file-excel"></i> Excel',
        titleAttr: 'Export to Excel',
        title: 'Zriya Solutions - Time Accounts',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Time Accounts',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Time Accounts',
        exportOptions: {
            columns: ':not(:last-child)',
        },
    },
    ],

    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    
  });
</script>

<script src="dist/js/sweetalert2.all.min.js"></script>

<?php
  if(isset($_SESSION['success'])){
  ?>   
    <script type="text/javascript">
      Swal.fire({
        title: "Success!",
        text: "<?php  echo $_SESSION['success']; ?>",
        icon: "success",
      });
    </script>
  <?php   
    unset($_SESSION['success']);
  }
  if(isset($_SESSION['error'])){
  ?>               
    <script type="text/javascript">
      Swal.fire({
        title: "Oops!",
        text: "<?php  echo $_SESSION['error']; ?>",
        icon: "error",
      });
    </script>                  
  <?php                   
    unset($_SESSION['error']);
  }
  ?>

<script type="text/javascript">

  $('.btn-del').on('click', function(e){
      e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            document.location.href = href;
            /*
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            */
          }
        })
  });

</script>