<?php
  $title = "CRM | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_deal.php'); ?>
<?php include('class/class_crm_task.php'); ?>
<?php include('class/class_crm_call.php'); ?>
<?php include('class/class_crm_meeting.php'); ?>
<?php include('class/class_crm_lead.php'); ?>
<?php include('class/class_crm_contact.php'); ?>
<?php include('class/class_crm_account.php'); ?>
<?php include('class/class_crm_vendor.php'); ?>

<?php  
  $result_usr = new User();    
  $sql_usr = $result_usr->getonerecord($id);

  foreach ($sql_usr as $list_data) {  
  $id = $list_data['id'];                  
  $name1 = $list_data['fullname'];
  $role = $list_data['role'];
?>

<style type="text/css">
  #dash_grid .icon img{
    position: absolute;
    right: 15px;
    top: 15px;
  }
  #dash_grid .small-box p{
      margin-bottom: 0 !important;
  }
  .card-zg1{
    background-color: #1d4f5c;
    color: #fff !important;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CRM Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CRM Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php

      $result = new DB_crm_deal();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql = $result->list_crm_deal();
      }
      else{
        $sql = $result->get_one_crm_deal($id);
      }
      $num_deal = mysqli_num_rows($sql);
      /* end deal */

      $result1 = new DB_crm_task();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql1 = $result1->list_crm_task();
      }
      else{
        $sql1 = $result1->get_one_crm_task($id);
      }
      $num_task = mysqli_num_rows($sql1);
      /* end task */

      $result2 = new DB_crm_call();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql2 = $result2->list_crm_call();
      }
      else{
        $sql2 = $result2->get_one_crm_call($id);
      }
      $num_call = mysqli_num_rows($sql2);
      /* end call */

      $result3 = new DB_crm_meeting();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql3 = $result3->list_crm_meeting();
      }
      else{
        $sql3 = $result3->get_one_crm_meeting($id);
      }
      $num_meeting = mysqli_num_rows($sql3);
      /* end meeting */

      $result4 = new DB_crm_lead();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql4 = $result4->list_crm_lead();
      }
      else{
        $sql4 = $result4->get_one_crm_lead($id);
      }
      $num_lead = mysqli_num_rows($sql4);
      /* end meeting */

      $result5 = new DB_crm_contact();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql5 = $result5->list_crm_contact();
      }
      else{
        $sql5 = $result5->get_one_crm_contact($id);
      }
      $num_contact = mysqli_num_rows($sql5);
      /* end meeting */

      $result6 = new DB_crm_account();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql6 = $result6->list_crm_account();
      }
      else{
        $sql6 = $result6->get_one_crm_account($id);
      }
      $num_account = mysqli_num_rows($sql6);
      /* end meeting */

      $result7 = new DB_crm_vendor();         
      if($role == 1 || $role == 2 || $role == 4){ 
        $sql7 = $result7->list_crm_vendor();
      }
      else{
        $sql7 = $result7->get_one_crm_vendor($id);
      }
      $num_vendor = mysqli_num_rows($sql7);
      /* end meeting */

    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="dash_grid">          
          <?php 
          if($role == 1 || $role == 2 || $role == 4){ 
          ?> 
          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_deal; ?></h4>
                <p>My Deals</p>
              </div>
              <div class="icon">
                <img src="dist/img/deal.png">
              </div>
              <a href="crm_deal_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  

          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_task; ?></h4>
                <p>My Tasks</p>
              </div>
              <div class="icon">
                <img src="dist/img/task.png">
              </div>
              <a href="crm_task_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  

          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_call; ?></h4>
                <p>My Calls</p>
              </div>
              <div class="icon">
                <img src="dist/img/call.png">
              </div>
              <a href="crm_call_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>   
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_meeting; ?></h4>
                <p>My Meetings</p>
              </div>
              <div class="icon">
                <img src="dist/img/meeting.png">
              </div>
              <a href="crm_meeting_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  

          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_lead; ?></h4>
                <p>My Leads</p>
              </div>
              <div class="icon">
                <img src="dist/img/lead.png">
              </div>
              <a href="crm_lead_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_contact; ?></h4>
                <p>My Contacts</p>
              </div>
              <div class="icon">
                <img src="dist/img/contact.png">
              </div>
              <a href="crm_contact_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_account; ?></h4>
                <p>My Accounts</p>
              </div>
              <div class="icon">
                <img src="dist/img/accounts.png">
              </div>
              <a href="crm_account_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_vendor; ?></h4>
                <p>My Vendors</p>
              </div>
              <div class="icon">
                <img src="dist/img/vendor.png">
              </div>
              <a href="crm_vendor_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <hr><br>
        
        <div class="row">
          <div class="col-sm-6"> 
            <div class="card">
              <div class="card-header card-zg1">
                <h3 class="card-title"><i class="fas fa-phone-alt"></i> Today's Call</h3>
              </div>                
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="crm_call" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>                    
                    <th>Call To</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $today = date('Y-m-d');
                    $result = new DB_crm_call();
                    $sql = $result->list_crm_call_today($today);   
                    //echo $sql;
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;        
                      $cont_id = $list['call_to'];                            
                    ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <?php                      
                      $sql1 = $result->list_crm_contact_user($cont_id);
                      foreach ($sql1 as $list1) {                        
                    ?>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    <?php                    
                      }
                    ?> 
                    <td><?php $date = strtotime($list['call_date']); echo date('d-m-Y', $date); ?></td>                
                                      
                    <td>                      
                      <a href="crm_call_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg"  data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                    </td>                    
                  </tr>
                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>                    
                    <th>Call To</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="col-sm-6"> 
            <div class="card">
              <div class="card-header card-zg1">
                <h3 class="card-title"><i class="fas fa-users"></i> Today's Meeting</h3>
              </div>                
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="crm_meeting" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Start Date</th>
                    <th>Subject</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $today = date('Y-m-d');
                    //echo $today;
                    $result = new DB_crm_meeting();
                    $sql = $result->list_crm_meeting_today($today);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                   
                    ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <td>
                      <?php $date = strtotime($list['from_date']); echo date('d-m-Y', $date); ?>
                    </td>
                    <td><?php echo $list['subject'];?></td>                 
                    <td>                      
                      <a href="crm_meeting_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg"  data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                    </td>                    
                  </tr>
                  <?php
                  }
                  ?>                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Start Date</th>
                    <th>Subject</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6"> 
            <div class="card">
              <div class="card-header card-zg1">
                <h3 class="card-title"><i class="fas fa-tasks"></i> Today's Task</h3>
              </div>                
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="crm_task" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>                    
                    <th>Contact</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $today = date('Y-m-d');
                    $result = new DB_crm_task();
                    $sql = $result->list_crm_task_today($today);   
                    //echo $sql;
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;        
                      $cont_id = $list['contact'];                            
                    ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <?php                      
                      $sql1 = $result->list_crm_contact_user($cont_id);
                      foreach ($sql1 as $list1) {                        
                    ?>
                    <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                    <?php                    
                      }
                    ?> 
                    <td><?php $date = strtotime($list['due_date']); echo date('d-m-Y', $date); ?></td>                
                                      
                    <td>                      
                      <a href="crm_task_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg"  data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a> 
                    </td>                    
                  </tr>
                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>                    
                    <th>Call To</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="col-sm-6"> 
            <div class="card">
              <div class="card-header card-zg1">
                <h3 class="card-title"><i class="fas fa-handshake"></i> Today's Deal</h3>
              </div>                
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="crm_deal" class="table">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Deal Name</th>
                    <th>End Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $today = date('Y-m-d');
                    $result = new DB_crm_deal();
                    $sql = $result->list_crm_deal_today($today);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;     
                      $cont_id = $list['contact'];                              
                    ?>

                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list['deal_name'];?></td>
                    <td><?php $date = strtotime($list['close_date']); echo date('d-m-Y', $date); ?></td>                               
                    <td>                      
                      <a href="crm_deal_detail.php?id=<?php echo $list['id'];?>" target="_blank"><button class="btn btn-zg" data-toggle="tooltip" data-placement="top" title="View"><i class="nav-icon fas fa-eye"></i></button></a>
                    </td>                    
                  </tr>
                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Deal Name</th>
                    <th>End Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        else{ ?>
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Lead List</h3>
              </div>                
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row (main row) -->
        <?php
        }
        ?>             
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
}
?>

</div>
<!-- /.content-wrapper -->
  
<?php include('footer.php'); ?>

<!-- Page specific script -->
<script> 
  $(function () {
    $('#crm_call').DataTable({
    dom: 'lrtip',
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });    
  });

  $(function () {
    $('#crm_meeting').DataTable({
    dom: 'lrtip',   
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });    
  });
  $(function () {
    $('#crm_task').DataTable({
    dom: 'lrtip',   
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });    
  });
   $(function () {
    $('#crm_deal').DataTable({
    dom: 'lrtip',   
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });    
  });
</script>
