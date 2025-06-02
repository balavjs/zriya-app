

<?php include('class/class_quotation.php'); ?>

  <table id="example1" class="table table-bordered table-striped" style="width:100%">
    
      <?php 
      $id = $_GET['id'];
      $result = new DB_quotation();
      $sql = $result->get_one_quotation($id);   
      $i=0;             
      foreach ($sql as $list) { 
        $i++;
                     
      ?>
<?php

$vExcelFileName="Quotation-". $list['quote_no']. ".doc"; //replace your file name from here.

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
          font-size: 11pt; 
          padding: 10px;
        }
        table{
          width:100% !important;
        }
        table, th, td{
          border:1px solid #000 !important;
          border-collapse: collapse;
          font-family: Courier New;
          font-size: 11pt;
        }
        th, td{
          padding:10px !important;
        }
        .text-right{
          text-align: right !important;
        }
        .align_left{
          text-align:left !important;
        }
        .text-center{
          text-align:center !important;
        }
        
        </style>';

echo $content;

?>
    <tr> 
      <th rowspan="3" style="border: 1px solid #000; width:50%;"><img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png"></th>     
      
      <td style="padding: 15px 10px !important;"><b>Quote No:</b> <?php echo $list['quote_no'];?></td> 
    </tr>
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
    </tr>
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Signed Off:</b> <?php echo $list['signed'];?></td>
    </tr>
    <tr>                    
      <td colspan="2">
        <h3 style="text-align: center;padding: 15px 0;"><b><u>Quotation Letter</u></b></h3>
        <p><b>To:</b><br>
        Mr. <?php echo $list['name'];?><br>
        <?php echo $list['address'];?><br>
        Phone: <?php echo $list['phone'];?><br>
        E-mail: <?php echo $list['email'];?><br>
        </p><br>
        <p>
          <h5><b>In Scope</b></h5>
          <?php echo $list['inscope'];?>
        </p>
        <p>
          <h5><b>Out of Scope</b></h5>
          <?php echo $list['outscope'];?>
        </p>
        <p>
          <h5><b>Expected Addendums</b></h5>
          <?php echo $list['addendums'];?>
        </p>
        <p>
          <h5><b>Payment method</b></h5>
          <?php echo $list['payment'];?>
        </p>
        <p>
          <h5><b>Pricing</b></h5>
          <table id="example1" class="table table-bordered">
            <thead>
              <th class="text-center" width="150px">S.No</th>
              <th class="text-left">Product description</th>
              <th class="text-center" width="250px">Price (excl. MOMS)</th>
            </thead>
            <tbody>                
              <?php
                $sql1 = $result->list_quote_price($id);   
                $i=0;             
                foreach ($sql1 as $list1) { 
                  $i++;             
              ?>
              <tr>
                <td class="text-center"><?php echo $i;?></td>
                <td><?php echo $list1['product_desc'];?></td>
                <td class="text-right">
                  <?php 
                    $price = $list1['price'];
                    echo number_format($price, 2, ',', ' ');
                  ?>
                </td>
              </tr>
              <?php
              }                             
              ?>
            </tbody>
          </table>
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
      </td>
      
    </tr>
    
    
  </table>