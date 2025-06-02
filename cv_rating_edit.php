<?php
  $title = "CV Rating Update | Zriya Solutions"; 
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_cv_rating.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interview Evaluation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Update CV Rating Details</li>
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
                <h3 class="card-title">Update CV Rating Details</h3>
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
                $result=new DB_cv_rating();
                if(isset($_POST['update'])){

                  $id = $_GET['id'];          

                  define ('SITE_ROOT', realpath(dirname(__FILE__)));      
                  
                  $cv_id            = $_GET['id'];
                  $tech_rating      = $_POST['tech_rating'];
                  $tech_comment     = $_POST['tech_comment'];
                  $eng_rating       = $_POST['eng_rating'];
                  $eng_comment      = $_POST['eng_comment'];
                  $hr_rating        = $_POST['hr_rating'];
                  $hr_comment       = $_POST['hr_comment'];
                  $experience       = $_POST['experience'];
                  $team             = $_POST['team'];
                  $willing          = $_POST['willing'];
                  $notice           = $_POST['notice'];
                  $hvts             = $_POST['hvts'];
                  $profile_nature   = $_POST['profile_nature'];
                  $area             = $_POST['area'];
                  $lang             = $_POST['lang'];
                  $value            = $_POST['value']; 
                  $lang_comment     = $_POST['lang_comment'];
                  $domain           = $_POST['domain']; 
                  $personal_detail  = $_POST['personal_detail'];  
                  $comment          = $_POST['comment'];
                  $status           = $_POST['status'];  

                  $id1              = $_POST['id1'];                

                  $sql = $result->update($id, $id1, $cv_id, $tech_rating, $tech_comment, $eng_rating, $eng_comment, $hr_rating, $hr_comment, $experience, $team, $willing, $notice, $hvts, $profile_nature, $area, $lang, $value, $lang_comment, $domain, $personal_detail, $comment, $status);
                  
                  if ($sql) {  
                    $_SESSION['success'] = "CV updated successfully!";   
                    header('location:cv_view.php');                  
                  }
                  else{                    
                    $_SESSION['error'] = "CV not updated!";   
                    header('location:cv_view.php');                    
                  }  
                }
              ?>
                                
              <?php
                $id  = $_GET['id'];
                $result1 = new DB_cv();
                $sql1 = $result1->get_one_cv($id);
                foreach ($sql1 as $list_user) {   
              ?>
              <div class="row">                   
                <div class="col-sm-4">
                  <label>Profile Name</label>
                  <p><?php echo $list_user['name']; ?></p>
                </div>
                <div class="col-sm-4">
                  <label>Email</label>
                  <p><?php echo $list_user['email']; ?></p>
                </div>
                <div class="col-sm-4">
                  <label>Phone</label>
                  <p><?php echo $list_user['phone']; ?></p>
                </div>
              </div> 
              
              <?php
              }
              ?>
              <hr>
              <form method="post" enctype="multipart/form-data">
                <?php
                  $id = $_GET['id'];
                  $result1 = new DB_cv_rating();
                  $sql1 = $result1->get_one_cv_id_rating($id);   

                  while($row = mysqli_fetch_array($sql1)){  
                ?>
                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>Technical Rating (0 to 5)</label>
                        <select class="form-control" name="tech_rating" required>
                          <option value="" selected disabled>-- Select Rating --</option>
                          <option value="1" <?php if($row['tech_rating']=='1'){echo "selected='selected'";} ?>>1</option>
                          <option value="1.5" <?php if($row['tech_rating']=='1.5'){echo "selected='selected'";} ?>>1.5</option>
                          <option value="2" <?php if($row['tech_rating']=='2'){echo "selected='selected'";} ?>>2</option>
                          <option value="2.5" <?php if($row['tech_rating']=='2.5'){echo "selected='selected'";} ?>>2.5</option>
                          <option value="3" <?php if($row['tech_rating']=='3'){echo "selected='selected'";} ?>>3</option>
                          <option value="3.5" <?php if($row['tech_rating']=='3.5'){echo "selected='selected'";} ?>>3.5</option>
                          <option value="4" <?php if($row['tech_rating']=='4'){echo "selected='selected'";} ?>>4</option>
                          <option value="4.5" <?php if($row['tech_rating']=='4.5'){echo "selected='selected'";} ?>>4.5</option>
                          <option value="5" <?php if($row['tech_rating']=='5'){echo "selected='selected'";} ?>>5</option>
                        </select> 
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Technical Comments</label>
                      <textarea class="form-control" rows="1" placeholder="Enter the comments" name="tech_comment" required><?php echo $row['tech_comment']; ?></textarea>
                    </div>
                  </div> 
                </div>         

                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>English Rating (0 to 5)</label>
                        <select class="form-control" name="eng_rating" required>
                          <option value="" selected disabled>-- Select Rating --</option>
                          <option value="1" <?php if($row['eng_rating']=='1'){echo "selected='selected'";} ?>>1</option>
                          <option value="1.5" <?php if($row['eng_rating']=='1.5'){echo "selected='selected'";} ?>>1.5</option>
                          <option value="2" <?php if($row['eng_rating']=='2'){echo "selected='selected'";} ?>>2</option>
                          <option value="2.5" <?php if($row['eng_rating']=='2.5'){echo "selected='selected'";} ?>>2.5</option>
                          <option value="3" <?php if($row['eng_rating']=='3'){echo "selected='selected'";} ?>>3</option>
                          <option value="3.5" <?php if($row['eng_rating']=='3.5'){echo "selected='selected'";} ?>>3.5</option>
                          <option value="4" <?php if($row['eng_rating']=='4'){echo "selected='selected'";} ?>>4</option>
                          <option value="4.5" <?php if($row['eng_rating']=='4.5'){echo "selected='selected'";} ?>>4.5</option>
                          <option value="5" <?php if($row['eng_rating']=='5'){echo "selected='selected'";} ?>>5</option>
                        </select>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>English Comments</label>
                      <textarea class="form-control" rows="1" placeholder="Enter the comments" name="eng_comment" required><?php echo $row['eng_comment']; ?></textarea>
                    </div>
                  </div> 
                </div>

                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>HR Rating (0 to 5)</label>
                      <select class="form-control" name="hr_rating" required>
                        <option value="" selected disabled>-- Select Rating --</option>
                        <option value="1" <?php if($row['hr_rating']=='1'){echo "selected='selected'";} ?>>1</option>
                        <option value="1.5" <?php if($row['hr_rating']=='1.5'){echo "selected='selected'";} ?>>1.5</option>
                        <option value="2" <?php if($row['hr_rating']=='2'){echo "selected='selected'";} ?>>2</option>
                        <option value="2.5" <?php if($row['hr_rating']=='2.5'){echo "selected='selected'";} ?>>2.5</option>
                        <option value="3" <?php if($row['hr_rating']=='3'){echo "selected='selected'";} ?>>3</option>
                        <option value="3.5" <?php if($row['hr_rating']=='3.5'){echo "selected='selected'";} ?>>3.5</option>
                        <option value="4" <?php if($row['hr_rating']=='4'){echo "selected='selected'";} ?>>4</option>
                        <option value="4.5" <?php if($row['hr_rating']=='4.5'){echo "selected='selected'";} ?>>4.5</option>
                        <option value="5" <?php if($row['hr_rating']=='5'){echo "selected='selected'";} ?>>5</option>
                      </select>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>HR Comments</label>
                      <textarea class="form-control" rows="1" placeholder="Enter the comments" name="hr_comment" required><?php echo $row['hr_comment']; ?></textarea>
                    </div>
                  </div> 
                </div>

                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>Previous international experience</label>
                      <input type="text" class="form-control" placeholder="Enter the Experience" name="experience" value="<?php echo $row['experience']; ?>" required>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Team</label>
                      <input type="text" class="form-control" placeholder="Enter the team" name="team" value="<?php echo $row['team']; ?>" required>
                    </div>
                  </div> 
                </div>

                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>Willing to move to Sweden</label>
                      <input type="text" class="form-control" placeholder="Enter the willing" name="willing" value="<?php echo $row['willing']; ?>" required>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Notice Period</label>
                      <input type="text" class="form-control" placeholder="Enter the Notice period days" name="notice" value="<?php echo $row['notice']; ?>" required>
                    </div>
                  </div> 
                </div>

                <div class="row">                    
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sigma by "Zriya"</label>
                      <input type="text" class="form-control" placeholder="Enter the HVTS" name="hvts" value="<?php echo $row['hvts']; ?>" required>
                    </div>
                  </div>
                </div>                                    

                <div class="row">                   
                  <div class="col-sm-6">    
                    <div class="form-group">
                      <label>Profile Nature</label>
                      <input type="text" class="form-control" placeholder="Enter the Profile Nature" name="profile_nature" value="<?php echo $row['profile_nature']; ?>" required>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Area</label>
                      <input type="text" class="form-control" placeholder="Enter the Area" name="area" value="<?php echo $row['area']; ?>" required>
                    </div>
                  </div> 
                </div>

                <div class="row">                    
                  <div class="col-sm-12">
                    <table class="table family" id="h_apnd">
                      <thead>
                        <tr class="tr_bg">
                          <td colspan="3" style="background-color: transparent !important; text-align: center !important;    vertical-align: middle;"><strong>Pricing</strong></td>
                          <!--
                          <td colspan="1" style="background-color: transparent !important; text-align:center;"><button type="button" class="btn add_product btn-success">+ Add New</button></td>
                        -->
                        </tr>
                        <tr>
                          <th>Product Description</th>
                          <th>Price (excl. MOMS)</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <?php

                        $result=new DB_cv_rating();
                        $id = $_GET['id'];
                        $sqlf = $result->get_one_cv_id_rating_lang($id);

                        if (is_array($sqlf) || is_object($sqlf))
                        {
                        foreach ($sqlf as $list_lang) {  

                          $id1          = $list_lang['id'];
                          $cv_id        = $list_lang['cv_id'];       
                          $lang         = $list_lang['lang'];
                          $value        = $list_lang['value'];                       
                          $lang_comment = $list_lang['lang_comment'];   
                        ?>   

                        <tr class="ap_rw">  
                          <input type="hidden" class="form-control" name="cv_id[]" value="<?php echo $cv_id; ?>">   
                          <input type="hidden" class="form-control" name="id1[]" value="<?php echo $id1; ?>">             
                          <td><input type="text" class="form-control" name="lang[]" value="<?php echo $lang; ?>"required></td>
                          <td>
                            <select class="form-control" name="value[]" required>
                              <option value="" selected disabled>-- Select Status --</option>
                              <option value="Yes" <?php if($value=='Yes'){echo "selected='selected'";} ?>>Yes</option>
                              <option value="No" <?php if($value=='No'){echo "selected='selected'";} ?>>No</option>
                            </select> 
                          </td>
                          <td><textarea class="form-control" rows="1" placeholder="Enter the comments" name="lang_comment[]"><?php echo $lang_comment; ?></textarea></td>                          
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
                      <label>Domain</label>
                      <input type="text" class="form-control" placeholder="DSP Engineer, Embedded Engineers.." name="domain" value="<?php echo $row['domain']; ?>" required>
                    </div>                       
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Personal Details</label>
                      <input type="text" class="form-control" placeholder="Enter the Personal Details" name="personal_detail" value="<?php echo $row['personal_detail']; ?>" required>
                    </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">  
                      <label>Comments</label>
                      <textarea class="form-control" rows="3" placeholder="Enter the comments" name="comment" required><?php echo $row['comment']; ?></textarea>
                    </div>
                  </div> 
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Status</label>
                        <select class="form-control" name="status" required>
                          <option value="" selected disabled>-- Select Status --</option>
                          <option value="Selected" <?php if($row['status']=='Selected'){echo "selected='selected'";} ?>>Selected</option>
                          <option value="Not Decided" <?php if($row['status']=='Not Decided'){echo "selected='selected'";} ?>>Not Decided</option>
                          <option value="Rejected" <?php if($row['status']=='Rejected'){echo "selected='selected'";} ?>>Rejected</option>
                        </select>          
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
              <div class="card-header">
                <h3 class="card-title">Update Company</h3>
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
    <!-- /.content -->
  </div>

<?php include('footer.php'); ?>

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
