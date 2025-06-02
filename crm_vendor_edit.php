<?php
  $title = "CRM Vendors Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_vendor.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_vendor_view.php">CRM Vendor</a></li>
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

      if($role == 1 || $role == 2 || $role == 4){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Update Vendor Details</h3>
              </div>            

              <div class="card-body">  
              
                <?php
                $result=new DB_crm_vendor();

                if(isset($_POST['update'])){
                  $id = $_GET['id'];                
                  
                  $vendor_owner   = $_POST['vendor_owner'];
                  $vendor_name    = $_POST['vendor_name'];
                  $phone          = $_POST['phone'];
                  $website        = $_POST['website'];
                  $gl_account     = $_POST['gl_account'];
                  $category       = $_POST['category'];
                  $description    = $_POST['description'];                
                  $street         = $_POST['street'];
                  $city           = $_POST['city'];
                  $state          = $_POST['state'];
                  $zip            = $_POST['zip'];
                  $country        = $_POST['country'];
                  $status         = $_POST['status'];      
                  
                  $sql = $result->update($id, $vendor_owner, $vendor_name, $phone, $website, $gl_account, $category, $description, $street, $city, $state, $zip, $country, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "Updated successfully!";   
                    header('location:crm_vendor_view.php');                  
                  }
                  else{
                    $_SESSION['error'] = "Not updated!";   
                    header('location:crm_vendor_view.php');
                  }                  
                }
                ?>              

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_vendor();
                    $sql1 = $result1->get_one_crm_vendor($id);   

                    while($row = mysqli_fetch_array($sql1)){  
                  ?>

                  <h4>Vendor Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Vendor Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead vendor onwer name" name="vendor_owner" value="<?php echo $row['vendor_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Vendor Name</label>
                        <input type="text" class="form-control" placeholder="Enter the lead vendor name" name="vendor_name" value="<?php echo $row['vendor_name']; ?>" required>
                      </div>
                    </div>
                  </div>                  

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" readonly required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                      </div>                      
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Website</label>
                        <input type="url" class="form-control" placeholder="Enter the website" name="website" value="<?php echo $row['website']; ?>" required>
                      </div> 
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>GL Account</label>
                        <select class="form-control" name="gl_account" required>
                          <option value="" selected disabled>-- Select --</option>
                          <option value="Sales-Software" <?php if($row['gl_account']=='Sales-Software'){echo "selected='selected'";} ?>>Sales-Software</option>
                          <option value="Sales-Hardware" <?php if($row['gl_account']=='Sales-Hardware'){echo "selected='selected'";} ?>>Sales-Hardware</option>
                          <option value="Rental Income" <?php if($row['gl_account']=='Rental Income'){echo "selected='selected'";} ?>>Rental Income</option>
                          <option value="Interest Income" <?php if($row['gl_account']=='Interest Income'){echo "selected='selected'";} ?>>Interest Income</option>
                          <option value="Sales Software Support" <?php if($row['gl_account']=='Sales Software Support'){echo "selected='selected'";} ?>>Sales Software Support</option>
                          <option value="Sales Other" <?php if($row['gl_account']=='Sales Other'){echo "selected='selected'";} ?>>Sales Other</option>
                          <option value="Interest Sales" <?php if($row['gl_account']=='Interest Sales'){echo "selected='selected'";} ?>>Interest Sales</option>
                          <option value="Labor Hardware Service" <?php if($row['gl_account']=='Labor Hardware Service'){echo "selected='selected'";} ?>>Labor Hardware Service</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" placeholder="Enter the category" name="category" value="<?php echo $row['category']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                      <textarea class="form-control" rows="4" placeholder="Enter the description" name="description"><?php echo $row['description']; ?></textarea>
                      </div>
                    </div>
                  </div>               

                  <hr>
                  <h4>Address Informations</h4><hr>                     

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Street</label>
                        <input type="text" class="form-control" placeholder="Enter the street name" name="street" value="<?php echo $row['street']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Enter the city name" name="city" value="<?php echo $row['city']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" placeholder="Enter the state name" name="state" value="<?php echo $row['state']; ?>" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the Zip code" name="zip" value="<?php echo $row['zip']; ?>" required>
                      </div> 
                    </div>
                  </div>                 

                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Enter the country name" name="country" value="<?php echo $row['country']; ?>" required>
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
                <h3 class="card-title">Update Contact Details</h3>
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
