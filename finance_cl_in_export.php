

<?php include('class/class_finance_cl_in.php'); ?>

  <table id="example1" class="table table-bordered table-striped" style="width:100%">
    
      <?php 
      $id = $_GET['id'];
      $result = new DB_finance_cl_in();
      $sql = $result->get_one_finance_cl_in($id);   
      $i=0;             
      foreach ($sql as $list) { 
        $i++;
        $comp_id = $list['comp_id'];
                     
      ?>
<?php

$vExcelFileName="Invoice-". $list['invoice_no']. ".doc"; //replace your file name from here.

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
      <th rowspan="3" style="border: 1px solid #000; width:50%;">
        <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
        <p>Organisation No: U72900TN2021PTC143808</p>
      </th>                   
      <td style="padding: 15px 10px !important;"><b>Invoice No:</b> <?php echo $list['invoice_no'];?></td> 
    </tr>
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
    </tr> 
    <tr>                    
      <td style="padding: 15px 10px !important;"><b>Signed Off:</b> <?php echo $list['signed'];?></td>
    </tr>   
    <tr>                    
      <td colspan="2">
        <h3 style="text-align: center;padding: 15px 0;"><b><u>INVOICE/FAKTURA</u></b></h3>

        <?php 
          $sql1 = $result->get_one_company($comp_id);   
          $i=0;             
          foreach ($sql1 as $list1) { 
                                                
        ?> 

        <p><b>To:</b><br>
          <?php echo $list1['name'];?><br>
          <?php echo $list1['address'];?><br>
          Phone: <?php echo $list1['phone'];?><br>
          E-mail: <?php echo $list1['email'];?>
        </p>
        <p><b>Company Details:</b><br>
          Company Name: <?php echo $list1['comp_name'];?><br>
          Contact Name: <?php echo $list1['cont_name'];?><br>
          <?php
          if($list1['cont_email'] != ""){
          ?>
          Contact Email: <?php echo $list1['cont_email'];?><br>
           <?php
          }
          if($list1['cont_phone'] != ""){
          ?>
          Contact Phone: <?php echo $list1['cont_phone'];?><br>
          <?php
          }
          ?>
          Registration No: <?php echo $list1['reg_no'];?><br>
          VAT No: <?php echo $list1['vat_no'];?>
        </p>
        <p>
          Dear <b><?php echo $list1['name'];?>,</b><br>
          Thanks for your business. Kindly find this invoice and please do pay the corresponding amount to the bank account details mentioned below.
        </p>

        <?php
        }
        ?>

        <p>
          <h5><b>Description</b></h5>
          <table id="example1" class="table table-bordered">
            <thead>
              <th class="text-center">S.No</th>
              <th class="text-center">Desc</th>
              <th class="text-center">Unit Price</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Price</th>
              <th class="text-center" width="120px">Curr</th>
              <th class="text-center" width="120px">MOMS/ GST/ VAT</th>
              <th class="text-center" width="120px">Total</th>
            </thead>
            <tbody>
                
              <?php
              $sql1 = $result->list_finance_cl_in_desc($id);   
              $i=0;             
              foreach ($sql1 as $list1) { 
                $i++;             
              ?>

              <tr>
                <td class="text-center"><?php echo $i;?></td>
                <td><?php echo $list1['product_desc'];?></td>
                <td class="text-center"><?php echo $list1['u_price'];?></td>
                <td class="text-center"><?php echo $list1['qty'];?></td>
                <td class="text-right">
                  <?php
                    $price = $list1['price'];
                    echo number_format($price, 2, ',', ' ');
                  ?>
                </td>
                <td class="text-center"><?php echo $list1['currency'];?></td>
                <td class="text-right">
                  <?php 
                    $price = $list1['price'];                                      
                    $vat = $list1['vat']*100;
                    $vat_value = floor($price * $vat)/100;
                    $vat_value = bcdiv($vat_value,1,2);
                    //echo $vat_value;
                    echo number_format($vat_value, 2, ',', ' ');
                  ?> - (<?php echo $vat; ?>%)
                </td>
                <td class="text-right">
                  <?php 
                    $total = $list1['total'];
                    echo number_format($total, 2, ',', ' ');
                  ?>
                </td>
              </tr>
              <?php
              }                             
              ?>
              <tr>
                <td colspan="3" style="text-align:right;"></td>
                <th class="text-right">Subtotal (SEK)</th>
                <td class="text-right">
                  <?php 
                    $pricetotal = $list['pricetotal'];
                    echo number_format($pricetotal, 2, ',', ' ');
                  ?>
                </td>
                <td></td>
                <td class="text-right">
                  <?php 
                    $momtotal = $list['momtotal'];
                    echo number_format($momtotal, 2, ',', ' ');
                  ?>
                </td>
                <td class="text-right">
                  <?php 
                    $subtotal = $list['subtotal'];
                    echo number_format($subtotal, 2, ',', ' ');
                  ?>
                </td>
              </tr>
              <?php
              if(!empty($list['advance'] )){
              ?>
              <tr>
                <td colspan="6" style="text-align:right;"></td>
                <th class="text-right">Advance (<?php echo $list1['currency'];?>)</th>
                <td class="text-right">
                  <?php 
                    $adv_value = $list['advance'];
                    //$advance = bcdiv($adv_value,1,2);
                    //echo $advance;
                    echo number_format($adv_value, 2, ',', ' ');
                  ?>
                </td>
              </tr>
              <?php
              }
              ?>
              <tr>
                <td colspan="6" style="text-align:right;"></td>
                <th class="text-right">Grand Total (<?php echo $list1['currency'];?>)</th>
                <td class="text-right">
                  <?php 
                    $gtotal = $list['gtotal'];
                    echo number_format($gtotal, 2, ',', ' ');                                     
                  ?>
                </td>
              </tr>
              <?php
              if(!empty($list['comment'] )){
              ?>
              <tr>
                <th colspan="8" class="align_left">Comments</th>
              </tr>
              <tr>
                <td colspan="8"><?php echo $list['comment'];?></th>                                
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <br>
          <table id="example1" class="table table-bordered table_custom">
            <tr>
              <th class="text-center">Price Total</th>
              <th class="text-center">MOMS/GST/VAT</th>
              <th class="text-center">Advance </th>
              <th class="text-center">Grand Total </th>
            </tr>
            <tr>
              <td align="center"><b><?php echo number_format($pricetotal, 2, ',', ' '); ?></b></td>
              <td align="center"><b><?php echo number_format($momtotal, 2, ',', ' '); ?></b></td>
              <td align="center"><b><?php echo number_format($adv_value, 2, ',', ' '); ?></b></td>
              <td align="center"><b><?php echo number_format($gtotal, 2, ',', ' '); ?></b></td>
            </tr>
          </table>
        </p><br><br>
        <p>
          <table id="example1" class="table table-bordered">
            <tbody>
              <tr>
                <th colspan="2" style="text-align: left;"><h5><b>Bank Details</b></h5></th>
              </tr>
              <tr>
                <td width="30%">ACCOUNT NO</td>
                <td>40131963736</td>
              </tr>
              <tr>  
                <td>SWIFT</td>
                <td>SBININBB246</td>   
              </tr>
              <tr>  
                <td>NAME</td>
                <td>Name of the Company Zriya Digital Solutions Pvt Ltd</td>   
              </tr>
              <tr>  
                <td>BANK</td>
                <td>STATE BANK OF INDIA</td>   
              </tr>
              <tr>  
                <td>IFSC CODE</td>
                <td>SBIN0004060</td>   
              </tr>
            </tbody>
          </table>

        </p><br>
        <p>
          Thank you <br>
          Best Regards <br>
          
          PM Radhakrishnan<br> 
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