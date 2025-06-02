
<?php

require_once "db_config.php";

class DB_crm_call
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
	public function insert($call_owner, $call_to, $related, $call_type, $call_status, $call_date, $call_time, $subject, $purpose, $agenda, $status){		

		$call_owner = $this->dbs->real_escape_string($call_owner);
		$call_to = $this->dbs->real_escape_string($call_to);
		$related = $this->dbs->real_escape_string($related);
		$call_type = $this->dbs->real_escape_string($call_type);
		$call_status = $this->dbs->real_escape_string($call_status);
		$call_date = $this->dbs->real_escape_string($call_date);
		$call_time = $this->dbs->real_escape_string($call_time);
		$subject = $this->dbs->real_escape_string($subject);
		$purpose = $this->dbs->real_escape_string($purpose);
		$agenda = $this->dbs->real_escape_string($agenda);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_call(call_owner, call_to, related, call_type, call_status, call_date, call_time, subject, purpose, agenda, status)VALUES('$call_owner','$call_to','$related','$call_type','$call_status','$call_date','$call_time','$subject','$purpose','$agenda','$status')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $call_owner, $call_to, $related, $call_type, $call_status, $call_date, $call_time, $subject, $purpose, $agenda, $status){

		$call_owner = $this->dbs->real_escape_string($call_owner);
		$call_to = $this->dbs->real_escape_string($call_to);
		$related = $this->dbs->real_escape_string($related);
		$call_type = $this->dbs->real_escape_string($call_type);
		$call_status = $this->dbs->real_escape_string($call_status);
		$call_date = $this->dbs->real_escape_string($call_date);
		$call_time = $this->dbs->real_escape_string($call_time);
		$subject = $this->dbs->real_escape_string($subject);
		$purpose = $this->dbs->real_escape_string($purpose);
		$agenda = $this->dbs->real_escape_string($agenda);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_call SET call_owner='$call_owner', call_to='$call_to', related='$related', call_type='$call_type', call_status='$call_status', call_date='$call_date', call_time='$call_time', subject='$subject', purpose='$purpose', agenda='$agenda', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_call WHERE id=$id");
		return $delete_data;
	}

	//crm_call List View function
	public function list_crm_call(){
		$list_crm_call = mysqli_query($this->dbs, "SELECT * FROM crm_call");
		return $list_crm_call;
	}

	//crm_call List View function
	public function list_crm_call_today($today){
		$list_crm_call = mysqli_query($this->dbs, "SELECT * FROM crm_call WHERE call_date='$today'");
		return $list_crm_call;
	}

	//crm_call List View with status function
	public function list_crm_call_status(){
		$list_crm_call = mysqli_query($this->dbs, "SELECT * FROM crm_call WHERE id!=1 AND status = 1");
		return $list_crm_call;
	}	

	//Data particular one record read Function while update - crm_call
	public function get_one_crm_call($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_call WHERE id=$id");
		return $get_data;
	}	

	//crm_contact List View function
	public function list_crm_contact(){
		$list_crm_contact = mysqli_query($this->dbs, "SELECT * FROM crm_contact");
		return $list_crm_contact;
	}
	//crm_contact List View function
	public function list_crm_contact_user($cont_id){
		$list_crm_contact = mysqli_query($this->dbs, "SELECT * FROM crm_contact WHERE id=$cont_id");
		return $list_crm_contact;
	}
}

?>