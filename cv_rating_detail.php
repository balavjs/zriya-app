<?php
  $title = "CV Rating Details | Zriya Solutions";
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
              <li class="breadcrumb-item active">CV Rating</li>
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
     
        if($role == 1 || $role == 2 || $role == 3){ 
    ?>

	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">CV Rating Details</h3>
              </div>                                

              <div class="card-body">
                <a href="cv_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to CV</button>
                </a>
                <table id="example1" class="table">                  
                  <?php 
                    $id = $_GET['id'];
                    $result = new DB_cv_rating();
                    $sql = $result->get_one_cv_id_rating($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;                                     
                  ?>                     
                  
                  <tr>                    
                    <th width="40%">Name</th>
                    <td>
                      <?php 
                        $id = $list['cv_id'];
                        
                        $result1 = new DB_cv();
                        $sql1 = $result1->get_one_cv($id);   
                                     
                        foreach ($sql1 as $list1) { 
                          echo $list1['name'];
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>                    
                    <th>Technical Rating</th>
                    <td><?php echo $list['tech_rating'];?></td>
                  </tr>
                  <tr>                    
                    <th>Technical Comments</th>
                    <td><?php echo $list['tech_comment'];?></td>
                  </tr>
                  <tr>                    
                    <th>English Rating</th>
                    <td><?php echo $list['eng_rating'];?></td>
                  </tr>
                  <tr>                    
                    <th>English Comments</th>
                    <td><?php echo $list['eng_comment'];?></td>
                  </tr>
                  <tr>                    
                    <th>HR Rating</th>
                    <td><?php echo $list['hr_rating'];?></td>
                  </tr>
                  <tr>                    
                    <th>HR Comments</th>
                    <td><?php echo $list['hr_comment'];?></td>
                  </tr>
                  <tr>                    
                    <th>Previous international experience</th>
                    <td><?php echo $list['experience'];?></td>
                  </tr>
                  <tr>                    
                    <th>Team</th>
                    <td><?php echo $list['team'];?></td>
                  </tr>
                  <tr>                    
                    <th>Willing to move to Sweden</th>
                    <td><?php echo $list['willing'];?></td>
                  </tr>
                  <tr>                    
                    <th>Notice Period</th>
                    <td><?php echo $list['notice'];?></td>
                  </tr>
                  <tr>                    
                    <th>Sigma by "Zriya"</th>
                    <td><?php echo $list['hvts'];?></td>
                  </tr>                 
                  <tr>                    
                    <th>Profile Nature</th>
                    <td><?php echo $list['profile_nature'];?></td>
                  </tr>
                  <tr>                    
                    <th>Area</th>
                    <td><?php echo $list['area'];?></td>
                  </tr>
                  <tr>    
                  <br>                
                    <th colspan="2">Languages</th>
                  </tr>
                  <tr>                  
                    <td colspan="2">

                      <table id="example1" class="table">
                          <thead>
                            <th width="100px">S.No</th>
                            <th width="300px">Language</th>
                            <th width="100px">Value</th>
                            <th>Comments</th>
                          </thead>
                          <tbody>
                              
                            <?php
                            $sql2 = $result->get_one_cv_id_rating_lang($id);   
                            $j=0;             
                            foreach ($sql2 as $list2) { 
                              $j++;                           
                            ?>
                            <tr>
                              <td><?php echo $j;?></td>
                              <td><?php echo $list2['lang'];?></td>
                              <td><?php echo $list2['value'];?></td>                                  
                              <td><?php echo $list2['lang_comment'];?></td>
                            </tr>
                            <?php
                            }                                           
                            ?>
                          </tbody>
                        </table>
                    </td>
                  </tr>                      
                  <tr>                    
                    <th>Domain</th>
                    <td><?php echo $list['domain'];?></td>
                  </tr>
                  <tr>                    
                    <th>Personal Details</th>
                    <td><?php echo $list['personal_detail'];?></td>
                  </tr>
                  <tr>                    
                    <th>Comment</th>
                    <td><?php echo $list['comment'];?></td>
                  </tr>
                  <tr>                    
                    <th>Status</th>
                    <td><?php echo $list['status'];?></td>
                  </tr>
                  <?php
                    }
                  ?>
                </table>
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
   
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">CV Details</h3>
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
