<?php
  $title = "Finance - Sweden Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_finance_sv.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finance - Sweden</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="finance_sv_view.php">Finance - Sweden</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  	<!-- Main content -->
  	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">   
            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Add Finance - Sweden</h3>
              </div> 
              <div class="card-body">
                <?php 
 
                  $result_usr = new User();                    
                  $sql_usr = $result_usr->getonerecord($id);

                  foreach ($sql_usr as $list_data) {  
                  $id = $list_data['id'];                  
                  $name1 = $list_data['fullname'];
                  $role = $list_data['role'];

                  if($role == 1 || $role == 5 || $role == 6 || $role == 8){ 
                ?>

                <?php
                  $result=new DB_finance_sv();
                  if(isset($_POST['submit'])){

                    $invoice_no = $_POST['invoice_no'];
                    $receipt_no = $_POST['receipt_no'];  
                    $inv_cnt    = $_POST['inv_cnt'];                   
                    $year       = $_POST['year'];   
                    $signed     = $_POST['signed'];
                    $inv_date   = $_POST['inv_date'];
                    $terms      = $_POST['terms'];
                    $due_date   = $_POST['due_date'];
                    $comp_id    = $_POST['comp_id'];
                    $status     = $_POST['status'];

                    $product_desc    = $_POST['product_desc'];
                    $hrs_rate   = $_POST['hrs_rate'];
                    $hrs_nos    = $_POST['hrs_nos'];
                    $price      = $_POST['price'];
                    $vat        = $_POST['vat'];
                    $total      = $_POST['total'];
                    $pricetotal = $_POST['pricetotal']; 
                    $momtotal   = $_POST['momtotal']; 
                    $subtotal   = $_POST['subtotal'];  
                    $advance    = $_POST['advance'];
                    $gtotal     = $_POST['gtotal'];
                    $comment    = $_POST['comment'];       
                                   

                    $sql = $result->insert($invoice_no, $receipt_no, $inv_cnt, $year, $signed, $inv_date, $terms, $due_date, $comp_id, $product_desc, $hrs_rate, $hrs_nos, $price, $vat, $total, $pricetotal, $momtotal, $subtotal, $advance, $gtotal, $comment, $status);

                    if ($sql) {                          
                      $_SESSION['success'] = "New Invoice added successfully";   
                      header('location:finance_sv_view.php');
                    }
                    else{
                      $_SESSION['error'] = "Invoice not created";   
                      header('location:finance_sv_view.php');
                    }
                  }
                ?>                    

              <form method="post" name="myform" onsubmit="enableSample();">
                <div class="row">                    
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Signed Off</label>
                      <input type="text" class="form-control" placeholder="Enter the signed off name" name="signed" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date of Invoice</label>
                      <input type="date" class="form-control" placeholder="Enter the date" id="inv_date" name="inv_date" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date / Days </label>
                      <select class="form-control" name="p_terms" id="p_terms" onChange=showHide() required>
                       <option value="0" selected disabled> --Select--</option>
                       <option value="1">Due Date</option>
                       <option value="2">Payment Terms</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3" id="date" style="display:none;">
                    <div class="form-group">
                      <label>Due Date</label>
                      <input type="date" class="form-control" placeholder="Enter the due date" id="due_date" name="due_date" onchange="date()" required>
                    </div>
                  </div>
                  <div class="col-md-3" id="day" style="display:none;">
                    <div class="form-group">
                      <label>Payment Terms</label>
                      <select class="form-control" id="terms" name="terms" onchange="day()" required>
                        <option value="0" selected disabled>-- Select terms --</option>
                        <option value="30">30 Days</option>
                        <option value="45">45 Days</option>
                        <option value="60">60 Days</option>
                        <option value="90">90 Days</option>
                      </select>   
                    </div>
                  </div>
                </div>

                <script>
                  function showHide() {
                    let p_terms = document.getElementById('p_terms')
                    if (p_terms.value == 1) {
                      document.getElementById('date').style.display = 'block';
                      document.getElementById('day').style.display = 'none';
                      document.getElementById('due_date').required = true;
                      document.getElementById('terms').required = false;
                      document.getElementById('terms').value= "0";
                    } 
                    else if (p_terms.value == 2){
                      document.getElementById('day').style.display = 'block';
                      document.getElementById('date').style.display = 'none';
                      document.getElementById('terms').required = true;
                      document.getElementById('due_date').required = false;
                      document.getElementById('due_date').value= "";
                    }
                    else{
                      document.getElementById('day').style.display = 'none';
                      document.getElementById('date').style.display = 'none';
                      document.getElementById('terms').required = false;
                      document.getElementById('due_date').required = false;
                      document.getElementById('due_date').value= "";
                      document.getElementById('terms').value= "0";
                    }
                  }

                  function day() {  
                    document.getElementById('due_date').value= ""; 
                  }

                  function date() {  
                    document.getElementById('terms').value= "0";                       
                  }

                </script>                
                
                <div class="row">
                    <?php 

                      $y1 = date('y');      
                      //$y1 = 24;                  

                      $result = new DB_finance_sv();
                      $sql = $result->list_finance_sv_last1();  

                      $i=0;    
                      $row_cnt1 = $sql->num_rows; 
                      if($row_cnt1 == 0){   
                        $next_id = 1;
                      }
                      else{       
                      foreach ($sql as $list) { 
                        //echo $list['id']."<br>";
                        //echo $list['invoice_no']."<br>";
                        //echo $list['inv_cnt']."<br>";

                        $string = $list['inv_cnt'];

                        $last_id = $string;

                        $sql3 = $result->list_finance_sv_year($y1);
                        $row_cnt = $sql3->num_rows; 
                        if($row_cnt == 0){ 
                          $next_id = 1;
                          //echo $next_id;
                        }
                        else{
                          $next_id = $last_id + 1;
                          //echo $next_id;
                        }
                        //echo "Next ID : ".$next_id."<br>";
                        //echo "Year : ".$list['year']."<br>";
                       // echo "Current Year : ".$y1."<br>";
                      }
                      }
                    ?>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Invoice No</label>
                        <input type="text" class="form-control" placeholder="Enter the Invoice No" name="invoice_no" value="INV-SV-<?php echo $y1."-000".$next_id; ?>" readonly required>
                        <input type="hidden" class="form-control" placeholder="Enter the Receipt no" name="receipt_no" value="REC-SV-<?php echo $y1."-000".$next_id; ?>" readonly required>
                        <input type="hidden" class="form-control" placeholder="Enter last id" name="inv_cnt" value="<?php echo $next_id; ?>"  required>
                        <input type="hidden" class="form-control" placeholder="Enter the year" name="year" value="<?php echo $y1; ?>"  required>
                      </div> 
                    </div> 
                  </div>
                  
                <div class="row">                    
                  <div class="col-sm-6">
                  <label>Select Company</label>
                  
                    <select class="form-control sel_comp" id="sel_comp" name="comp_id" required>
                      <option selected disabled value="">-- Select the Company --</option>
                      <?php
                      $result = new DB_finance_sv();
                      $sql = $result->list_company();
                      foreach ($sql as $list) { ?>     
                        
                      <option value="<?php echo $list['id']; ?>"><?php echo $list['comp_name']; ?></option>
                      <?php
                      }
                        ?>
                    </select>
                  </div>
                  <div class="col-sm-6 d-flex align-items-end">
                    <label>(*If not in the list click here)</label>&nbsp;&nbsp;
                    <a href="company_add.php" class="btn btn-zo">Add New Company</a>
                  </div>
                </div>
                <br>

                <div class="row"> 
                  <div class="col-md-12">
                    <!-- display company details -->
                    <div id="show-city"> </div>
                  </div>  
                </div>

                <div class="row"> 
                  <table class="table" id="orders">
                    <tr class="tr_bg">
                      <td colspan="6" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Description </strong></td>
                      <td><button type="button" name="add" id="add" class="btn btn-zg circle">+</button></td>
                    </tr>
                    <tr>
                      <th>Description</th>
                      <th>Hour Rate</th>
                      <th>No.of Hours</th>
                      <th>Price (SEK)</th>
                      <th>MOMS (SEK) 25%</th>
                      <th>Total (SEK)</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control" name="product_desc[]" placeholder="Description" id="description_1" data-type="price" required></td>
                      <td><input class="form-control hrs_rate" type='number' data-type="hrs_rate" id='hrs_rate_1' name='hrs_rate[]' for="1"/ placeholder="Hour Rate" step="any" ></td>
                      <td><input class="form-control hrs_nos" type='number' data-type="hrs_nos" id='hrs_nos_1' name='hrs_nos[]' for="1"/ placeholder="No.of Hour" step="any" ></td>
                      <td><input class="form-control price" type='number' data-type="price" id='price_1' name='price[]' for="1"/  placeholder="Price" required step="any" ></td> 
                      <td><input class="form-control vat" type='number' id='vat_1' name='vat[]' for="1"/ readonly></td>
                      <td><input class="form-control total" type='text' id='total_1' name='total[]' for='1' readonly/></td>
                      <td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle" disabled  >-</button></td>
                    </tr>
                  </table>
                  <table class="table">
                    <tr>
                      <td></td>
                      <td></td>
                      <th width="160px">Subtotal (SEK)</th>
                      <td width="160px">
                        <input style="margin-bottom: 10px;" class="form-control pricetotal" type='text' id='pricetotal' name='pricetotal' readonly/>
                      </td>
                      <td width="160px">
                        <input style="margin-bottom: 10px;" class="form-control momtotal" type='text' id='momtotal' name='momtotal' readonly/>
                      </td>
                      <td width="160px">
                        <input style="margin-bottom: 10px;" class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly/>
                      </td>
                      <td width="70px"></td>
                    </tr>
                  </table>
                  <input class="form-control" type='hidden' data-type="product_id_1" id='product_id_1' name='product_id[]'/>
                </div>
                
                <div class="row">                      
                  <div class="col-md-8" style="text-align: right;">
                    <div class="form-group">
                      <label>Advance (SEK)</label>
                    </div>
                  </div>
                  <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                    <div class="form-group">                        
                      <input style="margin-bottom: 10px;" class="form-control advance" type='number' id='advance' name='advance' required />
                    </div>
                  </div>              
                </div>

                <div class="row">                      
                  <div class="col-md-8" style="text-align: right;">
                    <div class="form-group">
                      <label>Grand Total (SEK)</label>
                    </div>
                  </div>
                  <div class="col-md-4 pull-right nopadding" style="padding: 0 80px 0 40px;">
                    <div class="form-group">            
                      <input style="margin-bottom: 10px;" class="form-control gtotal" type='text' id='gtotal' name='gtotal' readonly/>
                    </div>
                  </div>              
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Comments</label>
                      <textarea  style="height: 123px;" class="form-control tinymce" rows="4" placeholder="Enter the comments" name="comment"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Status</label>
                        <select class="form-control" name="status" required>
                          <option value="" selected disabled>-- Select Status --</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>            
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
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="alert alert-danger" role="alert">
                        <strong>Oops!</strong> You don't have access to view this page.
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

<script type="text/javascript">

var rowCount = 1;
  
$('#add').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input class="form-control description" type="text" data-type="description" id="description_'+rowCount+'" name="product_desc[]" for="'+rowCount+'" placeholder="Description" required/></td><td><input class="form-control hrs_rate" type="number" data-type="hrs_rate" id="hrs_rate_'+rowCount+'" name="hrs_rate[]" for="'+rowCount+'"/ placeholder="Hour Rate" step="any" ></td><td><input class="form-control hrs_nos" type="number" data-type="hrs_nos" id="hrs_nos_'+rowCount+'" name="hrs_nos[]" for="'+rowCount+'"/ placeholder="No.of Hour" step="any" ></td><td><input class="form-control price" type="number" data-type="price" id="price_'+rowCount+'" name="price[]" for="'+rowCount+'"  placeholder="Price" required step="any" /></td><input class="form-control" type="hidden" data-type="product_id" id="product_id_'+rowCount+'" name="product_id[]" for="'+rowCount+'"/><td><input class="form-control vat" type="number" class="vat" id="vat_'+rowCount+'" name="vat[]" for="'+rowCount+'"/ readonly> </td><td><input class="form-control total" type="text" id="total_'+rowCount+'" name="total[]"  for="'+rowCount+'" readonly/> </td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
  $("#advance").val(""); 
});

// Add a generic event listener for any change on vat or price classed inputs
$("#orders").on('input', 'input.vat,input.price,input.hrs_rate,input.hrs_nos', function() {
  getTotalCost($(this).attr("for"));
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
  $("#advance").val(""); 
  calculateSubTotal();
});

// Using a new index rather than your global variable i
function getTotalCost(ind) {
  
  var hrs_rate = $('#hrs_rate_'+ind).val();
  var hrs_nos = $('#hrs_nos_'+ind).val();

  if (hrs_rate !== ""  && hrs_nos !== "") {
    var price = (hrs_rate * hrs_nos).toFixed(2);
    $('#price_'+ind).val(price);
    $('#price_'+ind).val().disabled = true;
  }
  else{
    var price = $('#price_'+ind).val();
  }

  var tot1 = (0.25 * price);
  var totNumber = (+tot1 + +price);
  var tot = totNumber.toFixed(2);
  var tot1 = tot1.toFixed(2);
  $('#total_'+ind).val(tot);
  $('#vat_'+ind).val(tot1);
  $("#advance").val(""); 
  calculateSubTotal();
}

function calculateSubTotal() {
  var pricetotal = 0;
  var momtotal = 0;
  var subtotal = 0;  
  var gtotal = 0;
  $('.total').each(function() {
     subtotal += parseFloat($(this).val());
     gtotal += parseFloat($(this).val());
  });
  $('.price').each(function() {
     pricetotal += parseFloat($(this).val());
  });
  $('.vat').each(function() {
     momtotal += parseFloat($(this).val());
  });
  var pricetotal = pricetotal.toFixed(2);
  var momtotal = momtotal.toFixed(2);
  var subtotal = subtotal.toFixed(2);
  var gtotal = gtotal.toFixed(2);
  $('#pricetotal').val(pricetotal);
  $('#momtotal').val(momtotal);
  $('#subtotal').val(subtotal);
  $('#gtotal').val(gtotal);  
 
}

$("#advance").on("keyup", function() {
  
  var val = +this.value || 0;
  var gtotal = 0;
  $("#gtotal").val(($("#subtotal").val() - val).toFixed(2));
  
});

</script>

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_comp").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "display.php",
            type:"POST",
            cache:false,
            data:{id:id},
            success:function(data){
              $("#show-city").html(data);
            }
          });
        }else{
          $("#show-city").html(" ");
        }
      })
  });
</script>
