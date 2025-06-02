<?php
  $title = "Quotation Update | Zriya Solutions";
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

  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Update Quotation Details</h3>
              </div>        

              <?php 
                $result_usr = new User();                
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                  $id = $list_data['id'];                  
                  $name1 = $list_data['fullname'];
                  $role = $list_data['role'];
                   
                  if($role == 1){ 
              ?>

              <div class="card-body">  

              <?php
                $result=new DB_quotation();

                if(isset($_POST['update'])){
                  $id = $_GET['id'];
                                       
                  $signed = $_POST['signed'];
                  $name = $_POST['name'];
                  $email = $_POST['email'];
                  $phone = $_POST['phone'];
                  $address = $_POST['address'];
                  $inscope = $_POST['inscope'];                        
                  $outscope = $_POST['outscope'];
                  $addendums = $_POST['addendums'];
                  $pricing = $_POST['pricing'];
                  $payment = $_POST['payment'];
                  $product_desc    = $_POST['product_desc'];
                  $price    = $_POST['price'];
                  $status = $_POST['status'];
                  $id1 = $_POST['id1'];
                  
                  $sql = $result->update($id, $id1, $signed, $name, $phone, $address, $inscope, $outscope, $addendums, $payment, $product_desc, $price, $status);
                  if ($sql) {  
                    $_SESSION['success'] = "Quotation Updated Successfully!";   
                    header('location:quotation_view.php');                  
                  }
                  else{
                    $_SESSION['error'] = "Quotation not Updatation";   
                    header('location:quotation_view.php');   
                  }
                }
              ?>             

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_quotation();
                    $sql1 = $result1->get_one_quotation($id);   

                    while($row = mysqli_fetch_array($sql1)){ 
                  ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the first name" name="name" value="<?php echo $row['name']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="signed" value="<?php echo $row['signed']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" required disabled>
                      </div>   
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                      </div>                   
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea style="height: 123px;" class="form-control" rows="3" placeholder="Enter the address" name="address" required><?php echo $row['address']; ?></textarea>
                      </div>
                    </div>
                  </div>                  

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Inscope</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Inscope details" name="inscope" required><?php echo $row['inscope']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div>   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Outscope</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Outscope details" name="outscope" required><?php echo $row['outscope']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div>                 
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Addendums</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Attendums details" name="addendums" required><?php echo $row['addendums']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Payment</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Payment details" name="payment" required><?php echo $row['payment']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div>                     
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table table-bordered family" id="h_apnd">
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
                          <?php
                            $result=new DB_quotation();
                            $id = $_GET['id'];
                            $sqlf = $result->list_quote_price($id);

                            if (is_array($sqlf) || is_object($sqlf)) {
                              foreach ($sqlf as $list_price) {

                                $id1 = $list_price['id'];
                                $quote_id     = $list_price['quote_id'];       
                                $product_desc = $list_price['product_desc'];
                                $price        = $list_price['price']; 
                          ?> 
                          <tr class="ap_rw">  
                            <input type="hidden" class="form-control" name="quote_id[]" value="<?php echo $quote_id; ?>">   
                            <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">             
                            <td><input type="text" class="form-control" name="product_desc[]" value="<?php echo $product_desc; ?>"required></td>
                            <td><input type="number" class="form-control" name="price[]" value="<?php echo $price; ?>" required></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                          </tr>
                          <?php
                            }
                          }
                          ?>
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
                          <option value="1" <?php if($row['status']=='1'){echo "selected='selected'";} ?>>Active</option>
                          <option value="0" <?php if($row['status']=='0'){echo "selected='selected'";} ?>>Inactive</option>
                        </select>          
                      </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="update">Update</button>
                      </div>
                    </div>                    
                  </div>
                  <?php
                  }
                  ?>
                </form>
              </div>
              <!-- /.card -->
            </div>             
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
            <div class="card-body">
              <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> You don't have access to view this page.
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

