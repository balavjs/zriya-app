<?php
  $title = "External CV Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_external_cv.php'); ?>

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
              <li class="breadcrumb-item active">CV</li>
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
                <h3 class="card-title">CV Details</h3>
              </div>         

              <div class="card-body">
                <a href="cv_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to CV</button>
                </a><br><br>
                <table id="example1" class="table table-bordered">
                  
                    <?php 
                    $id = $_GET['id'];
                    $result = new DB_external_cv();
                    $sql = $result->get_one_external_cv($id);   
                    $i=0;             
                    foreach ($sql as $list) { 
                      $i++;
                      $name       = $list['name'];  
                      $summary    = $list['summary'];    
                      $technical  = $list['technical']; 
                      $experience = $list['experience']; 
                      $project    = $list['project'];  

                    ?>                      
                  
                  <tr>                    
                    <th width="75%" style="padding:70px 15px; border-right: 1px solid #fff !important;">
                      <h3><b>
                        <?php 
                          $result1 = new DB_cv();

                          $id         = $list['cv_id'];

                          $sql1 = $result1->get_one_cv($id);   
                                       
                          foreach ($sql1 as $list1) { 
                            echo $list1['name'];
                          }
                        ?></b></h3>
                    </th>
                    <th style="text-align: center;"><img src="dist/img/logo.png"><br>Zriya Solutions</th>
                  </tr>
                  <tr>                    
                    <td colspan="2">
                      <p>
                        <h5><b>SUMMARY</b></h5>
                        <hr style="border: 2px solid #215968;">
                        <?php echo $summary;?>
                      </p><br>

                      <?php 
                      if($technical != "") { ?>
                      <p>
                        <h5><b>TECHNICAL COMPETENCE</b></h5>
                        <hr style="border: 2px solid #215968;">
                        <?php echo $technical;?>
                      </p><br> 
                      <?php
                      } 
                      ?>

                      <p>
                        <h5><b>Work Experience</b></h5>
                        <hr style="border: 2px solid #215968;">                         
                                        
                          <?php 
                            $id = $_GET['id'];
                            $resultx = new DB_external_cv();
                            $sqlx = $resultx->get_one_external_cv_exp($id);   
                            $i=0;             
                            foreach ($sqlx as $listx) { 
                              $i++;
                              $company      = $listx['company'];
                              $year         = $listx['year'];
                              $position     = $listx['position'];
                              $description  = $listx['description'];
                          ?>                              
                              
                            <p><b>Company :</b> <?php echo $company;?></p>
                            <p><b>Year :</b> <?php echo $year;?></p>
                            <p><b>Position :</b> <?php echo $position;?></p>
                            <p><b>Description :</b><br><?php echo $description;?></p><br>
                            
                          <?php
                          }
                          ?>
                      </p>

                      <p>
                        <h5><b>EDUCATION</b></h5>
                        <hr style="border: 2px solid #215968;">
                        <table id="example1" class="table table-bordered">
                          <tr>   
                            <th>S.No</th>                 
                            <th>Education</th>
                            <th>Institution/University</th>
                            <th>Main Subject (Specialization)</th>
                            <th>Marks Secured / Aggregate %</th>
                            <th>Month & Year of Pass</th>            
                          </tr>
                          
                            <?php 
                            $id = $_GET['id'];
                            $result2 = new DB_external_cv();
                            $sql2 = $result2->get_one_external_cv_edu($id);   
                            $i=0;             
                            foreach ($sql2 as $list2) { 
                              $i++;
                              $education    = $list2['education'];
                              $institution  = $list2['institution'];
                              $subject      = $list2['subject'];
                              $marks        = $list2['marks'];
                              $pass_year    = $list2['pass_year'];
                          ?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $education;?></td>
                              <td><?php echo $institution;?></td>
                              <td><?php echo $subject;?></td>
                              <td><?php echo $marks;?></td>
                              <td><?php echo $pass_year;?></td>
                            </tr>                
                            <?php                                            
                            }
                            ?>
                          
                        </table>
                      </p><br>

                      <?php 
                      if($project != "") { ?>

                      <p>
                        <h5><b>PROJECTS</b></h5>
                        <hr style="border: 2px solid #215968;">
                        <?php echo $project;?>
                      </p><br>

                      <?php } ?>

                      <p>               
                        <?php 
                          $id = $_GET['id'];
                          $resulty = new DB_external_cv();
                          $sqly = $resulty->get_one_external_cv_other($id);   
                          $i=0;             
                          foreach ($sqly as $listy) { 
                            $i++;
                            $title         = $listy['title'];
                            $tdescription  = $listy['tdescription'];

                            if($title != ""){
                        ?>                              
                          <h5 style="text-transform: uppercase;"><b><?php echo $title;?></b></h5>
                          <hr style="border: 2px solid #215968;"> 
                          <p><?php echo $tdescription;?></p><br>
                          
                        <?php
                          }
                        }
                        ?>
                      </p>
                    </td>                        
                  </tr>

                    <?php                                            
                    }
                    ?>                  
                </table>
              </div>                
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
