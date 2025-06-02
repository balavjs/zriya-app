<?php

require_once __DIR__ . '/vendor/autoload.php';

include('class/class_finance_cl_in.php');

$result = new DB_finance_cl_in();

if(isset($_POST['submit'])){

  $id           = $_POST['id']; 

  $sql = $result->get_one_finance_cl_in($id);   
               
  foreach ($sql as $list) { 
    
    $comp_id    = $list['comp_id']; 
    $invoice_no = $list['invoice_no'];
    $date       = $list['date'];
    $date1      = date('Y-m-d', strtotime($date));
    $signed     = $list['signed'];

    $sql1 = $result->get_one_company($comp_id);   
                                   
    foreach ($sql1 as $list1) {
      $name       = $list1['name'];
      $email      = $list1['email'];
      $phone      = $list1['phone'];
      $address    = $list1['address'];
      $comp_name  = $list1['comp_name'];
      $cont_name  = $list1['cont_name'];
      $cont_email = $list1['cont_email'];
      $cont_phone = $list1['cont_phone'];
      $reg_no     = $list1['reg_no'];
      $vat_no     = $list1['vat_no'];
    }
  }

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
                  <span>Organisation No: U72900TN2021PTC143808</span>
                  </div>
                </div>
                <div class='col-md-6 column2'>
                  <div class='row'>
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0; padding:20px 10px;'><b>Invoice No:</b> ".$invoice_no."</div>
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0;padding:20px 10px;'><b>Date:</b> ".$date1."</div>
                    <div class='col-md-12' style='padding:20px 10px;'><b>Signed Off:</b> ".$signed."</div>                  
                  </div>
                </div>
              </div>

              <hr style='margin-top:-0px;'>

              <div class='row'>
                <div class='col-md-12'>
                  <h3>INVOICE/FAKTURA</h3>
                </div>
              </div>

              <div class='row'>
                <div class='col-md-12'>
                  <p>
                    <b>To:</b><br>
                    ".$name.",</b><br>
                    ".$address."<br>
                    Phone:".$phone."<br>
                    E-mail: ".$email."<br>
                  </p>
                  <p>
                    <b>Company Details:</b><br>
                    Company Name: ".$comp_name."<br>
                    Contact Name: ".$cont_name."<br>
            ";

            if($cont_email != ""){
  $data .= "                  
                    Contact Email: ".$cont_email."<br>
            ";
            }

            if($cont_phone != ""){
  $data .= "                  
                    Contact Phone: ".$cont_phone."<br>
            ";
            }

  $data .= "
                    Registration No: ".$reg_no."<br>
                    VAT No: ".$vat_no."<br>
                  </p>
                  <p>
                    Dear <b>".$name.",</b><br>
                    Thanks for your business. Kindly find this invoice and please do pay the corresponding amount to the bank account details mentioned below.<br>
                  </p>
                  <p>
                    <b>Description</b>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                      <tr>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>S.No</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>Desc</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>Unit Price</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>Qty</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px; width:100px;'>Price</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px;'>Curr</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px; width:120px;'>MOMS/ GST/ VAT</th>
                        <th align='center' style='border:1px solid #b0b0b0; padding:10px; width:120px;'>Total</th>
                      </tr>
                      <tbody>
                      ";    
  
                       
                      $sql1 = $result->list_finance_cl_in_desc($id);   
                      $i=0;             
                      foreach ($sql1 as $list1) { 

                      $i++;

                      $product_desc = $list1['product_desc'];
                      $u_price      = $list1['u_price'];
                      $qty          = $list1['qty'];
                      $price        = $list1['price'];

                      $vat          = $list1['vat']*100;
                      $vat_value    = floor($price * $vat)/100;
                      $vat_value    = bcdiv($vat_value,1,2);

                      $currency     = $list1['currency'];
                      $total        = $list1['total'];
                      $pricetotal   = $list['pricetotal'];
                      $momtotal     = $list['momtotal'];
                      $subtotal     = $list['subtotal'];

                      $adv_value    = $list['advance'];
                      $advance      = bcdiv($adv_value,1,2);

                      $gtotal       = $list['gtotal'];
                      $comment      = $list['comment'];
                        
  $data .= "
                        <tr>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:center;'>".$i."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$product_desc."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:center;'>".$u_price."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:center;'>".$qty."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($price, 2, ',', ' ')."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:center;'>".$currency."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($vat_value, 2, ',', ' ')." (".$vat."%)</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($total, 2, ',', ' ')."</td>
                        </tr>
            ";                                
                        
                      }

  $data .= "                      
                        <tr>
                          <th colspan='4' style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>Subtotal (".$currency.")</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($pricetotal, 2, ',', ' ')."</td>
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align:right;'></th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($momtotal, 2, ',', ' ')."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($subtotal, 2, ',', ' ')."</td>
                        </tr>
            ";
                        
                        if(!empty($list['advance'] )){
  $data .= "                      
                        <tr>
                          <th colspan='7' style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>Advance (".$currency.")</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($adv_value, 2, ',', ' ')."</td>
                        </tr>
            ";
                        
                        }
  $data .= "                      
                        <tr>
                          <th colspan='7' style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>Grand Total (".$currency.")</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align:right;'>".number_format($gtotal, 2, ',', ' ')."</td>
                        </tr>
            ";
                        if(!empty($comment)){
  $data .= "
                        
                        <tr>
                          <th colspan='8' style='border:1px solid #b0b0b0; padding:10px; text-align:left;'>Comments</th>
                        </tr>
                        <tr>
                          <td colspan='8' style='border:1px solid #b0b0b0; padding:10px;'>".$comment."</th>                                
                        </tr>
            ";
                        }
  $data .= "                     
                      </tbody>
                    </table>
                    <br>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                      <tr>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>Price Total</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>MOMS/GST/VAT</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>Advance</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>Grand Total</b></th>
                      </tr>
                      <tr>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>".number_format($pricetotal, 2, ',', ' ')."</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>".number_format($momtotal, 2, ',', ' ')."</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>".number_format($adv_value, 2, ',', ' ')."</b></th>
                        <th style='padding:10px;border:1px solid #b0b0b0;'><b>".number_format($gtotal, 2, ',', ' ')."</b></th>
                      </tr>
                    </table>
                  </p>

                  <p>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                      <tbody>
                        <tr>
                          <th colspan='2' style='text-align: left; padding:10px;'><b>Bank Details</b></th>
                        </tr>
                        <tr>
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>ACCOUNT NO</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>40131963736</td>
                        </tr>
                        <tr>  
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>SWIFT</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>SBININBB246</td>   
                        </tr>
                        <tr>  
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>NAME</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>Name of the Company Zriya Digital Solutions Pvt Ltd</td>   
                        </tr>
                        <tr>  
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>BANK</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>STATE BANK OF INDIA</td>   
                        </tr>
                        <tr>  
                          <th style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>IFSC CODE</th>
                          <td style='border:1px solid #b0b0b0; padding:10px; text-align: left;'>SBIN0004060</td>   
                        </tr>
                      </tbody>
                    </table>
                  </p>

                  <p>
                    Thank you <br>
                    Best Regards <br>
                    
                    PM Radhakrishnan<br> 
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

    $mpdf->Output($invoice_no.'.pdf', 'D');

    //$mpdf->Output();   
    

}