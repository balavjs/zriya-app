<?php
  $title = "Salary Slip Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_salary_slip.php'); ?>
<?php include('class/class_users.php'); ?>

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
              <li class="breadcrumb-item active">Add New Salary Slip</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add New Salary Slip</h3>
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

                $result=new DB_salary_slip();
                if(isset($_POST['submit'])){              

                  $emp_id       = $_POST['emp_id'];
                  $sal_date     = $_POST['sal_date'];
                  $month        = $_POST['month'];
                  $year         = $_POST['year']; 
                  $currency     = $_POST['currency'];  
                  $gsalary      = $_POST['gsalary'];
                  $advance      = $_POST['advance'];
                  $vat          = $_POST['vat'];  
                  $nsalary      = $_POST['nsalary']; 
                  
                  $sal_type     = $_POST['sal_type']; 
                  $name         = $_POST['name'];  
                  $quantity     = $_POST['quantity']; 
                  $price        = $_POST['price']; 
                  $total        = $_POST['total'];                  
                                 
                  $sql = $result->insert($emp_id, $sal_date, $month, $year, $currency, $gsalary, $advance, $vat, $nsalary, $sal_type, $name, $quantity, $price, $total);
                  
                  if ($sql) {       
                    $_SESSION['success'] = "New Salary Slip added successfully";   
                    header('location:salary_slip_view.php');
                  }
                  else{
                    $_SESSION['error'] = "Salary Slip not added";   
                    header('location:salary_slip_view.php');
                  }
              }
              ?>

                <form method="post" name="myform" onsubmit="enableSample();" enctype="multipart/form-data">

                  <div class="row">                    
                    <div class="col-sm-6">
                      <label>Anställningsnummer / Employee ID</label>
                    
                      <select class="form-control sel_comp" id="sel_emp_id" name="emp_id" required>
                        <option selected disabled value="">-- Select Employee ID --</option>
                        <?php
                          $result1 = new DB_user();
                          $sql1 = $result1->list_user_only();
                          foreach ($sql1 as $list_user) {   
                        ?>
                        <option value="<?php echo $list_user['id']; ?>"><?php echo $list_user['emp_id']; ?> - <?php echo $list_user['fname']; ?> <?php echo $list_user['lname']; ?></option>
                        <?php
                        }
                          ?>
                      </select>
                    </div>    
                    <div class="col-sm-6">
                      <label>Utbetalningsdag / Issued Date</label>
                      <input type="date" class="form-control" placeholder="Enter the phone" name="sal_date" required>
                    </div>                
                  </div>

                  <br>

                  <div class="row"> 
                    <div class="col-md-12">
                      <!-- display company details -->
                      <div id="show-emp"> </div>
                    </div>  
                  </div>

                  <div class="row">              
                     <div class="col-md-4">
                      <div class="form-group">
                        <label>Månad / Month</label>
                          <select class="form-control" name="month" required>
                            <option value="" selected disabled>-- Select Month --</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>                          
                            <option value="12">12</option>
                          </select>                        
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <?php
                          $starting_year  = 2020;
                          $ending_year    = 2030;

                          for($starting_year; $starting_year <= $ending_year; $starting_year++) {
                              $years[] = '<option value="'.$starting_year.'">'.$starting_year.'</option>';
                          }
                        ?>
                        <label>År / Year</label>
                        <select class="form-control" name="year" required>
                          <option value="" disabled selected>-- Select year --</option>'
                            <?php echo implode("\n\r", $years);  ?>
                        </select> 
                      </div>
                    </div>  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Currency</label>
                          <select class="form-control" name="currency" required>
                            <option value="" selected disabled>-- Select Currency --</option>
                            <option value="SEK">SEK</option>
                            <option value="INR">INR</option>
                          </select>            
                      </div> 
                    </div>                   
                  </div> 

                  <div class="row"> 
                    <table class="table" id="orders">
                      <tr class="tr_bg">
                        <td colspan="5" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Lönebesked / Salary notice</strong></td>
                        <td><button type="button" name="add" id="add" class="btn btn-zg circle">+</button></td>
                      </tr>
                      <tr>
                        <th>Löneart / Type of salary</th>
                        <th>Benämning / Description</th>
                        <th>Antal / Quantity</th>
                        <th>Kronor / Price</th>
                        <th>Totalt / Total</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td><input type="text" class="form-control" name="sal_type[]" placeholder="Type of salary" id="sal_type_1" data-type="sal_type" required></td>
                        <td><input class="form-control" type='text' data-type="name" id='name_1' name='name[]' for="1"/ placeholder="Name" required></td>
                        <td><input class="form-control quantity" type='number' data-type="quantity" id='quantity_1' name='quantity[]' for="1"/ placeholder="Quantity" required></td>
                        <td><input class="form-control price" type='number' data-type="price" id='price_1' name='price[]' for="1"/ placeholder="Price" step="any" required></td>
                        <td><input class="form-control total" type='number' data-type="total" id='total_1' name='total[]' for="1"/ placeholder="Total" readonly required></td>
                        <td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove circle" disabled  >-</button></td>
                      </tr>
                    </table>                    
                  </div>

                  <div class="row">                      
                    <div class="col-md-8" style="text-align: right;">
                      <div class="form-group">
                        <label>Bruttolön / Gross Salary</label>
                      </div>
                    </div>
                    <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                      <div class="form-group">            
                        <input style="margin-bottom: 10px;" class="form-control gsalary" type='text' id='gsalary' name='gsalary' readonly/>
                      </div>
                    </div>              
                  </div>

                  <div class="row">                      
                    <div class="col-md-8" style="text-align: right;">
                      <div class="form-group">
                        <label>Förskott / Advance</label>
                      </div>
                    </div>
                    <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                      <div class="form-group">                        
                        <input style="margin-bottom: 10px;" class="form-control advance" type='number' id='advance' name='advance' oninput="myFunction()" required />
                      </div>
                    </div>              
                  </div>

                  <div class="row">                      
                    <div class="col-md-8" style="text-align: right;">
                      <div class="form-group">
                        <label>Skatt / Tax Invoice</label>
                      </div>
                    </div>
                    <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                      <div class="form-group">                        
                        <input style="margin-bottom: 10px;" class="form-control vat" type='number' id='vat' name='vat' step="any" oninput="myFunction()" required />
                      </div>
                    </div>              
                  </div>

                  <div class="row">                      
                    <div class="col-md-8" style="text-align: right;">
                      <div class="form-group">
                        <label>Utbetalt / Paid Out</label>
                      </div>
                    </div>
                    <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                      <div class="form-group">            
                        <input style="margin-bottom: 10px;" class="form-control nsalary" type='text' id='nsalary' name='nsalary' readonly/>
                      </div>
                    </div>              
                  </div> 

                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit">Submit</button>
                      </div>
                    </div>                    
                  </div> 
                </form>               
              </div>

              <?php
              }
              else{
              ?>
              
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">             

                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Salary Slip</h3>
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

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_emp_id").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "get_emp_details.php",
            type:"POST",
            cache:false,
            data:{id:id},
            success:function(data){
              $("#show-emp").html(data);
            }
          });
        }else{
          $("show-emp").html(" ");
        }
      })
  });
</script>

<script type="text/javascript">

var rowCount = 1;
  
$('#add').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input type="text" class="form-control" name="sal_type[]" placeholder="Type of salary" id="sal_type_'+rowCount+'" data-type="sal_type" for="'+rowCount+'" required></td><td><input class="form-control" type="text" data-type="name" id="name_'+rowCount+'" name="name[]" for="'+rowCount+'"/ placeholder="Name" required></td><td><input class="form-control quantity" type="number" data-type="quantity" id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'"/ placeholder="Quantity" required></td><td><input class="form-control price" type="number" data-type="price" id="price_'+rowCount+'" name="price[]" for="'+rowCount+'"/ placeholder="Price" step="any" required></td><td><input class="form-control total" type="number" data-type="total" id="total_'+rowCount+'" name="total[]" for="'+rowCount+'"/ placeholder="Total" step="any" readonly required></td>><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
  $("#advance").val("");
  $("#vat").val("");
  calculategsalary();
});

// Add a generic event listener for any change on vat or price classed inputs
$("#orders").on('input', 'input.price,input.quantity', function() {
  getTotalCost($(this).attr("for"));
  
});


// Using a new index rather than your global variable i
function getTotalCost(ind) {
  var price     = $('#price_'+ind).val();
  var quantity  = $('#quantity_'+ind).val();

  var tot1 = (price * quantity);
  var tot = tot1.toFixed(2);
  var tot1 = tot1.toFixed(2);

  $('#total_'+ind).val(tot);
  calculategsalary();
}

function calculategsalary() {
  
  var gsalary = 0;
  var nsalary = 0;
  $('.total').each(function() {
     gsalary += parseFloat($(this).val());
     nsalary += parseFloat($(this).val());
  });   
  
  var gsalary = gsalary.toFixed(2);
  var nsalary = nsalary.toFixed(2);
  $('#gsalary').val(gsalary);
  $('#nsalary').val(nsalary);  
 
}

/*
$("#advance").on("keyup", function() {
  
  var val = +this.value || 0;
  var nsalary = 0;
  $("#nsalary").val(($("#gsalary").val() - val).toFixed(2));
  
});

*/
  

  function myFunction() {
    var advance  = $('#advance').val();
    var vat  = $('#vat').val();
    var deduction = +advance + +vat;
    $("#nsalary").val(($("#gsalary").val() - deduction).toFixed(2));
  }

</script>