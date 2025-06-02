<?php
  $title = "CRM Deals Add | Zriya Solutions";
  ob_start();
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
                <h3 class="card-title">Add New Deal</h3>
              </div>

              <div class="card-body">      

                <?php
                  $result=new DB_crm_deal();
                  if(isset($_POST['submit'])){
                    
                    $deal_owner   = $_POST['deal_owner'];
                    $deal_name    = $_POST['deal_name'];
                    $type         = $_POST['type'];
                    $next_step    = $_POST['next_step'];
                    $lead_source  = $_POST['lead_source'];
                    $contact      = $_POST['contact'];
                    $amount       = $_POST['amount'];
                    $close_date   = $_POST['close_date'];  
                    $stage        = $_POST['stage'];
                    $probability  = $_POST['probability'];
                    $exp_revenue  = $_POST['exp_revenue'];
                    $description  = $_POST['description'];
                    $status       = $_POST['status'];             
                                   
                    $sql = $result->insert($deal_owner, $deal_name, $type, $next_step, $lead_source, $contact, $amount, $close_date, $stage, $probability, $exp_revenue, $description, $status);
                    
                    if ($sql) {  
                      $_SESSION['success'] = "New Deal added successfully";   
                      header('location:crm_deal_view.php'); 

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
                         
                        $subject = "Zriya - CRM Deal"; 
                         
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
                                          Hi! Here the Deal details for you.
                                        </th>
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Deal Name</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$deal_name.'</td> 
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
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Lead Source</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$lead_source.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Deal Type</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$type.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Next Step</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$next_step.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Amount (SEK)</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$amount.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Closing Date</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$close_date.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Stage</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$stage.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Probability (%)</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$probability.'</td> 
                                    </tr>
                                    <tr> 
                                        <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Expected Revenue (SEK)</th>
                                        <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$exp_revenue.'</td> 
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
                        if(mail($to, $subject, $htmlContent, $headers)){ 
                            //echo 'Email has sent successfully.'; 
                        }else{ 
                           //echo 'Email sending failed.'; 
                        }                    
                    }
                    else{
                      $_SESSION['error'] = "Deal not created";   
                      header('location:crm_deal_view.php');                     
                    }
                }
                ?>         

                <form method="post" name="myform" onsubmit="enableSample();">

                  <h4>Deal Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deal Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the deal owner name" name="deal_owner" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact</label>                        
                        <select class="form-control sel_comp" id="sel_cont_id" name="contact" required>
                          <option selected disabled value="">-- Select Contact --</option>
                          <?php
                            $result1 = new DB_crm_deal();
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
                        <label>Deal Name</label>
                        <input type="text" class="form-control" placeholder="Enter the deal name" name="deal_name" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Source</label>
                        <select class="form-control" name="lead_source" required>
                          <option value="" selected disabled>-- Select Lead Source --</option>
                          <option value="Advertisement">Advertisement</option>
                          <option value="Cold Call">Cold Call</option>
                          <option value="Employee Referral">Employee Referral</option>
                          <option value="External Referral">External Referral</option>
                          <option value="Online Store">Online Store</option>
                          <option value="Partner">Partner</option>
                          <option value="Public Relations">Public Relations</option>
                          <option value="Sales Email Alias">Sales Email Alias</option>
                          <option value="Seminar Partner">Seminar Partner</option>
                          <option value="Internal Seminar">Internal Seminar</option>
                          <option value="Trade Show">Trade Show</option>
                          <option value="Web Download">Web Download</option>
                          <option value="Web Research">Web Research</option>
                          <option value="Chat">Chat</option>
                          <option value="Twitter">Twitter</option>
                          <option value="Facebook">Facebook</option>
                        </select>   
                      </div>
                    </div>
                  </div>

                  <div class="row">              
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deal Type</label>
                          <select class="form-control" name="type" required>
                            <option value="" selected disabled>-- Select type --</option>
                            <option value="Existing Business">Existing Business</option>
                            <option value="New Business">New Business</option>
                          </select>   
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Next Step</label>
                        <input type="text" class="form-control" placeholder="Enter the next step" name="next_step" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Amount (SEK)</label>
                        <input type="text" class="form-control" placeholder="Enter the amount" name="amount" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Closing Date</label>
                        <input type="date" class="form-control" name="close_date" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">              
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Stage</label>
                          <select class="form-control" name="stage" required>
                            <option value="" selected disabled>-- Select type --</option>
                            <option value="Qualification">Qualification</option>
                            <option value="Needs Analysis">Needs Analysis</option>
                            <option value="Value Proposition">Value Proposition</option>
                            <option value="Identify Decision Makers">Identify Decision Makers</option>
                            <option value="Proposal/Price Quote">Proposal/Price Quote</option>
                            <option value="Negotiation/Review">Negotiation/Review</option>
                            <option value="Closed Won">Closed Won</option>
                            <option value="Closed Lost">Closed Lost</option>
                            <option value="Closed-Lost to Competition">Closed-Lost to Competition</option>
                          </select>   
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Probability (%)</label>
                        <input type="number" class="form-control" placeholder="Enter the Probability %" name="probability" min="0" max="100" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Expected Revenue (SEK)</label>
                        <input type="number" class="form-control" placeholder="Enter the Expected Revenue" name="exp_revenue" required>
                      </div>
                    </div>          
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the description" name="description" required></textarea>
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
                          <h3 class="card-title">Deal List</h3>
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