

<?php include('class/class_external_cv.php'); ?>

<html>
<head></head>
<body>

  <table id="example1" class="table table-bordered table-striped" style="width:100%; border-collapse: collapse; border:none;">
    
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
<?php

$vExcelFileName="CV-". $list['name']. ".doc"; //replace your file name from here.

header("Content-type: application/x-ms-download"); //#-- build header to download the word file 
header("Content-Disposition: attachment; filename=$vExcelFileName"); 
header('Cache-Control: public'); 

$content = '<style>
        @page
        {
          font-family: Courier New;          
          size: auto;
          margin: 5% auto;
        }
        body, html { 
          margin:0;
          padding:0;
        }
      
        
        h3 { 
          font-size: 24px; 
          text-align:center; 
          padding:20px 0;
        }
        h5{
          font-size: 20px;
        }
        p {
          font-family: Courier New; 
          font-size: 14px; 
          padding: 10px;
        }
        table{
          width:100% !important;
        }
        table, th, td{          
          border-collapse: collapse;
          font-family: Courier New;
          font-size:15px;
        }
        #example1 table, #example1 th, #example1 td{
          border:1px solid #000;
        }
        th, td{
          padding:10px !important;
        }
        
        </style>';

echo $content;

?>
                      <tr>                    
                        <th width="70%" style="padding:70px 15px; border-right: 1px solid #fff !important; text-align: left !important;">
                          <h3><b><?php echo $name;?></b></h3>
                        </th>
                        <th style="text-align: center;"><img src="http://localhost/zriya/zriya_app/dist/img/logo.png"><br>Zriya Digital Solutions</th>
                      </tr>
                      <tr>                    
                        <td colspan="2">
                          <p>
                            <h5><b>SUMMARY</b></h5>
                            <hr style="border: 2px solid #215968;">
                            <?php echo $summary;?>
                          </p>
                          <p>
                            <h5><b>TECHNICAL COMPETENCE</b></h5>
                            <hr style="border: 2px solid #215968;">
                            <?php echo $technical;?>
                          </p>
                          <p>
                            <h5><b>WORK EXPERIENCE</b></h5>
                            <hr style="border: 2px solid #215968;">
                            <?php echo $experience;?>
                          </p>
                          <p>
                            <h5><b>PROJECTS</b></h5>
                            <hr style="border: 2px solid #215968;">
                            <?php echo $project;?>
                          </p>

                          <p>
                            <h5><b>EDUCATION</b></h5>
                            <hr style="border: 2px solid #215968;">
                            <table id="example1" class="table table-bordered" style="width:100%">
                              <tr>                
                                <th width="20%">Education</th>
                                <th width="20%">Institution/<br>University</th>
                                <th width="20%">Main Subject</th>
                                <th width="20%">Marks Secured / <br>Aggregate %</th>
                                <th width="20%">Month & Year of Pass</th>            
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
                          </p>
                        </td>                        
                      </tr>


                                         
                        <?php                                            
                        }
                        ?>
                      
                    </table>
    
   </body>
   </html>
    
    
    
    
    
