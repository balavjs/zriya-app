<?php
  $title = "CV Add | Zriya Solutions";
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
              <li class="breadcrumb-item active">Add New CV</li>
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
	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">            

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New CV</h3>
              </div> 
              <div class="card-body">
                <?php
                  $result=new DB_cv();
                  if(isset($_POST['submit'])){
                  
                  define ('SITE_ROOT', realpath(dirname(__FILE__)));

                  $name           = $_POST['name'];
                  $email          = $_POST['email'];
                  $phone          = $_POST['phone'];
                  $address        = $_POST['address'];
                  $position       = $_POST['position'];
                  $business_unit  = $_POST['business_unit'];
                  $status         = $_POST['status'];  

                  $cv  ="CV".time().$_FILES['cv']['name'];
                  move_uploaded_file($_FILES['cv']['tmp_name'], SITE_ROOT."/uploads/cv/".$cv);
                                                 
                  $sql = $result->insert($name, $email, $phone, $address, $position, $business_unit, $cv, $status);

                  if ($sql) {  
                    $_SESSION['success'] = "New CV added successfully!";   
                    header('location:cv_view.php');                  
                  }
                  else{                    
                    $_SESSION['error'] = "CV not added / Email already exist!";   
                    header('location:cv_view.php');                    
                  } 
                }
              ?>
              
                <form method="post" name="myform" onsubmit="enableSample();" enctype="multipart/form-data">
                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div> 
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone" name="phone" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea  style="height: 210px;" class="form-control" rows="4" placeholder="Enter the address" name="address" required></textarea>
                      </div>
                    </div> 
                  </div>         

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Position</label>
                        <input type="text" class="form-control" placeholder="Enter the position for apply" name="position" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Business Unit</label>
                          <select class="form-control" name="business_unit" required>
                            <option value="" selected disabled>-- Select --</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="Civil">Civil</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Embedded">Embedded</option>
                            <option value="IT">IT</option>
                          </select>            
                      </div> 
                    </div>
                  </div>                                    

                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="formFile" class="form-label">Upload CV</label>
                        <input class="form-control-file" type="file" id="cvFile" name="cv" required>                        
                      </div>
                    </div>                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>            
                      </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit">Submit</button>
                      </div>
                    </div>                    
                  </div> 
                </form>               
              <!-- /.card -->
              </div>

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
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>