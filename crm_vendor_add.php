<?php
  $title = "CRM Vendors Add | Zriya Solutions";
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

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Vendor</h3>
              </div>

              <div class="card-body">

                <?php

                $result=new DB_crm_vendor();
                if(isset($_POST['submit'])){
                  
                  $vendor_owner   = $_POST['vendor_owner'];
                  $vendor_name    = $_POST['vendor_name'];
                  $email          = $_POST['email'];
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
                                 
                  $sql = $result->insert($vendor_owner, $vendor_name, $email, $phone, $website, $gl_account, $category, $description, $street, $city, $state, $zip, $country, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "New Vendor added successfully";   
                    header('location:crm_vendor_view.php'); 

                    $to = 'krishna@zriyasolutions.com'; 
                    $from = 'krishna@zriyasolutions.com'; 
                    $fromName = 'Zriya Solutions'; 
                     
                    $subject = "Zriya - CRM Vendor"; 
                     
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
                                      Hi! Here the Vendor details for you.
                                    </th>
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Vendor Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$vendor_name.'</td> 
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
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">GL Account</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$gl_account.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Address</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$street.", ".$city.", ".$state.", ".$zip.", ".$country.'</td> 
                                </tr>                                
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Category</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$category.'</td> 
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
                    $_SESSION['error'] = "Deal not created";   
                    header('location:crm_vendor_view.php');                     
                  }                  
                }
               ?>                         

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Vendor Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Vendor Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the vendor owner name" name="vendor_owner" required>
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
                        <label>GL Account</label>
                        <select class="form-control" name="gl_account" required>
                          <option value="" selected disabled>-- Select --</option>
                          <option value="Sales-Software">Sales-Software</option>
                          <option value="Sales-Hardware">Sales-Hardware</option>
                          <option value="Rental Income">Rental Income</option>
                          <option value="Interest Income">Interest Income</option>
                          <option value="Sales Software Support">Sales Software Support</option>
                          <option value="Sales Other">Sales Other</option>
                          <option value="Interest Sales">Interest Sales</option>
                          <option value="Labor Hardware Service">Labor Hardware Service</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" placeholder="Enter the category" name="category" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the description" name="description"></textarea>
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
                          <h3 class="card-title">Vendor List</h3>
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