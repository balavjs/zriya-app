<?php
  $title = "Contract | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_contract.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contract</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Contract List</li>
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
      
        if($role == 1 || $role == 5 || $role == 6){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Contract List</h3>
              </div>
              
              <div class="card-body">
                <a href="contract_add.php">
                  <button class="btn btn-zo">Add New Contract</button>
                </a>
                <br><br>
                <table id="example1" class="table">
                  <thead>
                    <tr>
                      <th width="40px">S.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th width="125px" class="center">Action</th>
                      <th width="110px" class="center">Download</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      $result = new DB_contract();
                      $sql = $result->list_contract();   
                      $i=0;             
                      foreach ($sql as $list) { 
                        $i++;                                   
                    ?>

                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $list['name'];?></td>
                      <td><?php echo $list['email'];?></td>
                      <td>
                        <?php 
                          $status = $list['status'];
                          if($status == 1){
                            //echo "Active"; 
                            ?>
                            <p class="text-success">
                              <b><i class="fas fa-check-circle"></i> Accepted</b>
                            </p>
                            
                          <?php
                          }
                          elseif ($status == 2) {
                            //echo "Inactive";
                            ?>
                            <p class="text-danger">
                              <b><i class="fas fa-times-circle"></i> Rejected</b>
                            </p>
                            
                          <?php  
                          }  
                          else{
                            ?>
                            <p class="text-primary">
                              <b><i class="fas fa-hourglass-end"></i> Awaiting</b>
                            </p>
                          <?php
                          }               
                          
                        ?>
                      </td>
                      <td>                      
                        <a href="contract_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                        <a href="contract_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                        <a href="contract_delete.php?id=<?php echo $list['id'];?>" onClick="return confirm('Do you really want to delete?');"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="nav-icon far fa-trash-alt"></i></button></a>
                      </td>
                      <td align="center">
                        <?php 
                          $status = $list['status'];
                          if($status == 1){
                            ?>
                            <a href="contract_mail.php?id=<?php echo $list['id'];?>"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Send a Copy Mail"><i class="nav-icon fas fa-envelope"></i></button></a>
                            <a href="contract_download.php?id=<?php echo $list['id'];?>">
                              <button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Dowload Contract"><i class="fas fa-download"></i></button>
                            </a>
                          <?php
                          }else{
                            echo "-";
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th width="125px">Action</th>
                      <th>Download</th>
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
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Contract List</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>
                <h4></h4>
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
    dom: 'Blfrtip',
    buttons: [

    {
        extend: 'excelHtml5',
        text: '<i class="far fa-file-excel"></i> Excel',
        titleAttr: 'Export to Excel',
        title: 'Zriya Solutions - Contracts',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Contracts',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Contracts',
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