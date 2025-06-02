<?php
  $title = "CRM Leads Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_lead.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lead</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_lead_view.php">CRM Lead</a></li>
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

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Update Lead Details</h3>
              </div>          

              <div class="card-body">              

                <?php
                  $result=new DB_crm_lead();

                  if(isset($_POST['update'])){
                    $id = $_GET['id'];                
                    
                    $lead_owner   = $_POST['lead_owner'];
                    $company      = $_POST['company'];
                    $fname        = $_POST['fname'];
                    $lname        = $_POST['lname'];
                    $email        = $_POST['email'];
                    $phone        = $_POST['phone'];
                    $semail       = $_POST['semail'];
                    $website      = $_POST['website'];
                    $title        = $_POST['title'];
                    $description  = $_POST['description'];
                    $lead_source  = $_POST['lead_source'];
                    $lead_status  = $_POST['lead_status'];
                    $industry     = $_POST['industry'];
                    $street       = $_POST['street'];
                    $city         = $_POST['city'];
                    $state        = $_POST['state'];
                    $zip          = $_POST['zip'];
                    $country      = $_POST['country'];
                    $status       = $_POST['status'];
                    
                    $sql = $result->update($id, $lead_owner, $company, $fname, $lname, $email, $phone, $semail, $website, $title, $description, $lead_source, $lead_status, $industry, $street, $city, $state, $zip, $country, $status);
                    
                    if ($sql) {  
                      $_SESSION['success'] = "Updated successfully!";   
                      header('location:crm_lead_view.php');                  
                    }
                    else{
                      $_SESSION['error'] = "Not updated!";   
                      header('location:crm_lead_view.php');
                    }                    
                  }
                ?>                                 

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_lead();
                    $sql1 = $result1->get_one_crm_lead($id);   

                    while($row = mysqli_fetch_array($sql1)){ 
                  ?>

                  <h4>Lead Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead owner name" name="lead_owner" value="<?php echo $row['lead_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Enter the company name" name="company" value="<?php echo $row['company']; ?>" required>
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
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" required>
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
                        <label>Secondary Email</label>
                        <input type="email" class="form-control" placeholder="Enter the secondary email" name="semail" value="<?php echo $row['semail']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Website</label>
                        <input type="url" class="form-control" placeholder="Enter the website" name="website" value="<?php echo $row['website']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Enter the Title" name="title" value="<?php echo $row['title']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea  rows="3" class="form-control" rows="4" placeholder="Enter the description" name="description" required><?php echo $row['description']; ?></textarea>
                      </div>
                    </div>
                  </div>                 
                  
                  <div class="row">                    
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Lead Status</label>
                        <select class="form-control" name="lead_status" required>
                          <option value="" selected disabled>-- Select Lead Status --</option>
                          <option value="Attempted to Contact" <?php if($row['lead_status']=='Attempted to Contact'){echo "selected='selected'";} ?>>Attempted to Contact</option>
                          <option value="Contact in Future" <?php if($row['lead_status']=='Contact in Future'){echo "selected='selected'";} ?>>Contact in Future</option>
                          <option value="Contacted" <?php if($row['lead_status']=='Contacted'){echo "selected='selected'";} ?>>Contacted</option>
                          <option value="Junk Lead" <?php if($row['lead_status']=='Junk Lead'){echo "selected='selected'";} ?>>Junk Lead</option>
                          <option value="Lost Lead" <?php if($row['lead_status']=='Lost Lead'){echo "selected='selected'";} ?>>Lost Lead</option>
                          <option value="Not Contacted" <?php if($row['lead_status']=='Not Contacted'){echo "selected='selected'";} ?>>Not Contacted</option>
                          <option value="Pre-Qualified" <?php if($row['lead_status']=='Pre-Qualified'){echo "selected='selected'";} ?>>Pre-Qualified</option>
                          <option value="Not Qualified" <?php if($row['lead_status']=='Not Qualified'){echo "selected='selected'";} ?>>Not Qualified</option>
                        </select>            
                      </div> 
                    </div>
                    <div class="col-sm-4">
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
                <h3 class="card-title">Update Lead Details</h3>
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
