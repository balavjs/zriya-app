<?php
   
   // include database connection file
   include "class/connection.php";
   // load records using select box jquery ajax in PHP
   $id = $_POST['id'];
   $query = "SELECT * FROM user WHERE id = '$id'";
   $result = $conn->query($query);
   $output = "";
   if ($result->num_rows > 0) {
      
      $output .= "<table class='table table-hover table-border'>
                   <thead>
                     <tr>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Address</th>
                     </tr>
                   </thead>";
      while ($row = $result->fetch_assoc()) {
      $output .= "<tbody>
                  <tr>
                    <td>{$row['fname']} {$row['lname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['address']}</td>
                  </tr>
                </tbody>";
      }                   
                   
      $output .= "</table>";
      echo $output;
   }else{
      echo "No records found";
   }
?>