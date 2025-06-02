<?php

require_once __DIR__ . '/vendor/autoload.php';

include('class/class_salary_slip.php');
include('class/class_users.php'); 

$result = new DB_salary_slip();

if(isset($_POST['submit'])){

  $id           = $_POST['id'];   
  $sal_my       = $_POST['sal_my'];

  $sql = $result->get_one_salary_slip($id); 
  foreach ($sql as $list) { 
  $i++;
    $emp_id = $list['emp_id']; 

    $currency     = $list['currency'];
    $gsalary      = $list['gsalary'];
    $pan_no       = $list['pan_no'];  
    $sal_date     = $list['sal_date'];
    $sal_date1    = date("d-M-Y", strtotime($sal_date));
    $advance      = $list['advance'];
    $vat          = $list['vat'];
    $nsalary      = $list['nsalary'];

  $result1 = new DB_user();
  $sql1 = $result1->get_emp_id_user($emp_id);
  foreach ($sql1 as $list1) {
    $emp_id1 = $list1['emp_id'];
    $fname = $list1['fname'];
    $lname = $list1['lname'];
    $pan_no = $list1['pan_no'];

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
            <div class='container pdf_container1 sal_table1'>
              <div class='row pdf_row'>
                <div class='col-md-6'>
                  <div style='padding:0px;'>
                    <img src='https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png'>  
                  </div>
                </div>  
                <div class='col-md-6'>
                  <div style='padding:0px; text-align:right;'>
                    <p>Kopparbergsvägen 10, 722 13<br>Västerås, Sweden<br>Organisation No: 559361-1030<br>MOMS Nummer: SE559361103001</p>                
                  </div>
                </div>                
              </div>

              <hr style='margin-top:20px; height:5px; color:#17353d'>

              <div class='row'>
                <div class='col-md-12'>
                  <table class='sal_table1' width='100%' style='border-collapse: collapse;'>                    
                    <tr>
                      <th align='left' width='150px'>Utbetalningsdag</th>
                      <td>: ".$sal_date1."</td>
                    </tr>
                    <tr>
                      <th align='left' width='200px'>namn</th>
                      <td>: ".$fname." ".$lname."</td>
                    </tr>
                    <tr>
                      <th align='left' width='200px'>Anställningsnummer</th>
                      <td>: ".$emp_id1."</td>
                    </tr>
                    <tr>
                      <th align='left'>Personnummer</th>
                      <td>: ".$pan_no."</td>
                    </tr> 
                  
          ";

                    $month  = $list['month'];

                    if($month == 1){
                      $month_name = "January";
                    }
                    elseif($month == 2){
                      $month_name = "February";
                    }
                    elseif($month == 3){
                      $month_name = "March";
                    }
                    elseif($month == 4){
                      $month_name = "April";
                    }
                    elseif($month == 5){
                      $month_name = "May";
                    }
                    elseif($month == 6){
                      $month_name = "June";
                    }
                    elseif($month == 7){
                      $month_name = "July";
                    }
                    elseif($month == 8){
                      $month_name = "August";
                    }
                    elseif($month == 9){
                      $month_name = "September";
                    }
                    elseif($month == 10){
                      $month_name = "October";
                    }
                    elseif($month == 11){
                      $month_name = "November";
                    }
                    elseif($month == 12){
                      $month_name = "December";
                    }

    $data .= "
                    <tr>
                      <th align='left' width='200px'>Löneperiod</th>
                      <td>: ".$month_name." - ".$list['year']."</td>
                    </tr> 
                  </table>                  
                </div>
              </div>
              <br>
              <div class='row'>
                <div class='col-md-12'>
                  <h3 style='font-size:16px;'>Lönebesked</h3>
                </div>

                <table class='sal_table1' width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                  <tr>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:center'>S.No</th>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:left'>Löneart </th>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:left'>Benämning </th>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:center'>Antal </th>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:right'>Kronor </th>
                    <th style='border-bottom:1px solid #b0b0b0; padding:10px;text-align:right'>Totalt </th>
                  </tr>
          ";                                  
                        
                  $sql2 = $result->get_one_salary_slip_detail($id);   
                  $i=0;             
                  foreach ($sql2 as $list2) { 
                    $i++;                               
      $data .= "
                  <tr>
                    <td style='border:0; padding:10px;text-align:center'>".$i."</td>
                    <td style='border:0; padding:10px;'>".$list2['sal_type']."</td>
                    <td style='border:0; padding:10px;'>".$list2['name']."</td>
                    <td style='border:0; padding:10px;text-align:center;'>".$list2['quantity']."</td>
                    <td style='border:0; padding:10px;text-align:right;'>".$list2['price']."</td>
                    <td style='border:0; padding:10px;text-align:right;'>".$list2['total']."</td>
                  </tr>  
                                           
                  ";
                  }  


      $data .= " 
                  <tr>
                    <td style='color:#fff;'>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1</td>                    
                  </tr> 
                </table>  
                <table width='100%' style='margin: 0 10px; border-collapse: collapse;'>   
                  <tr>
                    <td style='border:1px solid #b0b0b0;border-top:0;' colspan='2'>
                      <table width='100%' style='margin: 0 10px; border-collapse: collapse;'>
                      <tr>
                          <th class='text-center' style='border-bottom:1px solid #b0b0b0; padding:10px;'>Semesterdagar </th>
                        </tr>
                        <tr>
                          <td style='padding-top:10px;'>Semesterrätt </td>
                          <td style='padding-top:10px;'></td>
                        </tr>
                        <tr>
                          <td>Betalda </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Förskott </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Uttagna </td>
                          <td></td>
                        </tr>
                      </table>
                    </td>
                    <td style='border:1px solid #b0b0b0;border-top:0;border-left:0;' colspan='2'>
                      <table width='100%' style='margin: 0 10px; border-collapse: collapse;'>
                        <tr>
                          <th colspan='3' class='text-center' style='border-bottom:1px solid #b0b0b0; padding:10px;'>Summa</th>
                        </tr>
                        <tr>
                          <td style='padding-top:10px;'></td>
                          <td style='text-align:right;padding-top:10px;'><b>Totalt under året </b></td>
                          <td style='text-align:right;padding-top:10px;'><b>Totalt under perioden</b></td>
                        </tr>
                        <tr>
                          <td>Bruttolön </td>
                          <td style='text-align:right'>".$gsalary."</td>
                          <td style='text-align:right'>".$gsalary."</td>
                        </tr>
                        <tr>
                          <td>Förmåner </td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Skatt </td>
                          <td style='text-align:right'>".$vat."</td>
                          <td style='text-align:right'>".$vat."</td>
                        </tr>
                      </table>
                    </td>
                    <td style='border:1px solid #b0b0b0;border-top:0;border-left:0;' colspan='2'>
                      <table width='100%' style='margin: 0 10px; border-collapse: collapse;'>
                        <tr>
                          <th colspan='2' class='text-center' style='border-bottom:1px solid #b0b0b0; padding:10px;'>Denna period</th>
                        </tr>
                        <tr>
                          <td style='padding-top:10px;'>Bruttolön (SEK)</td>
                          <td style='text-align:right;padding-top:10px;'>".$gsalary."</td>
                        </tr>
                        <tr>
                          <td>Förskott (SEK)</td>
                          <td style='text-align:right'>".$advance."</td>
                        </tr>
                        <tr>
                          <td>Skatt (SEK)</td>
                          <td style='text-align:right'>".$vat."</td>
                        </tr>
                        <tr>
                          <td><b>Utbetalt (SEK)</b></td>
                          <td style='text-align:right;padding-bottom:10px;'><b>".$nsalary."</b></td>
                        </tr>
                      </table>
                    </td>
                  </tr> 
                </table>                     
              </div>                     
            
            </body>
            </html>
            ";           

    }
  }

    $mpdf->WriteHtml($data);

    $mpdf->Output($emp_id1.'-'.$sal_my.'.pdf', 'D');

    //$mpdf->Output();       

}