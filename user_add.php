<?php
  $title = "User Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title">Add New User</h3>
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
                $result=new DB_user();
                if(isset($_POST['submit'])){

                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $fullname = $_POST['fullname'];
                  $pass = md5($_POST['pass']);
                  $email = $_POST['email'];
                  $phone = $_POST['phone'];
                  $address = $_POST['address'];
                  $pan_no = $_POST['pan_no'];
                  $sales    = $_POST['sales'];
                  $cost     = $_POST['cost'];
                  $profit   = $_POST['profit'];
                  $role = $_POST['role'];
                  $status = $_POST['status'];
                  
                  $sql = $result->insert($fname, $lname, $fullname, $emp_id, $pass, $email, $phone, $address, $pan_no, $sales, $cost, $profit, $role, $status);

                  if ($sql) {                          
                    $_SESSION['success'] = "New User added successfully";   
                    header('location:user_view.php');
                  }
                  else{
                    $_SESSION['error'] = "User not created / Email Already exist!";   
                    header('location:user_view.php');
                  }                  
                }
              ?>                

              <script type="text/javascript">  
                function validate(){  
                var firstpassword=document.myform.pass.value;  
                var secondpassword=document.myform.pass1.value;  
                  
                  if(firstpassword==secondpassword){  
                    return true;  
                  } 
                  else if(firstpassword.length<6){  
                    alert("Password must be at least 6 characters long.");  
                    return false;  
                  }   
                  else{  
                    alert("password must be same!");  
                    return false;  
                  }  
                }  
                </script>                  

                <form method="post" name="myform" onsubmit="return validate()">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Enter the first name" name="fname" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="lname" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter the email" name="email" required>
                      </div>                      
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone" name="phone" required>
                      </div>
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter the password" name="pass" required>
                      </div>                      
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Re Password</label>
                        <input type="password" class="form-control" placeholder="Enter the password" name="pass1" required>
                      </div>                      
                    </div>
                  </div>               

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" placeholder="Enter the address" name="address" required></textarea>
                      </div>
                    </div>   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>PAN No</label>
                        <input type="text" class="form-control" placeholder="Enter the PAN" name="pan_no" required>
                      </div>
                    </div>                                     
                  </div>

                  <div class="row">                    
                    <div class="col-md-4">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Sales Account</label>
                        <input type="number" class="form-control" placeholder="Enter the Sales cost" id="sales" name="sales" onkeyup="sumProfit()" required>
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Cost Account</label>
                        <input type="number" class="form-control" placeholder="Enter the Cost" id="cost" name="cost" onkeyup="sumProfit()" required>
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Profit Margin</label>
                        <input type="number" class="form-control" id="profit" step="any" name="profit" required readonly>
                      </div>
                    </div>           
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>User type</label>
                          <select class="form-control" name="role" required>
                            <option value="" selected disabled>-- Select User Type --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Advanced User (TA+CRM+CV)</option>
                            <option value="3">Moderate User (TA+CV)</option>
                            <option value="4">Sales User (TA+CRM)</option>
                            <option value="5">Finance User IN (FI + CLOTHING)</option>  
                            <option value="6">Finance User SV (FI + CLOTHING)</option> 
                            <option value="7">Auditor User IN (FI Only)</option> 
                            <option value="8">Auditor User SV (FI Only)</option>                          
                            <option value="0">Gerneral User (TA)</option>
                          </select>          
                      </div> 
                    </div>
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
                        <button type="submit" class="btn btn-zg" name="submit">Submit</button>
                      </div>
                    </div>                    
                  </div>                  
                </form>              
              </div>
            <!-- /.card -->
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

function sumProfit(){
  var sales = parseInt(document.getElementById("sales").value);
  var cost = parseInt(document.getElementById("cost").value);
  var sal1 = sales - cost;
  //document.getElementById("profit").value = (parseInt(sal1) / parseInt(cost)*100).toFixed(2);    
  document.getElementById("profit").value = (parseInt(sal1) / parseInt(sales)*100).toFixed(2);    
}

</script>