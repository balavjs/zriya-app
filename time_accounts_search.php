<?php
  $title = "Time Accounts Search | Zriya Solutions";
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
                <h3 class="card-title">Time Accounts Search</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                <form  action="" method="post">
                <div class="row"> 
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Select Month</label>
                        <select class="form-control" name="month" required>
                          <option value="" selected disabled>-- Select Month --</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>                          
                          <option value="12">12</option>
                        </select>                        
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <?php

                      $starting_year  = 2020;
                      $ending_year    = 2030;

                      for($starting_year; $starting_year <= $ending_year; $starting_year++) {
                          $years[] = '<option value="'.$starting_year.'">'.$starting_year.'</option>';
                      }
                      ?>
                      <label>Select Year</label>
                      <select class="form-control" name="year" required>
                        <option value="" disabled selected>-- Select year --</option>'
                          <?php echo implode("\n\r", $years);  ?>
                      </select> 
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label>Select Employee ID</label>                    
                    <select class="form-control" name="emp_id" required>
                      <option selected disabled value="">-- Select the Employee ID  --</option>                       

                      <?php
                          $result1 = new DB_user();
                          $sql1 = $result1->list_user_only();
                          foreach ($sql1 as $list_user) {   
                        ?>
                        <option value="<?php echo $list_user['id']; ?>"><?php echo $list_user['emp_id']; ?> - <?php echo $list_user['fname']; ?> <?php echo $list_user['lname']; ?></option>
                        <?php
                        }
                          ?>
                    </select>
                  </div>
                  <div class="col-sm-4 align-self-end">
                    <div class="form-group">  
                      <button type="submit" class="btn btn-zo btn-block" name="submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            

              <?php

              include('class/connection.php');

              if(isset($_POST['submit'])){
                
                $month = $_POST['month'];
                $year = $_POST['year'];
                $emp_id  = $_POST['emp_id'];     

                $sql2 = "SELECT * FROM time_accounts_detail WHERE MONTH(work_date) = '$month' AND YEAR(work_date) = '$year' AND emp_id = '$emp_id' GROUP BY MONTH(work_date)"; 

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
                <h3 class="card-title">Searched Time Accounts List for <b><?php echo $month_name; ?>-<?php echo $year; ?></b> and Emp ID="<b>E-010<?php echo $emp_id; ?></b>"</h3>
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
                    $before =rand(10000, 90000);
                    $after = rand(10000, 90000);
                    }

                    ?>                           
                    <!--
                    <td>
                      <?php 
                    
                      $result2 = new DB_time_accounts();
                      $sql2 = $result2->get_one_time_accounts_status($time_acc_id);
                      foreach ($sql2 as $list2) {         

                        $dep_status = $list2['status'];
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
                      }
                      
                      ?>
                    </td>
                    -->
                    <td>              
                      <a href="time_accounts_detail.php?id=<?php echo $time_acc_id;?>&month=<?php echo $month;?>&year=<?php echo $year;?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="time_accounts_edit.php?id=<?php echo $time_acc_id;?>&month=<?php echo $month;?>&year=<?php echo $year;?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <!--
                      <a href="time_accounts_delete.php?id=<?php echo $row1['id'];?>" onClick="return confirm('Do you really want to delete?');"><button class="btn btn-danger"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    -->
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
              <h3 class="card-title">Searched Time Accounts List for <b><?php echo $month_name; ?>-<?php echo $year; ?></b>" and Emp ID="<b>E-010<?php echo $emp_id; ?></b>"</h3>
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

