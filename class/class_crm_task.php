
<?php

require_once "db_config.php";

class DB_crm_task
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
	public function insert($task_owner, $subject, $due_date, $contact, $tstatus, $priority, $description, $status){		

		$task_owner = $this->dbs->real_escape_string($task_owner);
		$subject = $this->dbs->real_escape_string($subject);
		$contact = $this->dbs->real_escape_string($contact);
		$tstatus = $this->dbs->real_escape_string($tstatus);
		$priority = $this->dbs->real_escape_string($priority);
		$description = $this->dbs->real_escape_string($description);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_task(task_owner, subject, due_date, contact, tstatus, priority, description, status)VALUES('$task_owner','$subject','$due_date','$contact','$tstatus','$priority','$description','$status')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $task_owner, $subject, $due_date, $contact, $tstatus, $priority, $description, $status){

		$task_owner = $this->dbs->real_escape_string($task_owner);
		$subject = $this->dbs->real_escape_string($subject);
		$contact = $this->dbs->real_escape_string($contact);
		$tstatus = $this->dbs->real_escape_string($tstatus);
		$priority = $this->dbs->real_escape_string($priority);
		$description = $this->dbs->real_escape_string($description);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_task SET task_owner='$task_owner', subject='$subject', due_date='$due_date', contact='$contact', tstatus='$tstatus', priority='$priority', description='$description', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_task WHERE id=$id");
		return $delete_data;
	}

	//crm_task List View function
	public function list_crm_task(){
		$list_crm_task = mysqli_query($this->dbs, "SELECT * FROM crm_task");
		return $list_crm_task;
	}

	//crm_call List View function
	public function list_crm_task_today($today){
		$list_crm_task = mysqli_query($this->dbs, "SELECT * FROM crm_task WHERE due_date='$today'");
		return $list_crm_task;
	}

	//crm_task List View with status function
	public function list_crm_task_status(){
		$list_crm_task = mysqli_query($this->dbs, "SELECT * FROM crm_task WHERE id!=1 AND status = 1");
		return $list_crm_task;
	}	

	//Data particular one record read Function while update - crm_task
	public function get_one_crm_task($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_task WHERE id=$id");
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