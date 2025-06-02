<?php
  $title = "External CV Add | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_external_cv.php'); ?>

<style type="text/css">
  #h_apnd1 .no_border td{
    border: 0 !important;
    border-right:1px solid #dee2e6 !important;
  }
  #h_apnd1 .no_border{
    border: 0 !important;
    border-right:1px solid #dee2e6 !important;
  }
  #h_apnd1 .no_border td.border{
    border-bottom:1px solid #dee2e6 !important;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add New CV</li>
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
                <h3 class="card-title">Add New CV</h3>
              </div>         

              <div class="card-body">  

                <?php 
 
                  $result_usr = new User();                    
                  $sql_usr = $result_usr->getonerecord($id);

                  foreach ($sql_usr as $list_data) {  
                  $id = $list_data['id'];                  
                  $name1 = $list_data['fullname'];
                  $role = $list_data['role'];

                  if($role == 1 || $role == 2 || $role == 3){ 
                ?>

                 

                <?php
                  $result=new DB_external_cv();
                  if(isset($_POST['submit'])){     

                    define ('SITE_ROOT', realpath(dirname(__FILE__)));         

                    $cv_id        = $_POST['cv_id'];
                    $summary      = $_POST['summary'];
                    $technical    = $_POST['technical'];
                    $project      = $_POST['project'];  

                    $education    = $_POST['education'];
                    $institution  = $_POST['institution'];
                    $subject      = $_POST['subject'];
                    $marks        = $_POST['marks'];
                    $pass_year    = $_POST['pass_year'];  

                    $company      = $_POST['company'];
                    $year         = $_POST['year'];
                    $position     = $_POST['position'];
                    $description  = $_POST['description'];  

                    $title        = $_POST['title'];
                    $tdescription = $_POST['tdescription'];    
                    
                    $profile_image1  = "profile".time().$_FILES['profile_image']['name'];
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], SITE_ROOT."/uploads/img/".$profile_image1);

                    if(empty($_FILES['profile_image']['name'])){
                      $profile_image ='';  
                    }
                    else{
                      $profile_image = $profile_image1;
                    }  

                    $header_image1  ="header".time().$_FILES['header_image']['name'];
                    move_uploaded_file($_FILES['header_image']['tmp_name'], SITE_ROOT."/uploads/img/".$header_image1);
                    
                    if(empty($_FILES['header_image']['name'])){
                      $header_image ='';  
                    }
                    else{
                      $header_image = $header_image1;
                    }  

                    $footer_text = $_POST['footer_text'];                   
                                   
                    $sql = $result->insert($cv_id, $profile_image, $summary, $technical, $project, $education, $institution, $subject, $marks, $pass_year, $company, $year, $position, $description, $title, $tdescription, $header_image, $footer_text);
                    
                    if ($sql) {  
                      $_SESSION['success'] = "New CV added successfully!";   
                      header('location:external_cv_view.php');                  
                    }
                    else{                    
                      $_SESSION['error'] = "CV not added / Email already exist!";   
                      header('location:external_cv_view.php');                    
                    }
                  }
                ?>                      

                <form method="post" name="myform" onsubmit="enableSample();" enctype="multipart/form-data">
                  <div class="row">                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <select class="form-control sel_comp" id="sel_cv_id" name="cv_id" required>
                          <option selected disabled value="">-- Select Name --</option>
                          <?php
                            $result1 = new DB_cv();
                            $sql1 = $result1->list_cv();
                            foreach ($sql1 as $list_user) {   
                          ?>
                          <option value="<?php echo $list_user['id']; ?>"><?php echo $list_user['name']; ?></option>
                          <?php
                          }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Profile Image</label>
                        <input type="file" class="form-control-file" name="profile_image" id="imgInp" accept="image/*">
                        <br>Size: 180 X 200
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="row"> 
                    <div class="col-md-12">
                      <!-- display company details -->
                      <div id="show-contact"> </div>
                    </div>  
                  </div> 

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">                        
                        <label>Summary</label>
                        <textarea class="form-control" rows="3" placeholder="Enter the Summary" name="summary" ></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div> 
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">                        
                        <label>Technical Competence</label>
                        <textarea class="form-control" rows="3" placeholder="Enter the Technical Competence" name="technical" ></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>                  
                  </div>
                  <br>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table family1" id="h_apnd1">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Work Experince</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product1 btn-zg">+</button></td>
                          </tr>                            
                        </thead>
                        <tbody>
                          <tr class="ap_rw1">             
                              <td>
                                <input type="text" class="form-control" placeholder="Company" name="company[]" required><br>
                                <input type="text" class="form-control" placeholder="Year" name="year[]" required><br>
                                <input type="text" class="form-control" placeholder="Position" name="position[]" required>
                              </td>                       
                              <td class="border"><textarea class="form-control" id="myeditable_1" rows="3" placeholder="Description" name="description[]"></textarea></td>
                              <td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>                            
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table family" id="h_apnd">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="5" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Education</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                          </tr>
                          <tr>
                            <th>Education</th>
                            <th>Institution/University</th>
                            <th>Main Subject (Specialization)</th>
                            <th>Marks Secured / Aggregate %</th>
                            <th>Month & Year of Pass</th> 
                            <th>Action</th>
                          </tr>  
                        </thead>
                        <tbody>
                          <tr class="ap_rw">                
                            <td><input type="text" class="form-control" placeholder="Education" name="education[]" required></td>
                            <td><input type="text" class="form-control" placeholder="Institution" name="institution[]" required></td>
                            <td><input type="text" class="form-control" placeholder="Subject" name="subject[]" required></td>
                            <td><input type="text" class="form-control" placeholder="Marks" name="marks[]"></td>
                            <td><input type="text" class="form-control" placeholder="Pass Year" name="pass_year[]" required></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">                        
                        <label>Projects</label>
                        <textarea class="form-control" rows="3" placeholder="Enter the Projects" name="project" ></textarea>
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table family2" id="h_apnd2">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Other Fields</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product2 btn-zg">+</button></td>
                          </tr>
                          <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>  
                        </thead>
                        <tbody>
                          <tr class="ap_rw2">    
                            <tr class="no_border">            
                              <td><input type="text" class="form-control" placeholder="Title" name="title[]"></td>
                              <td colspan="" class="border"><textarea class="form-control" id="myeditable_1" rows="3" placeholder="Description" name="tdescription[]"></textarea></td> 
                              <td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>                            
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Header Image</label>
                        <input type="file" class="form-control-file" name="header_image"><br>
                        <p>
                          * Rectangle Size: 250 X 50<br>
                          * Square Size: 100 X 100
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Footer text</label>
                        <input type="text" class="form-control" name="footer_text">
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-sm-12">
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

<script>
    $(document).ready(function(){
      $(".add_product").click(function(){
        $("table#h_apnd tbody").append('<tr class="ap_rw"><td><input type="text" class="form-control" placeholder="Education" name="education[]" required/></td><td><input type="text" class="form-control" placeholder="Institution" name="institution[]" required/></td><td><input type="text" class="form-control" placeholder="Subject" name="subject[]" required></td><td><input type="text" class="form-control" placeholder="Marks" name="marks[]"></td><td><input type="text" class="form-control" placeholder="Pass Year" name="pass_year[]" required></td><td style="text-align:center;"><button type="button" class="btn delete-row btn-danger">X</button></td></tr>');
      });

      $("table#h_apnd tbody").on('click','.delete-row',function(){
          $(this).parent().parent().remove();
      });
    }); 
</script>

<script>
  var rowCount = 1;
  
    $(document).ready(function(){
      
      $(".add_product1").click(function(){
        rowCount++;
        $("table#h_apnd1 tbody").append('<tr class="ap_rw1" id="row'+rowCount+'"><tr class="no_border"><td><input type="text" class="form-control" placeholder="Company" name="company[]" required><br><input type="text" class="form-control" placeholder="Year" name="year[]" required></br><input type="text" class="form-control" placeholder="Position" name="position[]" required></td><td class="border"><textarea class="form-control" id="myeditable_'+rowCount+'" rows="3" placeholder="Description" name="description[]"></textarea></td><td style="text-align:center;" class="border"><button type="button" class="btn delete-row btn-danger">X</button></td></tr></tr>')
        initializeIt('textarea');
      });

      $("table#h_apnd1 tbody").on('click','.delete-row',function(){
          $(this).parent().parent().remove();
      });
    }); 
</script>

<script>
  var rowCount = 1;
  
    $(document).ready(function(){
      
      $(".add_product2").click(function(){
        rowCount++;
        $("table#h_apnd2 tbody").append('<tr class="ap_rw2" id="row'+rowCount+'"><tr class="no_border"><td><input type="text" class="form-control" placeholder="Title" name="title[]"></td><td colspan="" class="border"><textarea class="form-control" rows="3" placeholder="description" name="tdescription[]" id="myeditable_'+rowCount+'"></textarea></td><td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row">X</button></td></tr></tr>')
        initializeIt('textarea');
      });

      $("table#h_apnd2 tbody").on('click','.delete-row',function(){
          $(this).parent().parent().remove();
      });
    }); 
</script>

<script type="text/javascript">

  initializeIt('textarea');

  function initializeIt(selector) {
  tinymce.init({
      forced_root_block : "", 
      force_br_newlines : true,
      force_p_newlines : false,
      statusbar: false,
      selector: selector,
      plugins: "paste table hr anchor lists",  
      menubar: 'edit view format table',      
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist',
      
      images_dataimg_filter: function(img) {
          
      }
    });
  }
</script>

<script>
  $('#imgInp').change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only '.jpeg','.jpg','.png' formats are allowed.");
          $('#imgInp').val(''); 
        }
  });
  /*
  $("#imgInp").on("change", function () {
     if(this.files[0].size > 100000) {
       alert("Please upload file less than 100KB. Thanks!!");
       $(this).val('');
     }
    });
    */
    /*
    $fileinfo = @getimagesize($_FILES["profile_image"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];

    if($width > "250" || $height > "50") {
      $response = array(
        "type" => "error",
        "message" => "Image dimension should be within 250X50"
      );
    }
    */
</script>

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_cv_id").on("change", function(){
        var id = $(this).val();
        if (id !== "") {
          $.ajax({
            url : "get_cv_details.php",
            type:"POST",
            cache:false,
            data:{id:id},
            success:function(data){
              $("#show-contact").html(data);
            }
          });
        }else{
          $("show-contact").html(" ");
        }
      })
  });
</script>