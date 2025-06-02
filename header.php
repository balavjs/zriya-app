<?php 
session_start();
    include_once 'class/class_user.php';
    $user = new User();

    $id = $_SESSION['id'];

    if (!$user->get_session()){
       header("location:login.php");
    }

    if (isset($_GET['logout'])){
        $user->user_logout();
        header("location:login.php");
    }
    //echo $user->get_fullname($uid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo isset($title) ? $title : "Zriya App | Zriya Solutions"; ?>
  </title>
  <link rel="icon" type="image/x-icon" href="dist/img/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <style type="text/css">
    .dataTables_length{
      display: contents;
    }
    .dataTables_length label{
      margin-left: 20px;
    }
    .dataTables_length .custom-select-sm{
      font-size: 100%;
    }
    #profile_image{
      width: 2.5em;
      border-radius: 4px;
      border: 1px solid #f4f4f4;
    }
    .user-panel{
      align-items: center;
    }
    .brand-image{
      border: 1px solid #f4f4f4 !important;
      padding: 2px !important;
      border-radius: 4px !important;
    }
    .nav li a, .user-panel a, .nav p{
      font-family: 'Play', sans-serif !important;
      font-weight: 600;
    }
    h1, h2, h3, h4, h5, h6, th{
      font-family: 'Play', sans-serif;
      font-weight: 600;
    }
    .brand-text, .navbar-light .navbar-nav .nav-link{
      font-family: 'Play', sans-serif;
      font-weight: 600!important;
     }
    .navbar-light .navbar-nav .nav-link{
      color: #17353d !important;
    }
    .card-zg{
      background-color: #17353d !important;
      color: #fff !important;
    }
    td, p, label, button, 
    textarea.form-control, 
    .form-control, 
    .breadcrumb-item{
      font-family: 'ABeeZee', sans-serif;
      font-size: 15px !important;
    }
    .btn-zg{
      background-color: #17353d !important;
      border: 1px solid #17353d !important;
      color: #fff;
    }
    .btn-zg:hover{
      background-color: #1d3f48 !important;
      border: 1px solid #17353d !important;
      color: #fff !important;
    }
    .btn-zo{
      background-color: #c67e32 !important;
      border: 1px solid #c67e32 !important;
      color: #fff;
    }
    .btn-zo:hover{
      background-color: #d18b42 !important;
      border: 1px solid #c67e32 !important;
      color: #fff ;
    }
    .center{
      text-align: center !important;
    }
    .bg-zg{
      background-color: #205866 !important;
      border: 1px solid #205866 !important;
      color: #fff;
    }
    .bg-zo{
      background-color: #c67e32 !important;
      border: 1px solid #c67e32 !important;
      color: #fff;
    }
    .text-zg{
      color: #205866 !important;
    } 
    .text-zo{
      color: #c67e32 !important;
    }
    button.close{
      font-size:  25px !important;
    }
    .alert{
      padding: 0.5rem 1.25rem;
    }
    .export_options{
      display: flex !important;
    }
    .table thead th{
      border-bottom: none !important;
      vertical-align: top;
    }
    .tooltip-inner {
      max-width: 200px;
      padding: 3px 8px;
      color: #fff;
      text-align: center;
      background-color: #17353d;
      border-radius: .25rem;
    }
    .tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before, .tooltip.bs-tooltip-top .arrow::before {
      /*margin-left: -3px;*/
      content: "";
      border-width: 5px 5px 0;
      border-top-color: #17353d;
    }
    tfoot tr th{
      border-bottom: 1px solid #dee2e6 !important;
    }
    .page-item.active .page-link{
      background-color: #17353d !important;
      border: 1px solid #17353d !important;
      color: #fff;
    }
    .btn-group{
      display: contents !important;
    }
    .buttons-excel, .buttons-csv{
      background-color: #f4f6f9 !important;
      border-radius: 4px !important;
      border: 1px solid #1f6e43 !important;
      color: #1f6e43 !important;
      margin-right: 3px;
    }
    .buttons-excel:hover, .buttons-csv:hover{
      background-color: #1f6e43 !important;
      border-radius: 4px !important;
      border: 1px solid #1f6e43 !important;      
      color: #fff !important;
    }
    .buttons-pdf{
      background-color: #f4f6f9 !important;
      border-radius: 4px !important;
      border: 1px solid #f20f00 !important;
      color: #f20f00 !important;
    }
    .buttons-pdf:hover{
      background-color: #f20f00 !important;
      border-radius: 4px !important;
      border: 1px solid #f20f00 !important;
      color: #fff !important;
    }  
    .btn-zw{
      background-color: #295394 !important;
      border: 1px solid #295394 !important;
      color: #fff;
    }
    .btn-zw:hover{
      background-color: #263a58 !important;
      border: 1px solid #263a58 !important;
      color: #fff !important;
    }
    .btn-zp{
      background-color: #f20f00 !important;
      border: 1px solid #f20f00 !important;
      color: #fff;
    }
    .btn-zp:hover{
      background-color: #c11f15 !important;
      border: 1px solid #c11f15 !important;
      color: #fff !important;
    }  
    .d-block{
      white-space: normal;
      word-break: break-word;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="134" width="200">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>      
    </ul>

    <ul class="navbar-nav ml-auto">      
      <li class="nav-item">
        <img src="dist/img/logo.png">
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      <li class="nav-item">
        <a class="nav-link"  href="index.php?logout=logout" role="button">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-purple elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image elevation-1">
      <span class="brand-text font-weight-light">Zriya Solutions</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php

            $result1 = new User();
            $sql1 = $result1->getonerecord($id);   

            while($row = mysqli_fetch_array($sql1)){
              $profile_image = $row['profile_image'];

              if($profile_image != ""){
              ?>
              <img src="uploads/img/<?php echo $profile_image;?>" class="elevation-2" alt="User Image" id="profile_image">
              <?php
              }
              else{
              ?>
              <img src="dist/img/placeholder.jpg" class="elevation-2" alt="User Image" id="profile_image">
              <?php 
              }
            }
          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $user->get_fullname($id); ?> </a>
        </div>
      </div>

      <?php  
        $result_usr = new User();        
        $sql_usr = $result_usr->getonerecord($id);

        foreach ($sql_usr as $list_data) {  
          $id = $list_data['id'];                  
          $name1 = $list_data['fullname'];
          $role = $list_data['role'];
      ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard                
              </p>
            </a>            
          </li>

          <?php if($role == 1){ ?>          

          <li class="nav-item">
            <a href="quotation_view.php" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Quotations                
              </p>
            </a>
          </li>  
          
          <li class="nav-item">
            <a href="contract_view.php" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Contract                
              </p>
            </a>
          </li>                 

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Supplier Quotations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="consulting_rfq_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consulting RFQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project_rfq_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project RFQ</p>
                </a>
              </li>              
            </ul>
          </li>
          
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Finance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finance_in_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - India</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_cl_in_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clothing - India</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_cl_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clothing - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="company_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>                   
          <?php
          }
          ?>

          <?php if($role == 5 || $role == 6){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Finance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finance_in_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - India</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_cl_in_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clothing - India</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_cl_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clothing - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="company_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!--
          <?php if($role == 6){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Finance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finance_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="finance_cl_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clothing - Sweden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="company_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          -->
          <?php if($role == 7){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <img src="dist/img/finance_menu.png" style="margin: 0 5px">
              <p>
                Finance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finance_in_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - India</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="company_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($role == 8){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <img src="dist/img/finance_menu.png" style="margin: 0 5px">
              <p>
                Finance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finance_sv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice - Sweden</p>
                </a>
              </li>             
              <li class="nav-item">
                <a href="company_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a href="profile_view.php" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profile                
              </p>
            </a>
          </li>
          <?php if($role != 5 && $role != 6){ ?> 
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Time Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="time_accounts_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Time Accounts</p>
                </a>
              </li>
              <?php } ?>
              <?php if($role == 1){ ?> 
              <li class="nav-item">
                <a href="time_accounts_view_my.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search By Month</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="time_accounts_search.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search By User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="time_accounts_admin_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Time Accounts</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php if($role != 1 && $role != 5 && $role != 6){ ?>  
          <li class="nav-item">
            <a href="salary_slip_view.php" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Salary Slip                
              </p>
            </a>
          </li>
          <?php } ?>
          <?php if($role == 1){ ?> 
           <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-user"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="salary_slip_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salary Slip</p>
                </a>
              </li>              
            </ul>
          </li>
          <?php } ?> 
          <?php if($role == 1 || $role == 2 || $role == 4){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                CRM
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crm_home.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crm_account_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accounts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crm_call_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calls</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crm_contact_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="crm_deal_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Deals</p>
                </a>
              </li>             
              <li class="nav-item">
                <a href="crm_lead_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leads</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="crm_meeting_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meetings</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="crm_task_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tasks</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="crm_vendor_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendors</p>
                </a>
              </li>           
            </ul>
          </li> 
          <?php } ?>       
          <?php if($role == 1 || $role == 2 || $role == 3){ ?>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                CV
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Internal CV</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="external_cv_view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>External CV</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="cv_search.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search CV</p>
                </a>
              </li>          
            </ul>
          </li>     

          <?php } ?> 
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php
    }
    ?>
    <!-- /.sidebar -->
  </aside>

  <style type="text/css">
    #example1_filter label{
      float: right;
      margin-bottom: 20px;
    }
    #example1_filter{
      display: contents;
    } 
  </style>