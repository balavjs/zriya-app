<?php
  $title = "CRM Contacts Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_contact.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_contact_view.php">CRM Contact</a></li>
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
                <h3 class="card-title">Update Contact Details</h3>
              </div> 

              <div class="card-body"> 

                <?php
                  $result=new DB_crm_contact();

                  if(isset($_POST['update'])){
                    $id = $_GET['id'];                
                    
                    $contact_owner  = $_POST['contact_owner'];
                    $lead_source    = $_POST['lead_source'];
                    $fname          = $_POST['fname'];
                    $lname          = $_POST['lname'];
                    $acc_name       = $_POST['acc_name'];
                    $vendor_name    = $_POST['vendor_name'];
                    $email          = $_POST['email'];
                    $semail         = $_POST['semail'];
                    $phone          = $_POST['phone'];
                    $sphone         = $_POST['sphone'];
                    $title          = $_POST['title'];
                    $department     = $_POST['department'];
                    $description    = $_POST['description'];                
                    $street         = $_POST['street'];
                    $city           = $_POST['city'];
                    $state          = $_POST['state'];
                    $zip            = $_POST['zip'];
                    $country        = $_POST['country'];
                    $status         = $_POST['status'];     
                    
                    $sql = $result->update($id, $contact_owner, $lead_source, $fname, $lname, $acc_name, $vendor_name, $email, $semail, $phone, $sphone, $title, $department, $description, $street, $city, $state, $zip, $country, $status);
                    
                    if($sql) {  
                      $_SESSION['success'] = "Updated successfully!";   
                      header('location:crm_contact_view.php');                  
                    }
                    else{                    
                      $_SESSION['error'] = "Not updated!";   
                      header('location:crm_contact_view.php');                    
                    }  
                  }
                ?>              

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_contact();
                    $sql1 = $result1->get_one_crm_contact($id);   

                    while($row = mysqli_fetch_array($sql1)){
                  ?>
                  <h4>Contact Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead contact name" name="contact_owner" value="<?php echo $row['contact_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Source</label>
                        <select class="form-control" name="lead_source" required>
                          <option value="" selected disabled>-- Select Lead Source --</option>
                          <option value="Advertisement" <?php if($row['lead_source']=='Advertisement'){echo "selected='selected'";} ?>>Advertisement</option>
                          <option value="Cold Call" <?php if($row['lead_source']=='Cold Call'){echo "selected='selected'";} ?>>Cold Call</option>
                          <option value="Employee Referral" <?php if($row['lead_source']=='Employee Referral'){echo "selected='selected'";} ?>>Employee Referral</option>
                          <option value="External Referral" <?php if($row['lead_source']=='External Referral'){echo "selected='selected'";} ?>>External Referral</option>
                          <option value="Online Store" <?php if($row['lead_source']=='Online Store'){echo "selected='selected'";} ?>>Online Store</option>
                          <option value="Partner" <?php if($row['lead_source']=='Partner'){echo "selected='selected'";} ?>>Partner</option>
                          <option value="Public Relations" <?php if($row['Public Relations']=='Contacted'){echo "selected='selected'";} ?>>Public Relations</option>
                          <option value="Sales Email Alias" <?php if($row['lead_source']=='Sales Email Alias'){echo "selected='selected'";} ?>>Sales Email Alias</option>
                          <option value="Seminar Partner" <?php if($row['lead_source']=='Seminar Partner'){echo "selected='selected'";} ?>>Seminar Partner</option>
                          <option value="Internal Seminar" <?php if($row['lead_source']=='Internal Seminar'){echo "selected='selected'";} ?>>Internal Seminar</option>
                          <option value="Trade Show" <?php if($row['lead_source']=='Trade Show'){echo "selected='selected'";} ?>>Trade Show</option>
                          <option value="Web Download" <?php if($row['lead_source']=='Web Download'){echo "selected='selected'";} ?>>Web Download</option>
                          <option value="Web Research" <?php if($row['lead_source']=='Web Research'){echo "selected='selected'";} ?>>Web Research</option>
                          <option value="Chat" <?php if($row['lead_source']=='Chat'){echo "selected='selected'";} ?>>Chat</option>
                          <option value="Twitter" <?php if($row['lead_source']=='Twitter'){echo "selected='selected'";} ?>>Twitter</option>
                          <option value="Facebook" <?php if($row['lead_source']=='Facebook'){echo "selected='selected'";} ?>>Facebook</option>
                        </select>            
                      </div> 
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Enter the first name" name="fname" value="<?php echo $row['fname']; ?>" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="lname" value="<?php echo $row['lname']; ?>" required>
                      </div> 
                    </div>
                  </div>
                  
                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" placeholder="Enter the account name" name="acc_name" value="<?php echo $row['acc_name']; ?>" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Vendor Name</label>
                        <input type="text" class="form-control" placeholder="Enter the vendor name" name="vendor_name" value="<?php echo $row['vendor_name']; ?>" required>
                      </div> 
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Secondary Email</label>
                        <input type="email" class="form-control" placeholder="Enter the secondary email" name="semail" value="<?php echo $row['semail']; ?>" required>
                      </div>                      
                    </div>
                  </div>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alternate Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the alternate phone" name="sphone" value="<?php echo $row['sphone']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Enter the title" name="title" value="<?php echo $row['title']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" placeholder="Enter the department" name="department" value="<?php echo $row['department']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <label>Description</label>
                      <textarea class="form-control" rows="4" placeholder="Enter the description" name="description"><?php echo $row['description']; ?></textarea>
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
