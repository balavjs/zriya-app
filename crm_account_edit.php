<?php
  $title = "CRM Accounts Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_account.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_account_view.php">CRM Accounts</a></li>
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
                <h3 class="card-title">Update Account Details</h3>
              </div> 
              <div class="card-body">               
                <?php
                  $result=new DB_crm_account();

                  if(isset($_POST['update'])){
                    $id = $_GET['id'];                
                    
                    $acc_owner    = $_POST['acc_owner'];
                    $acc_name     = $_POST['acc_name'];
                    $acc_site     = $_POST['acc_site'];
                    $acc_no       = $_POST['acc_no'];
                    $acc_type     = $_POST['acc_type'];
                    $industry     = $_POST['industry'];
                    $revenue      = $_POST['revenue'];
                    $rating       = $_POST['rating'];
                    $phone        = $_POST['phone'];
                    $website      = $_POST['website'];
                    $ownership    = $_POST['ownership'];
                    $employees    = $_POST['employees'];
                    $sic_code     = $_POST['sic_code'];
                    $description  = $_POST['description'];
                    $bill_street  = $_POST['bill_street'];
                    $bill_city    = $_POST['bill_city'];
                    $bill_state   = $_POST['bill_state'];
                    $bill_zip     = $_POST['bill_zip'];
                    $bill_country = $_POST['bill_country'];
                    $ship_street  = $_POST['ship_street'];
                    $ship_city    = $_POST['ship_city'];
                    $ship_state   = $_POST['ship_state'];
                    $ship_zip     = $_POST['ship_zip'];
                    $ship_country = $_POST['ship_country'];
                    $status       = $_POST['status'];
                    
                    $sql = $result->update($id, $acc_owner, $acc_name, $acc_site, $acc_no, $acc_type, $industry, $revenue, $rating, $phone, $website, $ownership, $employees, $sic_code, $description, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_country, $ship_street, $ship_city, $ship_state, $ship_zip, $ship_country, $status);
                    
                    if($sql) {  
                      $_SESSION['success'] = "Updated successfully!";   
                      header('location:crm_account_view.php');                  
                    }
                    else{                    
                      $_SESSION['error'] = "Not updated!";   
                      header('location:crm_account_view.php');                    
                    }                    
                  }
                ?>             

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_account();
                    $sql1 = $result1->get_one_crm_account($id);   

                    while($row = mysqli_fetch_array($sql1)){   
                  ?>
                  <h4>Account Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the account owner name" name="acc_owner" value="<?php echo $row['acc_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" placeholder="Enter the account name" name="acc_name" value="<?php echo $row['acc_name']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Site</label>
                        <input type="text" class="form-control" placeholder="Enter the account site" name="acc_site" value="<?php echo $row['acc_site']; ?>" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account No</label>
                        <input type="text" class="form-control" placeholder="Enter the account no" name="acc_no" value="<?php echo $row['acc_no']; ?>" required>
                      </div> 
                    </div>
                  </div>
                  
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Type</label>
                        <select class="form-control" name="acc_type" required>
                          <option value="" selected disabled>-- Select Type --</option>
                          <option value="Analyst" <?php if($row['acc_type']=='Analyst'){echo "selected='selected'";} ?>>Analyst</option>
                          <option value="Competitor" <?php if($row['acc_type']=='Competitor'){echo "selected='selected'";} ?>>Competitor</option>
                          <option value="Customer" <?php if($row['acc_type']=='Customer'){echo "selected='selected'";} ?>>Customer</option>
                          <option value="Distributor" <?php if($row['acc_type']=='Distributor'){echo "selected='selected'";} ?>>Distributor</option>
                          <option value="Integrator" <?php if($row['acc_type']=='Integrator'){echo "selected='selected'";} ?>>Integrator</option>
                          <option value="Investor" <?php if($row['acc_type']=='Investor'){echo "selected='selected'";} ?>>Investor</option>
                          <option value="Other" <?php if($row['acc_type']=='Other'){echo "selected='selected'";} ?>>Other</option>
                          <option value="Partner" <?php if($row['acc_type']=='Partner'){echo "selected='selected'";} ?>>Partner</option>
                          <option value="Press" <?php if($row['acc_type']=='Press'){echo "selected='selected'";} ?>>Press</option>
                          <option value="Prospect" <?php if($row['acc_type']=='Prospect'){echo "selected='selected'";} ?>>Prospect</option>
                          <option value="Reseller" <?php if($row['acc_type']=='Reseller'){echo "selected='selected'";} ?>>Reseller</option>
                          <option value="Supplier" <?php if($row['acc_type']=='Supplier'){echo "selected='selected'";} ?>>Supplier</option>
                          <option value="Vendor" <?php if($row['acc_type']=='Vendor'){echo "selected='selected'";} ?>>Vendor</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Industry</label>
                          <select class="form-control" name="industry" required>
                            <option value="" selected disabled>-- Select Industry --</option>
                            <option value="ASP (Application Service Provider)" <?php if($row['industry']=='ASP (Application Service Provider)'){echo "selected='selected'";} ?>>ASP (Application Service Provider)</option>
                            <option value="Data/Telecom OEM" <?php if($row['industry']=='Data/Telecom OEM'){echo "selected='selected'";} ?>>Data/Telecom OEM</option>
                            <option value="ERP (Enterprise Resource Planning)" <?php if($row['industry']=='ERP (Enterprise Resource Planning)'){echo "selected='selected'";} ?>>ERP (Enterprise Resource Planning)</option>
                            <option value="Government/Military" <?php if($row['industry']=='Government/Military'){echo "selected='selected'";} ?>>Government/Military</option>
                            <option value="Large Enterprise" <?php if($row['industry']=='Large Enterprise'){echo "selected='selected'";} ?>>Large Enterprise</option>
                            <option value="ManagementISV" <?php if($row['industry']=='ManagementISV'){echo "selected='selected'";} ?>>ManagementISV</option>
                            <option value="MSP (Management Service Provider)" <?php if($row['industry']=='MSP (Management Service Provider)'){echo "selected='selected'";} ?>>MSP (Management Service Provider)</option>
                            <option value="Network Equipment Enterprise" <?php if($row['industry']=='Network Equipment Enterprise'){echo "selected='selected'";} ?>>Network Equipment Enterprise</option>
                            <option value="Non-management ISV" <?php if($row['industry']=='Non-management ISV'){echo "selected='selected'";} ?>>Non-management ISV</option>
                            <option value="Optical Networking" <?php if($row['industry']=='Optical Networking'){echo "selected='selected'";} ?>>Optical Networking</option>
                            <option value="Service Provider" <?php if($row['industry']=='Service Provider'){echo "selected='selected'";} ?>>Service Provider</option>
                            <option value="Small/Medium Enterprise" <?php if($row['industry']=='Small/Medium Enterprise'){echo "selected='selected'";} ?>>Small/Medium Enterprise</option>
                            <option value="Storage Equipment" <?php if($row['industry']=='Storage Equipment'){echo "selected='selected'";} ?>>Storage Equipment</option>
                            <option value="Storage Service Provider" <?php if($row['industry']=='Storage Service Provider'){echo "selected='selected'";} ?>>Storage Service Provider</option>
                            <option value="Systems Integrator" <?php if($row['industry']=='Systems Integrator'){echo "selected='selected'";} ?>>Systems Integrator</option>
                            <option value="Wireless Industry" <?php if($row['industry']=='Wireless Industry'){echo "selected='selected'";} ?>>Wireless Industry</option>
                            <option value="ERP" <?php if($row['industry']=='ERP'){echo "selected='selected'";} ?>>ERP</option>
                            <option value="Management ISV" <?php if($row['industry']=='Management ISV'){echo "selected='selected'";} ?>>Management ISV</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Annual Revenue (SEK)</label>
                        <input type="number" class="form-control" placeholder="Enter the annual revenue" name="revenue" value="<?php echo $row['revenue']; ?>" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Rating</label>
                        <select class="form-control" name="rating" required>
                          <option value="" selected disabled>-- Select Rating --</option>
                          <option value="Acquired" <?php if($row['rating']=='Acquired'){echo "selected='selected'";} ?>>Acquired</option>
                          <option value="Active" <?php if($row['rating']=='Active'){echo "selected='selected'";} ?>>Active</option>
                          <option value="Market Failed" <?php if($row['rating']=='Market Failed'){echo "selected='selected'";} ?>>Market Failed</option>
                          <option value="Project Cancelled" <?php if($row['rating']=='Project Cancelled'){echo "selected='selected'";} ?>>Project Cancelled</option>
                          <option value="Shut Down" <?php if($row['rating']=='Shut Down'){echo "selected='selected'";} ?>>Shut Down</option>
                        </select>
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
                        <label>Ownership</label>
                        <input type="text" class="form-control" placeholder="Enter the ownership" name="ownership" value="<?php echo $row['ownership']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Employees</label>
                        <input type="text" class="form-control" placeholder="Enter the employees" name="employees" value="<?php echo $row['employees']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>SIC Code</label>
                        <input type="text" class="form-control" placeholder="Enter the SIC Code" name="sic_code" value="<?php echo $row['sic_code']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the description" name="description" required><?php echo $row['description']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <h4>Address Informations</h4><hr>                     

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Billing Street</label>
                        <input type="text" class="form-control" placeholder="Enter the billing street name" name="bill_street" value="<?php echo $row['bill_street']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Billing City</label>
                        <input type="text" class="form-control" placeholder="Enter the billing city name" name="bill_city" value="<?php echo $row['bill_city']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Billing State</label>
                        <input type="text" class="form-control" placeholder="Enter the billing state name" name="bill_state" value="<?php echo $row['bill_state']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Billing Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the billing zip code" name="bill_zip" value="<?php echo $row['bill_zip']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Billing Country</label>
                        <input type="text" class="form-control" placeholder="Enter the billing country name" name="bill_country" value="<?php echo $row['bill_country']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Shipping Street</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping street name" name="ship_street" value="<?php echo $row['ship_street']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping City</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping city name" name="ship_city" value="<?php echo $row['ship_city']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping State</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping state name" name="ship_state" value="<?php echo $row['ship_state']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping zip code" name="ship_zip" value="<?php echo $row['ship_zip']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping Country</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping country name" name="ship_country" value="<?php echo $row['ship_country']; ?>" required>
                      </div>
                    </div>
                  </div>                       

                  <div class="row">                                      
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
                <h3 class="card-title">Update Account Details</h3>
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
