<?php
  $title = "Time Accounts Admin Details | Zriya Solutions";
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
              <li class="breadcrumb-item active">Time Accounts Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Time Account Details</h3>
              </div>

              <div class="card-body">
                <a href="time_accounts_admin_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Time Accounts</button>
                </a><br><br>

                <table id="example1" class="table ">                  
                  <?php 
                    $id = $_GET['id'];
                    
                    $result = new DB_time_accounts();
                    $sql = $result->get_one_time_accounts($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;
                      $emp_id = $list['emp_id'];             
                  ?> 

                  <?php                    
                    $result1 = new DB_user();
                    $sql1 = $result1->get_emp_id_user($emp_id);

                    if (is_array($sql1) || is_object($sql1)){
                      foreach ($sql1 as $list1) {                          
                    ?>

                    <tr>                    
                      <th>Employee ID</th>
                      <td><?php echo $list1['emp_id'];?></td>
                    </tr>
                    <tr>                    
                      <th>Employee Name</th>
                      <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    </tr>

                    <?php                    
                    }
                    }
                  }
                  ?>                   
                </table>
                <br>

                <table id="example1" class="table">
                  <thead>
                    <th>S.No</th>
                    <th>Project Name</th>
                    <th>Account Customer</th>
                    <th>Date</th>
                    <th>Worked Time</th>
                    <th>Hours</th>
                    <th>Off Day</th>
                    <th>Status</th>
                  </thead>
                  <tbody>                      
                    <?php  
                      $time_acc_id = $_GET['id'];
                      $result2 = new DB_time_accounts();                        
                      $sql2 = $result2->list_time_accounts_my($id);  

                        
                      $i=0;   
                      if (is_array($sql2) || is_object($sql2)){          
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
                      <td> 
                        <?php   
                          $hour     = $list2['hour'];
                          if($hour == "0" || $hour == ""){
                            $time1 = new DateTime($list2['in_time']);
                            $time2 = new DateTime($list2['out_time']);
                            $timediff = $time1->diff($time2);
                            echo $timediff->format('%h:%i Hours')."<br/>";
                            }
                            else{
                              echo $hour." Hours";
                            }                                                   
                        ?>
                      </td> 
                      <td>
                        <?php 

                        $off_day = $list2['off_day'];
                        if($off_day == 1){   ?>
                          <p>0001_ Leave of Absence</p>                              
                        <?php
                        }
                        else if($off_day == 2){ ?>
                          <p>0002_Parental Leave (25%)</p>                              
                        <?php
                        }
                        else if($off_day == 3){ ?>
                          <p>0003_Parental Leave(50%)</p>                              
                        <?php
                        }
                        else if($off_day == 4){ ?>
                          <p>0004_Parental Leave</p>                              
                        <?php
                        }
                        else if($off_day == 5){ ?>
                          <p>0005_Sick Leave 50%</p>                              
                        <?php
                        }
                        else if($off_day == 6){ ?>
                          <p>0006_Sick Leave( 100%)</p>                              
                        <?php
                        }
                        else if($off_day == 7){ ?>
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
                            <b><i class="fas fa-check-circle"></i> Approved</b>
                          </p>
                          
                        <?php
                        }
                        else{
                           //echo "Inactive";
                          ?>
                          <p class="text-danger">
                            <b><i class="fas fa-clock"></i> Pending</b>
                          </p>
                          
                        <?php                    
                        }
                        ?>
                    </td>                        
                    </tr>
                    <?php
                    }
                    }         
                    ?>
                  </tbody>
                </table>
                <br>
                
              </div>
              <!-- /.card-body -->                
            </div>
            <!-- /.card -->
          </div>
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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Time Account Details</h3>
              </div> 
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>                
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
