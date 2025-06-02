<html
xmlns:o='urn:schemas-microsoft-com:office:office'
xmlns:w='urn:schemas-microsoft-com:office:word'
xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>

<head>
<style>
        <!-- /* Style Definitions */
        p.MsoHeader, li.MsoHeader, div.MsoHeader{
            margin:0in;
            margin-top:.0001pt;
            mso-pagination:widow-orphan;
            tab-stops:center 3.0in right 6.0in;
        }
        p.MsoFooter, li.MsoFooter, div.MsoFooter{
            margin:0in 0in 1in 0in;
            margin-bottom:.0001pt;
            mso-pagination:widow-orphan;
            tab-stops:center 3.0in right 6.0in;
        }
        .footer {
            font-size: 9pt;
        }
        @page Section1{
            size:8.5in 11.0in;
            margin:0.5in 0.5in 0.5in 0.5in;
            mso-header-margin:0.5in;
            mso-header:h1;
            mso-footer:f1;
            mso-footer-margin:0.5in;
            mso-paper-source:0;
        }
        div.Section1{
            page:Section1;
        }
        table#hrdftrtbl{
            margin:0in 0in 0in 9in;
        } 

        body {
            font-family: "Calibri", "Verdana","HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-size:11pt;
        }
        pageBreak {
          clear:all;
          page-break-before:always;
          mso-special-character:line-break;
        }
        h5{
          font-size: 16px;
        }
        
        table{
          width:100% !important;
        }
        table, th, td{          
          border-collapse: collapse;
          /*font-family: Calibri;*/
          /*font-size:14px;*/
        }
        #example1 table, #example1 th, #example1 td{
          border:1px solid #000;
        }
        th, td{
          padding:10px !important;
        }
        hr{
          border: 3px solid #ff0000 !important;
        }
        .bg_div{
          width: 100%;
          float: left;
          min-height: 5px;
          background-color: #215968;
          font-size: 2px !important;
          color: #215968;
        }
        .img_footer img{
          max-width: 50px !important;
          height: auto;
        }
</style>

</head>

<?php 

      include('class/class_external_cv.php');

      $id = $_GET['id'];
      $result = new DB_external_cv();
      $sql = $result->get_one_external_cv($id);   
      $i=0;             
      foreach ($sql as $list) { 
        $i++;
        $cv_id      = $list['cv_id'];  
        $summary    = $list['summary'];    
        $technical  = $list['technical']; 
        $experience = $list['experience']; 
        $project    = $list['project']; 
        $header_image = $list['header_image'];   

        $sql1 = $result->get_one_cv_id($cv_id);   
                     
        foreach ($sql1 as $list1) { 
           $name = $list1['name'];
        }

$vWordFileName="CV-".$name.".doc"; //replace your file name from here.
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$vWordFileName");
?>

<body style='tab-interval:.5in'>
<div class="Section1">

<table id="example2" class="table table-bordered table-striped" style="width:100%; border-collapse: collapse; border:none;">     

      <tr>                    
        <th style="padding:10px; border-right: 1px solid #fff !important; text-align: left !important;">
          <h2><b><?php echo $name;?></b></h2>
        </th>        
      </tr>
      <tr>                    
        <td colspan="2">
          <p>
            <h5><b>SUMMARY</b></h5>
            <div class="bg_div">test</div>
            <?php echo $summary;?>
          </p><br>

          <?php 
          if($technical != "") { ?>
          <p>
            <h5><b>TECHNICAL COMPETENCE</b></h5>
            <div class="bg_div">test</div>
            <?php echo $technical;?>
          </p><br>         
          <?php
          } 
          ?>
                          
          <p>
            <h5><b>WORK EXPERIENCE</b></h5>
            <div class="bg_div">test</div>                         
                            
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
            <div class="bg_div">test</div>
            <br>
            <table id="example1" class="table table-bordered" style="width:100%;">
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
          </p><br>

          <?php 
          if($project != "") { ?>

          <p>
            <h5><b>PROJECTS</b></h5>
            <div class="bg_div">test</div>
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
                <div class="bg_div">test</div>
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
    
    <table id='hrdftrtbl' border='1' cellspacing='0' cellpadding='0'>
      <tr>
        <td>
          <div style='mso-element:header' id="h1" >
            <p class="MsoHeader">
              <table border="0" width="100%">
                <?php

              //include('class/class_external_cv.php');

                $id = $_GET['id'];
                $result = new DB_external_cv();
                $sql = $result->get_one_external_cv($id);   
                $i=0;             
                foreach ($sql as $list) { 
                  $i++;
                  $header_image = $list['header_image'];
                  $footer_text = $list['footer_text'];

                if($header_image == ''){
                ?>
                <tr>                  
                  <td align="right">
                    <p></p>
                  </td>
                </tr>
                <?php
                }
                else{
                ?>
                <tr>                  
                  <td align="right">
                    <img src="https://zriyasolutions.com/employee_portal/zriya_app/uploads/img/<?php echo $header_image; ?>">
                  </td>
                </tr>                
                <?php    
                }
                ?>
              </table>
            </p>
          </div>
        </td>
        <td>
          <div style='mso-element:footer' id="f1">
            <p class="MsoFooter">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php
                if($footer_text == ''){
                ?>
                <tr>
                  <td align="center" class="footer">
                    <p></p>
                  </td>
                </tr>
                <?php
                }
                else{
                ?>
                <tr>
                  <td align="center" class="footer">
                    <p><?php echo $footer_text; ?></p>
                  </td>
                </tr>
                <?php
                }
                }
                ?>
              </table>
            </p>
          </div>
        </td>
      </tr>
    </table> 
  </div>
</body>
</html>