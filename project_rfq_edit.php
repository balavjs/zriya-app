<?php
  $title = "Project RFQ Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_project_rfq.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project RFQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="project_rfq_view.php">Project RFQ</a></li>
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
                <h3 class="card-title">Update Project RFQ</h3>
              </div>        

              <?php 
   
                $result_usr = new User();                  
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $user_id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];
                
                  if($role == 1){ 
              ?>

            <div class="card-body"> 

            <?php
              $result=new DB_project_rfq();

              if(isset($_POST['update'])){
                $id = $_GET['id'];                                           
                $id1        = $_POST['id1'];
                $signed       = $_POST['signed'];
                $aim          = $_POST['aim'];
                $deliverables = $_POST['deliverables'];
                $cost         = $_POST['cost'];
                $status       = $_POST['status']; 

                $name       = $_POST['name']; 
                $role       = $_POST['role']; 

                $user_id      = $_POST['user_id'];  
                
                $sql = $result->update($id, $id1, $signed, $aim, $deliverables, $cost, $name, $role, $user_id, $status);
                if ($sql) {  
                  $_SESSION['success'] = "Updated successfully";   
                  header('location:project_rfq_view.php');                  
                }
                else{
                  $_SESSION['error'] = "Not Updated";   
                  header('location:project_rfq_view.php');
                }
              }
            ?>
                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_project_rfq();
                    $sql1 = $result1->get_one_project_rfq($id);   

                    while($row = mysqli_fetch_array($sql1)){ 

                  ?>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="signed" value="<?php echo $row['signed']; ?>" required>
                        
                        <?php if($role == 1){ ?>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>"required>
                        <?php } ?>

                      </div>
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Aim</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the aim" name="aim" required><?php echo $row['aim']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div>
                  </div>
                  <br>
                  <div class="row"> 
                    <table class="table" id="orders">
                      <tr class="tr_bg">
                        <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Stakeholders</strong></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success circle">+</button></td>
                      </tr>
                      <tr>
                        <th>Name of the Person</th>
                        <th>Role</th>
                      </tr>
                      <?php

                        $result=new DB_project_rfq();
                        $id = $_GET['id'];
                        $sqlf = $result->list_project_rfq_role($id);
                        $i=0;

                        if (is_array($sqlf) || is_object($sqlf))  {
                        foreach ($sqlf as $list) {  
                          $i++;                       

                          $id1          = $list['id'];
                          $project_rfq_id  = $list['project_rfq_id'];       
                          $name         = $list['name'];
                          $role         = $list['role'];                    
                              
                      ?>
                      <tr>
                        <input type="hidden" class="form-control" name="project_rfq_id[]" value="<?php echo $project_rfq_id; ?>">  
                        <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">
                        <td><input type="text" class="form-control" name="name[]" placeholder="name" id="name_<?php echo $i; ?>" data-type="name" value="<?php echo $name; ?>" for="<?php echo $i; ?>"/ required></td>
                        <td><input class="form-control" type='text' data-type="role" id="role_<?php echo $i; ?>" name="role[]" value="<?php echo $role; ?>" for="<?php echo $i; ?>"/></td> 
                      </tr>
                      <?php
                        }
                      }
                      ?>
                    </table>                    
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Deliverables</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the deliverables" name="deliverables" required><?php echo $row['deliverables']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Cost</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the cost" name="cost" required><?php echo $row['cost']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
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
                        <button type="submit" class="btn btn-zg" id="submit" name="update">Update</button>
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
            <br>
            <div class="alert alert-danger" role="alert">
              <strong>Oops!</strong> You don't have access to view this page.
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

<script type="text/javascript">

var rowCount = 1;
  
$('#add').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input class="form-control" type="text" data-type="name" id="name_'+rowCount+'" name="name[]" for="'+rowCount+'" placeholder="Name" required/></td><td><input class="form-control" type="text" data-type="role" id="role_'+rowCount+'" name="role[]" for="'+rowCount+'" required/></td><input class="form-control" type="hidden" data-type="rfq_id" id="rfq_id'+rowCount+'" name="rfq_id[]" for="'+rowCount+'"/><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
});

</script>
