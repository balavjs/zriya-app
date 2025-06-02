<?php
  $title = "CV Rating Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_cv_rating.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interview Evaluation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add New CV Rating</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New CV Rating</h3>
              </div>          

              <div class="card-body">  

                <?php    
                  $result_usr = new User();                    
                  $sql_usr = $result_usr->getonerecord($id);

                  foreach ($sql_usr as $list_data) {  
                  $id = $list_data['id'];                  
                  $name1 = $list_data['fullname'];
                  $role = $list_data['role'];

                  if($role == 1 || $role == 2 || $role == 3){ 
                ?>

                <?php

                  $result=new DB_cv_rating();

                  if(isset($_POST['submit'])){
                    
                    define ('SITE_ROOT', realpath(dirname(__FILE__)));

                    $cv_id            = $_GET['id'];
                    $tech_rating      = $_POST['tech_rating'];
                    $tech_comment     = $_POST['tech_comment'];
                    $eng_rating       = $_POST['eng_rating'];
                    $eng_comment      = $_POST['eng_comment'];
                    $hr_rating        = $_POST['hr_rating'];
                    $hr_comment       = $_POST['hr_comment'];
                    $experience       = $_POST['experience'];
                    $team             = $_POST['team'];
                    $willing          = $_POST['willing'];
                    $notice           = $_POST['notice'];
                    $hvts             = $_POST['hvts'];
                    $profile_nature   = $_POST['profile_nature'];
                    $area             = $_POST['area'];
                    $lang             = $_POST['lang'];
                    $value            = $_POST['value']; 
                    $lang_comment     = $_POST['lang_comment'];
                    $domain           = $_POST['domain']; 
                    $personal_detail  = $_POST['personal_detail'];  
                    $comment          = $_POST['comment'];
                    $status           = $_POST['status'];                                                    
                                   
                    $sql = $result->insert($cv_id, $tech_rating, $tech_comment, $eng_rating, $eng_comment, $hr_rating, $hr_comment, $experience, $team, $willing, $notice, $hvts, $profile_nature, $area, $lang, $value, $lang_comment, $domain, $personal_detail, $comment, $status);

                    if ($sql) {                     

                      $_SESSION['success'] = "New CV Rating added successfully!";   
                      header('location:cv_view.php');                      

                        $id        = $_GET['id'];

                        $result = new DB_cv();
                          $sql = $result->get_one_cv($id);   
                          $i=0;             
                          foreach ($sql as $list) { 
                            $i++;                                       
                          
                            $name     = $list['name']; 
                            $to       = $list['email']; 
                            $from     = 'info@zriyasolutions.com'; 
                            $fromName = 'Zriya Solutions'; 
                             
                            $subject  = "Zriya Interview Status"; 
                         }

                        $htmlContent = '
                             
                            <table style="border: 1px solid #a6a6a6; width: 450px; border-collapse: collapse;" >
                            '; 
                        $htmlContent .= '

                              <tr> 
                                <th style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                  <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                </th>
                              </tr>
                              <tr>                      
                                <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">
                            ';

                        if($status == 'Selected') { 

                          $htmlContent .= '
                                  <p>
                                    Hi <b>'.$name.'</b>, <br>We are happy to announce that we here at Zriya Solutions Interview Panel. We have selected you to move forward to the next rounds of interview.  <br>
                                  </p>
                              ';
                        }

                        if($status == 'Not Decided') { 
                          
                          $htmlContent .= '
                                  <p>
                                    Hi <b>'.$name.'</b>, <br>Your cv is now being processed. Wait for confirmation from our panel.<br>
                                  </p>
                              ';
                        }

                        if($status == 'Rejected') { 
                          
                          $htmlContent .= '
                                  <p>
                                    Hi <b>'.$name.'</b>, <br>We sadly have to announce to you that , although you are a brilliant candidate, we feel we are not a good fit at this stage of your career. We wish you good luck in all your endeavors and hopefully we will meet again soon. <br>
                                  </p>
                              ';
                        }

                        $htmlContent .= '
                                Thank you <br>
                                Best Regards <br> 
                                Zriya Solutions Team
                                </td> 
                              </tr>                          
                            ';                           

                        $htmlContent .= '
                            </table> 
                            '; 
                         
                        // Set content-type header for sending HTML email 
                        $headers = "MIME-Version: 1.0" . "\r\n"; 
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                         
                        // Additional headers 
                        $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n";
                         
                        $success = mail($to, $subject, $htmlContent, $headers);
                        // Send email 
                        if($success){  
                          //echo "<script>if(confirm('Email Sent Sucessfully!')){document.location.href='cv_view.php'};</script>";
                        }else{ 
                          //echo 'Email sending failed.'; 
                        }
                    ?>

                    <?php
                    }
                    else{
                      $_SESSION['error'] = "CV not added / Email already exist!";   
                      header('location:cv_view.php');                          
                    }
                  }
                ?>                       

                  <?php
                    $id  = $_GET['id'];
                    $result1 = new DB_cv();
                    $sql1 = $result1->get_one_cv($id);
                    foreach ($sql1 as $list_user) {   
                  ?>
                  <div class="row">                   
                    <div class="col-sm-4">
                      <label>Profile Name</label>
                      <p><?php echo $list_user['name']; ?></p>
                    </div>
                    <div class="col-sm-4">
                      <label>Email</label>
                      <p><?php echo $list_user['email']; ?></p>
                    </div>
                    <div class="col-sm-4">
                      <label>Phone</label>
                      <p><?php echo $list_user['phone']; ?></p>
                    </div>
                  </div> 
                  
                  <?php
                  }
                  ?>
                  <hr>
                  <form method="post" onsubmit="enableSample();">

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>Technical Rating (0 to 5)</label>
                            <select class="form-control" name="tech_rating" required>
                              <option value="" selected disabled>-- Select Rating --</option>
                              <option value="1">1</option>
                              <option value="1.5">1.5</option>
                              <option value="2">2</option>
                              <option value="2.5">2.5</option>
                              <option value="3">3</option>
                              <option value="3.5">3.5</option>
                              <option value="4">4</option>
                              <option value="4.5">4.5</option>
                              <option value="5">5</option>
                            </select> 
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Technical Comments</label>
                          <textarea class="form-control" rows="1" placeholder="Enter the comments" name="tech_comment" required></textarea>
                        </div>
                      </div> 
                    </div>         

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>English Rating (0 to 5)</label>
                            <select class="form-control" name="eng_rating" required>
                              <option value="" selected disabled>-- Select Rating --</option>
                              <option value="1">1</option>
                              <option value="1.5">1.5</option>
                              <option value="2">2</option>
                              <option value="2.5">2.5</option>
                              <option value="3">3</option>
                              <option value="3.5">3.5</option>
                              <option value="4">4</option>
                              <option value="4.5">4.5</option>
                              <option value="5">5</option>
                            </select>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>English Comments</label>
                          <textarea class="form-control" rows="1" placeholder="Enter the comments" name="eng_comment" required></textarea>
                        </div>
                      </div> 
                    </div>

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>HR Rating (0 to 5)</label>
                            <select class="form-control" name="hr_rating" required>
                              <option value="" selected disabled>-- Select Rating --</option>
                              <option value="1">1</option>
                              <option value="1.5">1.5</option>
                              <option value="2">2</option>
                              <option value="2.5">2.5</option>
                              <option value="3">3</option>
                              <option value="3.5">3.5</option>
                              <option value="4">4</option>
                              <option value="4.5">4.5</option>
                              <option value="5">5</option>
                            </select>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>HR Comments</label>
                          <textarea class="form-control" rows="1" placeholder="Enter the comments" name="hr_comment" required></textarea>
                        </div>
                      </div> 
                    </div>

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>Previous international experience</label>
                          <input type="text" class="form-control" placeholder="Enter the Experience" name="experience" required>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Team</label>
                          <input type="text" class="form-control" placeholder="Enter the team" name="team" required>
                        </div>
                      </div> 
                    </div>

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>Willing to move to Sweden</label>
                          <input type="text" class="form-control" placeholder="Enter the willing" name="willing" required>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Notice Period</label>
                          <input type="text" class="form-control" placeholder="Enter the Notice period days" name="notice" required>
                        </div>
                      </div> 
                    </div>

                    <div class="row">                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Sigma by "Zriya"</label>
                          <input type="text" class="form-control" placeholder="Enter the HVTS" name="hvts" required>
                        </div>
                      </div>
                    </div>                                    

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>Profile Nature</label>
                          <input type="text" class="form-control" placeholder="Enter the Profile Nature" name="profile_nature" required>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Area</label>
                          <input type="text" class="form-control" placeholder="Enter the Area" name="area" required>
                        </div>
                      </div> 
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-12">
                        <table class="table family" id="h_apnd">
                          <thead>
                            <tr class="tr_bg">
                              <td colspan="3" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Languages</strong></td>
                              <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                            </tr>
                            <tr>
                              <th>Language</th>
                              <th>Value</th>
                              <th>Comments</th>
                              <th>Action</th>
                            </tr>  
                          </thead>
                          <tbody>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]"  value="C Programming" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="C++" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="C Sharp" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="MATLAB" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="AUTOSAR" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="Python" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="ADAS" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="Networking" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="Cluster and Infotainment" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="Linux" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="SAFe Organisation" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                            <tr class="ap_rw">                
                              <td width="30%"><input type="text" class="form-control" name="lang[]" value="Agile Methodology" readonly required></td>
                              <td width="30%">
                                <select class="form-control" name="value[]" required>
                                  <option value="" selected disabled>-- Select --</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </td>
                              <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td>
                              <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row">                   
                      <div class="col-sm-6">    
                        <div class="form-group">
                          <label>Domain</label>
                          <input type="text" class="form-control" placeholder="DSP Engineer, Embedded Engineers.." name="domain" required>
                        </div>                       
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Personal Details</label>
                          <input type="text" class="form-control" placeholder="Enter the Personal Details" name="personal_detail" required>
                        </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">  
                          <label>Comments</label>
                          <textarea class="form-control" rows="3" placeholder="Enter the comments" name="comment" required></textarea>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Status</label>
                            <select class="form-control" name="status" required>
                              <option value="" selected disabled>-- Select Status --</option>
                              <option value="Selected">Selected</option>
                              <option value="Not Decided">Not Decided</option>
                              <option value="Rejected">Rejected</option>
                            </select>            
                        </div> 
                      </div>                    
                    </div> 

                    <div class="row">
                      <div class="col-sm-12">
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
                        <div class="card-header">
                          <h3 class="card-title">CV Rating List</h3>
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
      $("#sel_cv_id").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "get_cv_details.php",
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

<script>
  $(document).ready(function(){
    $(".add_product").click(function(){
      $("table#h_apnd tbody").append('<tr class="ap_rw"><td width="30%"><input type="text" class="form-control" name="lang[]" required></td><td width="30%"><select class="form-control" name="value[]" required><option value="" selected disabled>-- Select --</option><option value="Yes">Yes</option><option value="No">No</option></select</td><td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"></textarea></td><td style="text-align:center;"><button type="button" class="btn delete-row btn-danger">X</button></td></tr>');
    });

    $("table#h_apnd tbody").on('click','.delete-row',function(){
        $(this).parent().parent().remove();
    });
  }); 
</script>