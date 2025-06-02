<?php
  $title = "Quotations | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_quotation.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Quotations</li>
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
                <h3 class="card-title">Quotation List</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <a href="quotation_add.php">
                  <button class="btn btn-zo">Add New Quotation</button>
                </a>

                <br><br>

                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Quote No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="125px">Action</th>
                    <th width="215px">Export</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                    $result = new DB_quotation();
                    $sql = $result->list_quotation();   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                   
                  ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list['quote_no'];?></td>
                    <td><?php echo $list['name'];?></td>
                    <td><?php echo $list['email'];?></td>                 
                    <td>                      
                      <a href="quotation_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="quotation_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="quotation_delete.php?id=<?php echo $list['id'];?>" class="btn-del"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    </td>
                    <td class="export_options">
                      <a href="quotation_export.php?id=<?php echo $list['id'];?>" style="margin-right: 3px;"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Word"><i class="fas fa-file-word"></i> Word</button></a>
                    <?php
                      $id         = $list['id']; 
                      $quote_no   = $list['quote_no'];   
                      $signed     = $list['signed'];                   
                      $name       = $list['name'];
                      $email      = $list['email'];
                      $phone      = $list['phone'];
                      $address    = $list['address'];
                      $inscope    = $list['inscope'];
                      $outscope   = $list['outscope'];
                      $addendums  = $list['addendums'];
                      $payment    = $list['payment'];
                      $date       = $list['date'];
                      
                      $result = new DB_quotation();

                      $sql2 = $result->get_one_quotation($id);                   

                      if($sql2){ 
                        foreach ($sql2 as $list1) {
                          ?>
                        <form method="post" action='quotation_pdf.php'>

                        <input type="hidden" name="id" value="<?php echo $list1['id']; ?>"> 
                        <input type="hidden" name="quote_no" value="<?php echo $quote_no; ?>"> 
                        <input type="hidden" name="date" value="<?php echo $date; ?>"> 
                        <input type="hidden" name="signed" value="<?php echo $signed; ?>">   
                        <input type="hidden" name="name" value="<?php echo $name; ?>"> 
                        <input type="hidden" name="email" value="<?php echo $email; ?>"> 
                        <input type="hidden" name="phone" value="<?php echo $phone; ?>">                                          
                        <textarea name="address" hidden><?php echo $address; ?></textarea> 
                        <textarea name="inscope" hidden><?php echo $inscope; ?></textarea> 
                        <textarea name="outscope" hidden><?php echo $outscope; ?></textarea> 
                        <textarea name="addendums" hidden><?php echo $addendums; ?></textarea> 
                        <textarea name="payment" hidden><?php echo $payment; ?></textarea> 

                        <button type="submit" class="btn btn-zg" name="submit" data-toggle="tooltip" data-placement="top" title="Export PDF"><i class="fas fa-file-pdf"></i> PDF</button> 
                        
                      </form> &nbsp;
                      <a href="quotation_mail.php?id=<?php echo $list['id'];?>" style="float:right;">
                        <button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Send Mail"><i class="fas fa-envelope"></i> Mail</button>
                      </a>
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
                    <th>Quote No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
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
              <div class="card-header">
                <h3 class="card-title">Doctors List</h3>
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
        title: 'Zriya Solutions - Quotations',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Quotations',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Quotations',
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