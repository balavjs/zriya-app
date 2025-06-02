<?php

require_once __DIR__ . '/vendor/autoload.php';

include('class/class_consulting_rfq.php');

$result = new DB_consulting_rfq();

if(isset($_POST['submit'])){

  $id         = $_POST['id']; 
  $rfq_no     = $_POST['rfq_no'];                      
  $date       = $_POST['date'];
  $date1      = date('Y-m-d', strtotime($date));
  $ddate      = date('Y-m-d', strtotime($date. ' + 10 days'));
  $signed       = $_POST['signed'];
  $name      = $_POST['name'];
  $description     = $_POST['description'];
                      


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


  $data .= "";  

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

    //$mpdf->Output($rfq_no.'.pdf', 'D');

    $mpdf->Output();
    
    

}