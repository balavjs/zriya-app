<?php
  $title = "CV Search | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_cv_rating.php'); ?>

<!-- Multiselect -->
<script src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="http://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>

<style type="text/css">
  .btn-group, .multiselect-container{
    width: 100%;
    transform: initial !important;
  }
  .text-center{
    text-align: left !important;
  }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CV Search</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">CV Search List</li>
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

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">CV Search</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                <div class="row"> 

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Technical Rating</label>
                      <select class="form-control" name="tech_rating" required>
                        <option value="" selected disabled>-- Select --</option>
                        <?php
                          $result = new DB_cv_rating();
                          $sql = $result->list_cv_rating_tech();
                          foreach ($sql as $list_rating) {   
                        ?>
                        <option value="<?php echo $list_rating['tech_rating']; ?>"><?php echo $list_rating['tech_rating']; ?></option>
                        <?php
                        }
                        ?>
                      </select>                        
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>English Rating</label>
                      <select class="form-control" name="eng_rating" required>
                        <option value="" selected disabled>-- Select --</option>
                        <?php
                          $result = new DB_cv_rating();
                          $sql = $result->list_cv_rating_eng();
                          foreach ($sql as $list_rating) {   
                        ?>
                        <option value="<?php echo $list_rating['eng_rating']; ?>"><?php echo $list_rating['eng_rating']; ?></option>
                        <?php
                        }
                        ?>
                      </select>                        
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>HR Rating</label>
                      <select class="form-control" name="hr_rating" required>
                        <option value="" selected disabled>-- Select --</option>
                        <?php
                          $result = new DB_cv_rating();
                          $sql = $result->list_cv_rating_hr();
                          foreach ($sql as $list_rating) {   
                        ?>
                        <option value="<?php echo $list_rating['hr_rating']; ?>"><?php echo $list_rating['hr_rating']; ?></option>
                        <?php
                        }
                        ?>
                      </select>                        
                    </div>
                  </div>
                  
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Languages</label>
                      <select class="form-control" name="lang[]" id="lang" multiple>
                        
                        <?php
                          $result = new DB_cv_rating();
                          $sql = $result->list_cv_rating_language();
                          foreach ($sql as $list_lang) {   
                        ?>
                        <option value="<?php echo $list_lang['lang']; ?>"><?php echo $list_lang['lang']; ?></option>
                        <?php
                        }
                        ?>
                      </select>                        
                    </div>
                  </div>

                   <script id="example">                     
                      $('#lang').multiselect({
                        enableClickableOptGroups: true,
                         maxHeight: 200  
                      });

                    </script>
                  
                  <div class="col-sm-4 align-self-end">
                    <div class="form-group">  
                      <button type="submit" class="btn btn-zg btn-block" name="submit">Search</button>
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
              
              $tech_rating  = $_POST['tech_rating'];
              $eng_rating   = $_POST['eng_rating'];
              $hr_rating    = $_POST['hr_rating'];  
              $lang         = $_POST['lang'];
              $lang         = implode("|",$lang);               
               
              $sql = "SELECT * FROM cv INNER JOIN cv_rating ON cv.id = cv_rating.cv_id INNER JOIN cv_rating_lang ON cv_rating.cv_id = cv_rating_lang.cv_id WHERE tech_rating = '$tech_rating' AND eng_rating = '$eng_rating' AND hr_rating = '$hr_rating' AND lang REGEXP ('$lang') AND value = 'Yes' GROUP BY cv.id"; 
              
              $res = mysqli_query($conn,$sql);                

              if(mysqli_num_rows($res) > 0) { ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Searched CV</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table">
                  <thead>
                  <tr>                    
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="125px">Interview Rating</th>
                    <th>Status</th>
                    <th width="50px">CV</th>
                    <th width="125px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_assoc($res)) {
                      $i++;
                      $id = $row['id'];
                      $cv_id = $row['cv_id'];
                      //echo $id;
                       ?> 
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['email'];?></td>                     
                    <?php
                      
                      $sql1 = "SELECT * FROM cv_rating WHERE cv_id='$id'";   

                      $res1 = mysqli_query($conn,$sql1);                

                      if(mysqli_num_rows($res1) > 0) { ?>   
                      ?>

                      <td align="center"><a href="cv_rating_add.php?id=<?php echo $row['cv_id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Add New Rating"> Add New</button></a></td>   
                      <td align="center">-</td>
                      <?php
                      } 
                      else{                          
                                               
                      ?>
                      <td>
                        <a href="cv_rating_detail.php?id=<?php echo $row['cv_id'];?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View Rating"><i class="nav-icon fas fa-eye"></i> </button></a>
                        <a href="cv_rating_edit.php?id=<?php echo $row['cv_id'];?>"><button type="button" class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update Rating"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="cv_rating_delete.php?id=<?php echo $row['cv_id'];?>" onClick="return confirm('Do you really want to delete?');"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Rating"><i class="nav-icon far fa-trash-alt"></i></button></a>
                      </td>
                      <td align="center">
                        <?php 
                          $status = $row['status'];
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
                      ?> 

                    <td>
                      <a href="uploads/cv/<?php echo $row['cv'];?>" target="_blank">
                        <button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="Download CV"><i class="fas fa-download"></i></button>
                      </a>
                    </td>               
                    <td>                      
                      <a href="cv_detail.php?id=<?php echo $cv_id; ?>" target="_blank"><button type="button" class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View CV"><i class="nav-icon fas fa-eye"></i></button></a> 
                      <a href="cv_edit.php?id=<?php echo $cv_id; ?>"><button type="button" class="btn btn-zo" data-toggle="tooltip" data-placement="top" title="Update CV"><i class="nav-icon fas fa-edit"></i></button></a> 
                      <a href="cv_delete.php?id=<?php echo $cv_id; ?>" onClick="return confirm('Do you really want to delete?');"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete CV"><i class="nav-icon far fa-trash-alt"></i></button></a>
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
                    <th>Interview Rating</th>
                    <th>Status</th>
                    <th>Rating Options</th>
                    <th>Action</th>
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
          ?>
          <div class="card">
            <div class="card-header card-zg">
              <h3 class="card-title">Searched CV</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> No records found.                    
              </div>
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
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">CV Search</h3>
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

<script type="text/javascript">

</script>

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
        title: 'Zriya Solutions - CV',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="far fa-file-alt"></i> CSV',
        titleAttr: 'CSV',
        title: 'Zriya Solutions - CV',
        exportOptions: {
            columns: ':not(:last-child)',
        }
    },
    {
        extend: 'pdfHtml5',
        text: '<i class="far fa-file-pdf"></i> PDF',
        titleAttr: 'PDF',
        title: 'Zriya Solutions - CV',
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

