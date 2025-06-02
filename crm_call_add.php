<?php
  $title = "CRM Calls Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_crm_call.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calls</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="crm_call_view.php">CRM Calls</a></li>
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
                <h3 class="card-title">Add New Call</h3>
              </div>

              <div class="card-body"> 

                <?php

                $result=new DB_crm_call();
                if(isset($_POST['submit'])){
                  
                  $call_owner   = $_POST['call_owner'];
                  $call_to      = $_POST['call_to'];
                  $related      = $_POST['related'];
                  $call_type    = $_POST['call_type'];
                  $call_status  = $_POST['call_status'];
                  $call_date    = $_POST['call_date'];
                  $call_time    = $_POST['call_time'];
                  $subject      = $_POST['subject']; 
                  $purpose      = $_POST['purpose'];
                  $agenda       = $_POST['agenda'];
                  $status       = $_POST['status'];              
                                 
                  $sql = $result->insert($call_owner, $call_to, $related, $call_type, $call_status, $call_date, $call_time, $subject, $purpose, $agenda, $status);
                  if ($sql) {  

                     $_SESSION['success'] = "New Call added successfully";   
                      header('location:crm_call_view.php');    
                  
                      $cont_id = $call_to;

                      $sql1 = $result->list_crm_contact_user($cont_id);

                      foreach ($sql1 as $list1) {  
                                      
                        $fname1 = $list1['fname'];
                        $lname1 = $list1['lname'];
                        $phone1 = $list1['phone'];
                    }
                    ?>

                    <?php
                        $to = 'krishna@zriyasolutions.com'; 
                        $from = 'krishna@zriyasolutions.com'; 
                        $fromName = 'Zriya Solutions'; 
                         
                        $subject = $subject; 
                         
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
                                          Hi! Here the Call details for you.
                                        </th>
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Call to</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname1." ".$lname1.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Phone</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$phone1.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Related</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$related.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Call Date</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$call_date." - ".$call_time.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Call Type</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$call_type.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Subject</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$subject.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Call Purpose</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$purpose.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Call Agenda</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$agenda.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Host</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$call_owner.'</td> 
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
                        if(mail($to, $subject, $htmlContent, $headers)){ 
                            //echo 'Email has sent successfully.'; 
                        }else{ 
                           //echo 'Email sending failed.'; 
                        }
                    ?>
                    <?php
                    }
                    else{
                      $_SESSION['error'] = "Call not created";   
                      header('location:crm_call_view.php');                       
                    }
                  }
                ?>                           

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Call Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Call Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the call owner name" name="call_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact</label>                        
                        <select class="form-control sel_comp" id="sel_cont_id" name="call_to" required>
                          <option selected disabled value="">-- Select Contact --</option>
                          <?php
                            $result1 = new DB_crm_call();
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
                  </div>

                  <br>

                  <div class="row"> 
                    <div class="col-md-12">
                      <!-- display company details -->
                      <div id="show-contact"> </div>
                    </div>  
                  </div> 

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Related to</label>
                        <input type="text" class="form-control" placeholder="Enter the related to" name="related" required>        
                      </div>               
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Call Status</label>
                          <select class="form-control" name="call_status" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="Scheduale a call">Scheduale a call</option>
                          </select>            
                      </div> 
                    </div>
                  </div>
                  
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Enter the call type" name="subject" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Call Type</label>
                      <select class="form-control" name="call_type" required>
                        <option value="" selected disabled>-- Select call type --</option>
                        <option value="Outbound">Outbound</option>
                        <option value="Inbound">Inbound</option>
                        <option value="Missed">Missed</option>
                      </select>
                    </div>
                  </div>                              

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Call Date</label>
                        <input type="date" class="form-control" name="call_date" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Call Time</label>
                        <input type="time" class="form-control" name="call_time" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">              
                    <div class="col-sm-6">
                      <label>Purpose</label>
                      <select class="form-control" name="purpose" required>
                          <option value="" selected disabled>-- Select call purpose --</option>
                          <option value="Prospecting">Prospecting</option>
                          <option value="Administrative">Administrative</option>
                          <option value="Negotiation">Negotiation</option>
                          <option value="Demo">Demo</option>
                          <option value="Project">Project</option>
                          <option value="Desk">Desk</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Call Agenda</label>
                        <input type="text" class="form-control" placeholder="Enter the call agenda" name="agenda" required>
                      </div>
                    </div>
                  </div> 

                  <div class="row">                                    
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
                          <h3 class="card-title">Call List</h3>
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