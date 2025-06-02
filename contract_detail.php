<?php
  $title = "Contract Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_contract.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contract</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="contrat_view.php">Contract</a></li>
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
      
        if($role == 1 || $role == 5 || $role == 6){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Contract Details</h3>
              </div>           

              <div class="card-body">
                <a href="contract_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to contract</button>
                </a><br><br>
                <table id="example1" class="table">
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_contract();
                    $sql = $result->get_one_contract($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                     
                  ?> 
                  <tr>                    
                    <td>
                      <b>Name</b><br>
                      <p><?php echo $list['name'];?></p>
                    </td>
                  </tr>
                  <tr>                    
                    <td>
                      <b>Email</b><br>
                      <p><?php echo $list['email'];?></p>
                    </td>
                  </tr>
                  
                  <?php 
                  if($list['message'] != "") { ?>
                  <tr>                    
                    <td>
                      <b>Message</b><br>
                      <p><?php echo $list['message'];?></p>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                  <tr>
                    <td>
                      <b>Uploaded Document</b><br><br>
                      <p>
                        <a href="uploads/contract/<?php echo $list['file'];?>" target="_blank">
                          <button class="btn btn-zg">View</button>
                        </a>
                      </p> 
                    </td>
                  </tr>
                  <?php  
                   } 
                  ?>
                </table>
              </div>                
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
                <h3 class="card-title">Contract Details</h3>
              </div>
              
              <!-- /.card-header -->
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



