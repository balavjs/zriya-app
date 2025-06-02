<?php
  $title = "Finance - Sweden Update | Zriya Solutions";
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
                <h3 class="card-title">Finance - Sweden Details</h3>
              </div>        

              <?php  
                $result_usr = new User();                            
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];

                  if($role == 1 || $role == 5 || $role == 6 || $role == 8){ 
              ?>

              <div class="card-body">            

              <?php
              $result=new DB_finance_sv();

              if(isset($_POST['update'])){
                $id = $_GET['id'];
                
                $id1        = $_POST['id1'];
                $signed     = $_POST['signed'];
                $inv_date   = $_POST['inv_date'];
                $terms      = $_POST['terms'];
                $due_date   = $_POST['due_date'];
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
                $total      = $_POST['total'];
                $pricetotal = $_POST['pricetotal']; 
                $momtotal   = $_POST['momtotal']; 
                $subtotal   = $_POST['subtotal'];
                $advance    = $_POST['advance'];
                $gtotal     = $_POST['gtotal'];
                $comment    = $_POST['comment'];
                
                $sql = $result->update($id, $id1, $signed, $inv_date, $terms, $due_date, $comp_id, $p_status, $p_date, $p_comment, $product_desc, $hrs_rate, $hrs_nos, $price, $vat, $total, $pricetotal, $momtotal, $subtotal, $advance, $gtotal, $comment, $status);
                
                if ($sql) {  
                  $_SESSION['success'] = "Updated successfully";   
                  header('location:finance_sv_view.php');                  
                }
                else{
                  $_SESSION['error'] = "Not Updated";   
                  header('location:finance_sv_view.php');
                }
              }
              ?>                

                <form method="post">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_finance_sv();
                    $sql1 = $result1->get_one_finance_sv($id);   

                    while($row = mysqli_fetch_array($sql1)){  
                  ?>

                  <div class="row">                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Signed Off</label>
                        <input type="text" class="form-control" placeholder="Enter the signed off name" name="signed" value="<?php echo $row['signed']; ?>"required>
                      </div>
                    </div>     
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date of Invoice</label>
                        <input type="date" class="form-control" placeholder="Enter the date" name="inv_date" value="<?php echo $row['inv_date']; ?>" required>
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
                        <input type="date" class="form-control" placeholder="Enter the due date" id="due_date" name="due_date" onchange="date()" value="<?php echo $row['due_date']; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3" id="day" style="display:none;">
                      <div class="form-group">
                        <label>Payment Terms</label>
                        <select class="form-control" id="terms" name="terms" onchange="day()" required>
                          <option value="0" <?php if($row['terms']=='0'){echo "selected='selected'";} ?> disabled>-- Select terms --</option>
                          <option value="30" <?php if($row['terms']=='30'){echo "selected='selected'";} ?>>30 Days</option>
                          <option value="45" <?php if($row['terms']=='45'){echo "selected='selected'";} ?>>45 Days</option>
                          <option value="60" <?php if($row['terms']=='60'){echo "selected='selected'";} ?>>60 Days</option>
                          <option value="90" <?php if($row['terms']=='90'){echo "selected='selected'";} ?>>90 Days</option>
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

                  <div class="row">
                    <table class="table" id="orders"> 
                      <tr class="tr_bg">
                        <td colspan="6" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Description </strong></td>
                        <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                      </tr>
                      <tr>
                        <th>Description</th>
                        <th>Hour Rate</th>
                        <th>No.of Hours</th>
                        <th>Price (SEK)</th>
                        <th>MOMS (SEK) 25%</th>
                        <th>Total (SEK)</th>
                      </tr>
                      <?php

                      $result=new DB_finance_sv();
                      $id = $_GET['id'];
                      $sqlf = $result->list_finance_sv_desc($id);
                      $i=0;

                      if (is_array($sqlf) || is_object($sqlf))
                      {
                      foreach ($sqlf as $list) {  
                        $i++;                       

                        $id1 = $list['id'];
                        $finance_sv_id     = $list['finance_sv_id'];       
                        $product_desc = $list['product_desc'];
                        $hrs_rate     = $list['hrs_rate']; 
                        $hrs_nos      = $list['hrs_nos']; 
                        $price        = $list['price'];   
                        $vat          = $list['vat']; 
                        $total        = $list['total'];                     
                            
                      ?>
                      <tr id="tr_rows">
                        <input type="hidden" class="form-control" name="finance_sv_id[]" value="<?php echo $finance_sv_id; ?>">  
                        <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">
                        <td><input type="text" class="form-control" name="product_desc[]" placeholder="Description" id="description_<?php echo $i; ?>" data-type="price" value="<?php echo $product_desc; ?>" for="<?php echo $i; ?>"/ required></td>
                        <td><input class="form-control hrs_rate" type="number" data-type="hrs_rate" id="hrs_rate_<?php echo $i; ?>" name="hrs_rate[]" for="<?php echo $i; ?>"/ value="<?php echo $hrs_rate; ?>" step="any" placeholder="Hour Rate"></td>
                        <td><input class="form-control hrs_nos" type='number' data-type="hrs_nos" id='hrs_nos_<?php echo $i; ?>' name='hrs_nos[]' for="<?php echo $i; ?>"/ value="<?php echo $hrs_nos; ?>" step="any" placeholder="No.of Hour"></td>
                        <td><input class="form-control price" type='number' data-type="price" id='price_<?php echo $i; ?>' name='price[]' value="<?php echo $price; ?>" step="any" for="<?php echo $i; ?>"/></td> 
                        <td><input class="form-control vat" type='number' id='vat_<?php echo $i; ?>' name='vat[]' value="<?php echo $vat; ?>" for="<?php echo $i; ?>"/ readonly></td>
                        <td><input class="form-control total" type='text' id='total_<?php echo $i; ?>' name='total[]' value="<?php echo $total; ?>" for="<?php echo $i; ?>"/ readonly/></td>     
                        <td><a href="finance_sv_det_delete.php?id=<?php echo $id1;?>&row_id=<?php echo $id;?>" onClick="return confirm('Do you really want to delete?');"><button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove cicle">-</button></a></td>                   
                      </tr>
                      <?php
                    }
                  }
                    ?>

                    </table>
                    <table class="table">
                      <tr>
                        <td></td>
                        <td></td>
                        <th width="160px">Subtotal (SEK)</th>
                        <td width="160px">
                          <input style="margin-bottom: 10px;" class="form-control pricetotal" type='text' id='pricetotal' name='pricetotal' value="<?php echo $row['pricetotal']; ?>" readonly/>
                        </td>
                        <td width="160px">
                          <input style="margin-bottom: 10px;" class="form-control momtotal" type='text' id='momtotal' name='momtotal' value="<?php echo $row['momtotal']; ?>" readonly/>
                        </td>
                        <td width="160px">
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
                        <label>Advance (SEK)</label><br>
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
                        <label>Grand Total (SEK)</label>
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
                        <textarea  style="height: 123px;" class="form-control" id="p_comment" rows="4" placeholder="Enter the comments" name="p_comment"><?php echo $row['p_comment']; ?></textarea>
                      </div>                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="update">Update</button>
                      </div>
                    </div>                    
                  </div>                  
                </form>
                <?php
                }
                ?>              
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
    ?>
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>

<script type="text/javascript">
 
var rowCount = ($("#orders > tbody > #tr_rows").length);

$('.add_product').click(function() {
  rowCount++;
  $('#orders').append('<tr id="row'+rowCount+'"><td><input class="form-control description" type="text" data-type="description" id="description_'+rowCount+'" name="product_desc[]" for="'+rowCount+'" placeholder="Description" required/></td><td><input class="form-control hrs_rate" type="number" data-type="hrs_rate" id="hrs_rate_'+rowCount+'" name="hrs_rate[]" for="'+rowCount+'"/ placeholder="Hour Rate" step="any"></td><td><input class="form-control hrs_nos" type="number" data-type="hrs_nos" id="hrs_nos_'+rowCount+'" name="hrs_nos[]" for="'+rowCount+'"/ placeholder="No.of Hour" step="any"></td><td><input class="form-control price" type="number" data-type="price" id="price_'+rowCount+'" name="price[]" for="'+rowCount+'" placeholder="Price" step="any" required/></td><input class="form-control" type="hidden" data-type="product_id" id="product_id_'+rowCount+'" name="product_id[]" for="'+rowCount+'"/><td><input class="form-control vat" type="number" class="vat" id="vat_'+rowCount+'" name="vat[]" for="'+rowCount+'"/ readonly> </td><td><input class="form-control total" type="text" id="total_'+rowCount+'" name="total[]"  for="'+rowCount+'" readonly/> </td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
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
  calculateSubTotal1();
  
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
  $('.vat').each(function() {
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