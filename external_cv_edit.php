<?php
  $title = "External CV Update | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_external_cv.php'); ?>

<style type="text/css">
  #h_apnd1 .no_border td{
    border: 0 !important;
  }
  #h_apnd1 .no_border{
    border: 0 !important;    
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
            <h1>External CV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Update CV Details</li>
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
                <h3 class="card-title">Update CV Details</h3>
              </div>        

            <?php  
              $result_usr = new User();              
              $sql_usr = $result_usr->getonerecord($id);

              foreach ($sql_usr as $list_data) {  
              $id = $list_data['id'];                  
              $name1 = $list_data['fullname'];
              $role = $list_data['role'];
              
                if($role == 1 || $role == 2 || $role == 3){ 
            ?>

            <div class="card-body">  

            <?php
              $result=new DB_external_cv();

              if(isset($_POST['update'])){

                $id = $_GET['id'];

                define ('SITE_ROOT', realpath(dirname(__FILE__)));  

                $cv_id        = $_POST['cv_id1'];
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
                
                $id1          = $_POST['id1'];     
                $id2          = $_POST['id2'];
                $id3          = $_POST['id3'];  

                $title        = $_POST['title'];
                $tdescription = $_POST['tdescription'];   

                $profile_image1 = $_FILES['profile_image']['name'];        

                if($profile_image1!=""){
                  $profile_image1  ="profile".time().$_FILES['profile_image']['name'];
                  move_uploaded_file($_FILES['profile_image']['tmp_name'], SITE_ROOT."/uploads/img/".$profile_image1);

                  $profile_image = $profile_image1;
                  
                }
                else{
                  $sql1 = $result->get_one_external_cv($id);                     
                  foreach ($sql1 as $list_app) { 
                    $profile_image = $list_app['profile_image'];
                  }
                }    

                $header_image1 = $_FILES['header_image']['name'];        

                if($header_image1!=""){
                  $header_image1  ="header".time().$_FILES['header_image']['name'];
                  move_uploaded_file($_FILES['header_image']['tmp_name'], SITE_ROOT."/uploads/img/".$header_image1);

                  $header_image = $header_image1;
                  
                }
                else{
                  $sql1 = $result->get_one_external_cv($id);                     
                  foreach ($sql1 as $list_app) { 
                    $header_image = $list_app['header_image'];
                  }
                } 
                
                $footer_text = $_POST['footer_text']; 

                $sql = $result->update($id, $id1, $id2, $id3, $cv_id, $profile_image, $summary, $technical, $project, $education, $institution, $subject, $marks, $pass_year, $company, $year, $position, $description, $title, $tdescription, $header_image, $footer_text);
                
                if ($sql) {  
                  $_SESSION['success'] = "CV updated successfully!";   
                  header('location:external_cv_view.php');                  
                }
                else{                    
                  $_SESSION['error'] = "CV not updated!";   
                  header('location:external_cv_view.php');                    
                } 
              }
            ?>             

                <form method="post" enctype="multipart/form-data">
                  <?php
                    $id = $_GET['id'];
                    $result1 = new DB_external_cv();
                    $sql1 = $result1->get_one_external_cv($id);   

                    while($row = mysqli_fetch_array($sql1)){  
                  ?>     
                  <div class="row">                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <select class="form-control sel_comp" id="sel_cv_id" name="cv_id1" required>
                          <option selected disabled value="">-- Select Name --</option>
                          <?php                        
                          $cv_id = $row['cv_id'];

                          $result2 = new DB_cv();
                          $sql2 = $result2->list_cv();
                          foreach ($sql2 as $list_user) {  
                            $cv_id1 = $list_user['id'];
                            $name1 = $list_user['name'];  
                          ?>
                          <option value="<?php echo $cv_id1; ?>" <?php if($cv_id1 == $cv_id){echo "selected='selected'";}?>><?php echo $name1; ?></option>
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
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Summary" name="summary" ><?php echo $row['summary']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div> 
                   
                    <div class="col-sm-12">
                      <div class="form-group">                        
                        <label>Technical Competence</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Technical Competence" name="technical" ><?php echo $row['technical']; ?></textarea>
                        <span class="error" style="color: #a80000;font-weight: bold;"></span>
                      </div>
                    </div>                   
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table table-bordered family1" id="h_apnd1">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Work Experince</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product1 btn-zg">+</button></td>
                          </tr>                            
                        </thead>
                        <tbody>
                          <?php
                            $result=new DB_external_cv();
                            $id = $_GET['id'];
                            $sqlf = $result->get_one_external_cv_exp($id);

                            if (is_array($sqlf) || is_object($sqlf)) {
                            foreach ($sqlf as $listf) {  
                              $id2          = $listf['id'];
                              $cv_id        = $listf['cv_id'];       
                              $company      = $listf['company'];
                              $year         = $listf['year']; 
                              $position     = $listf['position'];
                              $description  = $listf['description'];  
                          ?>
                          <tr class="ap_rw1">    
                            <input type="hidden" class="form-control" name="id2[]" value="<?php echo $id2; ?>"> 
                            <input type="hidden" class="form-control" name="cv_id[]" value="<?php echo $cv_id; ?>">              
                            <td>
                              <input type="text" class="form-control" placeholder="company" name="company[]" value="<?php echo htmlspecialchars($company); ?>" required><br>
                              <input type="text" class="form-control" placeholder="year" name="year[]" value="<?php echo htmlspecialchars($year); ?>" required><br>
                              <input type="text" class="form-control" placeholder="position" name="position[]" value="<?php echo htmlspecialchars($position); ?>" required>
                            </td>
                            <td colspan="1" class="border"><textarea class="form-control" rows="3" placeholder="description" name="description[]"><?php echo $description; ?></textarea></td>
                            <td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                          </tr>
                          <?php
                            }
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table family" id="h_apnd">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="5" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>EDUCATION</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-zg">+</button></td>
                          </tr>
                          <tr>
                            <th>Education</th>
                            <th>Institution/University</th>
                            <th>Main Subject (Specialization)</th>
                            <th>Marks Secured / Aggregate %</th>
                            <th>Month & Year of Pass</th> 
                          </tr>  
                        </thead>
                        <tbody>
                          <?php

                          $result=new DB_external_cv();
                          $id = $_GET['id'];
                          $sqlf = $result->get_one_external_cv_edu($id);

                          if (is_array($sqlf) || is_object($sqlf))
                          {
                          foreach ($sqlf as $list2) {  

                            $id1          = $list2['id'];
                            $cv_id        = $list2['cv_id'];       
                            $education    = $list2['education'];
                            $institution  = $list2['institution']; 
                            $subject      = $list2['subject'];
                            $marks        = $list2['marks'];
                            $pass_year    = $list2['pass_year'];                     
                                
                          ?>  
                          <tr class="ap_rw">   
                            <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>"> 
                            <input type="hidden" class="form-control" name="cv_id[]" value="<?php echo $cv_id; ?>">              
                            <td><input type="text" class="form-control" placeholder="Education" name="education[]" value="<?php echo htmlspecialchars($education); ?>" required></td>
                            <td><input type="text" class="form-control" placeholder="Institution" name="institution[]" value="<?php echo htmlspecialchars($institution); ?>" required></td>
                            <td><input type="text" class="form-control" placeholder="Subject" name="subject[]" value="<?php echo htmlspecialchars($subject); ?>" required></td>
                            <td><input type="text" class="form-control" placeholder="Marks" name="marks[]" value="<?php echo htmlspecialchars($marks); ?>"></td>
                            <td><input type="text" class="form-control" placeholder="Pass Year" name="pass_year[]" value="<?php echo htmlspecialchars($pass_year); ?>" required></td>
                            <td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                          </tr>
                          <?php
                          }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">                        
                        <label>Projects</label>
                        <textarea class="form-control tinymce" rows="3" placeholder="Enter the Projects" name="project" ><?php echo $row['project']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-sm-12">
                      <table class="table table-bordered family2" id="h_apnd2">
                        <thead>
                          <tr class="tr_bg">
                            <td colspan="2" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Other Fields</strong></td>
                            <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product2 btn-zg">+</button></td>
                          </tr>
                          <tr>
                            <th>Title</th>
                            <th>Description</th>
                          </tr>  
                        </thead>
                        <tbody>
                          <?php
                            $result=new DB_external_cv();
                            $id = $_GET['id'];
                            $sqly = $result->get_one_external_cv_other($id);

                            if (is_array($sqly) || is_object($sqly))
                            {
                            foreach ($sqly as $listy) {  

                              $id3          = $listy['id'];
                              $cv_id        = $listy['cv_id'];       
                              $title        = $listy['title'];
                              $tdescription = $listy['tdescription'];
                          ?>
                          <tr class="ap_rw2"> 
                            <tr class="no_border">   
                              <input type="hidden" class="form-control" name="id3[]" value="<?php echo $id3; ?>"> 
                              <input type="hidden" class="form-control" name="cv_id[]" value="<?php echo $cv_id; ?>">              
                              <td><input type="text" class="form-control" placeholder="Title" name="title[]" value="<?php echo $title; ?>"></td>
                              <td colspan="1" class="border"><textarea class="form-control" rows="3" placeholder="Description" name="tdescription[]"><?php echo $tdescription; ?></textarea></td>
                              <td style="text-align:center;" class="border"><button type="button" class="btn btn-danger delete-row" disabled>X</button></td>
                            </tr>                            
                          </tr>
                          <?php
                          }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Header Image</label>
                        <input type="file" class="form-control-file" name="header_image">  <br>     
                        <?php
                        if($row['header_image'] != ""){ ?>  
                          <img src="uploads/img/<?php echo $row['header_image'];?>">
                        <?php  }
                        ?>
                        <br><br>
                        <p>
                          * Rectangle Size: 250 X 50<br>
                          * Square Size: 100 X 100
                        </p>                  
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Footer text</label>
                        <input type="text" class="form-control" name="footer_text" value="<?php echo $row['footer_text']; ?>">
                      </div>
                    </div>
                  </div>
                  <br>

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
              </div>
              <!-- /.card-body -->
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
        $("table#h_apnd1 tbody").append('<tr class="ap_rw1" id="row'+rowCount+'"><tr class="no_border"><td class="border"><input type="text" class="form-control" placeholder="Company" name="company[]" required><br><input type="text" class="form-control" placeholder="Year" name="year[]" required></br><input type="text" class="form-control" placeholder="Position" name="position[]" required></td><td class="border"><textarea class="form-control" id="myeditable_'+rowCount+'" rows="3" placeholder="Description" name="description[]"></textarea></td><td style="text-align:center;" class="border"><button type="button" class="btn delete-row btn-danger">X</button></td></tr></tr>')
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

<!---jQuery ajax load rcords using select box --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#sel_cv_id").on("click", function(){
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