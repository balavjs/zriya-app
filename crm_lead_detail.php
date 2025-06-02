<?php
  $title = "CRM Leads Detail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_lead.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lead</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_lead_view.php">CRM Lead</a></li>
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
                <h3 class="card-title">Lead Details</h3>
              </div>
                  
              <div class="card-body">
                <a href="crm_lead_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Lead</button>
                </a><br><br>
                <table id="example1" class="table">                  
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_crm_lead();
                    $sql = $result->get_one_crm_lead($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                       
                  ?>  
                  <tr>                    
                    <th>Date</th>
                    <td>
                      <?php $date = strtotime($list['date']); echo date('d-m-Y', $date); ?>
                    </td>
                  </tr>
                  <tr>                    
                    <th>Lead Owner</th>
                    <td><?php echo $list['lead_owner'];?></td>
                  </tr>
                  <tr>                    
                    <th>Company Name</th>
                    <td><?php echo $list['company'];?></td>
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
                    <th>Secondary Email</th>
                    <td><?php echo $list['semail'];?></td>
                  </tr>
                  <tr>                    
                    <th>Website</th>
                    <td><?php echo $list['website'];?></td>
                  </tr>
                  <tr>                    
                    <th>Title</th>
                    <td><?php echo $list['title'];?></td>
                  </tr>                      
                  <tr>                    
                    <th>Description</th>
                    <td><?php echo $list['description'];?></td>
                  </tr>
                  <tr>                    
                    <th>Lead Source</th>
                    <td><?php echo $list['lead_source'];?></td>
                  </tr>
                  <tr>                    
                    <th>Lead Status</th>
                    <td><?php echo $list['lead_status'];?></td>
                  </tr>
                  <tr>                    
                    <th>Industry</th>
                    <td><?php echo $list['industry'];?></td>
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
                <h3 class="card-title">Lead Details</h3>
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
