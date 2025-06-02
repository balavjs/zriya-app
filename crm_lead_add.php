<?php
  $title = "CRM Leads Add | Zriya Solutions";
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

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Lead</h3>
              </div>

              <div class="card-body">  
                <?php

                $result=new DB_crm_lead();
                if(isset($_POST['submit'])){
                  
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
                                 
                  $sql = $result->insert($lead_owner, $company, $fname, $lname, $email, $phone, $semail, $website, $title, $description, $lead_source, $lead_status, $industry, $street, $city, $state, $zip, $country, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "New Lead added successfully";   
                    header('location:crm_lead_view.php'); 
                                       
                    $to = 'krishna@zriyasolutions.com'; 
                    $from = 'krishna@zriyasolutions.com'; 
                    $fromName = 'Zriya Solutions'; 
                     
                    $subject = "Zriya - CRM Lead"; 
                     
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
                                      Hi! Here the Lead details for you.
                                    </th>
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Company Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$company.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname." ".$lname.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email.", ".$semail.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Website</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$website.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Lead Source</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$lead_source.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Lead Status</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$lead_status.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Industry</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$industry.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Address</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$street.", ".$city.", ".$state.", ".$zip.", ".$country.'</td> 
                                </tr>                                
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Title</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$title.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
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
                    $_SESSION['error'] = "Lead not created";   
                    header('location:crm_lead_view.php');                     
                  }                    
                }
                ?>                        

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Lead Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead owner name" name="lead_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Enter the company name" name="company" required>
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
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the phone" name="phone" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Secondary Email</label>
                        <input type="email" class="form-control" placeholder="Enter the secondary email" name="semail" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Website</label>
                        <input type="url" class="form-control" placeholder="Enter the website" name="website" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Enter the Title" name="title" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea  rows="3" class="form-control" rows="4" placeholder="Enter the description" name="description" required></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Lead Status</label>
                        <select class="form-control" name="lead_status" required>
                          <option value="" selected disabled>-- Select Lead Status --</option>
                          <option value="Attempted to Contact">Attempted to Contact</option>
                          <option value="Contact in Future">Contact in Future</option>
                          <option value="Contacted">Contacted</option>
                          <option value="Junk Lead">Junk Lead</option>
                          <option value="Lost Lead">Lost Lead</option>
                          <option value="Not Contacted">Not Contacted</option>
                          <option value="Pre-Qualified">Pre-Qualified</option>
                          <option value="Not Qualified">Not Qualified</option>
                        </select>            
                      </div> 
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Industry</label>
                        <select class="form-control" name="industry" required>
                          <option value="" selected disabled>-- Select Industry --</option>
                          <option value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                          <option value="Data/Telecom OEM">Data/Telecom OEM</option>
                          <option value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                          <option value="Government/Military">Government/Military</option>
                          <option value="Large Enterprise">Large Enterprise</option>
                          <option value="ManagementISV">ManagementISV</option>
                          <option value="MSP (Management Service Provider)">MSP (Management Service Provider)</option>
                          <option value="Network Equipment Enterprise">Network Equipment Enterprise</option>
                          <option value="Non-management ISV">Non-management ISV</option>
                          <option value="Optical Networking">Optical Networking</option>
                          <option value="Service Provider">Service Provider</option>
                          <option value="Small/Medium Enterprise">Small/Medium Enterprise</option>
                          <option value="Storage Equipment">Storage Equipment</option>
                          <option value="Storage Service Provider">Storage Service Provider</option>
                          <option value="Systems Integrator">Systems Integrator</option>
                          <option value="Wireless Industry">Wireless Industry</option>
                          <option value="ERP">ERP</option>
                          <option value="Management ISV">Management ISV</option>
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
                          <h3 class="card-title">Lead List</h3>
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