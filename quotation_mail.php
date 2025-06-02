<?php
  $title = "Quotation Mail | Zriya Solutions";
?>

<?php

ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('header.php'); 
include('class/class_quotation.php'); 

require_once __DIR__ . '/vendor/autoload.php';


if(isset($_POST['submit'])) {

    //include 'class/class_quotation.php';

    $id           = $_GET['id']; 

    $result = new DB_quotation();
    $sql = $result->get_one_quotation($id);   
                 
    foreach ($sql as $list) { 
      $quote_no = $list['quote_no'];
      $date         = $list['date'];
      $date1        = date('Y-m-d', strtotime($date));
      $signed       = $list['signed'];
      $name         = $list['name'];
      $email        = $list['email'];
      $phone        = $list['phone'];
      $address      = $list['address'];
      $inscope      = $list['inscope'];
      $outscope     = $list['outscope'];
      $addendums    = $list['addendums'];
      $payment      = $list['payment'];  
    }
    
  // PDF
  require_once __DIR__ . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf();

  $mpdf = new \Mpdf\Mpdf([
    'orientation' => 'P',
    'default_font' => 'Lato-Regular']
  );

  $mpdf->SetCreator(PDF_CREATOR);
    $mpdf->SetAuthor('Zriya');
    $mpdf->SetTitle('Zriya Solutions');
    $mpdf->SetSubject('Zriya Solutions');
    //$mpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $mpdf->autoScriptToLang = true;
    $mpdf->baseScript = 1;  
    $mpdf->autoLangToFont = true;

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
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0; padding:20px 10px;'><b>Quote No:</b> ".$quote_no."</div>
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0;padding:20px 10px;'><b>Date:</b> ".$date1."</div>
                    <div class='col-md-12' style='padding:20px 10px;'><b>Signed Off:</b> ".$signed."</div>                  
                  </div>
                </div>
              </div>

              <hr style='margin-top:-0px;'>

              <div class='row'>
                <div class='col-md-12'>
                  <h3>QUOTATION LETTER</h3>
                </div>
              </div>

              <div class='row'>
                <div class='col-md-12'>
                  <p><b>To:</b><br> Mr/Mrs. ".$name.".<br>
                  ".$address.".<br>
                  Email: ".$email.".<br>
                  Phone: ".$phone.".<br>
                  
                    <h5><b>In Scope:</b></h5>
                    ".$inscope."
                    <h5><b>Out of Scope:</b></h5>
                    ".$outscope."
                    <h5><b>Expected Addendums:</b></h5>
                    ".$addendums."
                    <h5><b>Payment method:</b></h5>
                    ".$payment."
                  </p>
                  ";
      $data .= "  <h5><b>Pricing</b></h5>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                      <tr>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>S.No</th>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>Product description</th>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>Price (excl. MOMS)</th>
                      </tr>
                      <tbody>
                      ";                                  
                        
                        $sql1 = $result->list_quote_price($id);   
                        $i=0;             
                        foreach ($sql1 as $list1) { 
                          $i++;   
                          $price = $list1['price'];                           
      $data .= "
                        <tr>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$i."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$list1['product_desc']."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($price, 2, ',', ' ')."</td>
                        </tr>                                
                        ";
                        }                                                
      $data .= "                       
                      </tbody>
                    </table>

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
  
  //$mpdf->WriteHTML('Hello World'.$quote_no);
  //$content = $mpdf->Output('Quote.pdf', 'D');
    ob_clean();
  $content = $mpdf->Output('', 'S');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'invoice@zriyasolutions.com';                //SMTP username
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
    $mail->addStringAttachment($content,$quote_no.".pdf"); 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Quotation Letter';
    $mail->Body    = 'Hi '.$_POST['name'].',<br> Here the Quotation Letter ('.$quote_no.') for your reference.<br><br>
                      Thank you <br>
                      Best Regards <br>                    
                      Zriya Solutions<br>';

    $mail->send();
      //echo 'Message has been sent';
      $_SESSION['success'] = "Email sent successfully"; 
      echo "<script>window.location.href='quotation_view.php'</script>";
    } catch (Exception $e) {
      //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      $_SESSION['error'] = "'Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      echo "<script>window.location.href='quotation_view.php'</script>";
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
            <h1>Quotations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="quotation_view.php"><a href="quotation_view.php">Quotations</a></a></li>
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
              <div class="card-header card-zg">
                <h3 class="card-title">Quotation Details</h3>
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
                            <div class="card-header card-zg">
                              <h3 class="card-title">Quotation List</h3>
                            </div>
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

