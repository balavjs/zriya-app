<?php
  $title = "Finance - India Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_finance_in.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finance Invoice - India</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="finance_in_view.php">Finance - India</a></li>
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

        if($role == 1 || $role == 5 || $role == 6 || $role == 7){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Finance Invoice - India</h3>
              </div>             

              <div class="card-body">
                <a href="finance_in_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Finance - India</button>
                </a><br><br>
                <table id="example1" class="table table-bordered ">
                  
                  <?php 
                  $id = $_GET['id'];
                  $result = new DB_finance_in();
                  $sql = $result->get_one_finance_in($id);   
                  $i=0;             
                  foreach ($sql as $list) { 
                    $i++;
                    $comp_id = $list['comp_id'];             
                  ?>

                  <tr> 
                    <th rowspan="3" width="50%"><img src="dist/img/logo.png">
                      <p>Organisation No: U72900TN2021PTC143808
                      </p>
                    </th>                   
                    <td><b>Invoice No:</b> <?php echo $list['invoice_no'];?></td>
                  </tr>
                  <tr>                    
                    <td><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
                  </tr> 
                  <tr>
                    <td><b>Signed Off:</b> <?php echo $list['signed'];?></td>
                  </tr> 

                  <?php 
                  $sql1 = $result->get_one_company($comp_id);   
                  $i=0;             
                  foreach ($sql1 as $list1) { 
                    $i++;                                     
                  ?> 

                  <tr>                    
                    <td colspan="2">
                      <h3 style="text-align: center;padding: 15px 0;"><b><u>INVOICE/FAKTURA</u></b></h3>
                      <p>
                      <h5><b>To:</b></h5>
                      <?php echo $list1['name'];?><br>
                      <?php echo $list1['address'];?><br>
                      Phone: <?php echo $list1['phone'];?><br>
                      E-mail: <?php echo $list1['email'];?><br>
                      </p>
                      <p>
                        <h5><b>Company Details:</b></h5>
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
                        VAT No: <?php echo $list1['vat_no'];?><br>
                      </p>
                      <p>
                        Dear <b><?php echo $list1['name'];?>,</b><br>
                        Thanks for your business. Kindly find this invoice and please do pay the corresponding amount to the bank account details mentioned below.<br>
                      </p>

                  <?php                    
                  }
                  ?>
                      <p>
                        <h5><b>Description</b></h5>
                        <table id="example1" class="table table-bordered">
                          <thead>
                            <th class="text-center">S.No</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Hour Rate</th>
                            <th class="text-center">No.of Hours</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Currency</th>
                            <th class="text-center" width="170px">MOMS/GST/VAT</th>
                            <th class="text-center" width="130px">Total</th>
                          </thead>
                          <tbody>
                              
                            <?php
                              $sql1 = $result->list_finance_in_desc($id);   
                              $i=0;             
                              foreach ($sql1 as $list1) { 
                                $i++;
                            ?>

                            <tr>
                              <td class="text-center"><?php echo $i;?></td>
                              <td><?php echo $list1['product_desc'];?></td>
                              <td class="text-center">
                                <?php 
                                if($list1['hrs_rate'] != ""){
                                  echo $list1['hrs_rate'];
                                }
                                else{
                                  echo "-";
                                }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php 
                                if($list1['hrs_nos'] != ""){
                                  echo $list1['hrs_nos'];
                                }
                                else{
                                  echo "-";
                                }
                                ?>
                              </td>
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
                              <th colspan="8">Comments</th>
                            </tr>
                            <tr>
                              <td colspan="8"><?php echo $list['comment'];?></td>                                
                            </tr>
                            <?php
                            }
                            ?>

                          </tbody>
                        </table>
                        <table id="example1" class="table table-bordered table_custom">
                          <thead>
                            <th class="text-center">Price Total</th>
                            <th class="text-center">MOMS/GST/VAT</th>
                            <th class="text-center">Advance </th>
                            <th class="text-center">Grand Total </th>
                          </thead>
                          <tbody>
                            <td align="center"><b><?php echo number_format($pricetotal, 2, ',', ' '); ?></b></td>
                            <td align="center"><b><?php echo number_format($momtotal, 2, ',', ' '); ?></b></td>
                            <td align="center"><b><?php echo number_format($adv_value, 2, ',', ' '); ?></b></td>
                            <td align="center"><b><?php echo number_format($gtotal, 2, ',', ' '); ?></b></td>
                          </tbody>
                        </table>
                      </p>
                      <p>
                        <table id="example1" class="table table-bordered">
                          <tbody>
                            <tr>
                              <th colspan="2" style="text-align: left;"><h5><b>Bank Details</b></h5></th>
                            </tr>
                            <tr>
                              <th>ACCOUNT NO</th>
                              <td>40131963736</td>
                            </tr>
                            <tr>  
                              <th>SWIFT</th>
                              <td>SBININBB246</td>   
                            </tr>
                            <tr>  
                              <th>NAME</th>
                              <td>Name of the Company Zriya Digital Solutions Pvt Ltd</td>   
                            </tr>
                            <tr>  
                              <th>BANK</th>
                              <td>STATE BANK OF INDIA</td>   
                            </tr>
                            <tr>  
                              <th>IFSC CODE</th>
                              <td>SBIN0004060</td>   
                            </tr>
                          </tbody>
                        </table>
                      </p>
                      <br>
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
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <?php
    }
    else{
    ?>
     
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Quotation Details</h3>
              </div>
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>
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
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>
