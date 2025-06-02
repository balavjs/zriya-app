<?php
  $title = "Dashboard | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_quotation.php'); ?>

<?php 
 
    $result_usr = new User();
      
    $sql_usr = $result_usr->getonerecord($id);

    foreach ($sql_usr as $list_data) {  
    $id = $list_data['id'];                  
    $name1 = $list_data['fullname'];
    $role = $list_data['role'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php

    $result = new DB_quotation();         
      if($role == 1){ 
        $sql = $result->list_quotation();
      }
      else{
        $sql = $result->get_one_quotation($id);
      }
      $num_quotation = mysqli_num_rows($sql);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <?php 
          if($role == 1){ 
          ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $num_quotation; ?></h3>
                <p>Quotations</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="quotation_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <?php } 
          if($role == 1){ ?>
          
          <!-- ./col -->
          <!--
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $num_department; ?></h3>

                <p>Departments</p>
              </div>
              <div class="icon">
                <i class="far fa-building"></i>
              </div>
              <a href="department_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        -->

          <?php } ?>

          <!-- ./col -->
          <!--
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $num_appointment; ?></h3>

                <p>Appointments</p>
              </div>
              <div class="icon">
                <i class="far fa-calendar-check"></i>
              </div>
              <a href="appointment_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
-->
          <?php if($role == 1){ ?>

          <!-- ./col -->
          <!--
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $num_patient; ?></h3>

                <p>Patients</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="patient_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          -->

          <!-- ./col -->
          <?php } ?>
          
        </div>


        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
}
?>

  </div>
  <!-- /.content-wrapper -->
  
  <?php include('footer.php'); ?>
