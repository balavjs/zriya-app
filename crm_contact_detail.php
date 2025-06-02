<?php
  $title = "CRM Contacts Detail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_contact.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_contact_view.php">CRM Contact</a></li>
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

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Contact Details</h3>
              </div>
                  
              <div class="card-body">
                <a href="crm_contact_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Contact</button>
                </a><br><br>
                <table id="example1" class="table">                      
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_crm_contact();
                    $sql = $result->get_one_crm_contact($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                       
                  ?>                   
                  <tr>                    
                    <th>Contact Owner</th>
                    <td><?php echo $list['contact_owner'];?></td>
                  </tr>
                  <tr>                    
                    <th>Lead Source</th>
                    <td><?php echo $list['lead_source'];?></td>
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
                    <th>Account Name</th>
                    <td><?php echo $list['acc_name'];?></td>
                  </tr>
                  <tr>                    
                    <th>Vendor Name</th>
                    <td><?php echo $list['vendor_name'];?></td>
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
                    <th>Secondary Email</th>
                    <td><?php echo $list['semail'];?></td>
                  </tr>
                  <tr>                    
                    <th>Alternate Phone</th>
                    <td><?php echo $list['sphone'];?></td>
                  </tr>
                  <tr>                    
                    <th>Title</th>
                    <td><?php echo $list['title'];?></td>
                  </tr>
                  <tr>                    
                    <th>Department</th>
                    <td><?php echo $list['department'];?></td>
                  </tr>                      
                  <tr>                    
                    <th>Description</th>
                    <td><?php echo $list['description'];?></td>
                  </tr>                      
                  <tr>                    
                    <th>Street</th>
                    <td><?php echo $list['street'];?></td>
                  </tr>
                  <tr>                    
                    <th>City</th>
                    <td><?php echo $list['city'];?></td>
                  </tr>
                  <tr>                    
                    <th>State</th>
                    <td><?php echo $list['state'];?></td>
                  </tr>
                  <tr>                    
                    <th>Country</th>
                    <td><?php echo $list['country'];?></td>
                  </tr>
                  <tr>                    
                    <th>Zip</th>
                    <td><?php echo $list['zip'];?></td>
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
                <h3 class="card-title">Contact Details</h3>
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



