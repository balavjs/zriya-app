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
        .footer p{
            font-size: 8pt;
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

        body, p {
            font-family: "Verdana", sans-serif;
            font-size:10pt;
        }
        pageBreak {
          clear:all;
          page-break-before:always;
          mso-special-character:line-break;
        }
        h5{
          font-size: 16px;
        }
        #name_head{
          font-size: 16pt !important;
          font-weight: 500 !important;
        }
        #name_head1{
          font-size: 12pt !important;
          font-weight: 500 !important;
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
        $profile_image = $list['profile_image'];
        $summary    = $list['summary'];    
        $technical  = $list['technical']; 
        $experience = $list['experience']; 
        $project    = $list['project'];    
        $date       = strtotime($list['date']); 
        $date1      = date('Y-m-d', $date);

        $sql1 = $result->get_one_cv_id($cv_id);   
                     
        foreach ($sql1 as $list1) { 
           $name = $list1['name'];
        }

$vWordFileName="AFRY-CV-".$name.".doc"; //replace your file name from here.
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$vWordFileName");
?>

<body style='tab-interval:.5in'>
<div class="Section1">

    <table id="example2" class="table table-bordered table-striped" style="width:100%; border-collapse: collapse; border:none;">   

      <tr>                  
        <td width="25%" style="vertical-align:top">
          <?php 
          if($profile_image != "") { ?>
          <span>
            <img src="https://zriyasolutions.com/employee_portal/zriya_app/uploads/img/<?php echo $profile_image; ?>" width="150" height="167">
          </span>
          <?php
          }
          else{ ?>
          <span>
            <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/placeholder.jpg" width="150" height="167">
          </span>
          <?php
          }
          ?>
        </td>
        <td width="75%" style="vertical-align:top">
          <h2 id="name_head"><?php echo $name;?></h2>
          <p><?php echo $summary;?></p><hr>
        </td> 
      </tr>

      <?php 
      if($technical != "") { ?>

      <tr>
        <td width="25%" style="vertical-align:top">         
          <h3 id="name_head1">Technical Competence</h3>         
        </td>
        <td width="75%" style="vertical-align:top">
          <p><?php echo $technical;?></p><hr>
        </td>
      </tr>

      <?php
      } 
      ?>
      
      <tr>
        <td colspan="2">         
          <h3 id="name_head1">Work Experience</h3>         
        </td>
      </tr>
                  
        
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
      <tr>
        <td width="25%" style="vertical-align:top">     
          <p>
            <b><?php echo $company;?></b><br>
            <?php echo $year;?>
          </p>
        </td>
        <td width="75%" style="vertical-align:top">
          <p>
            <b><?php echo $position;?></b><br>
            <?php echo $description;?>
          </p><hr>            
          
        </td>
      </tr>
      <?php
          }
          ?>

      <tr>
        <td colspan="2">         
          <h3 id="name_head1">Education</h3>         
        </td>
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
        <td width="25%" style="vertical-align:top">
          <p><?php echo $pass_year;?></p>               
        </td>
        <td width="75%" style="vertical-align:top">
          <p>            
            <b><?php echo $institution;?></b><br>
            <?php echo $education;?><br>
            <?php echo $subject;?><br>
            <?php echo $marks;?>
          </p>          
        </td>
      </tr>
      <?php                                            
      }
      ?> <hr>
      

      <?php 
      if($project != "") { ?>
      <tr>
        <td width="25%" style="vertical-align:top">         
          <h3 id="name_head1">Projects</h3>         
        </td>
        <td width="75%" style="vertical-align:top">
          <p><?php echo $project;?></p><hr>
        </td>
      </tr>
      <?php } ?>    
                                                         
                                            
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

      <tr>
        <td width="25%" style="vertical-align:top">         
          <h3 id="name_head1"><?php echo $title;?></h3>         
        </td>
        <td width="75%" style="vertical-align:top">
          <p><?php echo $tdescription;?></p>
        </td>
      </tr>  <hr>      
      <?php
        }
      }
      ?>

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
                <tr>                  
                  <td align="right">
                    <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/afry-logo.png">
                  </td>
                </tr>
              </table>
            </p>
          </div>
        </td>
        <td>
          <div style='mso-element:footer' id="f1">
            <p class="MsoFooter">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" class="footer">
                    <p>
                      <span style='text-transform: uppercase;'><?php echo $name; ?></span><br>
                      <?php echo $date1; ?> | (<span style='mso-field-code:PAGE'></span>/<span style='mso-field-code:NUMPAGES'></span>)<br>
                      afry.com
                    </p>
                  </td>
                </tr>
              </table>
            </p>
          </div>
        </td>
      </tr>
    </table>

  </div>
</body>
</html>