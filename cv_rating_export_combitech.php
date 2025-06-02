<?php include('class/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
      th, td{
        font-size: 11pt !important;
      }
      #table2 th{
        background-color: #006666 !important;
        color: #fff !important;
        padding: 10px;
      }
      /*
      #table2 th, #table2 td, #table2{
        border: 1px solid #d4d4d4;
      }
      */
      #table2 td{
        text-align: center;
      }
    </style>
</head>
<body>

<?php
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment; filename=CV_combitech_list.xls");

    ?>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
      <thead>
        <tr>
          &nbsp;<img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/combitech1.png">
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
      </thead>
    </table>

    <table id="table2" cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
      <thead>
        
        <tr>
          <th colspan="31"><h3>PROFILE REVIEW</h3></th>
        </tr>
        
        <tr>
          <th>&nbsp;&nbsp; S.No &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Name &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Technical Rating &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Technical Comments &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; English Rating &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; English Comments &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; HR Rating &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; HR Comments &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Previous <br>International <br>Experience &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Team &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Willing to move to Sweden &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Notice Period &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Sigma by "Zriya" &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Profile &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Profile Nature &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Area &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; C &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; C++ &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; C# &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; MATLAB &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; AUTOSAR &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Python &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; ADAS &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Networking &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Cluster & Infotainment &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Linux &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; SAFe Organisation &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Agile Methodology &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Domain &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Personal Details &nbsp;&nbsp;</th>
          <th>&nbsp;&nbsp; Comments &nbsp;&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if(isset($_POST['save'])){
        $checkbox = $_POST['check'];
        $j=0;
        for($i=0;$i<count($checkbox);$i++){
          $id = $checkbox[$i]; 
     

          $result = mysqli_query($conn,"SELECT * FROM cv WHERE id='".$id."'");
          if (mysqli_num_rows($result) > 0) {

          while($row = mysqli_fetch_array($result)) {
            $j++;
          ?>
          <tr>
            <td><?php echo $j;?></td>
            <td><?php echo $row['name'];?></td> 
            <?php
               $result1 = mysqli_query($conn,"SELECT * FROM cv_rating WHERE cv_id='".$id."'");
               while($row1 = mysqli_fetch_array($result1)) {
               ?>
               <td><?php echo $row1['tech_rating'];?></td>
               <td><?php echo $row1['tech_comment'];?></td>
               <td><?php echo $row1['eng_rating'];?></td>
               <td><?php echo $row1['eng_comment'];?></td>
               <td><?php echo $row1['hr_rating'];?></td>
               <td><?php echo $row1['hr_comment'];?></td>
               <td><?php echo $row1['experience'];?></td> 
               <td><?php echo $row1['team'];?></td>
               <td><?php echo $row1['willing'];?></td>
               <td><?php echo $row1['notice'];?></td>
               <td><?php echo $row1['hvts'];?></td>
               <td><a href="https://zriyasolutions.com/employee_portal/zriya_app/uploads/cv/<?php echo $row['cv'];?>">Download</a></td>
               <td><?php echo $row1['profile_nature'];?></td>
               <td><?php echo $row1['area'];?></td>
                    <?php
                    $result2 = mysqli_query($conn,"SELECT * FROM cv_rating_lang WHERE cv_id='".$id."'");
                    while($row2 = mysqli_fetch_array($result2)) {
                    ?>
                    <td><?php echo $row2['value'];?></td>
               <?php
                    }
                    ?>
               <td><?php echo $row1['domain'];?></td>
               <td><?php echo $row1['personal_detail'];?></td>
               <td><?php echo $row1['comment'];?></td>
               <?php
               }
            ?>
          </tr>
          <br>
          <?php 
          }
          } 
        }
      }

        ?> 
      </tbody>
    </table>
</body>
</html>