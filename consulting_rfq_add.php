<?php
  $title = "Consulting RFQ Add | Zriya Solutions";
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
                <h3 class="card-title">Add Consulting RFQ</h3>
              </div>  
              <div class="card-body">  

              <?php 
 
                $result_usr = new User();
                  
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];

                if($role == 1){ 
              ?>

              <?php
                $result=new DB_consulting_rfq();
                if(isset($_POST['submit'])){

                  $rfq_no       = $_POST['rfq_no'];   
                  $inv_cnt      = $_POST['inv_cnt'];                   
                  $year         = $_POST['year'];   
                  $signed       = $_POST['signed'];
                  $name         = $_POST['name'];
                  $description  = $_POST['description'];
                  $status       = $_POST['status'];                                     

                  $sql = $result->insert($rfq_no, $inv_cnt, $year, $signed, $name, $description, $status);
                  if ($sql) {                          
                    $_SESSION['success'] = "New RFQ added successfully";   
                    header('location:consulting_rfq_view.php');   
                  ?>
                  <!--
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> New RFQ added successfully.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="window.location.href='consulting_rfq_view.php'">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  -->
                  <?php
                  }
                  else{
                    $_SESSION['error'] = "RFQ not created";   
                    header('location:consulting_rfq_view.php');
                  ?>
                  <!--
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> RFQ not created.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
                  -->                       
                  <?php
                    
                  }
                }
              ?>                       

              <form method="post" name="myform" onsubmit="enableSample();">
                <div class="row">                    
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Signed Off</label>
                      <input type="text" class="form-control" placeholder="Enter the signed off name" name="signed" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Enter the name" name="name" required>
                    </div>
                  </div>                    
                </div>
                
                <div class="row">
                  <?php 

                    $y1 = date('y');      
                    //$y1 = 24;                  

                    $result = new DB_consulting_rfq();
                    $sql = $result->consulting_rfq_last1();  

                    $i=0;    
                    $row_cnt1 = $sql->num_rows; 
                    if($row_cnt1 == 0){   
                      $next_id = 1;
                    }
                    else{       
                    foreach ($sql as $list) { 
                      //echo $list['id']."<br>";
                      //echo $list['invoice_no']."<br>";
                      //echo $list['inv_cnt']."<br>";

                      $string = $list['inv_cnt'];

                      $last_id = $string;

                      $sql3 = $result->consulting_rfq_year($y1);
                      $row_cnt = $sql3->num_rows; 
                      if($row_cnt == 0){ 
                        $next_id = 1;
                        //echo $next_id;
                      }
                      else{
                        $next_id = $last_id + 1;
                        //echo $next_id;
                      }
                      //echo "Next ID : ".$next_id."<br>";
                      //echo "Year : ".$list['year']."<br>";
                     // echo "Current Year : ".$y1."<br>";
                    }
                    }
                  ?>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>RFQ No</label>
                      <input type="text" class="form-control" placeholder="Enter the Quote No" name="rfq_no" value="C-RFQ-<?php echo $y1."-000".$next_id; ?>" readonly required>
                      <input type="hidden" class="form-control" placeholder="Enter last id" name="inv_cnt" value="<?php echo $next_id; ?>"  required>
                      <input type="hidden" class="form-control" placeholder="Enter the year" name="year" value="<?php echo $y1; ?>"  required>
                    </div> 
                  </div> 
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control tinymce" rows="3" placeholder="Enter the description" name="description" required></textarea>
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
                      <button type="submit" class="btn btn-zg" id="submit" name="submit">Submit</button>
                    </div>
                  </div>                    
                </div> 
              </form> 
            </div>

            <?php
            }
            else{
            ?>
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12"> 
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

