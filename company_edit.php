<?php
  $title = "Company Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_company.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comapany</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="company_view.php">Company</a></li>
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
                <h3 class="card-title">Update Company Details</h3>
              </div>        

            <?php  
              $result_usr = new User();                
              $sql_usr = $result_usr->getonerecord($id);

              foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];
              
                if($role == 1 || $role == 5 || $role == 6 || $role == 7 || $role == 8){ 
            ?>

            <div class="card-body">  
            

            <?php
              $result=new DB_company();

              if(isset($_POST['update'])){

                $id = $_GET['id']; 
                $name       = $_POST['name'];
                $phone      = $_POST['phone'];
                //$address    = $_POST['address'];
                $address    = str_replace("\n", '<br />', $_POST['address']);
                $comp_name  = $_POST['comp_name'];
                $cont_name  = $_POST['cont_name'];
                $cont_email = $_POST['cont_email'];
                $cont_phone = $_POST['cont_phone'];
                $reg_no     = $_POST['reg_no'];
                $vat_no     = $_POST['vat_no'];
                $status     = $_POST['status'];
                
                $sql = $result->update($id, $name, $phone, $address, $comp_name, $cont_name, $cont_email, $cont_phone, $reg_no, $vat_no, $status);
                
                if ($sql) {                          
                  $_SESSION['success'] = "Company updated successfully";   
                  header('location:company_view.php');
                }
                else{
                  $_SESSION['error'] = "Company not updated / Email Already exist!";   
                  header('location:company_view.php');
                }
              }
            ?>                

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_company();
                    $sql1 = $result1->get_one_company($id);   

                    while($row = mysqli_fetch_array($sql1)){
                  ?>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the name" name="name" value="<?php echo $row['name']; ?>"required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" value="<?php echo $row['email']; ?>" readonly required>
                      </div>   
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea style="height: 210px;" class="form-control" rows="3" placeholder="Enter the address" name="address" required><?php echo strip_tags($row['address']); ?></textarea>
                      </div>
                    </div>
                  </div>  

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Enter the company name" name="comp_name" value="<?php echo $row['comp_name']; ?>" required>
                      </div>  
                    </div> 
                    <div class="col-sm-6">                
                      <div class="form-group">
                        <label>Contact Name</label>
                        <input type="text" class="form-control" placeholder="Enter the contact person name" name="cont_name" value="<?php echo $row['cont_name']; ?>" required>
                      </div> 
                    </div>
                  </div>                                

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" class="form-control" placeholder="Enter the contact person email" name="cont_email" value="<?php echo $row['cont_email']; ?>">
                      </div> 
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact Phone</label>
                        <input type="number" class="form-control" placeholder="Enter the contact person phone" name="cont_phone" value="<?php echo $row['cont_phone']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Registration No</label>
                        <input type="text" class="form-control" placeholder="Enter the registration no" name="reg_no" value="<?php echo $row['reg_no']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>VAT No</label>
                        <input type="text" class="form-control" placeholder="Enter the vat no" name="vat_no" value="<?php echo $row['vat_no']; ?>" required>
                      </div>
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
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="update">Update</button>
                      </div>
                    </div>                    
                  </div>                 
                </form>
              <?php
              }
              ?>              
            </div>
            
            </div>


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

    <?php
    }
    else{
      ?>
      <!-- Main content -->
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
