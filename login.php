<?php 
session_start();
include_once 'class/class_user.php';
$user = new User();

if (isset($_POST['submit'])) { 
    extract($_POST);   
      $login = $user->check_login($emailusername, $password);
      if ($login) {
          // Registration Success
         header("location:index.php");
      } else {
          // Registration Failed
          //echo 'Wrong username or password';
          echo '<style>.msgp{display:block !important;}</style>';
      }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in | Zriya Solutions</title>
  <link rel="icon" type="image/x-icon" href="dist/img/favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .title_div{      
      max-width: 850px !important;
      margin: 0 auto !important;
      margin-top: 7% !important;
      text-align: center;
      background-color: rgba(255,255,255,0.3);
      padding:20px;
    }
    .title_div h2{
      color:#7b0304 !important;
    }    
    .login-box-msg{
      /*color:#ff0000 !important;*/
      font-weight: 600 !important;
      font-size: 20px !important;
    }
    .login-box{
      /*margin-top: 20% !important;*/
    }
    .login-page{      
      background-position: center top;
      background-repeat: no-repeat;
      background-size: cover !important;
    }
    .login-card-body, .register-card-body, .login-box .card{
      background-color: rgba(255,255,255,0.3);
    }
    
  </style>
</head>
<body class="hold-transition login-page">
  
<div class="login-box">    
  
  <div class="card">
    <div class="card-body login-card-body">
      <img src="dist/img/logo.png" alt="Logo" class="" style="max-width: 70%; display: block; margin: 0 auto; padding-bottom: 10px;">
      <p class="login-box-msg text-dark">Welcome To Zriya Solutions</p>

      <form action="" method="post" name="login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="emailusername">
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-dark btn-block btn-flat" name="submit">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div style="padding: 10px 10px 0; text-align: center;">
        <a href="forgot_password.php">Forgot Password?</a>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
  <p style="color:red;text-align:center;display:none;" class="msgp">Wrong username or password / User may be Inactive</p>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/sweetalert2.all.min.js"></script>

</script>

  <?php
  if(isset($_SESSION['success'])){
  ?>   
    <script type="text/javascript">
      Swal.fire({
        title: "Success!",
        text: "<?php  echo $_SESSION['success']; ?>!",
        icon: "success",
      });
    </script>
  <?php   
    unset($_SESSION['success']);
  }
  if(isset($_SESSION['error'])){
  ?>               
    <script type="text/javascript">
      Swal.fire({
        title: "Oops!",
        text: "<?php  echo $_SESSION['error']; ?>!",
        icon: "error",
      });
    </script>                  
  <?php                   
    unset($_SESSION['error']);
  }
  ?>

<script type="text/javascript">

  $('.btn-del').on('click', function(e){
      e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            document.location.href = href;
            /*
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            */
          }
        })
  });

</script>

</body>
</html>
