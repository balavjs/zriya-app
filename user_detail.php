<?php
  $title = "User Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_users.php'); ?>
<style type="text/css">
.table thead th{
  vertical-align: top;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
	  
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">User Details</h3>
              </div>       

              <div class="card-body">
                <a href="user_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Users</button>
                </a><br><br>
                <table id="example1" class="table">                  
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_user();
                    $sql = $result->get_one_user($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                   
                  ?>                     
                  <tr>                    
                    <th>Employee ID</th>
                    <td><?php echo $list['emp_id'];?></td>
                  </tr>
                  <tr>                    
                    <th>First Name</th>
                    <td><?php echo $list['fname'];?></td>
                  </tr>
                  <tr>                    
                    <th>Last Name</th>
                    <td><?php echo $list['lname'];?></td>
                  </tr>
                  <tr>                    
                    <th>Email</th>
                    <td><?php echo $list['email'];?></td>
                  </tr>
                  <tr>                    
                    <th>Phone</th>
                    <td><?php echo $list['phone'];?></td>
                  </tr>
                  <tr>                    
                    <th>Address</th>
                    <td><?php echo $list['address'];?></td>
                  </tr>
                  <tr>                    
                    <th>PAN No</th>
                    <td><?php echo $list['pan_no'];?></td>
                  </tr>
                  <tr>                    
                    <th>Sales Account</th>
                    <td><?php echo $list['sales'];?></td>
                  </tr>
                  <tr>                    
                    <th>Cost Account</th>
                    <td><?php echo $list['cost'];?></td>
                  </tr>
                  <tr>                    
                    <th>Profit Margin</th>
                    <td><?php echo $list['profit'];?></td>
                  </tr>
                  <tr>                    
                    <th>User Role</th>                    
                    <td>
                      <?php 

                        $user_role = $list['role'];

                        if($user_role == 1){
                          echo "Administrator";                              
                        }
                        elseif($user_role == 2){
                           echo "Advanced User";                               
                        }   
                        elseif($user_role == 3){
                           echo "Moderate User";                               
                        }
                        elseif($user_role == 4){
                           echo "Sales User";                               
                        }
                        elseif($user_role == 5){
                           echo "Finance User";                               
                        }
                        elseif($user_role == 0){
                           echo "Gerneral User";                               
                        }            
                      ?>
                    </td>
                  </tr>
                  <tr>                    
                    <th>Status</th>                    
                    <td>
                      <?php 
                        $user_status = $list['status'];
                        if($user_status == 1){
                          //echo "Active"; 
                          ?>
                          <p class="text-success">
                            <b><i class="fas fa-check-circle"></i> Active</b>
                          </p>
                          
                        <?php
                        }
                        else{
                           //echo "Inactive";
                          ?>
                          <p class="text-danger">
                            <b><i class="fas fa-times-circle"></i> Inactive</b>
                          </p>
                          
                        <?php  
                        }                  
                        }
                      ?>
                    </td>                    
                  </tr>                  
                </table>
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
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">User Details</h3>
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
