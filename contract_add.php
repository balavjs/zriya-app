<?php
  $title = "Contract Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_contract.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contract</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="contrat_view.php">Contract</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  	<!-- Main content -->
  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Contract</h3>
              </div> 

              <div class="card-body">  

                <?php 
 
                  $result_usr = new User();                    
                  $sql_usr = $result_usr->getonerecord($id);

                  foreach ($sql_usr as $list_data) {  
                    $id = $list_data['id'];                  
                    $name1 = $list_data['fullname'];
                    $role = $list_data['role'];

                  if($role == 1 || $role == 5 || $role == 6){ 
                ?>                

                <?php

                  $result = new DB_contract();
                  if(isset($_POST['submit'])){

                    define ('SITE_ROOT', realpath(dirname(__FILE__)));

                    $name        = $_POST['name'];
                    $email       = $_POST['email'];

                    $n=15;
                    function getName($n) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                      
                        for ($i = 0; $i < $n; $i++) {
                            $index = rand(0, strlen($characters) - 1);
                            $randomString .= $characters[$index];
                        }
                      
                        return $randomString;
                    }
                      
                    $token = getName($n);

                    date_default_timezone_set('Europe/Stockholm');
                    $entry_date = date('Y-m-d h:i:s');
                    //echo $date;  
                    
                    $file  ="contract".time().$_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], SITE_ROOT."/uploads/contract/".$file); 
                                   
                    $sql = $result->insert($token, $name, $email, $file, $entry_date);
                    if ($sql) {                          
                      $_SESSION['success'] = "New contract added successfully";   
                      header('location:contract_view.php');   
                ?>

                  <?php
                      // multiple recipients
                      $to  = $_POST['email'];

                      // subject
                      $subject = 'Document to e-sign';

                      // message
                      $message = '
                      <html>
                      <head>
                        <title>Document to e-sign</title>
                      </head>
                      <body>                        
                        <table style="border: 1px solid #a6a6a6; width: 550px; border-collapse: collapse;">
                          <tr> 
                            <th style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                              <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                            </th>
                          </tr>
                          <tr>
                            <td style="padding:10px; text-align:center;">
                              <p style="font-size:24px;"><b>Zriya Solutions</b> has invited you to<br> e-sign the document</p>
                              <p>Click the button for further instructions</p>
                              <p>
                                <a href="https://zriyasolutions.com/employee_portal/contract-accept/?token='.$token.'"><button style="background-color:#17353d; color:#fff; padding:10px 20px; border-radious:4px; cursor:pointer;">Go to Document</button>
                                </a>
                              </p>
                            </td>
                          </tr>  
                          <tr>
                            <td style="padding:10px;">
                              This email contains confidential information and should not be forwarded. Disclosure, copying, distribution or other processing of the information contained in this message is prohibited and may be unlawful. If you have received this in error please notify the sender and delete immediately.
                            </td>
                          </tr>                        
                        </table>
                      </body>
                      </html>
                      ';

                      // To send HTML mail, the Content-type header must be set
                      $headers  = 'MIME-Version: 1.0' . "\r\n";
                      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                      // Additional headers                      
                      $headers .= 'From: Zriya Solutions <hr@zriyasolutions.com>' . "\r\n";

                      // Mail it
                      if(mail($to, $subject, $message, $headers)){
                        //echo "Email Sent Successfully";
                      }
                ?>

                <?php
                }
                else{
                  $_SESSION['error'] = "Contract not created";   
                  header('location:contract_view.php');                
                  }
                }
                ?>                                          

                <?php
                  
                ?>
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="formFile" class="form-label">Upload File (.pdf)</label>
                        <input class="form-control-file" type="file" id="contractFile" name="file" accept="application/pdf" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit">Add & Sign</button>
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
                      <div class="alert alert-danger" role="alert">
                        <strong>Oops!</strong> You don't have access to view this page.
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

<script type="text/javascript">
  $('#contractFile').change(function () {
    var fileExtension = ['pdf'];
    if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
      alert("Only .pdf format is allowed.");
      $('#contractFile').val('');            
    }
  });
</script>