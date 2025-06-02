<?php
  $title = "CRM Contacts Add | Zriya Solutions";
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
                <h3 class="card-title">Add New Contact</h3>
              </div>

              <div class="card-body">
                <?php
                $result=new DB_crm_contact();
                if(isset($_POST['submit'])){
                  
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
                                 
                  $sql = $result->insert($contact_owner, $lead_source, $fname, $lname, $acc_name, $vendor_name, $email, $semail, $phone, $sphone, $title, $department, $description, $street, $city, $state, $zip, $country, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "New Contact added successfully";   
                    header('location:crm_contact_view.php');        

                    $to = 'krishna@zriyasolutions.com'; 
                    $from = 'krishna@zriyasolutions.com'; 
                    $fromName = 'Zriya Solutions'; 
                     
                    $subject = "Zriya - CRM Contact"; 
                     
                    $htmlContent = ' 
                        <html> 
                        <head> 
                            <title>Welcome to Zriya Solutions</title> 
                        </head> 
                        <body> 
                            <table style="border: 1px solid #a6a6a6; width: 500px; border-collapse: collapse;" > 
                                <tr> 
                                    <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                      <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                    </th>
                                </tr>
                                <tr> 
                                    <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                      Hi! Here the Contact details for you.
                                    </th>
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Lead Source</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$lead_source.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname." ".$lname.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_name.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Vendor Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$vendor_name.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email.", ".$semail.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone.", ".$sphone.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Title</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$title.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Department</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$department.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Address</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$street.", ".$city.", ".$state.", ".$zip.", ".$country.'</td> 
                                </tr>                                
                            </table> 
                        </body> 
                        </html>'; 
                     
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    //$headers .= 'Cc:'.$participants . "\r\n";  
                     
                    // Send email 
                    if(mail($to, $subject, $htmlContent, $headers)){ 
                        //echo 'Email has sent successfully.'; 
                    }else{ 
                       //echo 'Email sending failed.'; 
                    }          
                  }
                  else{                    
                    $_SESSION['error'] = "Contact not created";   
                    header('location:crm_contact_view.php');                    
                  } 
                }
                ?>                                           

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Contact Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead contact name" name="contact_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Source</label>
                        <select class="form-control" name="lead_source" required>
                          <option value="" selected disabled>-- Select Lead Source --</option>
                          <option value="Advertisement">Advertisement</option>
                          <option value="Cold Call">Cold Call</option>
                          <option value="Employee Referral">Employee Referral</option>
                          <option value="External Referral">External Referral</option>
                          <option value="Online Store">Online Store</option>
                          <option value="Partner">Partner</option>
                          <option value="Public Relations">Public Relations</option>
                          <option value="Sales Email Alias">Sales Email Alias</option>
                          <option value="Seminar Partner">Seminar Partner</option>
                          <option value="Internal Seminar">Internal Seminar</option>
                          <option value="Trade Show">Trade Show</option>
                          <option value="Web Download">Web Download</option>
                          <option value="Web Research">Web Research</option>
                          <option value="Chat">Chat</option>
                          <option value="Twitter">Twitter</option>
                          <option value="Facebook">Facebook</option>
                        </select>            
                      </div> 
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Enter the first name" name="fname" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="lname" required>
                      </div> 
                    </div>
                  </div>
                  
                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" placeholder="Enter the account name" name="acc_name" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Vendor Name</label>
                        <input type="text" class="form-control" placeholder="Enter the vendor name" name="vendor_name" required>
                      </div> 
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Secondary Email</label>
                        <input type="email" class="form-control" placeholder="Enter the secondary email" name="semail" required>
                      </div>                      
                    </div>
                  </div>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the phone" name="phone" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alternate Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the alternate phone" name="sphone" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Enter the title" name="title" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" placeholder="Enter the department" name="department" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <label>Description</label>
                      <textarea class="form-control" rows="4" placeholder="Enter the description" name="description"></textarea>
                    </div>             
                  </div>

                  <hr>
                  <h4>Address Informations</h4><hr>                     

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Street</label>
                        <input type="text" class="form-control" placeholder="Enter the street name" name="street" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="Enter the city name" name="city" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" placeholder="Enter the state name" name="state" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the Zip code" name="zip" required>
                      </div> 
                    </div>
                  </div>                 

                  <div class="row"> 
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Enter the country name" name="country" required>
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
                          <h3 class="card-title">Contact List</h3>
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