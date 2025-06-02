<?php
  $title = "Consulting RFQ Details | Zriya Solutions";
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

    <?php 
 
    $result_usr = new User();      
    $sql_usr = $result_usr->getonerecord($id);

    foreach ($sql_usr as $list_data) {  
      $id = $list_data['id'];                  
      $name1 = $list_data['fullname'];
      $role = $list_data['role'];

      if($role == 1){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Consulting RFQ Details</h3>
              </div>        

              <div class="card-body">
                <a href="consulting_rfq_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to RFQ</button>
                </a><br><br>

                <table id="example1" class="table table-bordered ">
                  
                  <?php 
                  $id = $_GET['id'];
                  $result = new DB_consulting_rfq();
                  $sql = $result->get_one_consulting_rfq($id);   
                  $i=0;             
                  foreach ($sql as $list) { 
                    $i++;
                                 
                  ?>
                  <tr> 
                    <th rowspan="3" width="50%"><img src="dist/img/logo.png">
                      <p>Organisation No: 559361-1030<br>
                        MOMS Nummer: SE559361103001
                      </p>
                    </th>                   
                    <td><b>RFQ No:</b> <?php echo $list['rfq_no'];?></td> 
                  </tr>
                  <tr>                    
                    <td><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td>
                  </tr>
                  <tr>                    
                    <td><b>Signed Off:</b> <?php echo $list['signed'];?></td>
                  </tr>
                  <tr>                    
                    <td colspan="2">
                      <h3 style="text-align: center;padding: 15px 0;"><b><u>REQUEST FOR QUOTATION</u></b></h3>
                      <p><b>To:</b><br>
                      Whom it may concern,<br>
                      </p>
                      <p>Dear <b>Mr/Mrs. <?php echo $list['name'];?>,</b><br>
                      Through this RFQ, Zriya Digital Solutions requests to kindly provide your best candidates that fulfill the requirements described below considering the deadline of <b><?php $date1 = $list['date']; echo date('Y-m-d', strtotime($date1. ' + 10 days')); ?>.</b><br>
                      </p>
                      <p>
                        <h5><b>Description</b></h5>
                        <?php echo $list['description'];?>
                      </p><br>
                      <p>
                        Thank you <br>
                        Best Regards <br>
                        <img src="dist/img/krishna-sign.png"><br>
                        Krishna Radhakrishnan<br> 
                        Sales Director<br> 
                        Zriya Solutions<br>
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
                <h3 class="card-title">Consulting RFQ Details</h3>
              </div>
              
              <!-- /.card-header -->
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



