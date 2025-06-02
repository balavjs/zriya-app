<?php
  $title = "CRM Deals Detail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_deal.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Deals</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_deal_view.php">CRM Deal</a></li>
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
                <h3 class="card-title">Deal Details</h3>
              </div>

              <div class="card-body">
                <a href="crm_deal_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Deal</button>
                </a><br><br>
                <table id="example1" class="table">
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_crm_deal();
                    $sql = $result->get_one_crm_deal($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;   
                      $cont_id = $list['contact'];                                    
                  ?>  
                  <tr>                    
                    <th>Deal Owner</th>
                    <td><?php echo $list['deal_owner'];?></td>
                  </tr>
                  <tr>                    
                    <th>Deal Name</th>
                    <td><?php echo $list['deal_name'];?></td>
                  </tr>
                  <tr>                    
                    <th>Deal Type</th>
                    <td><?php echo $list['type'];?></td>
                  </tr>
                  <tr>                    
                    <th>Next Step</th>
                    <td><?php echo $list['next_step'];?></td>
                  </tr>
                  <tr>                    
                    <th>Lead Source</th>
                    <td><?php echo $list['lead_source'];?></td>
                  </tr>
                  <?php              
                  $sql1 = $result->list_crm_contact_user($cont_id);
                  foreach ($sql1 as $list1) {                           
                  ?>
                  <tr>         
                    <th>Contact Name</th>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>                        
                  </tr>  
                  <tr>         
                    <th>Email</th>
                    <td><?php echo $list1['email'];?><?php echo ", " .$list1['semail'];?></td>                        
                  </tr>  
                  <tr>         
                    <th>Phone</th>
                    <td><?php echo $list1['phone'];?><?php echo ", " .$list1['sphone'];?></td>                        
                  </tr>  
                  <?php                      
                  }
                  ?> 
                  <tr>                    
                    <th>Amount (SEK)</th>
                    <td><?php echo $list['amount'];?></td>
                  </tr>
                  <tr>                    
                    <th>Close Date</th>
                    <td>
                      <?php $date = strtotime($list['close_date']); echo date('d-m-Y', $date); ?>
                    </td>
                  </tr> 
                  <tr>                    
                    <th>Stage</th>
                    <td><?php echo $list['stage'];?></td>
                  </tr>
                  <tr>                    
                    <th>Probability (%)</th>
                    <td><?php echo $list['probability'];?>%</td>
                  </tr> 
                  <tr>                    
                    <th>Expected Revenue (SEK)</th>
                    <td><?php echo $list['exp_revenue'];?></td>
                  </tr>               
                  <tr>                    
                    <th>Description</th>
                    <td><?php echo $list['description'];?></td>
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
   
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Deal Details</h3>
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
