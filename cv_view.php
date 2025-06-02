<?php
  $title = "CV | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_cv_rating.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CV</h1>
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

              <form method="post">               
                <div class="card-body">

                    <a href="cv_add.php">
                      <button type="button" class="btn btn-zo">Add New CV</button>
                    </a>&nbsp;
                    
                    <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Zriya" name="save" formaction="cv_rating_export_zriya.php" id="export_zriya"> <i class="fas fa-file-excel"></i> Zriya</button>
                    <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Sigma" name="save" formaction="cv_rating_export_sigma.php" id="export_sigma">  <i class="fas fa-file-excel"></i> Sigma</button>
                    <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Afry" name="save" formaction="cv_rating_export_afry.php" id="export_afry"> <i class="fas fa-file-excel"></i> Afry</button>
                    <button type="submit" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Export Combitech" name="save" formaction="cv_rating_export_combitech.php" id="export_combitech">  <i class="fas fa-file-excel"></i> Combitech</button><br><br>
                  
                  <table id="example1" class="table">
                    <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAl"></th>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Business Unit</th>
                      <th width="120px" class="center">Interview Rating</th>
                      <th>Status</th>
                      <th>Invite</th>
                      <th width="40px">CV</th>
                      <th width="125px">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php 
                      $result = new DB_cv();
                      $sql = $result->list_cv();   
                      $i=0;             
                      foreach ($sql as $list) { 
                        $i++; 
                        $id = $list['id'];   
                        $cv_id = $list['cv_id'];                            
                      ?>

                    <tr>
                      <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $list['id']; ?>"></td>
                      <td><?php echo $i;?></td>
                      <td><?php echo $list['name'];?></td> 
                      <td>
                        <?php 
                        if($list['business_unit'] == ""){
                          echo "-";
                        }else{
                          echo $list['business_unit'];
                        }                        
                        ?>
                      </td> 
                      <?php
                        $result1 = new DB_cv_rating();
                        $sql1 = $result1->get_one_cv_id_rating($id);   

                        $row_cnt = $sql1->num_rows; 
                        if($row_cnt == 0){   
                      ?>                    
                        <td align="center"><a href="cv_rating_add.php?id=<?php echo $list['id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Add New Rating"> Add New</button></a></td>   
                        <td align="center">-</td>
                        <?php
                        } 
                        else{
                            
                          $sql2 = $result1->get_one_cv_id_rating($id);            
                          foreach ($sql2 as $list2) { 
                          
                        ?>
                        <td>
                          <a href="cv_rating_detail.php?id=<?php echo $list2['cv_id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View Rating"><i class="nav-icon fas fa-eye"></i> </button></a>
                          <a href="cv_rating_edit.php?id=<?php echo $list2['cv_id'];?>"><button type="button" class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update Rating"><i class="nav-icon fas fa-edit"></i></button></a> 
                          <a href="cv_rating_delete.php?id=<?php echo $list2['cv_id'];?>" class="btn-del"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Rating"><i class="nav-icon far fa-trash-alt"></i></button></a>                        
                        </td>
                        <td align="center">
                          <?php 
                            $status = $list2['status'];
                            if($status == "Selected"){
                              echo "<i class='fas fa-check-circle text-success'></i> &nbsp;";
                            }
                            if($status == "Not Decided"){
                              echo "<i class='fas fa-hourglass-half text-primary'></i>";
                            }
                            if($status == "Rejected"){
                              echo "<i class='fas fa-times-circle text-danger'></i>";
                            }                          
                          ?>
                        </td>
                        <?php
                          }
                        }
                        ?> 
                      <td>
                          <a href="cv_invite_mail.php?id=<?php echo $list['id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Send Invite"><i class="nav-icon fas fa-envelope"></i> </button></a>
                      </td>
                      <td>
                        <a href="uploads/cv/<?php echo $list['cv'];?>" target="_blank">
                          <button type="button" class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Donwload CV"><i class="fas fa-download"></i></button>
                        </a>
                      </td>               
                      <td>                      
                        <a href="cv_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View CV"><i class="nav-icon fas fa-eye"></i></button></a> 
                        <a href="cv_edit.php?id=<?php echo $list['id'];?>"><button type="button" class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update CV"><i class="nav-icon fas fa-edit"></i></button></a> 
                        <a href="cv_delete.php?id=<?php echo $list['id'];?>" class="btn-del"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete CV"><i class="nav-icon far fa-trash-alt"></i></button></a>
                      </td>                    
                    </tr>
                    <?php
                    }
                    ?>                    
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Check</th>
                      <th>S.No</th>
                      <th>Name</th>  
                      <th>Business Unit</th>                 
                      <th>Interview Rating</th>
                      <th>Status</th>                    
                      <th>Invite</th>
                      <th>CV</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>                
                </div>
              </form>
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
                <h3 class="card-title">CV List</h3>
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
    dom: 'lfrtip',
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

<script>
$("#checkAl").click(function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

<script>

$(document).ready(function(){

 $('#export_zriya').click(function(){

  if(confirm("Are you sure you want to export this?")) {
    var id = [];
      $(':checkbox:checked').each(function(i){
      id[i] = $(this).val();
    });
    if(id.length === 0) {//tell you if the array is empty
        
      alert("Please Select atleast one checkbox");
      return false;
    }
  }
  else{
   return false;
  }

 });

 $('#export_sigma').click(function(){

  if(confirm("Are you sure you want to export this?")) {
    var id = [];
      $(':checkbox:checked').each(function(i){
      id[i] = $(this).val();
    });
    if(id.length === 0) {//tell you if the array is empty
        
      alert("Please Select atleast one checkbox");
      return false;
    }
  }
  else{
   return false;
  }

 });

 $('#export_afry').click(function(){

  if(confirm("Are you sure you want to export this?")) {
    var id = [];
      $(':checkbox:checked').each(function(i){
      id[i] = $(this).val();
    });
    if(id.length === 0) {//tell you if the array is empty
        
      alert("Please Select atleast one checkbox");
      return false;
    }
  }
  else{
   return false;
  }
  
 });

 $('#export_combitech').click(function(){

  if(confirm("Are you sure you want to export this?")) {
    var id = [];
      $(':checkbox:checked').each(function(i){
      id[i] = $(this).val();
    });
    if(id.length === 0) {//tell you if the array is empty
        
      alert("Please Select atleast one checkbox");
      return false;
    }
  }
  else{
   return false;
  }
  
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