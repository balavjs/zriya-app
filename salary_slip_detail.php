<?php
  $title = "Salary Slip Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_salary_slip.php'); ?>
<?php include('class/class_users.php'); ?>

<style type="text/css">
.sal_des tr:last-child { 
    height:300px; 
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary Slip</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Salary Slip</li>
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
	  
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Salary Slip Details</h3>
              </div>          

              <div class="card-body">
                <a href="salary_slip_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to Salary Slip</button>
                </a><br><br>
                <table id="example1" class="table table-bordered ">
                      <tr>
                        <td colspan="2">
                          <p>
                            <img src='http://localhost/zriya/zriya_app/dist/img/logo.png' width='120'>    
                          <br>
                          <p>Organisation No: 559361-1030<br>MOMS Nummer: SE559361103001</p> 
                          </p>
                        </td>
                      </tr>
                      <?php 
                      $id = $_GET['id'];
                      $result = new DB_salary_slip();
                      $sql = $result->get_one_salary_slip($id);   
                      $i=0;             
                      foreach ($sql as $list) { 
                        $i++;
                        $emp_id = $list['emp_id'];       
                                          
                          $result1 = new DB_user();
                          $sql1 = $result1->get_emp_id_user($emp_id);
                          foreach ($sql1 as $list1) { 
                        
                      ?>
                      <tr>                    
                        <th width="40%">Anställningsnummer / Employee ID</th>
                        <td><?php echo $list1['emp_id'];?></td>
                      </tr>
                      <tr>
                        <th>namn / Name</th>
                        <td><?php echo $list1['fname'];?> <?php echo $list1['lname'];?></td>
                      </tr>
                      <tr>
                        <th>Personnummer / Pan No</th>
                        <td><?php echo $list1['pan_no'];?></td>
                      </tr>
                      <?php                      
                      }
                      ?>

                      <?php
                        $month  = $list['month'];

                        if($month == 1){
                          $month_name = "January";
                        }
                        elseif($month == 2){
                          $month_name = "February";
                        }
                        elseif($month == 3){
                          $month_name = "March";
                        }
                        elseif($month == 4){
                          $month_name = "April";
                        }
                        elseif($month == 5){
                          $month_name = "May";
                        }
                        elseif($month == 6){
                          $month_name = "June";
                        }
                        elseif($month == 7){
                          $month_name = "July";
                        }
                        elseif($month == 8){
                          $month_name = "August";
                        }
                        elseif($month == 9){
                          $month_name = "September";
                        }
                        elseif($month == 10){
                          $month_name = "October";
                        }
                        elseif($month == 11){
                          $month_name = "November";
                        }
                        elseif($month == 12){
                          $month_name = "December";
                        }
                      ?>
                      
                      <tr>                    
                        <th>Löneperiod / Pay period</th>
                        <td><?php echo $month_name;?> - <?php echo $list['year'];?></td>
                      </tr>                         
                      <tr>                    
                        <th>Utbetalningsdag / Issued Date</th>
                        <td><?php $date = strtotime($list['sal_date']); echo date('d-m-Y', $date); ?></td>
                      </tr>
                    </table>

                   <br>
                   <h4 class="text-center">Lönebesked</h4>
                   <br>
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th class="text-center">S.No</th>
                        <th class="text-center">Löneart / Salary Type</th>
                        <th class="text-center">Benämning / Description</th>
                        <th class="text-center">Antal / Quantity</th>
                        <th class="text-center">Kronor / Price</th>
                        <th class="text-center">Totalt / Total</th>
                      </thead>
                      <tbody  class="sal_des">                              
                        <?php
                          $id = $_GET['id'];
                          $sql2 = $result->get_one_salary_slip_detail($id);   
                          $i=0;             
                          foreach ($sql2 as $list2) { 
                            $i++;                           
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $i;?></td>
                          <td><?php echo $list2['sal_type'];?></td>
                          <td><?php echo $list2['name'];?></td>
                          <td><?php echo $list2['quantity'];?></td>
                          <td class="text-right"><?php echo $list2['price'];?></td>
                          <td class="text-right"><?php echo $list2['total'];?></td>
                        </tr>
                        <?php
                        }                                           
                        ?>
                      </tbody>
                    </table>
                       <br> 
                    <table id="example1" class="table table-bordered ">
                      <tr>                    
                        <th class="text-center">Semesterdagar / Vacation days</th>
                        <th class="text-center">Summa / Amount</th>
                        <th class="text-center">Denna period / This Period</th>
                      </tr>
                      <tr>
                        <td>

                          <div class="row">
                            <div class="col-sm-6">
                              Semesterrätt / Vacation
                            </div>
                            <div class="col-sm-6">                              
                            </div>
                          </div>  

                          <div class="row">
                            <div class="col-sm-6">
                              Betalda / Paid - Unpaid
                            </div>
                            <div class="col-sm-6">                             
                            </div>
                          </div> 

                          <div class="row">
                            <div class="col-sm-6">
                              Förskott / Advance
                            </div>
                            <div class="col-sm-6">                             
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              Uttagna / Taken out
                            </div>
                            <div class="col-sm-6">                             
                            </div>
                          </div>

                        </td> 

                        <td>
                          <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4 text-center">
                              <b style="font-size: 14px;">Totalt under året / Total during the year</b>                        
                            </div>
                            <div class="col-sm-4 text-center">
                              <b style="font-size: 14px;">Totalt under perioden / Total during the year</b>                        
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-sm-4">
                              Bruttolön / Gross Salary
                            </div>
                            <div class="col-sm-4 text-center">
                              <?php echo $list['gsalary'];?>                         
                            </div>
                            <div class="col-sm-4 text-center">
                              <?php echo $list['gsalary'];?>                    
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-4">
                              Förmåner / Benefits
                            </div>
                            <div class="col-sm-4 text-center">                                                      
                            </div>
                            <div class="col-sm-4 text-center">          
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-4">
                              Skatt / Tax Invoice
                            </div>
                            <div class="col-sm-4 text-center">  
                              <?php echo $list['vat'];?>                                                    
                            </div>
                            <div class="col-sm-4 text-center">
                              <?php echo $list['vat'];?>                    
                            </div>
                          </div>
                        </td> 

                        <td>
                          <div class="row">
                            <div class="col-sm-6">
                              Bruttolön / Gross Salary (<?php echo $list['currency'];?>)
                            </div>
                            <div class="col-sm-6 text-right">
                              <?php echo $list['gsalary'];?>
                            </div>
                          </div> 

                          <div class="row">
                            <div class="col-sm-6">
                              Förskott / Advance (<?php echo $list['currency'];?>)
                            </div>
                            <div class="col-sm-6 text-right">
                              <?php echo $list['advance'];?>
                            </div>
                          </div> 

                          <div class="row">
                            <div class="col-sm-6">
                              Skatt / Tax Invoice (<?php echo $list['currency'];?>)
                            </div>
                            <div class="col-sm-6 text-right">
                              <?php echo $list['vat'];?>
                            </div>
                          </div>  

                          <div class="row">
                            <div class="col-sm-6">
                              <b>Utbetalt / Paid Out (<?php echo $list['currency'];?>)</b>
                            </div>
                            <div class="col-sm-6 text-right">
                              <b><?php echo $list['nsalary'];?></b>
                            </div>
                          </div>  

                        </td>                        
                      </tr>                            
                      
                      <?php  
                      }
                      ?>
                      
                    </table>
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
                <h3 class="card-title">Salary Slip Details</h3>
              </div>
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
