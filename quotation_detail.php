<?php
  $title = "Quotation Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_quotation.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="quotation_view.php">Quotations</a></li>
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
      
        if($role == 1){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Quotation Details</h3>
              </div>
              
              <div class="card-body">
                <a href="quotation_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Quotations</button>
                </a><br><br>

                <table id="example1" class="table table-bordered ">                  
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_quotation();
                    $sql = $result->get_one_quotation($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                   
                  ?>
                  <tr> 
                    <th rowspan="3" width="50%"><img src="dist/img/logo.png"></th>                   
                    <td><b>Quote No:</b> <?php echo $list['quote_no'];?></td> 
                  </tr>
                  <tr>                    
                    <td><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
                  </tr>
                  <tr>                    
                    <td><b>Signed Off:</b> <?php echo $list['signed'];?></td>
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
                      </p><br>
                      <p>
                        <h5><b>Out of Scope</b></h5>
                        <?php echo $list['outscope'];?>
                      </p><br>
                      <p>
                        <h5><b>Expected Addendums</b></h5>
                        <?php echo $list['addendums'];?>
                      </p><br>
                      <p>
                        <h5><b>Payment method</b></h5>
                        <?php echo $list['payment'];?>
                      </p><br>
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
    <!-- Main content -->
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