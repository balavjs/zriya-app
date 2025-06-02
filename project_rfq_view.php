<?php
  $title = "Project RFQ | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_project_rfq.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project RFQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="project_rfq_view.php">Project RFQ</a></li>
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
              <div class="card-header">
                <h3 class="card-title">Project RFQ List</h3>
              </div>
              
              <div class="card-body">
                <a href="project_rfq_add.php">
                  <button class="btn btn-zo">Add New RFQ</button>
                </a><br><br>
                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>RFQ No</th>
                    <th>Signed Off</th>
                    <th width="125px">Action</th>
                    <th width="225px">Export</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $result = new DB_project_rfq();
                    $sql = $result->list_project_rfq();   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;
                                 
                    ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list['rfq_no'];?></td>
                    <td><?php echo $list['signed'];?></td>                    
                    <td>                      
                      <a href="project_rfq_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="project_rfq_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="project_rfq_delete.php?id=<?php echo $list['id'];?>" class="btn-del"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="nav-icon far fa-trash-alt"></i></button></a>
                    </td>
                    <td class="export_options">
                      <a href="project_rfq_export.php?id=<?php echo $list['id'];?>" style="margin-right: 3px;"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Word"><i class="fas fa-file-word"></i> Word</button></a>
                    <?php
                      $id         = $list['id']; 
                      $rfq_no     = $list['rfq_no'];                      
                      $date       = $list['date'];
                      $signed     = $list['signed'];
                      $aim        = $list['aim'];
                      $deliverables  = $list['deliverables'];
                      $cost       = $list['cost'];
                      
                      $result = new DB_project_rfq();

                      $sql2 = $result->get_one_project_rfq($id);                   

                      if($sql2){ 
                        foreach ($sql2 as $list1) {
                          ?>
                      <form method="post" action='project_rfq_pdf.php'>

                        <input type="hidden" name="id" value="<?php echo $list1['id']; ?>"> 
                        <input type="hidden" name="rfq_no" value="<?php echo $list['rfq_no']; ?>"> 
                        <input type="hidden" name="date" value="<?php echo $list['date']; ?>"> 
                        <input type="hidden" name="signed" value="<?php echo $list['signed']; ?>">                         
                        <textarea name="aim" hidden><?php echo $aim; ?></textarea> 
                        <textarea name="deliverables" hidden><?php echo $deliverables; ?></textarea> 
                        <textarea name="cost" hidden><?php echo $cost; ?></textarea>
                        <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export PDF" name="submit" style="margin-right: 3px;"><i class="fas fa-file-pdf"></i>&nbsp; PDF</button> 
                      </form> 
                      <a href="project_rfq_mail.php?id=<?php echo $list['id'];?>" target="_blank" style="margin-right: 3px;">
                        <button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Send Mail"><i class="fas fa-envelope"></i> &nbsp;Mail</button>
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
                    <th>RFQ No</th>
                    <th>Signed Off</th>
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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Project RFQ List</h3>
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
        title: 'Zriya Solutions - Project RFQ',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - Project RFQ',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - Project RFQ',
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