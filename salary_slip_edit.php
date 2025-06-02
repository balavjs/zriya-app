<?php
  $title = "Salary Slip Update | Zriya Solutions";
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
              <li class="breadcrumb-item active">Update Salary Slip Details</li>
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
                <h3 class="card-title">Update Salary Slip Details</h3>
              </div>        

              <?php 
                $result_usr = new User();                
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];
                 
                  if($role == 1){ 
              ?>

              <div class="card-body">

              <?php
                $result=new DB_salary_slip();

                if(isset($_POST['update'])){

                  $id = $_GET['id'];             
                  
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
                  $id1          = $_POST['id1'];

                  $sql = $result->update($id, $id1, $emp_id, $sal_date, $month, $year, $currency, $gsalary, $advance, $vat, $nsalary, $sal_type, $name, $quantity, $price, $total);
                  
                  if ($sql) {       
                    $_SESSION['success'] = "Salary Slip updated successfully";   
                    header('location:salary_slip_view.php');
                  }
                  else{
                    $_SESSION['error'] = "Salary Slip not updated";   
                    header('location:salary_slip_view.php');
                  }
                }
              ?>

                              

                <form method="post" enctype="multipart/form-data">

                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_salary_slip();
                    $sql1 = $result1->get_one_salary_slip($id);   

                    while($row = mysqli_fetch_array($sql1)){  

                      $emp_id       = $row['emp_id'];                     

                  ?>                                                  

                  <div class="row">                    
                    <div class="col-sm-3">
                      <label>Anställningsnummer / Employee ID</label>
                        <?php
                          $result1 = new DB_user();
                          $sql1 = $result1->get_emp_id_user($emp_id);
                          foreach ($sql1 as $list_user) { 
                            $emp_id1 = $list_user['emp_id'];
                            $fname = $list_user['fname']; 
                            $lname = $list_user['lname']; 
                        ?>
                        <p><?php echo $emp_id1; ?></p>
                                              
                    </div>  
                    <div class="col-sm-3">
                      <label>namn / Name</label>
                      <p><?php echo $fname; ?> <?php echo $lname; ?></p>
                    </div> 
                    <?php
                        }
                        ?>  

                    <div class="col-sm-6">
                      <label>Utbetalningsdag / Issued Date</label>
                      <input type="date" class="form-control" placeholder="Enter the phone" name="sal_date" value="<?php echo $row['sal_date']; ?>" required>
                      <input type="hidden" class="form-control" placeholder="Enter the emp id" name="emp_id" value="<?php echo $list_user['emp_id']; ?>" required>
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
                          <option value="01" <?php if($row['month']=='1'){echo "selected='selected'";} ?>>01</option>
                          <option value="02" <?php if($row['month']=='2'){echo "selected='selected'";} ?>>02</option>
                          <option value="03" <?php if($row['month']=='3'){echo "selected='selected'";} ?>>03</option>
                          <option value="04" <?php if($row['month']=='4'){echo "selected='selected'";} ?>>04</option>
                          <option value="05" <?php if($row['month']=='5'){echo "selected='selected'";} ?>>05</option>
                          <option value="06" <?php if($row['month']=='6'){echo "selected='selected'";} ?>>06</option>
                          <option value="07" <?php if($row['month']=='7'){echo "selected='selected'";} ?>>07</option>
                          <option value="08" <?php if($row['month']=='8'){echo "selected='selected'";} ?>>08</option>
                          <option value="09" <?php if($row['month']=='9'){echo "selected='selected'";} ?>>09</option>
                          <option value="10" <?php if($row['month']=='10'){echo "selected='selected'";} ?>>10</option>
                          <option value="11" <?php if($row['month']=='11'){echo "selected='selected'";} ?>>11</option>           
                          <option value="12" <?php if($row['month']=='12'){echo "selected='selected'";} ?>>12</option>
                        </select>                        
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <label>År / Year</label>
                        <select class="form-control" name="year" required>
                          <option value="" disabled selected>-- Select year --</option>'
                          <option value="2020" <?php if($row['year']=='2020'){echo "selected='selected'";} ?>>2020</option> 
                          <option value="2021" <?php if($row['year']=='2021'){echo "selected='selected'";} ?>>2021</option>
                          <option value="2022" <?php if($row['year']=='2022'){echo "selected='selected'";} ?>>2022</option>
                          <option value="2023" <?php if($row['year']=='2023'){echo "selected='selected'";} ?>>2023</option>
                          <option value="2024" <?php if($row['year']=='2024'){echo "selected='selected'";} ?>>2024</option>
                          <option value="2025" <?php if($row['year']=='2025'){echo "selected='selected'";} ?>>2025</option>
                          <option value="2026" <?php if($row['year']=='2026'){echo "selected='selected'";} ?>>2026</option>
                          <option value="2027" <?php if($row['year']=='2027'){echo "selected='selected'";} ?>>2027</option>
                          <option value="2028" <?php if($row['year']=='2028'){echo "selected='selected'";} ?>>2028</option>
                          <option value="2029" <?php if($row['year']=='2029'){echo "selected='selected'";} ?>>2029</option>
                          <option value="2030" <?php if($row['year']=='2030'){echo "selected='selected'";} ?>>2030</option> 
                        </select> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Currency</label>
                          <select class="form-control" name="currency" required>
                            <option value="" selected disabled>-- Select currency --</option>
                            <option value="SEK" <?php if($row['currency']=='SEK'){echo "selected='selected'";} ?>>SEK</option>
                            <option value="INR" <?php if($row['currency']=='INR'){echo "selected='selected'";} ?>>INR</option>
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

                      <?php
                        $id = $_GET['id'];
                        $sql2 = $result->get_one_salary_slip_detail($id);   
                        $i=0;             
                        foreach ($sql2 as $list2) { 
                          $i++;    
                          $id1            = $list2['id'];
                          $salary_slip_id = $list2['salary_slip_id'];                       
                      ?>

                      <tr>
                        <input type="hidden" class="form-control" name="salary_slip_id[]" value="<?php echo $salary_slip_id; ?>"> 
                        <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">  
                        <td><input type="text" class="form-control" name="sal_type[]" placeholder="Type of salary" id="sal_type_1" data-type="sal_type" value="<?php echo $list2['sal_type'];?>" required></td>
                        <td><input class="form-control" type='text' data-type="name" id='name_1' name='name[]' for="1"/ placeholder="Name" value="<?php echo $list2['name'];?>" required></td>
                        <td><input class="form-control quantity" type='number' data-type="quantity" id='quantity_1' name='quantity[]' for="1"/ placeholder="Quantity" value="<?php echo $list2['quantity'];?>" required></td>
                        <td><input class="form-control price" type='number' data-type="price" id='price_1' name='price[]' for="1"/ placeholder="Price" step="any" value="<?php echo $list2['price'];?>" required></td>
                        <td><input class="form-control total" type='number' data-type="total" id='total_1' name='total[]' for="1"/ placeholder="Total" readonly value="<?php echo $list2['total'];?>" required></td>
                        <td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove circle" disabled  >-</button></td>
                      </tr>
                      <?php
                    }
                  
                    ?>
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
                        <input style="margin-bottom: 10px;" class="form-control gsalary" type='text' id='gsalary' name='gsalary' value="<?php echo $row['gsalary'];?>" readonly/>
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
                        Previous Advance: <?php echo $row['advance']; ?>
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
                        Previous Advance: <?php echo $row['vat']; ?>
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
                        <input style="margin-bottom: 10px;" class="form-control nsalary" type='text' id='nsalary' name='nsalary' value="<?php echo $row['nsalary'];?>" readonly/>
                      </div>
                    </div>              
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="update">Update</button>
                      </div>
                    </div>                    
                  </div>
                </form>
                <?php
                }
                ?>
              </div>
              <?php
              }
              else{
              ?>          
                <div class="card-body">
                  <div class="alert alert-danger" role="alert">
                    <strong>Oops!</strong> You don't have access to view this page.
                  </div>
                </div>          
              <?php    
              }
              ?>
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
    ?>
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>


<script type="text/javascript">

var rowCount = 1;
  
$('#add').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input type="text" class="form-control" name="sal_type[]" placeholder="Type of salary" id="sal_type_'+rowCount+'" data-type="sal_type" for="'+rowCount+'" required></td><td><input class="form-control" type="text" data-type="name" id="name_'+rowCount+'" name="name[]" for="'+rowCount+'"/ placeholder="Name" required></td><td><input class="form-control quantity" type="number" data-type="quantity" id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'"/ placeholder="Quantity" required></td><td><input class="form-control price" type="number" data-type="price" id="price_'+rowCount+'" name="price[]" for="'+rowCount+'"/ placeholder="Price" step="any" required></td><td><input class="form-control total" type="number" data-type="total" id="total_'+rowCount+'" name="total[]" for="'+rowCount+'"/ placeholder="Total" step="any" readonly required></td>><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');

  $("#advance").val("");
  $("#vat").val("");
  
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