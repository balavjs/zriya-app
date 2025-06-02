<?php
  $title = "External CV Invite Mail | Zriya Solutions";
  ob_start();
?>

<?php include('header.php'); ?>
<?php include('class/class_cv.php'); ?>
<?php include('class/class_users.php'); ?>

<!-- Multiselect -->
<script src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="http://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>

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
              <li class="breadcrumb-item active">External CV Invite Mail</li>
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

      if($role == 1 || $role == 2 || $role == 4){ 
    ?>

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header card-zg">
                <h3 class="card-title">Invite Mail</h3>
              </div>

              <div class="card-body">            

              <?php

              $result = new DB_cv();
              if(isset($_POST['submit'])){                
                
                $from_date    = $_POST['from_date'];
                $to_date      = $_POST['to_date'];                
                $subject      = $_POST['subject'];
                $description  = $_POST['description']; 

                $id    = $_GET['id']; 
                $sql = $result->get_one_cv($id);   
                           
                foreach ($sql as $list) { 
                  $to_mail  = $list['email'];
                }
                
                $date = strtotime($_POST['from_date']); 
                $from_date1 = date('d-m-Y - h:i A', $date);
                $date1 = strtotime($_POST['to_date']); 
                $to_date1 = date('d-m-Y - h:i A', $date1);

                $from_name = "Zriya Solutions";        
                $from_address = "careers@zriyasolutions.com";        
                $to_name = "Receiver Name";        
                $to_address = $to_mail.",careers@zriyasolutions.com";          
                $startTime = $from_date;  
                $endTime = $to_date;    
                $subject = $subject;   
                $description = $description;    
                $location = "Västerås, Sweden";  
                $domain = 'zriyasolutions.com';
              

                //Create Email Headers
                $mime_boundary = "----Meeting Booking----".MD5(TIME());

                $headers = "From: ".$from_name." <".$from_address.">\n";
                $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";                      

                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
                $headers .= "Content-class: urn:content-classes:calendarmessage\n";
                 
                //Create Email Body (HTML)
                $message = "--$mime_boundary\r\n";
                $message .= "Content-Type: text/html; charset=UTF-8\n";
                $message .= "Content-Transfer-Encoding: 8bit\n\n";
                $message .= "<html>\n";
                $message .= "<body>\n";
                 
                $message .= ' 
                     
                        <table style="border: 1px solid #a6a6a6; width: 450px; border-collapse: collapse;" > 
                            <tr> 
                                <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                  <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                                </th>
                            </tr>
                            <tr> 
                                <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                                  Hi, you have a meeting. This is a remainder and details are as follows.
                                </th>
                            </tr>
                            <tr> 
                                <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">From Date</th>
                                <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$from_date1.' (CEST)</td> 
                            </tr> 
                            <tr> 
                                <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">To Date</th>
                                <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$to_date1.' (CEST)</td> 
                            </tr>                                   
                            <tr> 
                                <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Meeting Link</th>
                                <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;"><a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_ZTkzNTE3N2YtMGU0Zi00NjkwLTk4MTQtZmJiYWU3MDJiMDQ4%40thread.v2/0?context=%7b%22Tid%22%3a%22e28f33a4-019f-470e-bbd3-cd4c9a20952e%22%2c%22Oid%22%3a%229ab4bb77-726a-482c-89d7-ae50d0a65124%22%7d">Click Here</a></td> 
                            </tr>
                            
                            '; 

                if($description != ""){

                $message .= '           
                            <tr> 
                                <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Description</th>
                                <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$description.'</td> 
                            </tr>
                            ';
                }

                $message .= '
                        </table>'; 
                 
                $message .= "</body>\n";
                $message .= "</html>\n";
                $message .= "--$mime_boundary\r\n";

                //Event setting
                $ical = 'BEGIN:VCALENDAR' . "\r\n" .
                'PRODID:-//Microsoft Corporation//Outlook 12.0 MIMEDIR//EN' . "\r\n" .
                'VERSION:2.0' . "\r\n" .
                'METHOD:REQUEST' . "\r\n" .
                'BEGIN:VTIMEZONE' . "\r\n" .
                'TZID:Europe/Berlin' . "\r\n" .
                'X-LIC-LOCATION:Europe/Berlin' . "\r\n" .
                'BEGIN:STANDARD' . "\r\n" .
                'DTSTART:20000326T020000' . "\r\n" .
                'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=3' . "\r\n" .
                'TZOFFSETFROM:+0100' . "\r\n" .
                'TZOFFSETTO:+0200' . "\r\n" .
                'TZNAME:CEST' . "\r\n" .
                'END:STANDARD' . "\r\n" .
                'BEGIN:DAYLIGHT' . "\r\n" .
                'DTSTART:20001029T030000' . "\r\n" .
                'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=10' . "\r\n" .
                'TZOFFSETFROM:+0200' . "\r\n" .
                'TZOFFSETTO:+0100' . "\r\n" .
                'TZNAME:CET' . "\r\n" .
                'END:DAYLIGHT' . "\r\n" .
                'END:VTIMEZONE' . "\r\n" .  
                'BEGIN:VEVENT' . "\r\n" .
                'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
                'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
                'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
                'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
                'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
                'DTSTART;TZID="Europe/Berlin":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
                'DTEND;TZID="Europe/Berlin":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
                'TRANSP:OPAQUE'. "\r\n" .
                'SEQUENCE:1'. "\r\n" .
                'SUMMARY:' . $subject . "\r\n" .
                'LOCATION:' . $location . "\r\n" .
                'CLASS:PUBLIC'. "\r\n" .
                'PRIORITY:5'. "\r\n" .
                'BEGIN:VALARM' . "\r\n" .
                'TRIGGER:-PT15M' . "\r\n" .
                'ACTION:DISPLAY' . "\r\n" .
                'DESCRIPTION:Reminder' . "\r\n" .
                'END:VALARM' . "\r\n" .
                'END:VEVENT'. "\r\n" .
                'END:VCALENDAR'. "\r\n";
                $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
                $message .= "Content-Transfer-Encoding: 8bit\n\n";
                $message .= $ical;                    
                 
                // Send email 
                if(mail($to_address, $subject, $message, $headers)){ 
                  //echo 'Email has sent successfully.'; 
                  $_SESSION['success'] = "Invite sent successfully!";   
                  header('location:external_cv_view.php');                 
                }
                else{ 
                  $_SESSION['error'] = "Email sending failed";   
                  header('location:external_cv_view.php');
                  //echo 'Email sending failed.'; 
                }                 
              }
            ?>                       

                <form method="post" name="myform" onsubmit="enableSample();">
                  <h4>Invite Informations</h4><hr>
                  <div class="row">           
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>From Date</label>
                        <input type="datetime-local" class="form-control" name="from_date" required>
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>To Date</label>
                        <input type="datetime-local" class="form-control" name="to_date" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Enter the subject" name="subject" required>           
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter the Description"></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">  
                        <button type="submit" class="btn btn-zg" name="submit">Send Invite</button>
                      </div>
                    </div>                    
                  </div>
                </form>          
              </div>

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
                          <h3 class="card-title">Invite Mail</h3>
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

