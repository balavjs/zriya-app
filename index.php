<?php
$title = "Dashboard | Zriya Solutions";
/*
$description = "Dashboard meta description";
*/
?>

<?php
  include('header.php'); 
  include('class/class_quotation.php'); 
  include('class/class_project_rfq.php'); 
  include('class/class_consulting_rfq.php');
  include('class/class_finance_in.php');
  include('class/class_finance_cl_in.php');
  include('class/class_finance_sv.php');
  include('class/class_finance_cl_sv.php');
  include('class/class_company.php');
  include('class/class_users.php');
  include('class/class_salary_slip.php');
  include('class/class_cv.php');
  include('class/class_external_cv.php');
  include('class/class_time_accounts.php');
?>

<?php 
 
  $result_usr = new User();    
  $sql_usr = $result_usr->getonerecord($id);

  foreach ($sql_usr as $list_data) {  
  $id = $list_data['id'];                  
  $name1 = $list_data['fullname'];
  $role = $list_data['role'];
?>

<style type="text/css">
  #dash_grid .small-box p{
      margin-bottom: 0 !important;
  }
  #dash_grid .small-box .icon>i.fa, 
  #dash_grid .small-box .icon>i.fab, 
  #dash_grid .small-box .icon>i.fad, 
  #dash_grid .small-box .icon>i.fal, 
  #dash_grid .small-box .icon>i.far, 
  #dash_grid .small-box .icon>i.fas, 
  #dash_grid .small-box .icon>i.ion{
    font-size: 42px !important;
    color: #d9d9d9 !important;
    top: 15px !important;
  }
  #dash_grid .icon img{
    position: absolute;
    right: 15px;
    top: 15px;
  }
  
</style>

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

    <?php
      $result1 = new DB_project_rfq();         
      if($role == 1){ 
        $sql1 = $result1->list_project_rfq();
      }
      else{
        $sql1 = $result1->get_one_project_rfq($id);
      }
      $num_project_rfq = mysqli_num_rows($sql1);
    ?>

    <?php
      $result2 = new DB_consulting_rfq();         
      if($role == 1){ 
        $sql2 = $result2->list_consulting_rfq();
      }
      else{
        $sql2 = $result2->get_one_consulting_rfq($id);
      }
      $num_consulting_rfq = mysqli_num_rows($sql2);
    ?>

    <?php
      $result3 = new DB_finance_in();         
      
        $sql3 = $result3->list_finance_in();        
      
      $num_finance_in = mysqli_num_rows($sql3);
    ?>

    <?php
      $result4 = new DB_finance_cl_in();         
     
        $sql4 = $result4->list_finance_cl_in(); 
      
      $num_finance_cl_in = mysqli_num_rows($sql4);
    ?>

    <?php
      $result5 = new DB_finance_sv();         
      
        $sql5 = $result5->list_finance_sv();
     
      $num_finance_sv = mysqli_num_rows($sql5);
    ?>

    <?php
      $result6 = new DB_finance_cl_sv();         
     
        $sql6 = $result6->list_finance_cl_sv();
     
      $num_finance_cl_sv = mysqli_num_rows($sql6);
    ?>

    <?php
      $result7 = new DB_company();         
      
        $sql7 = $result7->list_company();
      
      $num_company = mysqli_num_rows($sql7);
    ?>

    <?php
      $result8 = new DB_user();         
      if($role == 1){ 
        $sql8 = $result8->list_user_only();
      }
      else{
        $sql8 = $result8->get_one_user($id);
      }
      $num_user = mysqli_num_rows($sql8);
    ?>

    <?php
      $result9 = new DB_salary_slip();         
      if($role == 1){ 
        $sql9 = $result9->list_salary_slip();
      }
      else{
        $sql9 = $result9->get_one_emp_salary_slip_limit($id);
      }
      $num_salary_slip = mysqli_num_rows($sql9);
    ?>

    <?php
      $result10 = new DB_cv();         
     
      $sql10 = $result10->list_cv();
      
      $num_cv = mysqli_num_rows($sql10);
    ?>

    <?php
      $result11 = new DB_external_cv();         
     
      $sql11 = $result11->list_external_cv();
      
      $num_external_cv = mysqli_num_rows($sql11);
    ?>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php 
            if($role == 1){ 
        ?>

        <?php
            $emp_id = $list_data['id'];
            $year = date('Y');
            $result = new DB_time_accounts();
            $sql = $result->get_one_user_y($emp_id,$year);
            $num_leave = mysqli_num_rows($sql);
            $total_leave = '25';
            $balance_leave = $total_leave - $num_leave;                    
          ?>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Leaves</h4>
          </div>
        </div>

        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $total_leave; ?> Days</h4>
                <p>Total Leaves Allocated</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>              
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $num_leave; ?> Days</h4>
                <p>Leaves Taken</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $balance_leave; ?> Days</h4>
                <p>Remaining Leave Days</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
            </div>
          </div>   

        </div>  
        <hr>
        <?php } ?>
        <?php if($role == 1){ ?>

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Quotations</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_quotation; ?></h4>
                <p>Quotations</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
              <a href="quotation_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_project_rfq; ?></h4>
                <p>Project RFQ</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
              <a href="project_rfq_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_consulting_rfq; ?></h4>
                <p>Consulting RFQ</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
              <a href="consulting_rfq_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>   

        </div>  
        <hr>
        <?php } ?>
        <?php if($role == 1){ ?>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Finance</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid">   

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_in; ?></h4>
                <p>Finance India</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_cl_in; ?></h4>
                <p>Finance India Clothing</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_cl_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_sv; ?></h4>
                <p>Finance Sweden</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_sv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_cl_sv; ?></h4>
                <p>Finance Sweden Clothing</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_cl_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_company; ?></h4>
                <p>Company</p>
              </div>
              <div class="icon">
                <img src="dist/img/company.png">
              </div>
              <a href="company_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div> 
        <hr>
        <?php } ?>


        <?php if($role == 1){ ?>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Users</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_user; ?></h4>
                <p>Users</p>
              </div>
              <div class="icon">
                <img src="dist/img/user.png">
              </div>
              <a href="user_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_salary_slip; ?></h4>
                <p>Salary Slips</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
              <a href="salary_slip_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

        </div> 
        <hr>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">CV</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_cv; ?></h4>
                <p>CV</p>
              </div>
              <div class="icon">
                <img src="dist/img/cv.png">
              </div>
              <a href="cv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_external_cv; ?></h4>
                <p>External CV</p>
              </div>
              <div class="icon">
                <img src="dist/img/cv.png">
              </div>
              <a href="external_cv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

        </div>
        <hr>
        
        <?php
        } 
        if($role != 1 && $role != 5 && $role != 6){
        ?>
          <?php
            $emp_id = $list_data['id'];
            $year = date('Y');
            $result = new DB_time_accounts();
            $sql = $result->get_one_user_y($emp_id,$year);
            $num_leave = mysqli_num_rows($sql);
            $total_leave = '25';
            $balance_leave = $total_leave - $num_leave;                    
          ?>
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Leaves</h4>
          </div>
        </div>

        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $total_leave; ?> Days</h4>
                <p>Total Leaves Allocated</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>              
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $num_leave; ?> Days</h4>
                <p>Leaves Taken</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zo">
              <div class="inner">
                <h4><?php echo $balance_leave; ?> Days</h4>
                <p>Remaining Leave Days</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
            </div>
          </div> 
        </div>  
        <hr>

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Salary Slip</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_salary_slip; ?></h4>
                <p>Salary Slips</p>
              </div>
              <div class="icon">
                <img src="dist/img/document.png">
              </div>
              <a href="salary_slip_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        </div>

        <?php } ?>

        <?php if($role == 5 || $role == 6){ ?>

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Finance</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid">   

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_in; ?></h4>
                <p>Finance India</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_cl_in; ?></h4>
                <p>Finance India Clothing</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_cl_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_sv; ?></h4>
                <p>Finance Sweden</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_sv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_cl_sv; ?></h4>
                <p>Finance Sweden Clothing</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_cl_sv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_company; ?></h4>
                <p>Company</p>
              </div>
              <div class="icon">
                <img src="dist/img/company.png">
              </div>
              <a href="company_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
        <hr>

        <?php } ?> 

        <!--
        <?php if($role == 6){ ?> 

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Finance</h4>
          </div>
        </div>

        <div class="row" id="dash_grid">  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!--
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_sv; ?></h4>
                <p>Finance Sweden</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_sv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!--
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_cl_sv; ?></h4>
                <p>Finance Sweden Clothing</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_cl_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!--
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_company; ?></h4>
                <p>Company</p>
              </div>
              <div class="icon">
                <img src="dist/img/company.png">
              </div>
              <a href="company_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div> 
        <hr>
        <?php } ?> 
-->
        <?php if($role == 7){ ?>

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Finance</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid">   

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_in; ?></h4>
                <p>Finance India</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_in_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>         

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_company; ?></h4>
                <p>Company</p>
              </div>
              <div class="icon">
                <img src="dist/img/company.png">
              </div>
              <a href="company_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
        <hr>

        <?php } ?> 

        <?php if($role == 8){ ?> 

        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">Finance</h4>
          </div>
        </div>

        <div class="row" id="dash_grid">  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_finance_sv; ?></h4>
                <p>Finance Sweden</p>
              </div>
              <div class="icon">
                <img src="dist/img/finance.png">
              </div>
              <a href="finance_sv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_company; ?></h4>
                <p>Company</p>
              </div>
              <div class="icon">
                <img src="dist/img/company.png">
              </div>
              <a href="company_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div> 
        <hr>
        <?php } ?>

        <?php if($role == 2 || $role == 3){ ?> 
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-zo" style="margin-bottom: 15px;">CV</h4>
          </div>
        </div>
        
        <div class="row" id="dash_grid"> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_cv; ?></h4>
                <p>CV</p>
              </div>
              <div class="icon">
                <img src="dist/img/cv.png">
              </div>
              <a href="cv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-zg">
              <div class="inner">
                <h4><?php echo $num_external_cv; ?></h4>
                <p>External CV</p>
              </div>
              <div class="icon">
                <img src="dist/img/cv.png">
              </div>
              <a href="external_cv_view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
        </div>
      <?php } ?> 
    </section>
  </div>

<?php
}
?>
  
<?php include('footer.php'); ?>
