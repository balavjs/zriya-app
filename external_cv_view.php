<?php
  $title = "External CV | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_external_cv.php'); ?>

<style>
  .cv_btns .btn{
    margin-bottom: 5px;
  }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>External CV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">CV List</li>
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
      
        if($role == 1 || $role == 2 || $role == 3){ 
    ?>
	  
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">CV List</h3>
              </div>
             
              <div class="card-body">
                <a href="external_cv_add.php">
                  <button class="btn btn-zo">Add New CV</button>
                </a><br><br>
                <table id="example1" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Business Unit</th>
                    <th width="300px">CV</th>
                    <th width="165px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $result = new DB_external_cv();
                      $sql = $result->list_external_cv();   
                      $i=0;             
                      foreach ($sql as $list) { 
                        $i++;
                        $id = $list['cv_id'];           
                    ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <?php 
                      $result1 = new DB_cv();
                      $sql1 = $result1->get_one_cv($id);   
                                   
                      foreach ($sql1 as $list1) { ?>
                        <td><?php echo $list1['name'];?></td>                    
                        <td>
                          <?php 
                          if($list1['business_unit'] == ""){
                            echo "-";
                          }else{
                            echo $list1['business_unit'];                      
                          }
                          ?>
                        </td> 
                      <?php
                      }
                    ?>
                    <td class="cv_btns">
                      <a href="external_cv_export_zriya.php?id=<?php echo $list['id'];?>"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Zriya"><i class="nav-icon fas fa-download"></i> Zriya</button></a>
                      <a href="external_cv_export_combitech.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Export Combitech"><i class="nav-icon fas fa-download"></i> Combitech</button></a>
                      <a href="external_cv_export_sigma.php?id=<?php echo $list['id'];?>"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Sigma"><i class="nav-icon fas fa-download"></i> Sigma</button></a>
                      <a href="external_cv_export_afry.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Export Afry"><i class="nav-icon fas fa-download"></i> Afry</button></a>
                      <a href="external_cv_export_other.php?id=<?php echo $list['id'];?>"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Other"><i class="nav-icon fas fa-download"></i> Other</button></a>                      
                    </td>                                                    
                    <td>     
                      <a href="external_cv_invite_mail.php?id=<?php echo $list['cv_id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Invite Mail"><i class="nav-icon fas fa-envelope"></i> </button></a>                 
                      <a href="external_cv_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="external_cv_edit.php?id=<?php echo $list['id'];?>"><button class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="external_cv_delete.php?id=<?php echo $list['id'];?>" class="btn-del"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="nav-icon far fa-trash-alt"></i></button></a>
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
                    <th>Business Unit</th>
                    <th>CV</th>
                    <th width="125px">Action</th>
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
                <h3 class="card-title">CV List</h3>
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
        title: 'Zriya Solutions - External CV',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - External CV',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - External CV',
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