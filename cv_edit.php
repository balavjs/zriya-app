<?php
  $title = "CV Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>

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
              <li class="breadcrumb-item active">Update CV Details</li>
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
                <h3 class="card-title">Update CV Details</h3>
              </div> 

              <div class="card-body"> 

              <?php
                $result=new DB_cv();

                if(isset($_POST['update'])){

                  $id = $_GET['id'];          

                  define ('SITE_ROOT', realpath(dirname(__FILE__)));      
                  
                  $name           = $_POST['name'];
                  $email          = $_POST['email'];
                  $phone          = $_POST['phone'];
                  $address        = $_POST['address'];
                  $position       = $_POST['position'];
                  $business_unit  = $_POST['business_unit'];
                  $status         = $_POST['status'];  

                  $cv_name        = $_FILES['cv']['name'];        

                  if($cv_name!=""){
                    $cv  ="CV".time().$_FILES['cv']['name'];
                    move_uploaded_file($_FILES['cv']['tmp_name'], SITE_ROOT."/uploads/cv/".$cv);                   
                  }
                  else{
                    $sql1 = $result->get_one_cv($id);                     
                    foreach ($sql1 as $list_app) { 
                      $cv  = $list_app['cv']; 
                    }
                  } 
                  
                  $sql = $result->update($id, $name, $email, $phone, $address, $position, $business_unit, $cv, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "CV updated successfully!";   
                    header('location:cv_view.php');                  
                  }
                  else{                    
                    $_SESSION['error'] = "CV not updated!";   
                    header('location:cv_view.php');                    
                  }                   
                }
              ?>              

                  <form method="post" enctype="multipart/form-data">

                    <?php
                      $id = $_GET['id'];
                      $result1 = new DB_cv();
                      $sql1 = $result1->get_one_cv($id);   
                      while($row = mysqli_fetch_array($sql1)){ 
                    ?>

                    <div class="row">                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="Enter the name" name="name" value="<?php echo $row['name']; ?>"required>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" readonly required>
                        </div>   
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                        </div>    
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Address</label>
                          <textarea style="height: 123px;" class="form-control" rows="3" placeholder="Enter the address" name="address" required><?php echo $row['address']; ?></textarea>
                        </div>
                      </div>
                    </div>                                  

                    <div class="row">                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Position</label>
                          <input type="text" class="form-control" placeholder="Enter the position for apply" name="position" value="<?php echo $row['position']; ?>"required>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="formFile" class="form-label">Upload CV</label>
                          <input class="form-control-file" type="file" id="cvFile" name="cv">   <br>
                          <?php
                          if($row['cv'] != ""){ ?>  
                          <a href="https://zriyasolutions.com/employee_portal/zriya_app/uploads/cv/<?php echo $row['cv'];?>" target="_blank">
                            <button type="button" class="btn btn-zo">View CV</button>
                          </a>
                          <?php  }
                          ?>                     
                        </div>
                      </div>
                    </div>                       
                    
                    <div class="row">    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Business Unit</label>
                            <select class="form-control" name="business_unit" required>
                              <option value="" selected disabled>-- Select --</option>
                              <option value="Mechanical" <?php if($row['business_unit']=='Mechanical'){echo "selected='selected'";} ?>>Mechanical</option>
                              <option value="Civil" <?php if($row['business_unit']=='Civil'){echo "selected='selected'";} ?>>Civil</option>
                              <option value="Electrical" <?php if($row['business_unit']=='Electrical'){echo "selected='selected'";} ?>>Electrical</option>
                              <option value="Automotive" <?php if($row['business_unit']=='Automotive'){echo "selected='selected'";} ?>>Automotive</option>
                              <option value="Embedded" <?php if($row['business_unit']=='Embedded'){echo "selected='selected'";} ?>>Embedded</option>
                              <option value="IT" <?php if($row['business_unit']=='IT'){echo "selected='selected'";} ?>>IT</option>
                            </select>            
                        </div> 
                      </div>                
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Status</label>
                            <select class="form-control" name="status" required>
                              <option value="" selected disabled>-- Select Status --</option>
                              <option value="1" <?php if($row['status']=='1'){echo "selected='selected'";} ?>>Active</option>
                              <option value="0" <?php if($row['status']=='0'){echo "selected='selected'";} ?>>Inactive</option>
                            </select>          
                        </div> 
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
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
                <!-- /.card-body -->           
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
                <h3 class="card-title">Update CV Details</h3>
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
