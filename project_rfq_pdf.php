<?php

require_once __DIR__ . '/vendor/autoload.php';

include('class/class_project_rfq.php');

$result = new DB_project_rfq();

if(isset($_POST['submit'])){

  $id           = $_POST['id']; 
  $rfq_no       = $_POST['rfq_no'];                      
  $date         = $_POST['date'];
  $date1        = date('Y-m-d', strtotime($date));
  $ddate        = date('Y-m-d', strtotime($date. ' + 10 days'));
  $signed       = $_POST['signed'];
  $aim          = $_POST['aim'];
  $deliverables = $_POST['deliverables'];
  $cost         = $_POST['cost'];                    


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
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0; padding:20px 10px;'><b>RFQ No:</b> ".$rfq_no."</div>
                    <div class='col-md-12' style='border-bottom:1px solid #b0b0b0;padding:20px 10px;'><b>Date:</b> ".$date1."</div>
                    <div class='col-md-12' style='padding:20px 10px;'><b>Signed Off:</b> ".$signed."</div>                  
                  </div>
                </div>
              </div>

              <hr style='margin-top:-0px;'>

              <div class='row'>
                <div class='col-md-12'>
                  <h3>Technical Specification Document</h3>
                </div>
              </div>

              <div class='row'>
                <div class='col-md-12'>
                  
                    <h5><b>Aim:</b></h5>
                    ".$aim."

                    <h5><b>Stakeholders</b></h5>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                      <tr>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>S.No</th>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>Name of the Person</th>
                        <th align='left' style='border:1px solid #b0b0b0; padding:10px;'>Role</th>
                      </tr>
                      <tbody>
          ";                                  
                        
                        $sql1 = $result->list_project_rfq_role($id);   
                        $i=0;             
                        foreach ($sql1 as $list1) { 
                          $i++;                               
      $data .= "
                        <tr>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$i."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$list1['name']."</td>
                          <td style='border:1px solid #b0b0b0; padding:10px;'>".$list1['role']."</td>
                        </tr>                                
                        ";
                        }                                               
      $data .= "                       
                      </tbody>
                    </table>

                    <h5><b>Deliverables:</b></h5>
                    ".$deliverables."
                  
                    <h5><b>Projected Costs:</b></h5>
                    ".$cost."
                  ";

      $data .= "
                  <h5><b>Revisions</b></h5>
                    <table width='100%' style='border:1px solid #b0b0b0;margin: 0 10px; border-collapse: collapse;'>
                    <tr>
                      <th style='border:1px solid #b0b0b0; padding:10px;'>S.No</th>
                      <th style='border:1px solid #b0b0b0; padding:10px;'>Version</th>
                      <th style='border:1px solid #b0b0b0; padding:10px;'>Status</th>
                      <th style='border:1px solid #b0b0b0; padding:10px;'>Date</th>
                      <th style='border:1px solid #b0b0b0; padding:10px;'>User</th>                                
                    </tr>

                    ";
      $result = new DB_project_rfq();
      $sql2 = $result->list_project_rfq_revision($id);   
        $i1=0; 
        $i2 = "-1";
        $i3 = "-1";

        foreach ($sql2 as $list2) { 
          $i1++; 
          $i2++; 
          $i3++;
          
          $rev_date  = $list2['date'];
          $rev_date1 = date('Y-m-d', strtotime($rev_date));

          $chars = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"); 

          if($i3==0){
            $i3_val =  "Initial";
          }
          else{
            $i3_val =  "Revision" .$i3;
          }

          $cur_user = $list2['user_id'];
          $sql3 = $result->list_cur_user($cur_user);   
          $i=0;             
          foreach ($sql3 as $list3) { 
               $fname = $list3['fname'];    
               $lname =  $list3['lname'];                        
          }

          $data .="<tr>
                    <td style='border:1px solid #b0b0b0; padding:10px;'>".$i1."</td>
                    <td style='border:1px solid #b0b0b0; padding:10px;'>".$rfq_no."- Rev ".$chars[$i2]."</td>
                    ";

          $data .= "<td style='border:1px solid #b0b0b0; padding:10px;'>".$i3_val."</td>
                    <td style='border:1px solid #b0b0b0; padding:10px;'>".$rev_date1."</td>
                    <td style='border:1px solid #b0b0b0; padding:10px;'>".$fname." ".$lname."</td>
                  </tr>
                  ";
          }
      $data .= "
                                      
                </table>
                ";

      $data .= "  <p>
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

    $mpdf->Output($rfq_no.'.pdf', 'D');

    //$mpdf->Output();   
    

}