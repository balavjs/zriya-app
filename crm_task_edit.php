<?php
  $title = "CRM Tasks Update | Zriya Solutions";
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

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Update Task Details</h3>
              </div>         

              <div class="card-body">  
                
                <?php
                  $result=new DB_crm_task();

                  if(isset($_POST['update'])){
                    $id = $_GET['id'];                
                    
                    $task_owner   = $_POST['task_owner'];
                    $subject      = $_POST['subject'];
                    $due_date     = $_POST['due_date'];
                    $contact      = $_POST['contact'];
                    $tstatus      = $_POST['tstatus'];
                    $priority     = $_POST['priority'];
                    $description  = $_POST['description'];
                    $status       = $_POST['status'];
                    
                    $sql = $result->update($id, $task_owner, $subject, $due_date, $contact, $tstatus, $priority, $description, $status);
                    
                    if ($sql) {  
                      $_SESSION['success'] = "Updated successfully!";   
                      header('location:crm_task_view.php');                  
                    }
                    else{
                      $_SESSION['error'] = "Not updated!";   
                      header('location:crm_task_view.php');
                    }                    
                  }
                ?>                  

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_crm_task();
                    $sql1 = $result1->get_one_crm_task($id);   

                    while($row = mysqli_fetch_array($sql1)){
                  ?>

                  <h4>Lead Informations</h4><hr>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Task Owner</label>
                        <input type="text" class="form-control" placeholder="Enter the lead owner name" name="task_owner" value="<?php echo $row['task_owner']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" class="form-control" name="due_date" value="<?php echo $row['due_date']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Contact</label>
                        <select class="form-control sel_comp" id="sel_cont_id" name="contact" required> 
                        <option selected disabled value="">-- Select Employee ID --</option>
                        <?php
                        
                          $cont_id = $row['contact'];

                          $result1 = new DB_crm_task();
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
                        <input type="text" class="form-control" placeholder="Enter the subject" name="subject" value="<?php echo $row['subject']; ?>" required><br>
                        <label>Task Status</label>
                        <select class="form-control" name="tstatus" required>
                          <option value="" selected disabled>-- Select Status --</option>
                          <option value="Not Started" <?php if($row['tstatus']=='Not Started'){echo "selected='selected'";} ?> >Not Started</option>
                          <option value="Deferred" <?php if($row['tstatus']=='Deferred'){echo "selected='selected'";} ?> >Deferred</option>
                          <option value="In Progress" <?php if($row['tstatus']=='In Progress'){echo "selected='selected'";} ?> >In Progress</option>
                          <option value="Completed" <?php if($row['tstatus']=='Completed'){echo "selected='selected'";} ?> >Completed</option>
                          <option value="Waiting for Input" <?php if($row['tstatus']=='Waiting for Input'){echo "selected='selected'";} ?> >Waiting for Input</option>
                        </select>                         
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" placeholder="Enter the description" name="description" required><?php echo $row['description']; ?></textarea>
                      </div>
                    </div>
                  </div>     

                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">                
                        <label>Priority</label>
                        <select class="form-control" name="priority" required>
                          <option value="" selected disabled>-- Select Priority --</option>
                          <option value="High" <?php if($row['priority']=='High'){echo "selected='selected'";} ?>>High</option>
                          <option value="Highest" <?php if($row['priority']=='Highest'){echo "selected='selected'";} ?>>Highest</option>
                          <option value="Low" <?php if($row['priority']=='Low'){echo "selected='selected'";} ?>>Low</option>
                          <option value="Lowest" <?php if($row['priority']=='Lowest'){echo "selected='selected'";} ?>>Lowest</option>
                          <option value="Normal" <?php if($row['priority']=='Normal'){echo "selected='selected'";} ?>>Normal</option>
                        </select> 
                      </div>
                    </div>
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
                <h3 class="card-title">Update Task Details</h3>
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
            url :"get_contact_details.php",
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