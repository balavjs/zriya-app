<?php
  $title = "Contract Update | Zriya Solutions";
  ob_start();
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
              <li class="breadcrumb-item active"><a href="contrat_view.php">Contract</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  	<!-- Main content -->
  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Update Contract Details</h3>
              </div>        

            <?php  
              $result_usr = new User();              
              $sql_usr = $result_usr->getonerecord($id);

              foreach ($sql_usr as $list_data) {  
              $id = $list_data['id'];                  
              $name1 = $list_data['fullname'];
              $role = $list_data['role'];
              
                if($role == 1 || $role == 5 || $role == 6){ 
            ?>

            <div class="card-body">  
            

            <?php
              $result=new DB_contract();

              if(isset($_POST['update'])){
                $id = $_GET['id'];

                define ('SITE_ROOT', realpath(dirname(__FILE__)));  
                
                $name        = $_POST['name'];
                $email       = $_POST['email'];
                
                $file_name     = $_FILES['file']['name'];        

                if($file_name!=""){
                  $file  ="contract".time().$_FILES['file']['name'];
                  move_uploaded_file($_FILES['file']['tmp_name'], SITE_ROOT."/uploads/contract/".$file);                   
                }
                else{
                  $sql1 = $result->get_one_contract($id);                     
                  foreach ($sql1 as $list_app) { 
                    $file  = $list_app['file']; 
                  }
                }  
                
                $sql = $result->update($id, $name, $email, $file);
                
                if ($sql) {
                  $_SESSION['success'] = "Contract Updated successfully";   
                  header('location:contract_view.php');                
                }
                else{
                  $_SESSION['error'] = "Contract not updated";   
                  header('location:contract_view.php');                   
                }
              }
            ?>              

                <form method="post" enctype="multipart/form-data">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_contract();
                    $sql1 = $result1->get_one_contract($id);   

                    while($row = mysqli_fetch_array($sql1)){  
                  ?>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" value="<?php echo $row['name']; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" required>
                      </div>
                    </div>
                  </div>                                  

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="formFile" class="form-label">Upload Document (.pdf)</label>
                        <input class="form-control-file" type="file" id="contractFile" name="file" accept="application/pdf" required> <br>
                        <?php
                        if($row['file'] != ""){ ?>  
                        <a href="uploads/contract/<?php echo $row['file'];?>" target="_blank">
                          <button type="button" class="btn btn-zo">View Uploaded file</button>
                        </a>
                        <?php  }
                        ?>                     
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="update">Update</button>
                      </div>
                    </div>                    
                  </div>                 
                </form>
                <?php
                }
                ?>
              </div>
            </div>
            <?php
            }
            else{
            ?>
              <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">   
                    <div class="card-body">
                      <div class="alert alert-danger" role="alert">
                        <strong>Oops!</strong> You don't have access to view this page.
                      </div>                        
                    </div>
                  </div>                  
                </div>
              </div>
            </section>
            <?php    
            }
            ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

   <?php
    }
    ?>
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>

<script type="text/javascript">
  $('#contractFile').change(function () {
    var fileExtension = ['pdf'];
    if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
      alert("Only .pdf format is allowed.");
      $('#contractFile').val('');            
    }
  });
</script>