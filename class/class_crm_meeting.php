
<?php

require_once "db_config.php";

class DB_crm_meeting
{
	// DB Construct Function
	function __construct(){
		$conn = mysqli_connect(db_host,db_user,db_pass,db_name);
		$this->dbs = $conn;

		if(mysqli_connect_errno()){
			echo "Error connecting DB". mysqli_connect_errno();
		}		
	}

	//Data Insertion Function 
	public function insert($host, $host_email, $from_date, $from_time, $to_date, $to_time, $participants, $check_mail, $subject, $description, $status){		

		$host = $this->dbs->real_escape_string($host);
		$description = $this->dbs->real_escape_string($description);		
					
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_meeting(host, host_email, from_date, to_date, participants, check_mail, subject, description, status)VALUES('$host','$host_email','$from_date','$to_date','$participants','$check_mail','$subject','$description','$status')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $host, $host_email, $from_date, $to_date, $participants, $check_mail, $subject, $description, $status){

		$host = $this->dbs->real_escape_string($host);
		$description = $this->dbs->real_escape_string($description);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_meeting SET host='$host', host_email='$host_email', from_date='$from_date', to_date='$to_date', participants='$participants', check_mail='$check_mail', subject='$subject', description='$description', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_meeting WHERE id=$id");
		return $delete_data;
	}

	//crm_meeting List View function
	public function list_crm_meeting(){
		$list_crm_meeting = mysqli_query($this->dbs, "SELECT * FROM crm_meeting");
		return $list_crm_meeting;
	}

	//crm_call List View function
	public function list_crm_meeting_today($today){
		$list_crm_meeting = mysqli_query($this->dbs, "SELECT * FROM crm_meeting WHERE from_date='$today'");
		return $list_crm_meeting;
	}

	//crm_meeting List View with status function
	public function list_crm_meeting_status(){
		$list_crm_meeting = mysqli_query($this->dbs, "SELECT * FROM crm_meeting WHERE id!=1 AND status = 1");
		return $list_crm_meeting;
	}	

	//Data particular one record read Function while update - crm_meeting
	public function get_one_crm_meeting($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_meeting WHERE id=$id");
		return $get_data;
	}	
	//crm_contact List View function
	public function list_crm_contact(){
		$list_crm_contact = mysqli_query($this->dbs, "SELECT * FROM crm_contact");
		return $list_crm_contact;
	}
}

?>