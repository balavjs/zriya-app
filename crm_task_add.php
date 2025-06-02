<?php
  $title = "CRM Tasks Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_task.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_task_view.php">CRM Task</a></li>
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
                <h3 class="card-title">Add New Task</h3>
              </div>

              <div class="card-body"> 
                <?php

                $result=new DB_crm_task();
                if(isset($_POST['submit'])){
                  
                  $task_owner   = $_POST['task_owner'];
                  $subject      = $_POST['subject'];
                  $due_date     = $_POST['due_date'];
                  $contact      = $_POST['contact'];
                  $tstatus      = $_POST['tstatus'];
                  $priority     = $_POST['priority'];
                  $description  = $_POST['description'];
                  $status       = $_POST['status'];               
                                 
                  $sql = $result->insert($task_owner, $subject, $due_date, $contact, $tstatus, $priority, $description, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "New Task added successfully";   
                    header('location:crm_task_view.php'); 

                    $cont_id = $contact;

                    $sql1 = $result->list_crm_contact_user($cont_id);

                    foreach ($sql1 as $list1) { 
                                  
                      $fname1 = $list1['fname'];
                      $lname1 = $list1['lname'];
                      $email1 = $list1['email'];
                      $semail1 = $list1['semail'];
                      $phone1 = $list1['phone'];
                    }
                 
                    $to = 'krishna@zriyasolutions.com'; 
                    $from = 'krishna@zriyasolutions.com'; 
                    $fromName = 'Zriya Solutions'; 
                     
                    $subject1 = "Zriya - CRM Task"; 
                     
                    $htmlContent = ' 
                        <html> 
                        <head> 
                            <title>Welcome to Zriya Solutions</title> 
                        </head> 
                        <body> 
                            <table style="border: 1px solid #a6a6a6; width: 500px; border-collapse: collapse;" > 
                                <tr> 
                                    <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                      <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                    </th>
                                </tr>
                                <tr> 
                                    <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                      Hi! Here the Task details for you.
                                    </th>
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Due Date</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$due_date.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Contact Name</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname1." ".$lname1.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email1.", ".$semail1.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone1.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Subject</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$subject.'</td> 
                                </tr>
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Task Status</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$tstatus.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Priority</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$priority.'</td> 
                                </tr> 
                                <tr> 
                                    <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                    <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                                </tr>
                            </table> 
                        </body> 
                        </html>'; 
                     
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    //$headers .= 'Cc:'.$participants . "\r\n";  
                     
                    // Send email 
                    if(mail($to, $subject1, $htmlContent, $headers)){ 
                        //echo 'Email has sent successfully.'; 
                    }else{ 
                       //echo 'Email sending failed.'; 
                    }   
                  }
                  else{
                    $_SESSION['error'] = "Task not created";   
                    header('location:crm_task_view.php');                     
                  }                    
                }
                ?>                      

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Task Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Task Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead owner name" name="task_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" class="form-control" name="due_date" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact</label>                        
                        <select class="form-control sel_comp" id="sel_cont_id" name="contact" required>
                          <option selected disabled value="">-- Select Contact --</option>
                          <?php
                            $result1 = new DB_crm_task();
                            $sql1 = $result1->list_crm_contact();
                            foreach ($sql1 as $list_user) {   
                          ?>
                          <option value="<?php echo $list_user['id']; ?>"><?php echo $list_user['fname']; ?> <?php echo $list_user['lname']; ?></option>
                          <?php
                          }
                            ?>
                        </select>
                      </div>               
                    </div>                    
                  </div><br>

                  <div class="row"> 
                    <div class="col-md-12">
                      <!-- display company details -->
                      <div id="show-contact"> </div>
                    </div>  
                  </div> 
                  
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Enter the subject" name="subject" required><br>
                        <label>Task Status</label>
                          <select class="form-control" name="tstatus" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="Not Started">Not Started</option>
                            <option value="Deferred">Deferred</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="Waiting for Input">Waiting for Input</option>
                          </select>                          
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" placeholder="Enter the description" name="description" required></textarea>
                      </div>
                    </div>
                  </div>                              

                  <div class="row">  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Priority</label>
                        <select class="form-control" name="priority" required>
                            <option value="" selected disabled>-- Select Priority --</option>
                            <option value="High">High</option>
                            <option value="Highest">Highest</option>
                            <option value="Low">Low</option>
                            <option value="Lowest">Lowest</option>
                            <option value="Normal">Normal</option>
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
                          <h3 class="card-title">Task List</h3>
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

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_cont_id").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "get_contact_details.php",
            type:"POST",
            cache:false,
            data:{id:id},
            success:function(data){
              $("#show-contact").html(data);
            }
          });
        }else{
          $("show-contact").html(" ");
        }
      })
  });
</script>