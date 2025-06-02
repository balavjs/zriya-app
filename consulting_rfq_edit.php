<?php
  $title = "Consulting RFQ Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_consulting_rfq.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consulting RFQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="consulting_rfq_view.php">Consulting RFQ</a></li>
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
                <h3 class="card-title">Update Consulting RFQ</h3>
              </div>        

              <?php 
   
                $result_usr = new User();              
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];
                 
                  if($role == 1){ 
              ?>

              <div class="card-body"> 

              <?php
                $result=new DB_consulting_rfq();

                if(isset($_POST['update'])){
                  $id = $_GET['id'];                                           
                  
                  $signed       = $_POST['signed'];
                  $name         = $_POST['name'];
                  $description  = $_POST['description'];
                  $status       = $_POST['status']; 
                  
                  $sql = $result->update($id, $signed, $name, $description, $status);
                  if ($sql) { 
                    $_SESSION['success'] = "RFQ Updated successfully";   
                    header('location:consulting_rfq_view.php');
                  ?>
                  <!--
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Updated successfully.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="window.location.href='consulting_rfq_view.php'">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  -->
                  <?php
                  }
                  else{
                    $_SESSION['error'] = "RFQ not updated";   
                    header('location:consulting_rfq_view.php');
                  ?>
                  <!--
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> Not updated.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>  
                  -->                      
                  <?php
                    
                  }
                }
              ?>
              
                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_consulting_rfq();
                    $sql1 = $result1->get_one_consulting_rfq($id);   

                    while($row = mysqli_fetch_array($sql1)){ 
                  ?>
                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the last name" name="signed" value="<?php echo $row['signed']; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter the first name" name="name" value="<?php echo $row['name']; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the description" name="description" required><?php echo $row['description']; ?></textarea>
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
            </div>
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
            <div class="card-body">
              <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> You don't have access to view this page.
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
