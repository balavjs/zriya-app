<?php
  $title = "Salary Slip | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_salary_slip.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary Slip</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Salary Slip</li>
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

    ?>

    <?php 
      if($role == 1){ 
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Salary Slip</h3>
              </div>
              <div class="card-header">
                <a href="salary_slip_add.php">
                  <button class="btn btn-zo">Add New Salary Slip</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table  ">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Month & Year</th>
                    <th>Salary</th>
                    <th width="125px">Action</th>
                    <th>Salary Slip</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $result = new DB_salary_slip();
                    $sql = $result->list_salary_slip();   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;
                      $emp_id = $list['emp_id'];
                      $month  = $list['month'];

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

                  <tr>
                    <td><?php echo $i;?></td>
                    <?php 
                    
                      $result1 = new DB_user();
                      $sql1 = $result1->get_emp_id_user($emp_id);
                      foreach ($sql1 as $list1) {

                      $pan_no   = $list1['pan_no']; 
                        
                    ?>
                    <td><?php echo $list1['emp_id'];?></td>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    <?php                    
                    }
                    ?> 
                    <td><?php echo $month_name;?> - <?php echo $list['year'];?></td>
                    <td><?php echo $list['currency'];?> <?php echo $list['nsalary'];?></td>
                                  
                    <td>                      
                      <a href="salary_slip_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="salary_slip_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="salary_slip_delete.php?id=<?php echo $list['id'];?>" class="btn-del" data-toggle="tooltip" data-placement="top" title="Delete"><button class="btn btn-danger"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    </td>  
                    <td>
                      <?php
                      $id           = $list['id'];                   
                      $currency     = $list['currency']; 
                      $result = new DB_salary_slip();

                      $sql2 = $result->get_one_salary_slip($id);                   

                      if($sql2){ 
                        foreach ($sql2 as $list2) {
                          if($currency == "INR"){
                          ?>
                      <form method="post" action='salary_slip_pdf.php'>
                        <input type="hidden" name="id" value="<?php echo $list2['id']; ?>">
                        <input type="hidden" name="sal_my" value="<?php echo $month_name;?>-<?php echo $list['year'];?>">
                        <button type="submit" class="btn btn-zg" name="submit"><i class="fas fa-file-pdf"></i>&nbsp; Download</button>                        
                      </form>
                      <?php
                        }
                        else{
                        ?>
                      <form method="post" action='salary_slip_pdf_sek.php'>
                        <input type="hidden" name="id" value="<?php echo $list2['id']; ?>">
                        <input type="hidden" name="sal_my" value="<?php echo $month_name;?>-<?php echo $list['year'];?>">
                        <button type="submit" class="btn btn-zg" name="submit"><i class="fas fa-file-pdf"></i>&nbsp; Download</button>                        
                      </form>
                      <?php
                        }
                        }
                      }
                      ?>

                    </td>                  
                  </tr>

                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Month & Year</th>
                    <th>Salary (SEK)</th>
                    <th>Action</th>
                    <th>Salary Slip</th>
                  </tr>
                  </tfoot>
                </table>
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
              <div class="card-header card-zg">
                <h3 class="card-title">Salary Slip List</h3>
              </div>
              <div class="card-body">

                
                <?php 
                    $id = $list_data['id'];
                    $result = new DB_salary_slip();
                    $sql = $result->get_one_emp_salary_slip_limit($id);   
                    $i=0; 

                    $row_cnt = $sql->num_rows;

                    //printf("Result set has %d rows.\n", $row_cnt);

                    if( $row_cnt!=0){
                ?>
                <table id="example1" class="table">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Month & Year</th>
                      <th>Salary</th>
                      <th>Salary Slip</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php           
                    foreach ($sql as $list) { 
                      $i++;
                      $emp_id = $list['emp_id']; 
                      $month  = $list['month'];
                      $year   = $list['year'];
                      $nsalary = $list['nsalary'];

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

                      //echo $emp_id;     
                      $before =rand(10000, 90000);
                      $after = rand(10000, 90000);
                    ?>

                    <tr>
                      <td><?php echo $i;?></td>                                
                      <td><?php echo $month_name;?> - <?php echo $year;?></td>
                      <td><?php echo $list['currency'];?> <?php echo $nsalary;?></td>
                      <td>
                        <?php
                          $id       = $list['id']; 
                          $emp_id   = $list['emp_id'];
                          $salary   = $list['salary'];
                          $sal_date = $list['sal_date'];
                          $currency     = $list['currency']; 
                          
                          $result = new DB_salary_slip();

                          $sql2 = $result->get_one_salary_slip($id);
                        
                          foreach ($sql2 as $list2) {
                            if($currency == "INR"){
                          ?>
                          <form method="post" action='salary_slip_pdf.php'>
                            <input type="hidden" name="id" value="<?php echo $list2['id']; ?>">
                            <input type="hidden" name="sal_my" value="<?php echo $month_name;?>-<?php echo $list['year'];?>">
                            <button type="submit" class="btn btn-zg" name="submit"><i class="fas fa-file-pdf"></i>&nbsp; Download</button>                        
                          </form>
                          <?php
                            }
                            else{
                            ?>
                          <form method="post" action='salary_slip_pdf_sek.php'>
                            <input type="hidden" name="id" value="<?php echo $list2['id']; ?>">
                            <input type="hidden" name="sal_my" value="<?php echo $month_name;?>-<?php echo $list['year'];?>">
                            <button type="submit" class="btn btn-zg" name="submit"><i class="fas fa-file-pdf"></i>&nbsp; Download</button>                        
                          </form>
                          <?php
                            }
                          }
                          ?>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Month & Year</th>
                    <th>Salary (SEK)</th>
                    <th>Salary Slip</th>
                  </tr>
                  </tfoot>
                </table>
                <?php 
                } else{ ?>                
                    <p>No Records Found</p>
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
        title: 'Zriya Solutions - Salary Slip',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Salary Slip',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Salary Slip',
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

</script>

  <?php
  if(isset($_SESSION['success'])){
  ?>   
    <script type="text/javascript">
      Swal.fire({
        title: "Success!",
        text: "<?php  echo $_SESSION['success']; ?>!",
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
        text: "<?php  echo $_SESSION['error']; ?>!",
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