<?php
  $title = "Finance Clothing - Sweden | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_finance_cl_sv.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finance Clothing - Sweden</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Finance Clothing - Sweden</li>
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
                <h3 class="card-title">Clothing List</h3>
              </div>
              <div class="card-body">
                <a href="finance_cl_sv_add.php">
                  <button class="btn btn-zo">Add New Invoice</button>
                </a><br><br>
                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Invoice No</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Paid / Unpaid</th>
                    <th width="125px">Action</th>
                    <th width="100px">Export</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $result = new DB_finance_cl_sv();
                    $sql = $result->list_finance_cl_sv();   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;
                      $comp_id = $list['comp_id'];         
                    ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list['invoice_no'];?></td>
                    <?php 
                      $sql1 = $result->get_one_company($comp_id);
                      foreach ($sql1 as $list1) { 
                    ?>                    
                    <td><?php echo $list1['name'];?></td>
                    <td><?php echo $list1['comp_name'];?></td>
                    <?php                    
                      }
                    ?> 
                    <td>
                      <?php 
                        $paid_status = $list['p_status'];
                        if($paid_status == 1){
                          ?>
                          <p class="text-success">
                            <b><i class="fas fa-check-circle"></i> Paid</b>
                          </p>
                        <?php
                        }
                        else{
                          ?>
                          <p class="text-danger">
                            <b><i class="fas fa-times-circle"></i> Unpaid</b>
                          </p>
                        <?php  
                        }    
                      ?>                       
                    </td>                                        
                    <td>                      
                      <a href="finance_cl_sv_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="finance_cl_sv_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="finance_cl_sv_delete.php?id=<?php echo $list['id'];?>" class="btn-del"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    </td>
                    <td  class="export_options">
                      <a href="finance_cl_sv_export.php?id=<?php echo $list['id'];?>" style="margin-right: 3px;"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Word"><i class="fas fa-file-word"></i> </button></a>
                    <?php

                      $id   = $list['id'];

                      $result = new DB_finance_cl_sv();
                      $sql2 = $result->get_one_finance_cl_sv($id);                   

                      if($sql2){ 
                      foreach ($sql2 as $list1) {
                          ?>
                      <form method="post" action='finance_cl_sv_pdf.php'>
                        <input type="hidden" name="id" value="<?php echo $list1['id']; ?>">
                        <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export PDF" name="submit"><i class="fas fa-file-pdf"></i></button>                         
                      </form> &nbsp;
                      <?php if($paid_status == 1){ ?>
                      <form method="post" action='finance_cl_sv_receipt.php'>
                        <input type="hidden" name="id" value="<?php echo $list1['id']; ?>"> 
                        <button type="submit" class="btn btn-zg" name="submit" data-toggle="tooltip" data-placement="top" title="Export Receipt"><i class="fas fa-file-pdf"></i></button>                        
                      </form>
                      <?php } 
                      else{
                        echo "-";
                      }
                      ?> 
                    </td>
                  </tr>
                  <?php
                  }
                }
              }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Invoice No</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Paid / Unpaid</th>
                    <th width="125px">Action</th>
                    <th>Export</th>
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
                <h3 class="card-title">Invoice List</h3>
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
    dom: 'Blfrtip',
    buttons: [

    {
        extend: 'excelHtml5',
        text: '<i class="far fa-file-excel"></i> Excel',
        titleAttr: 'Export to Excel',
        title: 'Zriya Solutions - Invoices',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Invoices',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Invoices',
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