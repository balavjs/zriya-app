<?php
  $title = "Time Accounts Admin Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_time_accounts.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Time Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Update Time Accounts Details</li>
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
                <h3 class="card-title">Update Time Accounts Details</h3>
              </div>        

              <?php  
                $result_usr = new User();                
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id1 = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];

                  if($role == 1){ 
              ?>

              <div class="card-body"> 

              <?php
                $result=new DB_time_accounts();

                if(isset($_POST['update'])){
                                     
                  $id = $_GET['id'];                 
                  
                  $emp_id         = $_POST['emp_id'];
                  $project_name   = $_POST['project_name'];
                  $acc_cust       = $_POST['acc_cust'];
                  $work_date      = $_POST['work_date'];
                  $hour           = $_POST['hour'];
                  $in_time        = $_POST['in_time'];
                  $out_time       = $_POST['out_time']; 
                  $off_day        = $_POST['off_day'];
                  $dstatus        = $_POST['dstatus'];             
                  $status         = $_POST['status'];
                  $id1            = $_POST['id1']; 

                  $sql = $result->update($id, $id1, $emp_id, $project_name, $acc_cust, $work_date, $hour, $in_time, $out_time, $off_day, $dstatus, $status);

                  if ($sql) {  
                    $_SESSION['success'] = "Updated Successfully!";   
                    header('location:time_accounts_admin_view.php');                  
                  }
                  else{
                    $_SESSION['error'] = "Not Updated";   
                    header('location:time_accounts_admin_view.php');   
                  } 
                }
              ?>               

                <form method="post" onsubmit="enableSample();">

                  <?php

                    $id = $_GET['id'];
                    $result1 = new DB_time_accounts();
                    $sql1 = $result1->get_one_time_accounts($id);   

                    while($row = mysqli_fetch_array($sql1)){   

                  ?>

                  <div class="row">                    
                  <div class="col-sm-4">
                    <label>Employee ID</label>                  
                    
                    <?php                      
                      $emp_id = $list_data['id'];               
                      $result1 = new DB_user();
                      $sql1 = $result1->get_emp_id_user($emp_id);

                      if (is_array($sql1) || is_object($sql1)){
                        foreach ($sql1 as $list1) {  
                    ?>
                    <p><?php echo $list1['emp_id']; ?></p>   
                    <input type="hidden" name="emp_id" value="<?php echo $list1['id']; ?>">                    
                  </div>   
                  <div class="col-sm-4">
                    <label>Name</label>                       
                    <p><?php echo $list1['fname']; ?> <?php echo $list1['lname']; ?> </p>                   
                    <?php
                      }
                    }
                    ?>
                  </div>                     
                </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table" id="h_apnd">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="8" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Time Account Details</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                          </tr>
                          <tr>                     
                            <th>Project Name</th>
                            <th>Customer A/C</th>
                            <th>Date</th>
                            <th>Hour</th>
                            <th>In time</th>
                            <th>Out time</th>
                            <th>Off Day</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>  
                        </thead>
                        <tbody>

                        <?php  
                        $result2 = new DB_time_accounts();                        
                        $sql2 = $result2->list_time_accounts_my($id);  

                          
                        $i=0;   
                        if (is_array($sql2) || is_object($sql2)){          
                        foreach ($sql2 as $list2) { 
                          $i++;
                          $id1 = $list2['id'];   
                          $dstatus = $list2['dstatus'];    
                          //echo  $dstatus;                 
                       
                        ?>
                          <tr class="ap_rw" id="tr_rows"> 
                            <input type="hidden" class="form-control" name="time_acc_id[]" required value="<?php echo $list2['time_acc_id'];?>">  
                            <input type="hidden" class="form-control" name="id1[]" required value="<?php echo $id1;?>">                                             
                            <td><input type="text" class="form-control" name="project_name[]" required value="<?php echo $list2['project_name'];?>"></td> 
                            <td><input type="text" class="form-control" name="acc_cust[]" required value="<?php echo $list2['acc_cust'];?>"></td>
                            <td><input type="date" class="form-control" name="work_date[]" required value="<?php echo $list2['work_date'];?>"></td>                   
                            <td width="110px"><input type="number" class="form-control hour" data-id="<?php echo $i;?>" id="hour_<?php echo $i;?>" name="hour[]" required step="0.25" value="<?php echo $list2['hour'];?>"></td>   
                            <td width="140px">
                              <select class="form-control in_time" data-id="<?php echo $i;?>" id="in_time_<?php echo $i;?>" name="in_time[]" required>
                                <option value="None" selected disabled>-Select-</option>
                                <option value="00:00:00" <?php if($list2['in_time']=='00:00:00'){echo "selected='selected'";} ?>>12:00 am</option>
                                <option value="00:15:00" <?php if($list2['in_time']=='00:15:00'){echo "selected='selected'";} ?>>12:15 am</option>
                                <option value="00:30:00" <?php if($list2['in_time']=='00:30:00'){echo "selected='selected'";} ?>>12:30 am</option>
                                <option value="00:45:00" <?php if($list2['in_time']=='00:45:00'){echo "selected='selected'";} ?>>12:45 am</option>
                                <option value="01:00:00" <?php if($list2['in_time']=='01:00:00'){echo "selected='selected'";} ?>>01:00 am</option>
                                <option value="01:15:00" <?php if($list2['in_time']=='01:15:00'){echo "selected='selected'";} ?>>01:15 am</option>
                                <option value="01:30:00" <?php if($list2['in_time']=='01:30:00'){echo "selected='selected'";} ?>>01:30 am</option>
                                <option value="01:45:00" <?php if($list2['in_time']=='01:45:00'){echo "selected='selected'";} ?>>01:45 am</option>
                                <option value="02:00:00" <?php if($list2['in_time']=='02:00:00'){echo "selected='selected'";} ?>>02:00 am</option>
                                <option value="02:15:00" <?php if($list2['in_time']=='02:15:00'){echo "selected='selected'";} ?>>02:15 am</option>>
                                <option value="02:30:00" <?php if($list2['in_time']=='02:30:00'){echo "selected='selected'";} ?>>02:30 am</option>>
                                <option value="02:45:00" <?php if($list2['in_time']=='02:45:00'){echo "selected='selected'";} ?>>02:45 am</option>
                                <option value="03:00:00" <?php if($list2['in_time']=='03:00:00'){echo "selected='selected'";} ?>>03:00 am</option>
                                <option value="03:15:00" <?php if($list2['in_time']=='03:15:00'){echo "selected='selected'";} ?>>03:15 am</option>
                                <option value="03:30:00" <?php if($list2['in_time']=='03:30:00'){echo "selected='selected'";} ?>>03:30 am</option>                                
                                <option value="03:45:00" <?php if($list2['in_time']=='03:45:00'){echo "selected='selected'";} ?>>03:45 am</option>
                                <option value="04:00:00" <?php if($list2['in_time']=='04:00:00'){echo "selected='selected'";} ?>>04:00 am</option>
                                <option value="04:15:00" <?php if($list2['in_time']=='04:15:00'){echo "selected='selected'";} ?>>04:15 am</option>
                                <option value="04:30:00" <?php if($list2['in_time']=='04:30:00'){echo "selected='selected'";} ?>>04:30 am</option>
                                <option value="04:45:00" <?php if($list2['in_time']=='04:45:00'){echo "selected='selected'";} ?>>04:45 am</option>
                                <option value="05:00:00" <?php if($list2['in_time']=='05:00:00'){echo "selected='selected'";} ?>>05:00 am</option>
                                <option value="05:15:00" <?php if($list2['in_time']=='05:15:00'){echo "selected='selected'";} ?>>05:15 am</option>
                                <option value="05:30:00" <?php if($list2['in_time']=='05:30:00'){echo "selected='selected'";} ?>>05:30 am</option>
                                <option value="05:45:00" <?php if($list2['in_time']=='05:45:00'){echo "selected='selected'";} ?>>05:45 am</option>
                                <option value="06:00:00" <?php if($list2['in_time']=='06:00:00'){echo "selected='selected'";} ?>>06:00 am</option>
                                <option value="06:15:00" <?php if($list2['in_time']=='06:15:00'){echo "selected='selected'";} ?>>06:15 am</option>
                                <option value="06:30:00" <?php if($list2['in_time']=='06:30:00'){echo "selected='selected'";} ?>>06:30 am</option>
                                <option value="06:45:00" <?php if($list2['in_time']=='06:45:00'){echo "selected='selected'";} ?>>06:45 am</option>
                                <option value="07:00:00" <?php if($list2['in_time']=='07:00:00'){echo "selected='selected'";} ?>>07:00 am</option>
                                <option value="07:15:00" <?php if($list2['in_time']=='07:15:00'){echo "selected='selected'";} ?>>07:15 am</option>
                                <option value="07:30:00" <?php if($list2['in_time']=='07:30:00'){echo "selected='selected'";} ?>>07:30 am</option>                                
                                <option value="07:45:00" <?php if($list2['in_time']=='07:45:00'){echo "selected='selected'";} ?>>07:45 am</option>
                                <option value="08:00:00" <?php if($list2['in_time']=='08:00:00'){echo "selected='selected'";} ?>>08:00 am</option>
                                <option value="08:15:00" <?php if($list2['in_time']=='08:15:00'){echo "selected='selected'";} ?>>08:15 am</option>
                                <option value="08:30:00" <?php if($list2['in_time']=='08:30:00'){echo "selected='selected'";} ?>>08:30 am</option>
                                <option value="08:45:00" <?php if($list2['in_time']=='08:45:00'){echo "selected='selected'";} ?>>08:45 am</option>
                                <option value="09:00:00" <?php if($list2['in_time']=='09:00:00'){echo "selected='selected'";} ?>>09:00 am</option>
                                <option value="09:15:00" <?php if($list2['in_time']=='09:15:00'){echo "selected='selected'";} ?>>09:15 am</option>
                                <option value="09:30:00" <?php if($list2['in_time']=='09:30:00'){echo "selected='selected'";} ?>>09:30 am</option>
                                <option value="09:45:00" <?php if($list2['in_time']=='09:45:00'){echo "selected='selected'";} ?>>09:45 am</option>
                                <option value="10:00:00" <?php if($list2['in_time']=='10:00:00'){echo "selected='selected'";} ?>>10:00 am</option>
                                <option value="10:15:00" <?php if($list2['in_time']=='10:15:00'){echo "selected='selected'";} ?>>10:15 am</option>
                                <option value="10:30:00" <?php if($list2['in_time']=='10:30:00'){echo "selected='selected'";} ?>>10:30 am</option>
                                <option value="10:45:00" <?php if($list2['in_time']=='10:45:00'){echo "selected='selected'";} ?>>10:45 am</option>
                                <option value="11:00:00" <?php if($list2['in_time']=='11:00:00'){echo "selected='selected'";} ?>>11:00 am</option>
                                <option value="11:15:00" <?php if($list2['in_time']=='11:15:00'){echo "selected='selected'";} ?>>11:15 am</option>
                                <option value="11:30:00" <?php if($list2['in_time']=='11:30:00'){echo "selected='selected'";} ?>>11:30 am</option>
                                <option value="11:45:00" <?php if($list2['in_time']=='11:45:00'){echo "selected='selected'";} ?>>11:45 am</option>
                                <option value="12:00:00" <?php if($list2['in_time']=='12:00:00'){echo "selected='selected'";} ?>>12:00 pm</option>
                                <option value="12:15:00" <?php if($list2['in_time']=='12:15:00'){echo "selected='selected'";} ?>>12:15 pm</option>
                                <option value="12:30:00" <?php if($list2['in_time']=='12:30:00'){echo "selected='selected'";} ?>>12:30 pm</option>
                                <option value="12:45:00" <?php if($list2['in_time']=='12:45:00'){echo "selected='selected'";} ?>>12:45 pm</option>
                                <option value="13:00:00" <?php if($list2['in_time']=='13:00:00'){echo "selected='selected'";} ?>>01:00 pm</option>
                                <option value="13:15:00" <?php if($list2['in_time']=='13:15:00'){echo "selected='selected'";} ?>>01:15 pm</option>
                                <option value="13:30:00" <?php if($list2['in_time']=='13:30:00'){echo "selected='selected'";} ?>>01:30 pm</option>
                                <option value="13:45:00" <?php if($list2['in_time']=='13:45:00'){echo "selected='selected'";} ?>>01:45 pm</option>
                                <option value="14:00:00" <?php if($list2['in_time']=='14:00:00'){echo "selected='selected'";} ?>>02:00 pm</option>
                                <option value="14:15:00" <?php if($list2['in_time']=='14:15:00'){echo "selected='selected'";} ?>>02:15 pm</option>
                                <option value="14:30:00" <?php if($list2['in_time']=='14:30:00'){echo "selected='selected'";} ?>>02:30 pm</option>
                                <option value="14:45:00" <?php if($list2['in_time']=='14:45:00'){echo "selected='selected'";} ?>>02:45 pm</option>
                                <option value="15:00:00" <?php if($list2['in_time']=='15:00:00'){echo "selected='selected'";} ?>>03:00 pm</option>
                                <option value="15:15:00" <?php if($list2['in_time']=='15:15:00'){echo "selected='selected'";} ?>>03:15 pm</option>
                                <option value="15:30:00" <?php if($list2['in_time']=='15:30:00'){echo "selected='selected'";} ?>>03:30 pm</option>
                                <option value="15:45:00" <?php if($list2['in_time']=='15:45:00'){echo "selected='selected'";} ?>>03:45 pm</option>
                                <option value="16:00:00" <?php if($list2['in_time']=='16:00:00'){echo "selected='selected'";} ?>>04:00 pm</option>
                                <option value="16:15:00" <?php if($list2['in_time']=='16:15:00'){echo "selected='selected'";} ?>>04:15 pm</option>
                                <option value="16:30:00" <?php if($list2['in_time']=='16:30:00'){echo "selected='selected'";} ?>>04:30 pm</option>
                                <option value="16:45:00" <?php if($list2['in_time']=='16:45:00'){echo "selected='selected'";} ?>>04:45 pm</option>
                                <option value="17:00:00" <?php if($list2['in_time']=='17:00:00'){echo "selected='selected'";} ?>>05:00 pm</option>
                                <option value="17:15:00" <?php if($list2['in_time']=='17:15:00'){echo "selected='selected'";} ?>>05:15 pm</option>
                                <option value="17:30:00" <?php if($list2['in_time']=='17:30:00'){echo "selected='selected'";} ?>>05:30 pm</option>
                                <option value="17:45:00" <?php if($list2['in_time']=='17:45:00'){echo "selected='selected'";} ?>>05:45 pm</option>
                                <option value="18:00:00" <?php if($list2['in_time']=='18:00:00'){echo "selected='selected'";} ?>>06:00 pm</option>
                                <option value="18:15:00" <?php if($list2['in_time']=='18:15:00'){echo "selected='selected'";} ?>>06:15 pm</option>
                                <option value="18:30:00" <?php if($list2['in_time']=='18:30:00'){echo "selected='selected'";} ?>>06:30 pm</option>
                                <option value="18:45:00" <?php if($list2['in_time']=='18:45:00'){echo "selected='selected'";} ?>>06:45 pm</option>
                                <option value="19:00:00" <?php if($list2['in_time']=='19:00:00'){echo "selected='selected'";} ?>>07:00 pm</option>
                                <option value="19:15:00" <?php if($list2['in_time']=='19:15:00'){echo "selected='selected'";} ?>>07:15 pm</option>
                                <option value="19:30:00" <?php if($list2['in_time']=='19:30:00'){echo "selected='selected'";} ?>>07:30 pm</option>
                                <option value="19:45:00" <?php if($list2['in_time']=='19:45:00'){echo "selected='selected'";} ?>>07:30 pm</option>
                                <option value="20:00:00" <?php if($list2['in_time']=='20:00:00'){echo "selected='selected'";} ?>>08:00 pm</option>
                                <option value="20:15:00" <?php if($list2['in_time']=='20:15:00'){echo "selected='selected'";} ?>>08:15 pm</option>
                                <option value="20:30:00" <?php if($list2['in_time']=='20:30:00'){echo "selected='selected'";} ?>>08:30 pm</option>
                                <option value="20:45:00" <?php if($list2['in_time']=='20:45:00'){echo "selected='selected'";} ?>>08:45 pm</option>
                                <option value="21:00:00" <?php if($list2['in_time']=='21:00:00'){echo "selected='selected'";} ?>>09:00 pm</option>
                                <option value="21:15:00" <?php if($list2['in_time']=='21:15:00'){echo "selected='selected'";} ?>>09:15 pm</option>
                                <option value="21:30:00" <?php if($list2['in_time']=='21:30:00'){echo "selected='selected'";} ?>>09:30 pm</option>
                                <option value="21:45:00" <?php if($list2['in_time']=='21:45:00'){echo "selected='selected'";} ?>>09:45 pm</option>
                                <option value="22:00:00" <?php if($list2['in_time']=='22:00:00'){echo "selected='selected'";} ?>>10:00 pm</option>
                                <option value="22:15:00" <?php if($list2['in_time']=='22:15:00'){echo "selected='selected'";} ?>>10:15 pm</option>
                                <option value="22:30:00" <?php if($list2['in_time']=='22:30:00'){echo "selected='selected'";} ?>>10:30 pm</option>
                                <option value="22:45:00" <?php if($list2['in_time']=='22:45:00'){echo "selected='selected'";} ?>>10:45 pm</option>
                                <option value="23:00:00" <?php if($list2['in_time']=='23:00:00'){echo "selected='selected'";} ?>>11:00 pm</option>                                
                                <option value="23:15:00" <?php if($list2['in_time']=='23:15:00'){echo "selected='selected'";} ?>>11:15 pm</option>                               
                                <option value="23:30:00" <?php if($list2['in_time']=='23:30:00'){echo "selected='selected'";} ?>>11:30 pm</option>                               
                                <option value="23:45:00" <?php if($list2['in_time']=='23:45:00'){echo "selected='selected'";} ?>>11:45 pm</option>
                              </select>
                            </td>
                            <td width="140px">
                              <select class="form-control out_time" data-id="<?php echo $i;?>" id="out_time_<?php echo $i;?>" name="out_time[]" required>
                                <option value="None" selected disabled>-Select-</option>
                                <option value="00:00:00" <?php if($list2['out_time']=='00:00:00'){echo "selected='selected'";} ?>>12:00 am</option>
                                <option value="00:15:00" <?php if($list2['out_time']=='00:15:00'){echo "selected='selected'";} ?>>12:15 am</option>
                                <option value="00:30:00" <?php if($list2['out_time']=='00:30:00'){echo "selected='selected'";} ?>>12:30 am</option>
                                <option value="00:45:00" <?php if($list2['out_time']=='00:45:00'){echo "selected='selected'";} ?>>12:45 am</option>
                                <option value="01:00:00" <?php if($list2['out_time']=='01:00:00'){echo "selected='selected'";} ?>>01:00 am</option>
                                <option value="01:15:00" <?php if($list2['out_time']=='01:15:00'){echo "selected='selected'";} ?>>01:15 am</option>
                                <option value="01:30:00" <?php if($list2['out_time']=='01:30:00'){echo "selected='selected'";} ?>>01:30 am</option>
                                <option value="01:45:00" <?php if($list2['out_time']=='01:45:00'){echo "selected='selected'";} ?>>01:45 am</option>
                                <option value="02:00:00" <?php if($list2['out_time']=='02:00:00'){echo "selected='selected'";} ?>>02:00 am</option>
                                <option value="02:15:00" <?php if($list2['out_time']=='02:15:00'){echo "selected='selected'";} ?>>02:15 am</option>>
                                <option value="02:30:00" <?php if($list2['out_time']=='02:30:00'){echo "selected='selected'";} ?>>02:30 am</option>>
                                <option value="02:45:00" <?php if($list2['out_time']=='02:45:00'){echo "selected='selected'";} ?>>02:45 am</option>
                                <option value="03:00:00" <?php if($list2['out_time']=='03:00:00'){echo "selected='selected'";} ?>>03:00 am</option>
                                <option value="03:15:00" <?php if($list2['out_time']=='03:15:00'){echo "selected='selected'";} ?>>03:15 am</option>
                                <option value="03:30:00" <?php if($list2['out_time']=='03:30:00'){echo "selected='selected'";} ?>>03:30 am</option>                                
                                <option value="03:45:00" <?php if($list2['out_time']=='03:45:00'){echo "selected='selected'";} ?>>03:45 am</option>
                                <option value="04:00:00" <?php if($list2['out_time']=='04:00:00'){echo "selected='selected'";} ?>>04:00 am</option>
                                <option value="04:15:00" <?php if($list2['out_time']=='04:15:00'){echo "selected='selected'";} ?>>04:15 am</option>
                                <option value="04:30:00" <?php if($list2['out_time']=='04:30:00'){echo "selected='selected'";} ?>>04:30 am</option>
                                <option value="04:45:00" <?php if($list2['out_time']=='04:45:00'){echo "selected='selected'";} ?>>04:45 am</option>
                                <option value="05:00:00" <?php if($list2['out_time']=='05:00:00'){echo "selected='selected'";} ?>>05:00 am</option>
                                <option value="05:15:00" <?php if($list2['out_time']=='05:15:00'){echo "selected='selected'";} ?>>05:15 am</option>
                                <option value="05:30:00" <?php if($list2['out_time']=='05:30:00'){echo "selected='selected'";} ?>>05:30 am</option>
                                <option value="05:45:00" <?php if($list2['out_time']=='05:45:00'){echo "selected='selected'";} ?>>05:45 am</option>
                                <option value="06:00:00" <?php if($list2['out_time']=='06:00:00'){echo "selected='selected'";} ?>>06:00 am</option>
                                <option value="06:15:00" <?php if($list2['out_time']=='06:15:00'){echo "selected='selected'";} ?>>06:15 am</option>
                                <option value="06:30:00" <?php if($list2['out_time']=='06:30:00'){echo "selected='selected'";} ?>>06:30 am</option>
                                <option value="06:45:00" <?php if($list2['out_time']=='06:45:00'){echo "selected='selected'";} ?>>06:45 am</option>
                                <option value="07:00:00" <?php if($list2['out_time']=='07:00:00'){echo "selected='selected'";} ?>>07:00 am</option>
                                <option value="07:15:00" <?php if($list2['out_time']=='07:15:00'){echo "selected='selected'";} ?>>07:15 am</option>
                                <option value="07:30:00" <?php if($list2['out_time']=='07:30:00'){echo "selected='selected'";} ?>>07:30 am</option>                                
                                <option value="07:45:00" <?php if($list2['out_time']=='07:45:00'){echo "selected='selected'";} ?>>07:45 am</option>
                                <option value="08:00:00" <?php if($list2['out_time']=='08:00:00'){echo "selected='selected'";} ?>>08:00 am</option>
                                <option value="08:15:00" <?php if($list2['out_time']=='08:15:00'){echo "selected='selected'";} ?>>08:15 am</option>
                                <option value="08:30:00" <?php if($list2['out_time']=='08:30:00'){echo "selected='selected'";} ?>>08:30 am</option>
                                <option value="08:45:00" <?php if($list2['out_time']=='08:45:00'){echo "selected='selected'";} ?>>08:45 am</option>
                                <option value="09:00:00" <?php if($list2['out_time']=='09:00:00'){echo "selected='selected'";} ?>>09:00 am</option>
                                <option value="09:15:00" <?php if($list2['out_time']=='09:15:00'){echo "selected='selected'";} ?>>09:15 am</option>
                                <option value="09:30:00" <?php if($list2['out_time']=='09:30:00'){echo "selected='selected'";} ?>>09:30 am</option>
                                <option value="09:45:00" <?php if($list2['out_time']=='09:45:00'){echo "selected='selected'";} ?>>09:45 am</option>
                                <option value="10:00:00" <?php if($list2['out_time']=='10:00:00'){echo "selected='selected'";} ?>>10:00 am</option>
                                <option value="10:15:00" <?php if($list2['out_time']=='10:15:00'){echo "selected='selected'";} ?>>10:15 am</option>
                                <option value="10:30:00" <?php if($list2['out_time']=='10:30:00'){echo "selected='selected'";} ?>>10:30 am</option>
                                <option value="10:45:00" <?php if($list2['out_time']=='10:45:00'){echo "selected='selected'";} ?>>10:45 am</option>
                                <option value="11:00:00" <?php if($list2['out_time']=='11:00:00'){echo "selected='selected'";} ?>>11:00 am</option>
                                <option value="11:15:00" <?php if($list2['out_time']=='11:15:00'){echo "selected='selected'";} ?>>11:15 am</option>
                                <option value="11:30:00" <?php if($list2['out_time']=='11:30:00'){echo "selected='selected'";} ?>>11:30 am</option>
                                <option value="11:45:00" <?php if($list2['out_time']=='11:45:00'){echo "selected='selected'";} ?>>11:45 am</option>
                                <option value="12:00:00" <?php if($list2['out_time']=='12:00:00'){echo "selected='selected'";} ?>>12:00 pm</option>
                                <option value="12:15:00" <?php if($list2['out_time']=='12:15:00'){echo "selected='selected'";} ?>>12:15 pm</option>
                                <option value="12:30:00" <?php if($list2['out_time']=='12:30:00'){echo "selected='selected'";} ?>>12:30 pm</option>
                                <option value="12:45:00" <?php if($list2['out_time']=='12:45:00'){echo "selected='selected'";} ?>>12:45 pm</option>
                                <option value="13:00:00" <?php if($list2['out_time']=='13:00:00'){echo "selected='selected'";} ?>>01:00 pm</option>
                                <option value="13:15:00" <?php if($list2['out_time']=='13:15:00'){echo "selected='selected'";} ?>>01:15 pm</option>
                                <option value="13:30:00" <?php if($list2['out_time']=='13:30:00'){echo "selected='selected'";} ?>>01:30 pm</option>
                                <option value="13:45:00" <?php if($list2['out_time']=='13:45:00'){echo "selected='selected'";} ?>>01:45 pm</option>
                                <option value="14:00:00" <?php if($list2['out_time']=='14:00:00'){echo "selected='selected'";} ?>>02:00 pm</option>
                                <option value="14:15:00" <?php if($list2['out_time']=='14:15:00'){echo "selected='selected'";} ?>>02:15 pm</option>
                                <option value="14:30:00" <?php if($list2['out_time']=='14:30:00'){echo "selected='selected'";} ?>>02:30 pm</option>
                                <option value="14:45:00" <?php if($list2['out_time']=='14:45:00'){echo "selected='selected'";} ?>>02:45 pm</option>
                                <option value="15:00:00" <?php if($list2['out_time']=='15:00:00'){echo "selected='selected'";} ?>>03:00 pm</option>
                                <option value="15:15:00" <?php if($list2['out_time']=='15:15:00'){echo "selected='selected'";} ?>>03:15 pm</option>
                                <option value="15:30:00" <?php if($list2['out_time']=='15:30:00'){echo "selected='selected'";} ?>>03:30 pm</option>
                                <option value="15:45:00" <?php if($list2['out_time']=='15:45:00'){echo "selected='selected'";} ?>>03:45 pm</option>
                                <option value="16:00:00" <?php if($list2['out_time']=='16:00:00'){echo "selected='selected'";} ?>>04:00 pm</option>
                                <option value="16:15:00" <?php if($list2['out_time']=='16:15:00'){echo "selected='selected'";} ?>>04:15 pm</option>
                                <option value="16:30:00" <?php if($list2['out_time']=='16:30:00'){echo "selected='selected'";} ?>>04:30 pm</option>
                                <option value="16:45:00" <?php if($list2['out_time']=='16:45:00'){echo "selected='selected'";} ?>>04:45 pm</option>
                                <option value="17:00:00" <?php if($list2['out_time']=='17:00:00'){echo "selected='selected'";} ?>>05:00 pm</option>
                                <option value="17:15:00" <?php if($list2['out_time']=='17:15:00'){echo "selected='selected'";} ?>>05:15 pm</option>
                                <option value="17:30:00" <?php if($list2['out_time']=='17:30:00'){echo "selected='selected'";} ?>>05:30 pm</option>
                                <option value="17:45:00" <?php if($list2['out_time']=='17:45:00'){echo "selected='selected'";} ?>>05:45 pm</option>
                                <option value="18:00:00" <?php if($list2['out_time']=='18:00:00'){echo "selected='selected'";} ?>>06:00 pm</option>
                                <option value="18:15:00" <?php if($list2['out_time']=='18:15:00'){echo "selected='selected'";} ?>>06:15 pm</option>
                                <option value="18:30:00" <?php if($list2['out_time']=='18:30:00'){echo "selected='selected'";} ?>>06:30 pm</option>
                                <option value="18:45:00" <?php if($list2['out_time']=='18:45:00'){echo "selected='selected'";} ?>>06:45 pm</option>
                                <option value="19:00:00" <?php if($list2['out_time']=='19:00:00'){echo "selected='selected'";} ?>>07:00 pm</option>
                                <option value="19:15:00" <?php if($list2['out_time']=='19:15:00'){echo "selected='selected'";} ?>>07:15 pm</option>
                                <option value="19:30:00" <?php if($list2['out_time']=='19:30:00'){echo "selected='selected'";} ?>>07:30 pm</option>
                                <option value="19:45:00" <?php if($list2['out_time']=='19:45:00'){echo "selected='selected'";} ?>>07:30 pm</option>
                                <option value="20:00:00" <?php if($list2['out_time']=='20:00:00'){echo "selected='selected'";} ?>>08:00 pm</option>
                                <option value="20:15:00" <?php if($list2['out_time']=='20:15:00'){echo "selected='selected'";} ?>>08:15 pm</option>
                                <option value="20:30:00" <?php if($list2['out_time']=='20:30:00'){echo "selected='selected'";} ?>>08:30 pm</option>
                                <option value="20:45:00" <?php if($list2['out_time']=='20:45:00'){echo "selected='selected'";} ?>>08:45 pm</option>
                                <option value="21:00:00" <?php if($list2['out_time']=='21:00:00'){echo "selected='selected'";} ?>>09:00 pm</option>
                                <option value="21:15:00" <?php if($list2['out_time']=='21:15:00'){echo "selected='selected'";} ?>>09:15 pm</option>
                                <option value="21:30:00" <?php if($list2['out_time']=='21:30:00'){echo "selected='selected'";} ?>>09:30 pm</option>
                                <option value="21:45:00" <?php if($list2['out_time']=='21:45:00'){echo "selected='selected'";} ?>>09:45 pm</option>
                                <option value="22:00:00" <?php if($list2['out_time']=='22:00:00'){echo "selected='selected'";} ?>>10:00 pm</option>
                                <option value="22:15:00" <?php if($list2['out_time']=='22:15:00'){echo "selected='selected'";} ?>>10:15 pm</option>
                                <option value="22:30:00" <?php if($list2['out_time']=='22:30:00'){echo "selected='selected'";} ?>>10:30 pm</option>
                                <option value="22:45:00" <?php if($list2['out_time']=='22:45:00'){echo "selected='selected'";} ?>>10:45 pm</option>
                                <option value="23:00:00" <?php if($list2['out_time']=='23:00:00'){echo "selected='selected'";} ?>>11:00 pm</option>                                
                                <option value="23:15:00" <?php if($list2['out_time']=='23:15:00'){echo "selected='selected'";} ?>>11:15 pm</option>                               
                                <option value="23:30:00" <?php if($list2['out_time']=='23:30:00'){echo "selected='selected'";} ?>>11:30 pm</option>                               
                                <option value="23:45:00" <?php if($list2['out_time']=='23:45:00'){echo "selected='selected'";} ?>>11:45 pm</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="off_day[]" required>
                                <option value="None" selected >-- None --</option>
                                <option value="1" <?php if($list2['off_day']=='1'){echo "selected='selected'";} ?>>0001_ Leave of Absence</option>
                                <option value="2" <?php if($list2['off_day']=='2'){echo "selected='selected'";} ?>>0002_Parental Leave (25%)</option>
                                <option value="3" <?php if($list2['off_day']=='3'){echo "selected='selected'";} ?>>0003_Parental Leave(50%)</option>
                                <option value="4" <?php if($list2['off_day']=='4'){echo "selected='selected'";} ?>>0004_Parental Leave</option>
                                <option value="5" <?php if($list2['off_day']=='5'){echo "selected='selected'";} ?>>0005_Sick Leave 50%</option>
                                <option value="6" <?php if($list2['off_day']=='6'){echo "selected='selected'";} ?>>0006_Sick Leave( 100%)</option>
                                <option value="7" <?php if($list2['off_day']=='7'){echo "selected='selected'";} ?>>0007_Vacation</option>
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="dstatus[]" required>
                                <option value="" selected disabled>-- Select Status --</option>
                                <option value="1" <?php if($list2['dstatus']=='1'){echo "selected='selected'";} ?>>Approved</option>
                                <option value="0" <?php if($list2['dstatus']=='0'){echo "selected='selected'";} ?>>Pending</option>
                              </select>
                            </td>
                            <td style="text-align:center;"><a href="time_acc_det_admin_delete.php?id=<?php echo $id1;?>&row_id=<?php echo $id;?>" onClick="return confirm('Do you really want to delete?');"><button type="button" class="btn btn-danger delete-row">X</button></a></td>
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
                            <option value="1" <?php if($row['status']=='1'){echo "selected='selected'";} ?>>Approved</option>
                            <option value="0" <?php if($row['status']=='0'){echo "selected='selected'";} ?>>Pending</option>
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
              <!-- /.card -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.container-fluid -->

    <?php
    }
    else{
      ?>
      <div class="row">
          <div class="col-12">               
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>
              </div>
          </div>
        </div>
    
    <?php    
    }
    }
    ?>
    <!-- /.content -->
    </section>
  </div>

<?php include('footer.php'); ?>

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_emp_id").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "get_emp_details.php",
            type:"POST",
            cache:false,
            data:{id:id},
            success:function(data){
              $("#show-emp").html(data);
            }
          });
        }else{
          $("show-emp").html(" ");
        }
      })
  });
</script>

<?php if($role == 1){ ?>
<script>
  //var rowCount = 1;
  var rowCount = ($("#h_apnd > tbody > #tr_rows").length);
    $(document).ready(function(){
      $(".add_product").click(function(){
         rowCount++;
        $("table#h_apnd tbody").append('<tr class="ap_rw" id="tr_rows"><td><input type="text" class="form-control" name="project_name[]" required/></td><td><input type="text" class="form-control" name="acc_cust[]" required></td><td><input type="date" class="form-control" name="work_date[]" required/></td><td><input type="number" class="form-control hour" data-id="'+rowCount+'" id="hour_'+rowCount+'" name="hour[]" step="0.25" required/></td><td><select class="form-control in_time" data-id="'+rowCount+'" id="in_time_'+rowCount+'" name="in_time[]" required><option value="None" selected disabled>-Select-</option><option value="00:00:00">12:00 am</option><option value="00:15:00">12:15 am</option><option value="00:30:00">12:30 am</option><option value="00:45:00">12:45 am</option><option value="01:00:00">01:00 am</option><option value="01:15:00">01:15 am</option><option value="01:30:00">01:30 am</option><option value="01:45:00">01:45 am</option><option value="02:00:00">02:00 am</option><option value="02:15:00">02:15 am</option><option value="02:30:00">02:30 am</option><option value="02:45:00">02:45 am</option><option value="03:00:00">03:00 am</option><option value="03:15:00">03:15 am</option><option value="03:30:00">03:30 am</option><option value="03:45:00">03:45 am</option><option value="04:00:00">04:00 am</option><option value="04:15:00">04:15 am</option><option value="04:30:00">04:30 am</option><option value="04:45:00">04:45 am</option><option value="05:00:00">05:00 am</option><option value="05:15:00">05:15 am</option><option value="05:30:00">05:30 am</option><option value="05:45:00">05:45 am</option><option value="06:00:00">06:00 am</option><option value="06:15:00">06:15 am</option><option value="06:30:00">06:30 am</option><option value="06:45:00">06:45 am</option><option value="07:00:00">07:00 am</option><option value="07:15:00">07:15 am</option><option value="07:30:00">07:30 am</option><option value="07:45:00">07:45 am</option><option value="08:00:00">08:00 am</option><option value="08:15:00">08:15 am</option><option value="08:30:00">08:30 am</option><option value="08:45:00">08:45 am</option><option value="09:00:00">09:00 am</option><option value="09:15:00">09:15 am</option><option value="09:30:00">09:30 am</option><option value="09:45:00">09:45 am</option><option value="10:00:00">10:00 am</option><option value="10:15:00">10:15 am</option><option value="10:30:00">10:30 am</option><option value="10:45:00">10:45 am</option><option value="11:00:00">11:00 am</option><option value="11:15:00">11:15 am</option><option value="11:30:00">11:30 am</option><option value="11:45:00">11:45 am</option><option value="12:00:00">12:00 pm</option><option value="12:15:00">12:15 pm</option><option value="12:30:00">12:30 pm</option><option value="12:45:00">12:45 pm</option><option value="13:00:00">01:00 pm</option><option value="13:15:00">01:15 pm</option><option value="13:30:00">01:30 pm</option><option value="13:45:00">01:45 pm</option><option value="14:00:00">02:00 pm</option><option value="14:15:00">02:15 pm</option><option value="14:30:00">02:30 pm</option><option value="14:45:00">02:45 pm</option><option value="15:00:00">03:00 pm</option><option value="15:15:00">03:15 pm</option><option value="15:30:00">03:30 pm</option><option value="15:45:00">03:45 pm</option><option value="16:00:00">04:00 pm</option><option value="16:15:00">04:15 pm</option><option value="16:30:00">04:30 pm</option><option value="16:45:00">04:45 pm</option><option value="17:00:00">05:00 pm</option><option value="17:15:00">05:15 pm</option><option value="17:30:00">05:30 pm</option><option value="17:45:00">05:45 pm</option><option value="18:00:00">06:00 pm</option><option value="18:15:00">06:15 pm</option><option value="18:30:00">06:30 pm</option><option value="18:45:00">06:45 pm</option><option value="19:00:00">07:00 pm</option><option value="19:15:00">07:15 pm</option><option value="19:30:00">07:30 pm</option><option value="19:45:00">07:45 pm</option><option value="20:00:00">08:00 pm</option><option value="20:15:00">08:15 pm</option><option value="20:30:00">08:30 pm</option><option value="20:45:00">08:45 pm</option><option value="21:00:00">09:00 pm</option><option value="21:15:00">09:15 pm</option><option value="21:30:00">09:30 pm</option><option value="21:45:00">09:45 pm</option><option value="22:00:00">10:00 pm</option><option value="22:15:00">10:15 pm</option><option value="22:30:00">10:30 pm</option><option value="22:45:00">10:45 pm</option><option value="23:00:00">11:00 pm</option><option value="23:15:00">11:15 pm</option><option value="23:30:00">11:30 pm</option><option value="23:45:00">11:45 pm</option></select></td><td><select class="form-control out_time" data-id="'+rowCount+'" id="out_time_'+rowCount+'" name="out_time[]" required><option value="None" selected disabled>-Select-</option><option value="00:00:00">12:00 am</option><option value="00:15:00">12:15 am</option><option value="00:30:00">12:30 am</option><option value="00:45:00">12:45 am</option><option value="01:00:00">01:00 am</option><option value="01:15:00">01:15 am</option><option value="01:30:00">01:30 am</option><option value="01:45:00">01:45 am</option><option value="02:00:00">02:00 am</option><option value="02:15:00">02:15 am</option><option value="02:30:00">02:30 am</option><option value="02:45:00">02:45 am</option><option value="03:00:00">03:00 am</option><option value="03:15:00">03:15 am</option><option value="03:30:00">03:30 am</option><option value="03:45:00">03:45 am</option><option value="04:00:00">04:00 am</option><option value="04:15:00">04:15 am</option><option value="04:30:00">04:30 am</option><option value="04:45:00">04:45 am</option><option value="05:00:00">05:00 am</option><option value="05:15:00">05:15 am</option><option value="05:30:00">05:30 am</option><option value="05:45:00">05:45 am</option><option value="06:00:00">06:00 am</option><option value="06:15:00">06:15 am</option><option value="06:30:00">06:30 am</option><option value="06:45:00">06:45 am</option><option value="07:00:00">07:00 am</option><option value="07:15:00">07:15 am</option><option value="07:30:00">07:30 am</option><option value="07:45:00">07:45 am</option><option value="08:00:00">08:00 am</option><option value="08:15:00">08:15 am</option><option value="08:30:00">08:30 am</option><option value="08:45:00">08:45 am</option><option value="09:00:00">09:00 am</option><option value="09:15:00">09:15 am</option><option value="09:30:00">09:30 am</option><option value="09:45:00">09:45 am</option><option value="10:00:00">10:00 am</option><option value="10:15:00">10:15 am</option><option value="10:30:00">10:30 am</option><option value="10:45:00">10:45 am</option><option value="11:00:00">11:00 am</option><option value="11:15:00">11:15 am</option><option value="11:30:00">11:30 am</option><option value="11:45:00">11:45 am</option><option value="12:00:00">12:00 pm</option><option value="12:15:00">12:15 pm</option><option value="12:30:00">12:30 pm</option><option value="12:45:00">12:45 pm</option><option value="13:00:00">01:00 pm</option><option value="13:15:00">01:15 pm</option><option value="13:30:00">01:30 pm</option><option value="13:45:00">01:45 pm</option><option value="14:00:00">02:00 pm</option><option value="14:15:00">02:15 pm</option><option value="14:30:00">02:30 pm</option><option value="14:45:00">02:45 pm</option><option value="15:00:00">03:00 pm</option><option value="15:15:00">03:15 pm</option><option value="15:30:00">03:30 pm</option><option value="15:45:00">03:45 pm</option><option value="16:00:00">04:00 pm</option><option value="16:15:00">04:15 pm</option><option value="16:30:00">04:30 pm</option><option value="16:45:00">04:45 pm</option><option value="17:00:00">05:00 pm</option><option value="17:15:00">05:15 pm</option><option value="17:30:00">05:30 pm</option><option value="17:45:00">05:45 pm</option><option value="18:00:00">06:00 pm</option><option value="18:15:00">06:15 pm</option><option value="18:30:00">06:30 pm</option><option value="18:45:00">06:45 pm</option><option value="19:00:00">07:00 pm</option><option value="19:15:00">07:15 pm</option><option value="19:30:00">07:30 pm</option><option value="19:45:00">07:45 pm</option><option value="20:00:00">08:00 pm</option><option value="20:15:00">08:15 pm</option><option value="20:30:00">08:30 pm</option><option value="20:45:00">08:45 pm</option><option value="21:00:00">09:00 pm</option><option value="21:15:00">09:15 pm</option><option value="21:30:00">09:30 pm</option><option value="21:45:00">09:45 pm</option><option value="22:00:00">10:00 pm</option><option value="22:15:00">10:15 pm</option><option value="22:30:00">10:30 pm</option><option value="22:45:00">10:45 pm</option><option value="23:00:00">11:00 pm</option><option value="23:15:00">11:15 pm</option><option value="23:30:00">11:30 pm</option><option value="23:45:00">11:45 pm</option></select></td><td><select class="form-control" name="off_day[]" required><option value="None" selected >-- None --</option><option value="1">0001_ Leave of Absence</option><option value="2">0002_Parental Leave (25%)</option><option value="3">0003_Parental Leave(50%)</option><option value="4">0004_Parental Leave</option><option value="5">0005_Sick Leave 50%</option><option value="6">0006_Sick Leave( 100%)</option><option value="7">0007_Vacation</option></select></td><td><select class="form-control" name="dstatus[]" required><option value="" selected disabled>-- Select Status --</option><option value="1">Approved</option><option value="0">Pending</option></select></td><td style="text-align:center;"><button type="button" class="btn delete-row btn-danger">X</button></td></tr>');

        removeTimeValue();
        removeHourValue();

      });

      $("table#h_apnd tbody").on('click','.delete-row',function(){
          $(this).parent().parent().remove();
      });
    }); 
</script>
<?php 
} 
?>

<script type="text/javascript">
   $(document).ready(function() { 
    var calculateHours = ()=>{

      var in_time = $(".in_time").val();
      var out_time = $(".out_time").val();

      //var hourDiff = out_time - in_time; 

      var timeStart = new Date("01/01/2007 " + in_time).getHours();
      var timeEnd = new Date("01/01/2007 " + out_time).getHours();
             
      var hourDiff = timeEnd - timeStart;

      console.log('hourDiff', hourDiff);      

    }
    $("select").change(calculateHours);
    calculateHours();
    });


    let removeTimeValue = ()=>{
      
      var element = document.querySelectorAll("tr td .hour");      
      var len = element.length;

      element.forEach((item)=>  {
          item.addEventListener('click', function(event){

            let id = $(event.target).attr('data-id');
            //console.log('event',id); 

            $(document).ready(function() { 
              var calculateHours = ()=>{  
                
                var in_time = $("#in_time_"+id).val("08:00:00");
                
                var hour = $("#hour_"+id).val();

                if(hour == 1){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("09:00:00");
                }
                if(hour == 1.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("09:15:00");
                }
                if(hour == 1.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("09:30:00");
                }
                if(hour == 1.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("09:45:00");
                }
                if(hour == 2){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("10:00:00");
                }
                if(hour == 2.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("10:15:00");
                }
                if(hour == 2.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("10:30:00");
                }
                if(hour == 2.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("10:45:00");
                }
                if(hour == 3){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("11:00:00");
                }
                if(hour == 3.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("11:15:00");
                }
                if(hour == 3.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("11:30:00");
                }
                if(hour == 3.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("11:45:00");
                }
                if(hour == 4){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("12:00:00");
                }
                if(hour == 4.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("12:15:00");
                }
                if(hour == 4.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("12:30:00");
                }
                if(hour == 4.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("12:45:00");
                }
                if(hour == 5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("13:00:00");
                }
                if(hour == 5.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("13:15:00");
                }
                if(hour == 5.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("13:30:00");
                }
                if(hour == 5.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("13:45:00");
                }
                if(hour == 6){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("14:00:00");
                }
                if(hour == 6.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("14:15:00");
                }
                if(hour == 6.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("14:30:00");
                }
                if(hour == 6.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("14:45:00");
                }
                if(hour == 7){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("15:00:00");
                }
                if(hour == 7.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("15:15:00");
                }
                if(hour == 7.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("15:30:00");
                }
                if(hour == 7.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("15:45:00");
                }
                if(hour == 8){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("16:00:00");
                }
                if(hour == 8.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("16:15:00");
                }
                if(hour == 8.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("16:30:00");
                }
                if(hour == 8.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("16:45:00");
                }
                if(hour == 9){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("17:00:00");
                }
                if(hour == 9.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("17:15:00");
                }
                if(hour == 9.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("17:30:00");
                }
                if(hour == 9.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("17:45:00");
                }
                if(hour == 10){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("18:00:00");
                }
                if(hour == 10.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("18:15:00");
                }
                if(hour == 10.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("18:30:00");
                }
                if(hour == 10.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("18:45:00");
                }
                if(hour == 11){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("19:00:00");
                }
                if(hour == 11.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("19:15:00");
                }
                if(hour == 11.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("19:30:00");
                }
                if(hour == 11.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("19:45:00");
                }
                if(hour == 12){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("20:00:00");
                }
                if(hour == 12.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("20:15:00");
                }
                if(hour == 12.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("20:30:00");
                }
                if(hour == 12.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("20:45:00");
                }
                if(hour == 13){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("21:00:00");
                }
                if(hour == 13.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("21:15:00");
                }
                if(hour == 13.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("21:30:00");
                }
                if(hour == 13.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("21:45:00");
                }
                if(hour == 14){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("22:00:00");
                }
                if(hour == 14.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("22:15:00");
                }
                if(hour == 14.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("22:30:00");
                }
                if(hour == 14.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("22:45:00");
                }
                if(hour == 15){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("23:00:00");
                }
                if(hour == 15.25){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("23:15:00");
                }
                if(hour == 15.5){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("23:30:00");
                }
                if(hour == 15.75){
                  $("#in_time_"+id).val("08:00:00");
                  $("#out_time_"+id).val("23:45:00");
                }
                
                if(hour > 15.75){
                  $("#in_time_"+id).val("");
                  $("#out_time_"+id).val("");
                }
                
            }

            $("#hour_"+id).change(calculateHours);
              calculateHours();
            });

            //$("#in_time_"+id).val(""); 
            //$("#out_time_"+id).val(""); 

            $("#in_time_"+id).prop('readonly', true);
            $("#out_time_"+id).prop('readonly', true);
            $("#in_time_"+id).attr("required", true);
            $("#out_time_"+id).attr("required", true);      
            $("#hour_"+id).prop('readonly', false);      
            $("#hour_"+id).attr("required", true);
          })
        })
    }

    removeTimeValue();

    let removeHourValue = ()=>{

      var element = document.querySelectorAll("tr td .in_time");
      var len = element.length;

      element.forEach((item)=>  {        
          item.addEventListener('click', function(){              

            let id = $(event.target).attr('data-id');
            //console.log('event',id); 

            
              $(document).ready(function() { 
              var calculateHours = ()=>{
                var in_time = $("#in_time_"+id).val();
                var out_time = $("#out_time_"+id).val();

                //var hourDiff = out_time - in_time; 

                var timeStart = new Date("01/01/2007 " + in_time).getHours();
                var timeEnd = new Date("01/01/2007 " + out_time).getHours();
                       
                var hourDiff = timeEnd - timeStart;

                var timeStart1 = new Date("01/01/2007 " + in_time).getMinutes();
                var timeEnd1 = new Date("01/01/2007 " + out_time).getMinutes(); 

                var hourDiff1 = timeEnd1 - timeStart1;               

                if(hourDiff1 == 15){
                  hourDiff1 = 25;
                } 
                if(hourDiff1 == 30){
                  hourDiff1 = 50;
                }
                if(hourDiff1 == 45){
                  hourDiff1 = 75;
                }                 

                $("#hour_"+id).val(hourDiff+ "." +hourDiff1);

                //$("#hour_"+id).val(hourDiff);
              }

              $("select").change(calculateHours);
                calculateHours();
              });


            //$("#hour_"+id).val("0"); 
            //$("#hour_"+id).prop('readonly', true);
            $("#hour_"+id).attr("required", true);
            $("#in_time_"+id).prop('readonly', false);
            $("#out_time_"+id).prop('readonly', false);
            $("#in_time_"+id).attr("required", true);
            $("#out_time_"+id).attr("required", true); 
          })
        })
    

    var element = document.querySelectorAll("tr td .out_time");
      var len = element.length;

      element.forEach((item)=>  {        
          item.addEventListener('click', function(){              

            let id = $(event.target).attr('data-id');
            //console.log('event',id); 
            
              $(document).ready(function() { 
              var calculateHours = ()=>{
                var in_time = $("#in_time_"+id).val();
                var out_time = $("#out_time_"+id).val();

                //var hourDiff = out_time - in_time; 

                var timeStart = new Date("01/01/2007 " + in_time).getHours();
                var timeEnd = new Date("01/01/2007 " + out_time).getHours();
                       
                var hourDiff = timeEnd - timeStart;

                var timeStart1 = new Date("01/01/2007 " + in_time).getMinutes();
                var timeEnd1 = new Date("01/01/2007 " + out_time).getMinutes(); 

                var hourDiff1 = timeEnd1 - timeStart1;               

                if(hourDiff1 == 15){
                  hourDiff1 = 25;
                } 
                if(hourDiff1 == 30){
                  hourDiff1 = 50;
                }
                if(hourDiff1 == 45){
                  hourDiff1 = 75;
                }                 

                $("#hour_"+id).val(hourDiff+ "." +hourDiff1);  

                //$("#hour_"+id).val(hourDiff);
              }

              $("select").change(calculateHours);
                calculateHours();
              });


            //$("#hour_"+id).val("0"); 
            //$("#hour_"+id).prop('readonly', true);
            $("#hour_"+id).attr("required", true);
            $("#in_time_"+id).prop('readonly', false);
            $("#out_time_"+id).prop('readonly', false);
            $("#in_time_"+id).attr("required", true);
            $("#out_time_"+id).attr("required", true); 
          })
        })

    }

    removeHourValue();

</script>
