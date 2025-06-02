<?php include('class/class_consulting_rfq.php'); ?>

  <table id="example1" class="table table-bordered table-striped" style="width:100%">
    
  <?php 
    $id = $_GET['id'];
    $result = new DB_consulting_rfq();
    $sql = $result->get_one_consulting_rfq($id);   
    $i=0;             
    foreach ($sql as $list) { 
      $i++;               
  ?>

  <?php

  $vExcelFileName="Consulting-". $list['rfq_no']. ".doc"; //replace your file name from here.

  header("Content-type: application/x-ms-download"); //#-- build header to download the word file 
  header("Content-Disposition: attachment; filename=$vExcelFileName"); 
  header('Cache-Control: public'); 

  $content = '<style>
          @page
          {
            font-family: Courier New;
            size:215.9mm 279.4mm;  /* A4 */            
            margin: 0.5mm !important;
          }        
          h3 { 
            font-size: 24px; 
            text-align:center; 
            padding:20px 0;
          }
          h5{
            font-size: 20px;
          }
          p {
            font-family: Courier New; 
            font-size: 16px; 
            padding: 10px;
          }
          table{
            width:100% !important;
          }
          table, th, td{
            border:1px solid #000 !important;
            border-collapse: collapse;
            font-family: Courier New;
          }
          th, td{
            padding:10px !important;
          }        
          </style>';

  echo $content;

  ?>
    <tr> 
      <th rowspan="3" style="border: 1px solid #000; width:50%;">
        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
        <p>Organisation No: 559361-1030<br>
          MOMS Nummer: SE559361103001
        </p>
      </th>                   
      <td style="padding: 15px 10px !important;"><b>RFQ No:</b> <?php echo $list['rfq_no'];?></td> 
    </tr>
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
    </tr>
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Signed Off:</b> <?php echo $list['signed'];?></td>
    </tr>
    <tr>                    
      <td colspan="2">
        <h3 style="text-align: center;padding: 15px 0;"><b><u>REQUEST FOR QUOTATION</u></b></h3>
        <p><b>To:</b><br>
        Whom it may concern,<br>
        </p>
        <p>Dear <b>Mr/Mrs. <?php echo $list['name'];?>,</b><br>
        Through this RFQ, Zriya Digital Solutions requests to kindly provide your best candidates that fulfill the requirements described below considering the deadline of <b><?php $date = $list['date']; echo date('Y-m-d', strtotime($date. ' + 10 days')); ?>.</b><br>
        </p>
        <p>
          <h5><b>Description</b></h5>
          <?php echo $list['description'];?>
        </p><br>
        <p>
          Thank you <br>
          Best Regards <br>
          <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/krishna-sign.png"><br>
          Krishna Radhakrishnan<br> 
          Sales Director<br> 
          Zriya Solutions<br>
        </p>
      </td>
    </tr>   
    
    <?php                 
    }
    ?>  
    
    
  </table>