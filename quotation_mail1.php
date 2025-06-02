<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['submit'])) {

  // PDF
  require_once __DIR__ . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf();
  
  $mpdf->WriteHTML('Hello World');
  //$content = $mpdf->Output('Quote.pdf', 'D');
  $content = $mpdf->Output('', 'S');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bala@zriyasolutions.com';              //SMTP username
    $mail->Password   = 'Krishna@123#';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bala@zriyasolutions.com', 'Zriya Solutions');
    $mail->addAddress($_POST['email'], $_POST['name']);     //Add a recipient

    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $mail->addStringAttachment($content,"Quotation Letter.pdf"); 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Quotation Letter';
    $mail->Body    = 'Hi '.$_POST['name'].',<br> Here the Quotation letter for your reference.';

    $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


<?php
  $title = "Quotation Mail | Zriya Solutions";
?>
<?php include('header.php'); ?>
<?php include('class/class_quotation.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="quotation_view.php">Quotations</a></li>
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

      if($role == 1){ 
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zriya">
                <h3 class="card-title">Quotation Details</h3>
              </div>              

                <div class="card-body">                  
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="name" class="form-control"  placeholder="Name" required="">
                        </div>
                        <div class="form-group">
                          <input type="email" name="email" class="form-control" placeholder="Email address" required="">
                        </div>                    
                        <div class="submit">
                          <input type="submit" name="submit" class="btn btn-success" value="Send Mail">
                        </div>
                      </div>
                    </div>
                  </form>            
                
                 <?php
                  }
                  else{
                    ?>
                    <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">             

                          <div class="card">
                            <div class="card-header card-zriya">
                              <h3 class="card-title">Quotation List</h3>
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

