<?php
  $title = "Time Accounts Admin | Zriya Solutions";
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

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             
            <?php                    
              $month = date('m');
              $year = date('Y');
            ?>
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Time Accounts List for the Month="<b><?php echo $month; ?></b>" and Year="<b><?php echo $year; ?></b>"</h3>
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
                ?>
                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php           
                    foreach ($sql as $list) { 
                      $i++;
                      $emp_id = $list['emp_id'];  
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
                      <a href="time_accounts_admin_detail.php?id=<?php echo $list['id']; ?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="time_accounts_admin_edit.php?id=<?php echo $list['id']; ?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a>

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
                    <th width="200px">Action</th>
                  </tr>
                  </tfoot>
                </table>
                <?php 
                } else{ ?>                
                    <a href="time_accounts_admin_add.php">
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
    else{
      ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">  
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Time Accounts List</h3>
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


<!-- Page specific script -->
<script>  

  $(function () {
    $('#example1').DataTable({
    dom: 'lfrtip',
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