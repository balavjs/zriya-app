<?php
  $title = "Finance - India Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_finance_in.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finance - India</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="finance_in_view.php">Finance - India</a></li>
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
                <h3 class="card-title">Finance - India Details</h3>
              </div>        

            <?php 
              $result_usr = new User();              
              $sql_usr = $result_usr->getonerecord($id);

              foreach ($sql_usr as $list_data) {  
              $id = $list_data['id'];                  
              $name1 = $list_data['fullname'];
              $role = $list_data['role'];
              
                if($role == 1 || $role == 5 || $role == 6 || $role == 7){ 
            ?>

            <div class="card-body">            

            <?php
              $result=new DB_finance_in();

              if(isset($_POST['update'])){
                $id = $_GET['id'];
                
                $id1        = $_POST['id1'];
                $signed     = $_POST['signed'];
                $comp_id    = $_POST['comp_id'];                
                $status     = $_POST['status'];
                $p_status   = $_POST['p_status'];
                $p_date     = $_POST['p_date'];
                $p_comment  = $_POST['p_comment'];

                $product_desc    = $_POST['product_desc'];                
                $hrs_rate   = $_POST['hrs_rate'];
                $hrs_nos    = $_POST['hrs_nos'];
                $price      = $_POST['price'];
                $vat        = $_POST['vat'];   
                $vatval     = $_POST['vatval'];             
                $currency   = $_POST['currency'];
                $total      = $_POST['total'];
                $pricetotal = $_POST['pricetotal']; 
                $momtotal   = $_POST['momtotal']; 
                $subtotal   = $_POST['subtotal'];
                $advance    = $_POST['advance'];
                $gtotal     = $_POST['gtotal'];
                $comment    = $_POST['comment'];
                
                $sql = $result->update($id, $id1, $signed, $comp_id, $p_status, $p_date, $p_comment, $product_desc, $hrs_rate, $hrs_nos, $price, $currency, $vat, $vatval, $total, $pricetotal, $momtotal, $subtotal, $advance, $gtotal, $comment, $status);
                
                if ($sql) {                          
                  $_SESSION['success'] = "Invoice updated successfully";   
                  header('location:finance_in_view.php');
                }
                else{
                  $_SESSION['error'] = "Invoice not updated";   
                  header('location:finance_in_view.php');
                }
              }
            ?>
                <form method="post">

                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_finance_in();
                    $sql1 = $result1->get_one_finance_in($id);   

                    while($row = mysqli_fetch_array($sql1)){    

                  ?>

                  <div class="row">                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the signed off name" name="signed" value="<?php echo $row['signed']; ?>"required>
                      </div>
                    </div>                    
                  </div>

                  <div class="row">                    
                    <div class="col-sm-6">
                    <label>Select Company</label>                    
                      <select class="form-control sel_comp" id="sel_comp" name="comp_id" required>
                        <option selected disabled value="">-- Select the Company --</option>                       

                        <?php
                          $comp_id = $row['comp_id'];
                          
                          $sql3 = $result->list_company();
                          foreach ($sql3 as $list_company) {
                            $comp_id1 = $list_company['id'];
                            $comp_name1 = $list_company['comp_name'];
                        ?>

                        <option value="<?php echo $comp_id1; ?>" <?php if($comp_id1 == $comp_id){echo "selected='selected'";}?>><?php echo $comp_name1; ?></option>
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
                  <br>
                  <div class="row">
                    <table class="table" id="orders">
                      <tr class="tr_bg">
                        <td colspan="8" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Description </strong></td>
                        <td><button type="button" name="add" id="add" class="btn btn-zg circle">+</button></td>
                      </tr>
                      <tr>
                        <th>Description</th>
                        <th>Hour Rate</th>
                        <th>No.of Hours</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th>MOMS %</th>
                        <th>MOMS/ GST/ VAT</th>
                        <th>Total</th>
                      </tr>
                      <?php

                      $result=new DB_finance_in();
                      $id = $_GET['id'];
                      $sqlf = $result->list_finance_in_desc($id);
                      $i=0;

                      if (is_array($sqlf) || is_object($sqlf)) {
                      foreach ($sqlf as $list) {  
                        $i++;                       

                        $id1 = $list['id'];
                        $finance_in_id = $list['finance_in_id'];       
                        $product_desc = $list['product_desc'];                        
                        $hrs_rate     = $list['hrs_rate']; 
                        $hrs_nos      = $list['hrs_nos']; 
                        $price        = $list['price'];   
                        $currency     = $list['currency'];
                        $vat          = $list['vat']; 
                        $vatval       = $list['vatval']; 
                        $total        = $list['total'];                     
                            
                      ?>
                      <tr id="tr_rows">
                        <input type="hidden" class="form-control" name="finance_in_id[]" value="<?php echo $finance_in_id; ?>">  
                        <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">
                        <td><input type="text" class="form-control" name="product_desc[]" placeholder="Description" id="description_<?php echo $i; ?>" data-type="price" value="<?php echo $product_desc; ?>" for="<?php echo $i; ?>"/ required></td>
                        <td><input class="form-control hrs_rate" type="number" data-type="hrs_rate" id="hrs_rate_<?php echo $i; ?>" name="hrs_rate[]" for="<?php echo $i; ?>"/ value="<?php echo $hrs_rate; ?>" placeholder="Hour Rate" step="any"></td>
                        <td><input class="form-control hrs_nos" type='number' data-type="hrs_nos" id='hrs_nos_<?php echo $i; ?>' name='hrs_nos[]' for="<?php echo $i; ?>"/ value="<?php echo $hrs_nos; ?>" placeholder="No.of Hour" step="any"></td>
                        <td><input class="form-control price" type='number' data-type="price" id='price_<?php echo $i; ?>' name='price[]' value="<?php echo $price; ?>" for="<?php echo $i; ?>"/ step="any"></td> 
                        <td>
                          <select class="form-control currency" id='currency_<?php echo $i; ?>' name="currency[]" for="<?php echo $i; ?>"/ required>
                            <option value="" selected disabled>-- Currency --</option>
                            <option value="USD" <?php if($currency=='USD'){echo "selected='selected'";} ?>>USD</option>
                            <option value="DKK" <?php if($currency=='DKK'){echo "selected='selected'";} ?>>DKK</option>
                            <option value="NOK" <?php if($currency=='NOK'){echo "selected='selected'";} ?>>NOK</option>
                            <option value="SEK" <?php if($currency=='SEK'){echo "selected='selected'";} ?>>SEK</option>
                            <option value="INR" <?php if($currency=='INR'){echo "selected='selected'";} ?>>INR</option>
                            <option value="EUR" <?php if($currency=='EUR'){echo "selected='selected'";} ?>>EUR</option>
                          </select>
                        </td>
                        <td>                          
                          <select class="form-control vat" id='vat_<?php echo $i; ?>' name="vat[]" for="<?php echo $i; ?>"/ required>
                            <option value="" selected disabled>-- Select --</option>
                            <option value="0" <?php if($vat=='0'){echo "selected='selected'";} ?>>0%</option>
                            <option value="0.05" <?php if($vat=='0.05'){echo "selected='selected'";} ?>>5%</option>
                            <option value="0.12" <?php if($vat=='0.12'){echo "selected='selected'";} ?>>12%</option>
                            <option value="0.18" <?php if($vat=='0.18'){echo "selected='selected'";} ?>>18%</option>
                            <option value="0.25" <?php if($vat=='0.25'){echo "selected='selected'";} ?>>25%</option>
                            <option value="0.28" <?php if($vat=='0.28'){echo "selected='selected'";} ?>>28%</option>
                          </select>
                        </td>    
                        <td><input class="form-control vatval" type='text' id='vatval_<?php echo $i; ?>' name='vatval[]' value="<?php echo $vatval; ?>" for='<?php echo $i; ?>' readonly/></td>                    
                        <td><input class="form-control total" type='text' id='total_<?php echo $i; ?>' name='total[]' value="<?php echo $total; ?>" for="<?php echo $i; ?>"/ readonly/></td> 
                        <td><a href="finance_in_det_delete.php?id=<?php echo $id1;?>&row_id=<?php echo $id;?>" onClick="return confirm('Do you really want to delete?');"><button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove cicle">-</button></a></td>                      
                      </tr>
                      <?php
                        }
                      }
                    ?>

                    </table>
                    <hr>
                    <table class="table">
                      <tr>
                        <td></td>
                        <td></td>
                        <th width="120px">Subtotal (SEK)</th>
                        <td width="120px">
                          <input style="margin-bottom: 10px;" class="form-control pricetotal" type='text' id='pricetotal' name='pricetotal' value="<?php echo $row['pricetotal']; ?>" readonly/>
                        </td>
                        <td width="120px"></td>
                        <td width="150px"></td>
                        <td width="110px">
                          <input style="margin-bottom: 10px;" class="form-control momtotal" type='text' id='momtotal' name='momtotal' value="<?php echo $row['momtotal']; ?>" readonly/>
                        </td>
                        <td width="110px">
                          <input style="margin-bottom: 10px;" class="form-control subtotal" type='text' id='subtotal' name='subtotal' value="<?php echo $row['subtotal']; ?>" readonly/>
                        </td>
                        <td width="60px"></td>
                      </tr>
                    </table>
                    <input class="form-control" type='hidden' data-type="product_id_1" id='product_id_1' name='product_id[]'/>    
                  </div>

                  <div class="row">                      
                    <div class="col-md-9" style="text-align: right;">
                      <div class="form-group">
                        <label>Advance</label><br>
                        Existing Advance: <?php echo $row['advance']; ?>
                      </div>
                    </div>
                    <div class="col-md-3 pull-right nopadding" style="padding: 0 16px 0 16px;">
                      <div class="form-group">                        
                        <input style="margin-bottom: 10px;" class="form-control advance" type='number' id='advance' name='advance' placeholder="Enter Advance" required />                       
                      </div>
                    </div>              
                  </div>

                  <div class="row">                      
                    <div class="col-md-9" style="text-align: right;">
                      <div class="form-group">
                        <label>Grand Total</label>
                      </div>
                    </div>
                    <div class="col-md-3 pull-right nopadding" style="padding: 0 16px 0 16px;">
                      <div class="form-group">
                        <input style="margin-bottom: 10px;" class="form-control gtotal" type='text' id='gtotal' name='gtotal' readonly value="<?php echo $row['gtotal']; ?>"/>
                      </div>
                    </div>              
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Comments</label>
                        <textarea  style="height: 123px;" class="form-control tinymce" rows="4" placeholder="Enter the comments" name="comment"><?php echo $row['comment']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Paid / Unpaid</label>
                          <select class="form-control" name="p_status" id="p_status" onchange="showDiv(this)" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="1" <?php if($row['p_status']=='1'){echo "selected='selected'";} ?>>Paid</option>
                            <option value="0" <?php if($row['p_status']=='0'){echo "selected='selected'";} ?>>Unpaid</option>
                          </select>          
                      </div>
                    </div>                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status" required>
                            <option value="" selected disabled>-- Select Status --</option>
                            <option value="1" <?php if($row['status']=='1'){echo "selected='selected'";} ?>>Active</option>
                            <option value="0" <?php if($row['status']=='0'){echo "selected='selected'";} ?>>Inactive</option>
                          </select>          
                      </div>                      
                    </div>
                  </div>

                  <div class="row" id="p_row" style="display: none;">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" class="form-control" name="p_date" id="p_date" value="<?php echo $row['p_date']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Payment Comments</label>
                        <textarea style="height: 123px;" class="form-control" id="p_comment" rows="4" placeholder="Enter the comments" name="p_comment"><?php echo $row['p_comment']; ?></textarea>
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
            <!-- /.card -->
            </div>


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
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card-body">
              <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> You don't have access to view this page.
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

<script type="text/javascript">

var rowCount = ($("#orders > tbody > #tr_rows").length);

$('#add').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input class="form-control description" type="text" data-type="description" id="description_'+rowCount+'" name="product_desc[]" for="'+rowCount+'" placeholder="Description" required/></td><td><input class="form-control hrs_rate" type="number" data-type="hrs_rate" id="hrs_rate_'+rowCount+'" name="hrs_rate[]" for="'+rowCount+'"/ placeholder="Hour Rate" step="any"></td><td><input class="form-control hrs_nos" type="number" data-type="hrs_nos" id="hrs_nos_'+rowCount+'" name="hrs_nos[]" for="'+rowCount+'"/ placeholder="No.of Hour" step="any"></td><td><input class="form-control price" type="number" data-type="price" id="price_'+rowCount+'" name="price[]" for="'+rowCount+'" placeholder="Price" step="any" required/></td><td><select class="form-control currency" name="currency[]" id="currency_'+rowCount+'" name="currency[]" for="'+rowCount+'" required><option value="" selected disabled>-- Currency --</option><option value="USD">USD</option><option value="DKK">DKK</option><option value="NOK">NOK</option><option value="SEK">SEK</option><option value="INR">INR</option><option value="EUR">EUR</option></select></td><input class="form-control" type="hidden" data-type="product_id" id="product_id_'+rowCount+'" name="product_id[]" for="'+rowCount+'"/></td><td><select class="form-control vat" id="vat_'+rowCount+'" name="vat[]" for="'+rowCount+'"/ required><option value="" selected disabled>-- Select --</option><option value="0">0%</option><option value="0.05">5%</option><option value="0.12">12%</option><option value="0.18">18%</option><option value="0.25">25%</option><option value="0.28">28%</option></select></td><td><input class="form-control vatval" type="text" id="vatval_'+rowCount+'" name="vatval[]"  for="'+rowCount+'" readonly/> </td><td><input class="form-control total" type="text" id="total_'+rowCount+'" name="total[]"  for="'+rowCount+'" readonly/> </td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
  $("#advance").val("");
});

// Add a generic event listener for any change on vat or price classed inputs
$("#orders").on('input', '.vat,input.price,input.hrs_rate,input.hrs_nos', function() {
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
  
  var vat = $('#vat_'+ind).val();
  var tot1 = (vat * price);
  var totNumber = (+tot1 + +price);
  var tot = totNumber.toFixed(2);
  var tot1 = tot1.toFixed(2);
  var tot2 = (vat * price);
  var tot2 = tot2.toFixed(2)
  var totNumber = (+tot1 + +price);
  $('#vatval_'+ind).val(tot2);
  $('#total_'+ind).val(tot);
  //$('#vat_'+ind).val(tot1);
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
  $('.vatval').each(function() {
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
  if(val >= 0){
    $("#gtotal").val(($("#subtotal").val() - val).toFixed(2));
    calculateSubTotal1();
  }
});

function calculateSubTotal1() {
  var pricetotal = 0;
  var momtotal = 0;
  var subtotal = 0;
  $('.total').each(function() {
     subtotal += parseFloat($(this).val());
  });
   $('.price').each(function() {
     pricetotal += parseFloat($(this).val());
  });
  $('.vatval').each(function() {
     momtotal += parseFloat($(this).val());
  });
  var pricetotal = pricetotal.toFixed(2);
  var momtotal = momtotal.toFixed(2);
  var subtotal = subtotal.toFixed(2);
  $('#pricetotal').val(pricetotal);
  $('#momtotal').val(momtotal);
  $('#subtotal').val(subtotal);
  $("#gtotal").val(($("#subtotal").val() - $("#advance").val()).toFixed(2));
}

</script>

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_comp").on("click", function(){
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

<script type="text/javascript">

(function() {
  var selTest = document.getElementById("p_status");
  var p_row = document.getElementById("p_row");
  var p_date = document.getElementById("p_date");
  var p_comment = document.getElementById("p_comment");

  selTest.onchange = function() {
    if (this.value === "1") {
      p_row.style.display = "block";
      p_date.required = true;
      p_comment.required = true;
    } else {
      p_row.style.display = "none";
      p_date.required = false;
      p_comment.required = false;
    }    
  };
}());

</script>