<?php
  $title = "CRM Deals Update | Zriya Solutions";
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
                <h3 class="card-title">Update Deals Details</h3>
              </div>           

              <div class="card-body"> 

              <?php
                $result=new DB_crm_deal();

                if(isset($_POST['update'])){
                  $id = $_GET['id'];                
                  
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
                                 
                  
                  $sql = $result->update($id, $deal_owner, $deal_name, $type, $next_step, $lead_source, $contact, $amount, $close_date, $stage, $probability, $exp_revenue, $description, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "Updated successfully!";   
                    header('location:crm_deal_view.php');                  
                  }
                  else{
                    $_SESSION['error'] = "Not updated!";   
                    header('location:crm_deal_view.php');
                  }
                }
              ?>               

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_deal();
                    $sql1 = $result1->get_one_crm_deal($id);   

                    while($row = mysqli_fetch_array($sql1)){ 
                  ?>
                  <h4>Deal Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Deal Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the deal owner name" name="deal_owner" value="<?php echo $row['deal_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact</label>
                        <select class="form-control sel_comp" id="sel_cont_id" name="contact" required> 
                          <option selected disabled value="">-- Select Employee ID --</option>
                          <?php                        
                            $cont_id = $row['contact'];
                            
                            $sql1 = $result1->list_crm_contact();
                            foreach ($sql1 as $list_user) {  
                              $id1 = $list_user['id'];
                              $fname1 = $list_user['fname']; 
                              $lname1 = $list_user['lname']; 
                          ?>
                          <option value="<?php echo $id1; ?>" <?php if($id1 == $cont_id){echo "selected='selected'";}?>><?php echo $fname1; ?> <?php echo $lname1; ?></option>
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
                        <input type="text" class="form-control" placeholder="Enter the deal name" name="deal_name" value="<?php echo $row['deal_name']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Source</label>
                        <select class="form-control" name="lead_source" required>
                          <option value="" selected disabled>-- Select Lead Source --</option>
                          <option value="Advertisement" <?php if($row['lead_source']=='Advertisement'){echo "selected='selected'";} ?>>Advertisement</option>
                          <option value="Cold Call" <?php if($row['lead_source']=='Cold Call'){echo "selected='selected'";} ?>>Cold Call</option>
                          <option value="Employee Referral" <?php if($row['lead_source']=='Employee Referral'){echo "selected='selected'";} ?>>Employee Referral</option>
                          <option value="External Referral" <?php if($row['lead_source']=='External Referral'){echo "selected='selected'";} ?>>External Referral</option>
                          <option value="Online Store" <?php if($row['lead_source']=='Online Store'){echo "selected='selected'";} ?>>Online Store</option>
                          <option value="Partner" <?php if($row['lead_source']=='Partner'){echo "selected='selected'";} ?>>Partner</option>
                          <option value="Public Relations" <?php if($row['Public Relations']=='Contacted'){echo "selected='selected'";} ?>>Public Relations</option>
                          <option value="Sales Email Alias" <?php if($row['lead_source']=='Sales Email Alias'){echo "selected='selected'";} ?>>Sales Email Alias</option>
                          <option value="Seminar Partner" <?php if($row['lead_source']=='Seminar Partner'){echo "selected='selected'";} ?>>Seminar Partner</option>
                          <option value="Internal Seminar" <?php if($row['lead_source']=='Internal Seminar'){echo "selected='selected'";} ?>>Internal Seminar</option>
                          <option value="Trade Show" <?php if($row['lead_source']=='Trade Show'){echo "selected='selected'";} ?>>Trade Show</option>
                          <option value="Web Download" <?php if($row['lead_source']=='Web Download'){echo "selected='selected'";} ?>>Web Download</option>
                          <option value="Web Research" <?php if($row['lead_source']=='Web Research'){echo "selected='selected'";} ?>>Web Research</option>
                          <option value="Chat" <?php if($row['lead_source']=='Chat'){echo "selected='selected'";} ?>>Chat</option>
                          <option value="Twitter" <?php if($row['lead_source']=='Twitter'){echo "selected='selected'";} ?>>Twitter</option>
                          <option value="Facebook" <?php if($row['lead_source']=='Facebook'){echo "selected='selected'";} ?>>Facebook</option>
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
                          <option value="Existing Business" <?php if($row['type']=='Existing Business'){echo "selected='selected'";} ?>>Existing Business</option>
                          <option value="New Business" <?php if($row['type']=='New Business'){echo "selected='selected'";} ?>>New Business</option>
                        </select>   
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Next Step</label>
                        <input type="text" class="form-control" placeholder="Enter the next step" name="next_step" value="<?php echo $row['next_step']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Amount (SEK)</label>
                        <input type="text" class="form-control" placeholder="Enter the amount" name="amount" value="<?php echo $row['amount']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Closing Date</label>
                        <input type="date" class="form-control" name="close_date" value="<?php echo $row['close_date']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">              
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Stage</label>
                        <select class="form-control" name="stage" required>
                          <option value="" selected disabled>-- Select stage --</option>
                          <option value="Qualification" <?php if($row['stage']=='Qualification'){echo "selected='selected'";} ?>>Qualification</option>
                          <option value="Needs Analysis" <?php if($row['stage']=='Needs Analysis'){echo "selected='selected'";} ?>>Needs Analysis</option>
                          <option value="Value Proposition" <?php if($row['stage']=='Value Proposition'){echo "selected='selected'";} ?>>Value Proposition</option>
                          <option value="Identify Decision Makers" <?php if($row['stage']=='Identify Decision Makers'){echo "selected='selected'";} ?>>Identify Decision Makers</option>
                          <option value="Proposal/Price Quote" <?php if($row['stage']=='Proposal/Price Quote'){echo "selected='selected'";} ?>>Proposal/Price Quote</option>
                          <option value="Negotiation/Review" <?php if($row['stage']=='Negotiation/Review'){echo "selected='selected'";} ?>>Negotiation/Review</option>
                          <option value="Closed Won" <?php if($row['stage']=='Closed Won'){echo "selected='selected'";} ?>>Closed Won</option>
                          <option value="Closed Lost" <?php if($row['stage']=='Closed Lost'){echo "selected='selected'";} ?>>Closed Lost</option>
                          <option value="Closed-Lost to Competition" <?php if($row['stage']=='Closed-Lost to Competition'){echo "selected='selected'";} ?>>Closed-Lost to Competition</option>
                        </select>   
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Probability (%)</label>
                        <input type="number" class="form-control" placeholder="Enter the Probability %" name="probability" min="0" max="100" value="<?php echo $row['probability']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Expected Revenue (SEK)</label>
                        <input type="number" class="form-control" placeholder="Enter the Expected Revenue" name="exp_revenue" value="<?php echo $row['exp_revenue']; ?>" required>
                      </div>
                    </div>          
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter the description" name="description" required><?php echo $row['description']; ?></textarea>
                      </div>
                    </div>
                  </div>                              

                  <div class="row">                                         
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                          <option value="" selected disabled>-- Select Status --</option>
                          <option value="1" <?php if($row['status']=='1'){echo "selected='selected'";} ?>>Active</option>
                          <option value="0" <?php if($row['status']=='0'){echo "selected='selected'";} ?>>Inactive</option>
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
                <h3 class="card-title">Update Deal Details</h3>
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

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_cont_id").on("click", function(){
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