<?php
  $title = "Project RFQ Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_project_rfq.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project RFQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="project_rfq_view.php">Project RFQ</a></li>
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
    
      if($role == 1){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Project RFQ Details</h3>
              </div>           

              <div class="card-body">
                <a href="Project_rfq_view.php">
                  <button class="btn btn-zo"><i class="fas fa-chevron-left"></i> Back to RFQ</button>
                </a><br><br>
                <table id="example1" class="table table-bordered ">
                  
                  <?php 
                  $id = $_GET['id'];
                  $result = new DB_project_rfq();
                  $sql = $result->get_one_project_rfq($id);   
                  $i=0;             
                  foreach ($sql as $list) { 
                    $i++;
                                 
                  ?>
                  <tr> 
                    <th rowspan="3" width="50%"><img src="dist/img/logo.png">
                      <p>Organisation No: 559361-1030<br>
                        MOMS Nummer: SE559361103001
                      </p>
                    </th>                   
                    <td><b>Date:</b> <?php $date = strtotime($list['date']); echo date('Y-m-d', $date); ?></td> 
                  </tr>
                  <tr>                    
                    <td><b>Signed Off:</b> <?php echo $list['signed'];?></td>
                  </tr>
                  <tr>                    
                    <td><b>RFQ No:</b> <?php echo $list['rfq_no'];?></td>
                  </tr>
                  <tr>                    
                    <td colspan="2">
                      <h3 style="text-align: center;padding: 15px 0;"><b><u>Technical Specification Document</u></b></h3>                        
                      <p>
                        <h5><b>Aim</b></h5>
                        <?php echo $list['aim'];?>
                      </p>
                      <p>
                        <h5><b>Stakeholders</b></h5>
                        <table id="example1" class="table table-bordered">
                          <thead>
                            <th>S.No</th>
                            <th>Name of the Person</th>
                            <th>Role</th>
                          </thead>
                          <tbody>                                  
                            <?php
                            $sql1 = $result->list_project_rfq_role($id);   
                            $i=0;             
                            foreach ($sql1 as $list1) { 
                              $i++;                               
                            ?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $list1['name'];?></td>
                              <td><?php echo $list1['role'];?></td>
                            </tr>                                
                            <?php
                            }                                               
                            ?>                       
                          </tbody>
                        </table>
                      </p>
                      <p>
                        <h5><b>Deliverables</b></h5>
                        <?php echo $list['deliverables'];?>
                      </p>
                      <p>
                        <h5><b>Projected Costs</b></h5>
                        <?php echo $list['cost'];?>
                      </p><br>

                      <p>
                        <h5><b>Revisions</b></h5>
                        <table id="example1" class="table table-bordered">
                          <thead>
                            <th>S.No</th>
                            <th>Version</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>User</th>                                
                          </thead>
                          <tbody>                                  
                            <?php
                            $sql2 = $result->list_project_rfq_revision($id);   
                            $i1=0; 
                            $i2 = '-1';
                            $i3 = '-1';

                            foreach ($sql2 as $list2) { 
                              $i1++; 
                              $i2++; 
                              $i3++;                              
                            ?>
                            <tr>
                              <td><?php echo $i1;?></td>
                              <td>
                                <?php echo $list['rfq_no'];?> - Rev
                                <?php
                                $chars = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"); 
                                echo $chars[$i2];
                                ?>
                              </td>
                              <td>
                                <?php
                                if($i3==0){
                                  echo "Initial";
                                }
                                else{
                                  echo "Revision" .$i3;
                                }
                                ?>
                              </td>
                              <td><?php $date = strtotime($list2['date']); echo date('Y-m-d', $date); ?></td>
                              <td>
                                <?php
                                $cur_user = $list2['user_id'];
                                $sql3 = $result->list_cur_user($cur_user);   
                                $i=0;             
                                foreach ($sql3 as $list3) {  ?>
                                     <?php echo $list3['fname']; ?> <?php echo $list3['lname']; ?>                            
                                    
                                <?php
                                                               
                                }
                                ?>

                              </td>
                            </tr>                                
                            <?php
                            }                                               
                            ?>                       
                          </tbody>
                        </table>
                      </p><br>

                      <p>
                        Thank you <br>
                        Best Regards <br>
                        <img src="dist/img/krishna-sign.png"><br>
                        Krishna Radhakrishnan<br> 
                        Sales Director<br> 
                        Zriya Solutions<br>
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
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-sg">
                <h3 class="card-title">Project RFQ Details</h3>
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