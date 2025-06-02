<?php
  $title = "CRM Accounts Add | Zriya Solutions";
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
                <h3 class="card-title">Add New Account</h3>
              </div>

              <div class="card-body"> 

                <?php
                  $result=new DB_crm_account();
                  if(isset($_POST['submit'])){
                    
                    $acc_owner    = $_POST['acc_owner'];
                    $acc_name     = $_POST['acc_name'];
                    $acc_site     = $_POST['acc_site'];
                    $acc_no       = $_POST['acc_no'];
                    $acc_type     = $_POST['acc_type'];
                    $industry     = $_POST['industry'];
                    $revenue      = $_POST['revenue'];
                    $rating       = $_POST['rating'];
                    $email        = $_POST['email'];
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
                                   
                    $sql = $result->insert($acc_owner, $acc_name, $acc_site, $acc_no, $acc_type, $industry, $revenue, $rating, $email, $phone, $website, $ownership, $employees, $sic_code, $description, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_country, $ship_street, $ship_city, $ship_state, $ship_zip, $ship_country, $status);
                    
                    if ($sql) {  
                      $_SESSION['success'] = "New Account added successfully";   
                      header('location:crm_account_view.php');                       

                      $to = 'krishna@zriyasolutions.com'; 
                      $from = 'krishna@zriyasolutions.com'; 
                      $fromName = 'Zriya Solutions'; 
                       
                      $subject = "Zriya - CRM Account"; 
                       
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
                                        Hi! Here the Account details for you.
                                      </th>
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Name</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_name.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Site</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_site.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account No</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_no.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Account Type</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$acc_type.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Industry</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$industry.'</td> 
                                  </tr> 
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Annual Revenue (SEK)</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$revenue.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Rating</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$rating.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email.'</td> 
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
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Ownership</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$ownership.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employees</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$employees.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">SIC Code</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$sic_code.'</td> 
                                  </tr>
                                  <tr> 
                                      <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                      <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                                  </tr>
                                  <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Billing Address</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$bill_street.", ".$bill_city.", ".$bill_state.", ".$bill_zip.", ".$bill_country.'</td> 
                                  </tr>
                                  <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Shipping Address</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$ship_street.", ".$ship_city.", ".$ship_state.", ".$ship_zip.", ".$ship_country.'</td> 
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
                      $_SESSION['error'] = "Account not created";   
                      header('location:crm_account_view.php');                    
                    }                 
                  }
                ?>                          

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Account Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the account owner name" name="acc_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" placeholder="Enter the account name" name="acc_name" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Site</label>
                        <input type="text" class="form-control" placeholder="Enter the account site" name="acc_site" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account No</label>
                        <input type="text" class="form-control" placeholder="Enter the account no" name="acc_no" required>
                      </div> 
                    </div>
                  </div>
                  
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account Type</label>
                        <select class="form-control" name="acc_type" required>
                          <option value="" selected disabled>-- Select Type --</option>
                          <option value="Analyst">Analyst</option>
                          <option value="Competitor">Competitor</option>
                          <option value="Customer">Customer</option>
                          <option value="Distributor">Distributor</option>
                          <option value="Integrator">Integrator</option>
                          <option value="Investor">Investor</option>
                          <option value="Other">Other</option>
                          <option value="Partner">Partner</option>
                          <option value="Press">Press</option>
                          <option value="Prospect">Prospect</option>
                          <option value="Reseller">Reseller</option>
                          <option value="Supplier">Supplier</option>
                          <option value="Vendor">Vendor</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
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

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Annual Revenue (SEK)</label>
                        <input type="number" class="form-control" placeholder="Enter the annual revenue" name="revenue" required>
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Rating</label>
                        <select class="form-control" name="rating" required>
                          <option value="" selected disabled>-- Select Rating --</option>
                          <option value="Acquired">Acquired</option>
                          <option value="Active">Active</option>
                          <option value="Market Failed">Market Failed</option>
                          <option value="Project Cancelled">Project Cancelled</option>
                          <option value="Shut Down">Shut Down</option>
                        </select>
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
                        <label>Website</label>
                        <input type="url" class="form-control" placeholder="Enter the website" name="website" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Ownership</label>
                        <input type="text" class="form-control" placeholder="Enter the ownership" name="ownership" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Employees</label>
                        <input type="text" class="form-control" placeholder="Enter the employees" name="employees" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>SIC Code</label>
                        <input type="text" class="form-control" placeholder="Enter the SIC Code" name="sic_code" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the description" name="description" required></textarea>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <h4>Address Informations</h4><hr>                     

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Billing Street</label>
                        <input type="text" class="form-control" placeholder="Enter the billing street name" name="bill_street" required>
                      </div>
                      <div class="form-group">
                        <label>Billing City</label>
                        <input type="text" class="form-control" placeholder="Enter the billing city name" name="bill_city" required>
                      </div>
                      <div class="form-group">
                        <label>Billing State</label>
                        <input type="text" class="form-control" placeholder="Enter the billing state name" name="bill_state" required>
                      </div>
                      <div class="form-group">
                        <label>Billing Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the billing zip code" name="bill_zip" required>
                      </div>
                      <div class="form-group">
                        <label>Billing Country</label>
                        <input type="text" class="form-control" placeholder="Enter the billing country name" name="bill_country" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Shipping Street</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping street name" name="ship_street" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping City</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping city name" name="ship_city" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping State</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping state name" name="ship_state" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping Zip Code</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping zip code" name="ship_zip" required>
                      </div>
                      <div class="form-group">
                        <label>Shipping Country</label>
                        <input type="text" class="form-control" placeholder="Enter the shipping country name" name="ship_country" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
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
                          <h3 class="card-title">Accounts List</h3>
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