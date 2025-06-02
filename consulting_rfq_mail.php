<?php
  $title = "Consulting RFQ Mail | Zriya Solutions";
  ob_start();
?>

<?php
  ob_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  include('header.php'); 
  include('class/class_consulting_rfq.php'); 


  require_once __DIR__ . '/vendor/autoload.php';

  if(isset($_POST['submit'])){

    $id         = $_GET['id']; 

    $result = new DB_consulting_rfq();
    $sql = $result->get_one_consulting_rfq($id);   
                 
    foreach ($sql as $list) { 
      $rfq_no       = $list['rfq_no'];                      
      $date         = $list['date'];
      $date1        = date('Y-m-d', strtotime($date));
      $ddate        = date('Y-m-d', strtotime($date. ' + 10 days'));
      $signed       = $list['signed'];
      $name         = $list['name'];
      $description  = $list['description'];
    }
    

    // a new instance of the library

    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf([
      'orientation' => 'P',
      'default_font' => 'Lato-Regular']
    );

    //$mpdf->SetCreator(PDF_CREATOR);
    $mpdf->SetAuthor('Zriya');
    $mpdf->SetTitle('Zriya Solutions');
    $mpdf->SetSubject('Zriya Solutions');
    //$mpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $mpdf->autoScriptToLang = true;
    $mpdf->baseScript = 1;  
    $mpdf->autoLangToFont = true;
    //$mpdf->shrink_tables_to_fit = 0;
    //$mpdf->autoPageBreak = true;

    // LOAD a stylesheet
    $stylesheet = file_get_contents('pdf-style.css');

    $mpdf->WriteHTML($stylesheet,1);

    $data = "";

    $data .= "
              <html>
              <head>
              <meta name='viewport' content='width=device-width, initial-scale=1'>
              </head

              <body>
              <div class='container pdf_container'>
                <div class='row pdf_row'>
                  <div class='col-md-6' style='border-right:1px solid #b0b0b0; margin-left:-1px; text-align:center;' >
                  <div style='padding:10px;'>
                    <img src='https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png'><br>
                    <span>Organisation No: 559361-1030<br>
                      MOMS Nummer: SE559361103001</span>
                    </div>
                  </div>
                  <div class='col-md-6 column2'>
                    <div class='row'>
                      <div class='col-md-12' style='border-bottom:1px solid #b0b0b0; padding:20px 10px;'><b>RFQ No:</b> ".$rfq_no."</div>
                      <div class='col-md-12' style='border-bottom:1px solid #b0b0b0;padding:20px 10px;'><b>Date:</b> ".$date1."</div>
                      <div class='col-md-12' style='padding:20px 10px;'><b>Signed Off:</b> ".$signed."</div>                  
                    </div>
                  </div>
                </div>

                <hr style='margin-top:-0px;'>

                <div class='row'>
                  <div class='col-md-12'>
                    <h3>REQUEST FOR QUOTATION</h3>
                  </div>
                </div>

                <div class='row'>
                  <div class='col-md-12'>
                    <p><b>To:</b><br> Whom it may concern,</p>
                    <p>Dear <b>Mr/Mrs. ".$name.",</b><br>
                    Through this RFQ, Zriya Digital Solutions requests to kindly provide your best candidates that fulfill the requirements described below considering the deadline of <b>".$ddate."</b>
                    <br>
                      <h5><b>Description:</b></h5>
                      ".$description."
                    </p>
                    <p>
                      Thank you <br>
                      Best Regards <br>
                      <img src='https://zriyasolutions.com/employee_portal/zriya_app/dist/img/krishna-sign.png'><br>
                      Krishna Radhakrishnan<br> 
                      Sales Director<br> 
                      Zriya Solutions<br>
                    </p>
                  </div>
                </div>
                </div>
              
              </body>
              </html>
              ";


    $mpdf->WriteHtml($data);
    ob_clean();
    //$mpdf->Output($rfq_no.'.pdf', 'D');

    //$mpdf->Output();
    $content = $mpdf->Output('', 'S');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'invoice@zriyasolutions.com';           //SMTP username
    $mail->Password   = 'krishnazriya@123#';   
    $mail->SMTPSecure = 'tls/ssl';                              //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption
    $mail->Port       = 587; 

  /*
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sales@zriyasolutions.com';              //SMTP username
    $mail->Password   = 'Krishna@123#';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
*/
    //Recipients
    $mail->setFrom('invoice@zriyasolutions.com', 'Zriya Solutions');
    $mail->addAddress($_POST['email'], $_POST['name']);     //Add a recipient

    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $mail->addStringAttachment($content,$rfq_no.".pdf"); 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Quotation Letter';
    $mail->Body    = 'Hi '.$_POST['name'].',<br> Here the Quotation Letter ('.$rfq_no.') for your reference.<br><br>
                      Thank you <br>
                      Best Regards <br>                    
                      Zriya Solutions<br>';

    $mail->send();
      //echo 'Message has been sent';
      $_SESSION['success'] = "Email sent successfully";   
      header('location:consulting_rfq_view.php');
        //echo "<script>alert('Email sent successfully');</script>";
        //echo "<script>window.location.href='consulting_rfq_view.php'</script>";
    } catch (Exception $e) {
      //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      $_SESSION['error'] = "'Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   
      header('location:consulting_rfq_view.php');
        //echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        //echo "<script>window.location.href='consulting_rfq_view.php'</script>";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consulting RFQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="consulting_rfq_view.php">Consulting RFQ</a></li>
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

	 
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Consulting RFQ Mail</h3>
              </div>
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" required>
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
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit">Submit</button>
                      </div>
                    </div>                    
                  </div> 
                </form>
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
                <h3 class="card-title">Consulting RFQ Mail</h3>
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
