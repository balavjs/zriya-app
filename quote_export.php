<?php
require_once __DIR__ . '/vendor/autoload.php';

// Create the new document..
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add an empty Section to the document
$section = $phpWord->addSection();


include('class/class_quotation.php');


	$id = $_GET['id'];
    $result = new DB_quotation();
    $sql = $result->get_one_quotation($id);   
    
    foreach ($sql as $list) { 

    	$quote_no  = $list['quote_no'];
        $date      = $list['date'];
        $date1     = date('Y-m-d', strtotime($date));
    	$signed    = $list['signed'];
        $name      = $list['name'];
        $email     = $list['email'];
        $phone     = $list['phone'];
        $address   = $list['address'];
        $inscope   = $list['inscope'];
        $outscope  = $list['outscope'];
        $addendums = $list['addendums'];
        $payment   = $list['payment'];

		$html  = '<table style="border: 1px #000 solid;">                   
                    <tr style="background-color: #fff; text-align: center; color: #000;">
                        <td rowspan="3" style="width: 500px !important;">
                            <span style="margin:10px 0 10px 10px;">
                            <img src="http://localhost/zriya/zriya_app/dist/img/logo.png" width="200px" /><br/>
                            <span>Organisation No: 559361-1030<br/>MOMS Nummer: SE559361103001</span>
                            </span>
                        </td>
                        <td style="width: 500px !important; padding:10px;">
                            <b>Quote NO:</b> '.$quote_no.'<br/><b>Date:</b> '.$date1.'<br/><hr/><b>Signed:</b> '.$signed.'
                        </td>
                    </tr>
                    <tr style="background-color: #fff; color: #000;">
                        <td colspan="2">
                            <p>
                                <b>To:</b><br/>Mr/Mrs.'.$name.'.<br/>'.$address.'.<br/>Email: '.$email.'.<br/>Phone: '.$phone.'.<br/>

                            </p>
                            <p style="font-size:20px !important;"><b>In Scope:</b></p>

                        </td>
                    </tr>                    
                 </table>';
           
              
     }
     

$html .= "<p>This is a paragraph of random text</p>";
$html .= "<table style='border:1px solid #000; border-collapse:collapse;'><tr><td style='border:1px solid #000;'>A table</td><td style='border:1px solid #000;'>Cell</td></tr></table>";



//$section->addText(htmlspecialchars(' in italic', ENT_COMPAT, 'UTF-8'), array('italic' => true));



\PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

// (D) OR FORCE DOWNLOAD
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;filename=\"convert.docx\"");
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
ob_clean();
$objWriter->save("php://output");