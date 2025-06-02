<?php
  $title = "Quotation Add | Zriya Solutions";
  ob_start();
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

  	<!-- Main content -->
  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Quotation</h3>
              </div>             

              <div class="card-body">  

                <?php    
                  $result_usr = new User();                    
                  $sql_usr = $result_usr->getonerecord($id);

                  foreach ($sql_usr as $list_data) {  
                    $id = $list_data['id'];                  
                    $name1 = $list_data['fullname'];
                    $role = $list_data['role'];

                  if($role == 1){ 
                ?>

                <?php
                  $result=new DB_quotation();
                  if(isset($_POST['submit'])){

                    $quote_no = $_POST['quote_no'];                        
                    $inv_cnt  = $_POST['inv_cnt'];                   
                    $year     = $_POST['year'];                          
                    $signed   = $_POST['signed'];
                    $name     = $_POST['name'];
                    $email    = $_POST['email'];
                    $phone    = $_POST['phone'];
                    $address  = $_POST['address'];
                    $inscope  = $_POST['inscope'];                        
                    $outscope = $_POST['outscope'];
                    $addendums = $_POST['addendums'];
                    $payment  = $_POST['payment'];
                    $status   = $_POST['status'];
                    $product_desc    = $_POST['product_desc'];
                    $price    = $_POST['price'];
                    
                    $sql = $result->insert($quote_no, $inv_cnt, $year, $signed, $name, $email, $phone, $address, $inscope, $outscope, $addendums,  $payment, $product_desc, $price, $status);

                    if ($sql) {       
                      $_SESSION['success'] = "New Quotation added successfully";   
                      header('location:quotation_view.php');
                    }
                    else{
                      $_SESSION['error'] = "Quotation not created";   
                      header('location:quotation_view.php');
                    }
                  }
                ?>                                             

                <form method="post" name="myform" onsubmit="return validate()">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the signed off name" name="signed" required>
                      </div>
                    </div>
                    <?php 

                      $y1 = date('y');      
                      //$y1 = 24;                  

                      $result = new DB_quotation();
                      $sql = $result->quotation_last1();  

                      $i=0;    
                      $row_cnt1 = $sql->num_rows; 
                      if($row_cnt1 == 0){   
                        $next_id = 1;
                      }
                      else{       
                      foreach ($sql as $list) { 
                        //echo $list['id']."<br>";
                        //echo $list['invoice_no']."<br>";
                        //echo $list['inv_cnt']."<br>";

                        $string = $list['inv_cnt'];

                        $last_id = $string;

                        $sql3 = $result->quotation_year($y1);
                        $row_cnt = $sql3->num_rows; 
                        if($row_cnt == 0){ 
                          $next_id = 1;
                          //echo $next_id;
                        }
                        else{
                          $next_id = $last_id + 1;
                          //echo $next_id;
                        }
                        //echo "Next ID : ".$next_id."<br>";
                        //echo "Year : ".$list['year']."<br>";
                       // echo "Current Year : ".$y1."<br>";
                      }
                      }
                    ?>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Quotation No</label>
                        <input type="text" class="form-control" placeholder="Enter the Quote No" name="quote_no" value="QT-<?php echo $y1."-000".$next_id; ?>" readonly required>
                        <input type="hidden" class="form-control" placeholder="Enter last id" name="inv_cnt" value="<?php echo $next_id; ?>"  required>
                        <input type="hidden" class="form-control" placeholder="Enter the year" name="year" value="<?php echo $y1; ?>"  required>
                      </div> 
                    </div>                    
                  </div>                  

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div>
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone" name="phone" required>
                      </div>                     
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea  style="height: 210px;" class="form-control" rows="4" placeholder="Enter the address" name="address" required></textarea>
                      </div>
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Inscope</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Inscope details" name="inscope" required></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Outscope</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the description" name="outscope" required></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">                       
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Addendums</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the description" name="addendums" required></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Payment</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the description" name="payment" required></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>                
                  </div>
                  <br>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table family" id="h_apnd">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Pricing</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                          </tr>
                          <tr>
                            <th>Product Description</th>
                            <th>Price (excl. MOMS)</th>
                            <th>Action</th>
                          </tr>  
                        </thead>
                        <tbody>
                          <tr class="ap_rw">                
                            <td><input type="text" class="form-control" name="product_desc[]" required></td>
                            <td><input type="number" class="form-control" name="price[]" required></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>            
                      </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit" id="submit">Submit</button>
                      </div>
                    </div>                    
                  </div>
                  
                </form>
              
            </div>

              <?php
              }
              else{
              ?>
                <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12"> 
                      <div class="alert alert-danger" role="alert">
                        <strong>Oops!</strong> You don't have access to view this page.
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <?php    
              }
              }
              ?>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>

<script>
    $(document).ready(function(){
      $(".add_product").click(function(){
        $("table#h_apnd tbody").append('<tr class="ap_rw"><td><input type="text" class="form-control" name="product_desc[]" required/></td><td><input type="text" class="form-control" name="price[]" required/></td><td style="text-align:center;"><button type="button" class="btn delete-row btn-danger">X</button></td></tr>');
      });

      $("table#h_apnd tbody").on('click','.delete-row',function(){
          $(this).parent().parent().remove();
      });
    }); 
</script>


