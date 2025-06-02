<?php
  $title = "CRM Accounts Detail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_account.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_account_view.php">CRM Accounts</a></li>
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
      
        if($role == 1 || $role == 2 || $role == 4){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Account Details</h3>
              </div>

              <div class="card-body">                
                <a href="crm_account_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Accounts</button>
                </a><br><br>

                <table id="example1" class="table">                  
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_crm_account();
                    $sql = $result->get_one_crm_account($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                       
                  ?> 
                  <tr>                    
                    <th width="40%">Account Owner</th>
                    <td><?php echo $list['acc_owner'];?></td>
                  </tr>
                  <tr>                    
                    <th>Account Name</th>
                    <td><?php echo $list['acc_name'];?></td>
                  </tr>
                  <tr>                    
                    <th>Account Site</th>
                    <td><?php echo $list['acc_site'];?></td>
                  </tr>
                  <tr>                    
                    <th>Account No</th>
                    <td><?php echo $list['acc_no'];?></td>
                  </tr>
                  <tr>                    
                    <th>Account type</th>
                    <td><?php echo $list['acc_type'];?></td>
                  </tr>
                  <tr>                    
                    <th>Industry</th>
                    <td><?php echo $list['industry'];?></td>
                  </tr>
                  <tr>                    
                    <th>Annual Revenue (SEK)</th>
                    <td><?php echo $list['revenue'];?></td>
                  </tr>
                  <tr>                    
                    <th>Rating</th>
                    <td><?php echo $list['rating'];?></td>
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
                    <th>Website</th>
                    <td><?php echo $list['website'];?></td>
                  </tr>
                  <tr>                    
                    <th>Ownership</th>
                    <td><?php echo $list['ownership'];?></td>
                  </tr>
                  <tr>                    
                    <th>Employees</th>
                    <td><?php echo $list['employees'];?></td>
                  </tr>
                  <tr>                    
                    <th>SIC Code</th>
                    <td><?php echo $list['sic_code'];?></td>
                  </tr>
                  <tr>                    
                    <th>Description</th>
                    <td><?php echo $list['description'];?></td>
                  </tr>
                  <tr>                    
                    <th>Billing Street</th>
                    <td><?php echo $list['bill_street'];?></td>
                  </tr>
                  <tr>                    
                    <th>Billing City</th>
                    <td><?php echo $list['bill_city'];?></td>
                  </tr>
                  <tr>                    
                    <th>Billing State</th>
                    <td><?php echo $list['bill_state'];?></td>
                  </tr>
                  <tr>                    
                    <th>Billing Zip Code</th>
                    <td><?php echo $list['bill_zip'];?></td>
                  </tr>
                  <tr>                    
                    <th>Billing Country</th>
                    <td><?php echo $list['bill_country'];?></td>
                  </tr>
                  <tr>                    
                    <th>Shipping Street</th>
                    <td><?php echo $list['ship_street'];?></td>
                  </tr>
                  <tr>                    
                    <th>Shipping City</th>
                    <td><?php echo $list['ship_city'];?></td>
                  </tr>
                  <tr>                    
                    <th>Shipping State</th>
                    <td><?php echo $list['ship_state'];?></td>
                  </tr>
                  <tr>                    
                    <th>Shipping Zip Code</th>
                    <td><?php echo $list['ship_zip'];?></td>
                  </tr>
                  <tr>                    
                    <th>Shipping Country</th>
                    <td><?php echo $list['ship_country'];?></td>
                  </tr>
                  
                  <tr>                    
                    <th>Status</th>                    
                    <td>
                      <?php 
                        $dep_status = $list['status'];
                        if($dep_status == 1){                              
                      ?>
                      <p class="text-success">
                        <b><i class="fas fa-check-circle"></i> Active</b>
                      </p>
                        
                      <?php
                      }
                      else{
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
                <h3 class="card-title">Account Details</h3>
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
