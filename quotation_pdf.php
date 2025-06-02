<?php

require_once __DIR__ . '/vendor/autoload.php';

include('class/class_quotation.php');

$result = new DB_quotation();

if(isset($_POST['submit'])){

  $id           = $_POST['id']; 
  $quote_no     = $_POST['quote_no'];                      
  $date         = $_POST['date'];
  $date1        = date('Y-m-d', strtotime($date));
  $signed       = $_POST['signed'];
  $name         = $_POST['name'];
  $email        = $_POST['email'];
  $phone        = $_POST['phone'];
  $address      = $_POST['address'];
  $inscope      = $_POST['inscope'];
  $outscope     = $_POST['outscope'];
  $addendums    = $_POST['addendums'];
  $payment      = $_POST['payment'];                  


  // a new instance of the library

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
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>S.No</th>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>Product description</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>Price (excl. MOMS)</th>
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

    $mpdf->Output($quote_no.'.pdf', 'D');

    //$mpdf->Output();   
    

}