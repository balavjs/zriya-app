<?php 
  ob_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;    
?>
<?php
  $title = "Contract Details | Zriya Solutions";
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
              <li class="breadcrumb-item active"><a href="contrat_view.php">Contract</a></li>
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
      
        if($role == 1 || $role == 5 || $role == 6){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Contract Download</h3>
              </div>           

              <div class="card-body">
                
                <table id="example1" class="table">
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_contract();
                    $sql = $result->get_one_contract($id);   
                                
                    foreach ($sql as $list) { 
                               
                      $name         = $list['name']; 
                      $email        = $list['email']; 
                      $file         = $list['file'];
                      $sign         = $list['sign'];
                      $entry_date   = $list['entry_date'];
                      $update_date  = $list['update_date'];                         
                  
                    require_once __DIR__ . '/vendor/autoload.php';

                    $mpdf = new \Mpdf\Mpdf();

                    // LOAD a stylesheet
                    $stylesheet = file_get_contents('contract-style.css');
                    $mpdf->WriteHTML($stylesheet,1);

                    $html = "";

                    $url = $_SERVER['DOCUMENT_ROOT'].'/employee_portal/zriya_app/uploads/contract/'.$file;

                    $pagecount = $mpdf->setSourceFile($url);
                    
                    for ($i=1; $i<=($pagecount); $i++) {
                      $mpdf->AddPage();
                      $import_page = $mpdf->ImportPage($i);
                      $mpdf->UseTemplate($import_page);
                    } 
                    
                    $mpdf->WriteHTML($html);

                    $mpdf->AddPage();

                    $html2 = "
                      <html>
                        <head>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        </head>

                        <body>
                          <h3><b>Signing Parties</b></h3>
                          <table class='con_table'>                                                         
                            <tr>
                              <td width='50%'>
                                <b>Zriya Solutions</b><br>
                                sales@zriyasolutions.com<br>
                                <img src='https://zriyasolutions.com/employee_portal/zriya_app/dist/img/krishna-sign.png' height='100px'>
                                <i style='color:#726f6f;'>Signed: ".$entry_date." (GMT+0200)</i>
                              </td>
                              <td>
                                <b>".$name."</b><br>
                                ".$email."<br>
                                <img src='https://zriyasolutions.com/employee_portal/zriya_app/uploads/img/".$sign."' height='100px'><br>
                                <i style='color:#726f6f;'>Signed: ".$update_date." (GMT+0200)</i>
                              </td>
                            </tr>  
                          </table>
                          <br>
                          <table class='con_table'>
                            <tr>
                              <td colspan='2'>
                              This verification was issued by Zriya Solutions. Information in italics has been safely verified by Zriya Solutions. For more information/evidence about this document see the concealed attachments. Use a PDF-reader such as Adobe Reader that can show concealed attachments to view the attachments. Please observe that if the document is printed, the integrity of such printed copy cannot be verified as per the below and that a basic print-out lacks the contents of the concealed attachments. The digital signature (electronic seal) ensures that the integrity of this document, including the concealed attachments, can be proven mathematically and independently of Zriya Solutions.  
                              </td>
                            </tr>             
                          </table>         
                        
                        </body>
                      </html>
                    ";
                    
                    $mpdf->WriteHTML($html2);
                    ob_clean();
                    //$mpdf->Output('Contract-'.$name.'.pdf', 'D'); 
                    $content = $mpdf->Output('', 'S');

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {

                        //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'hr@zriyasolutions.com';                //SMTP username
                        $mail->Password   = 'krishnazriya@123#';   
                        $mail->SMTPSecure = 'tls/ssl';                              //SMTP password
                        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        /*
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'contract@zriyasolutions.com';              //SMTP username
                        $mail->Password   = 'krishnazriya@123#';                         //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        */

                        //Recipients
                        $mail->setFrom('hr@zriyasolutions.com', 'Zriya Solutions');
                        //$mail->addAddress($email, $name);     //Add a recipient
                        $mail->addAddress('hr@zriyasolutions.com','Zriya Solutions');

                        
                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                        $mail->addStringAttachment($content,"contract-".$name.".pdf"); 

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Confirmation: e-signed document';
                        $mail->Body    = '
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
                                <p style="font-size:24px;">The document has been signed by <br>'.$name.' and Zriya Solutions.</p>
                                <p>The finalised document is attached.</p>                                
                              </td>
                            </tr>  
                            <tr>
                              <td style="padding:10px; text-align:center;">
                                <p>E-signing powered by <a href="https://zriyasolutions.com">Zriya Solutions</a></p>
                              </td>
                            </tr>                        
                          </table>
                        </body>
                        </html>

                        ';

                        $mail->send();
                          //echo 'Message has been sent';
                            $_SESSION['success'] = "Email sent successfully"; 
                            echo "<script>window.location.href='contract_view.php'</script>";
                        } catch (Exception $e) {
                          //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            $_SESSION['error'] = "'Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   
                            //echo "<script>window.location.href='contract_view.php'</script>";
                        }

                   } 
                  ?>
                </table>
              </div>                
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
                <h3 class="card-title">Contract Details</h3>
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
    <!-- /.content -->
  </div>



<?php include('footer.php'); ?>



