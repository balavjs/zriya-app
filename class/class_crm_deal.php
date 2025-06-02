
<?php

require_once "db_config.php";

class DB_crm_deal
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
	public function insert($deal_owner, $deal_name, $type, $next_step, $lead_source, $contact, $amount, $close_date, $stage, $probability, $exp_revenue, $description, $status){		

		$deal_owner = $this->dbs->real_escape_string($deal_owner);
		$deal_name = $this->dbs->real_escape_string($deal_name);
		$next_step = $this->dbs->real_escape_string($next_step);
		$contact = $this->dbs->real_escape_string($contact);
		$description = $this->dbs->real_escape_string($description);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_deal(deal_owner, deal_name, type, next_step, lead_source, contact, amount, close_date, stage, probability, exp_revenue, description, status)VALUES('$deal_owner', '$deal_name', '$type', '$next_step', '$lead_source', '$contact', '$amount', '$close_date', '$stage', '$probability', '$exp_revenue', '$description', '$status')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $deal_owner, $deal_name, $type, $next_step, $lead_source, $contact, $amount, $close_date, $stage, $probability, $exp_revenue, $description, $status){

		$deal_owner = $this->dbs->real_escape_string($deal_owner);
		$deal_name = $this->dbs->real_escape_string($deal_name);
		$next_step = $this->dbs->real_escape_string($next_step);
		$contact = $this->dbs->real_escape_string($contact);
		$description = $this->dbs->real_escape_string($description);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_deal SET deal_owner='$deal_owner', deal_name='$deal_name', type='$type', next_step='$next_step', lead_source='$lead_source', contact='$contact', amount='$amount', close_date='$close_date', stage='$stage', probability='$probability', exp_revenue='$exp_revenue', description='$description', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_deal WHERE id=$id");
		return $delete_data;
	}

	//crm_deal List View function
	public function list_crm_deal(){
		$list_crm_deal = mysqli_query($this->dbs, "SELECT * FROM crm_deal");
		return $list_crm_deal;
	}

	//crm_call List View function
	public function list_crm_deal_today($today){
		$list_crm_deal = mysqli_query($this->dbs, "SELECT * FROM crm_deal WHERE close_date='$today'");
		return $list_crm_deal;
	}

	//crm_deal List View with status function
	public function list_crm_deal_status(){
		$list_crm_deal = mysqli_query($this->dbs, "SELECT * FROM crm_deal WHERE id!=1 AND status = 1");
		return $list_crm_deal;
	}	

	//Data particular one record read Function while update - crm_deal
	public function get_one_crm_deal($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_deal WHERE id=$id");
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