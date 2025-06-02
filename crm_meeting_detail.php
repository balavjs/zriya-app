<?php
  $title = "CRM Meetings Detail | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_meeting.php'); ?>
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
            <h1>Meetings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_meeting_view.php">CRM Meeting</a></li>
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
                <h3 class="card-title">Meeting Details</h3>
              </div>
                 
              <div class="card-body">
                <a href="crm_meeting_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Meetings</button>
                </a><br><br>
                <table id="example1" class="table">
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_crm_meeting();
                    $sql = $result->get_one_crm_meeting($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                       
                  ?>  
                  <tr>                    
                    <th>Host</th>
                    <td><?php echo $list['host'];?></td>
                  </tr>
                  <tr>                    
                    <th>Host Email</th>
                    <td><?php echo $list['host_email'];?></td>
                  </tr>
                  <tr>                    
                    <th>From Date</th>
                    <td>
                      <?php $date = strtotime($list['from_date']); echo date('d-m-Y - h:i A', $date); ?>
                    </td>
                  </tr>
                  <tr>                    
                    <th>To Date</th>
                    <td>
                      <?php $date1 = strtotime($list['to_date']); echo date('d-m-Y - h:i A', $date1); ?>
                    </td>
                  </tr>
                  <tr>                    
                    <th>Participants</th>
                    <td><?php echo $list['participants'];?></td>
                  </tr>
                  <tr>                    
                    <th>Subject</th>
                    <td><?php echo $list['subject'];?></td>
                  </tr>

                  <?php 
                    $description = $list['description'];
                    if($description != ""){
                  ?>
                  <tr>                    
                    <th>Description</th>
                    <td><?php echo $description;?></td>
                  </tr>
                  <?php  
                    }
                  } 
                  ?>             
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
                <h3 class="card-title">Meeting Details</h3>
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
