<?php
  $title = "Convert to DOCX | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>

<style type="text/css">
  .form-control{
    border-radius: 0 !important;
  }
  .btn{
    border-radius: 0 !important;
  }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Convert to DOCX</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Convert to DOCX</li>
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
              <div class="card-header">
                <h3 class="card-title">Convert to DOCX</h3>
              </div>

            <div class="card-body">  

              <?php 
 
                $result_usr = new User();
                  
                $sql_usr = $result_usr->getonerecord($id);

                foreach ($sql_usr as $list_data) {  
                $id = $list_data['id'];                  
                $name1 = $list_data['fullname'];
                $role = $list_data['role'];

                if($role == 1){ 
              ?>

              <!-- general form elements disabled -->

              <?php
                
                if(isset($_POST['submit'])){

                  $file  = $_FILES['cv']['name'];

                  echo $file;       

                  require_once __DIR__ . '/vendor/autoload.php';

                  // Create the new document..
                  $PHPWord = new \PhpOffice\PhpWord\PhpWord();  
                  
                  $document = $PHPWord->loadTemplate('https://zriyasolutions.com/employee_portal/zriya_app/uploads/cv/CV1658814712Zriya-CV-PRAVANTIKA%20PANDEY.doc');

                  // Save File

                  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');

                  $objWriter->save('Excel2007.docx');                            
                  
                }
              ?>                          

                <form method="post" name="myform" enctype="multipart/form-data">
                  <div class="row"> 
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="formFile" class="form-label">Upload CV</label>
                        <input class="form-control-file" type="file" id="cvFile" name="cv">                        
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">  
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
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

                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">CV List</h3>
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