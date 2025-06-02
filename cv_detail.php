<?php
  $title = "CV Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">CV</li>
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
     
        if($role == 1 || $role == 2 || $role == 3){ 
    ?>

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">CV Details</h3>
              </div>           

              <div class="card-body">
                <a href="cv_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to CV</button>
                </a><br><br>
                <table id="example1" class="table">
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_cv();
                    $sql = $result->get_one_cv($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                   
                  ?> 
                  <tr>                    
                    <th>Name</th>
                    <td><?php echo $list['name'];?></td>
                  </tr>
                  <tr>                    
                    <th>Email</th>
                    <td><?php echo $list['email'];?></td>
                  </tr>
                  <tr>                    
                    <th>Phone</th>
                    <td><?php echo $list['phone'];?></td>
                  </tr>
                  <tr>                    
                    <th>Address</th>
                    <td><?php echo $list['address'];?></td>
                  </tr>
                  <tr>                    
                    <th>Position</th>
                    <td><?php echo $list['position'];?></td>
                  </tr>
                   <tr>                    
                    <th>Business Unit</th>
                    <td><?php echo $list['business_unit'];?></td>
                  </tr>
                  <tr>                    
                    <th>Uploaded CV</th>
                    <td>
                      <a href="https://zriyasolutions.com/employee_portal/zriya_app/uploads/cv/<?php echo $list['cv'];?>" target="_blank">
                        <button type="button" class="btn btn-zo">View CV</button>
                      </a>
                    </td>
                  </tr>              
                  <tr>                    
                    <th>Status</th>                    
                    <td>
                      <?php 
                        $dep_status = $list['status'];
                        if($dep_status == 1){
                          //echo "Active"; 
                          ?>
                          <p class="text-success">
                            <b><i class="fas fa-check-circle"></i> Active</b>
                          </p>                          
                        <?php
                        }
                        else{
                           //echo "Inactive";
                          ?>
                          <p class="text-danger">
                            <b><i class="fas fa-times-circle"></i> Inactive</b>
                          </p>                          
                        <?php  
                        }                  
                        }
                      ?>
                    </td>
                  </tr>                  
                </table>
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
                <h3 class="card-title">CV Details</h3>
              </div>
              <div class="card-body">
                <div class="alert alert-danger" role="alert">
                  <strong>Oops!</strong> You don't have access to view this page.
                </div>
                <h4></h4>
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
