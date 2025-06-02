
<?php

require_once "db_config.php";

class DB_crm_lead
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
	public function insert($lead_owner, $company, $fname, $lname, $email, $phone, $semail, $website, $title, $description, $lead_source, $lead_status, $industry, $street, $city, $state, $zip, $country, $status){		

		$lead_owner = $this->dbs->real_escape_string($lead_owner);
		$company = $this->dbs->real_escape_string($company);
		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$title = $this->dbs->real_escape_string($title);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		$zip = $this->dbs->real_escape_string($zip);		
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_lead(lead_owner, company, fname, lname, email, phone, semail, website, title, description, lead_source, lead_status, industry, street, city, state, country, zip, status)VALUES('$lead_owner','$company','$fname','$lname','$email','$phone','$semail','$website','$title','$description','$lead_source','$lead_status','$industry','$street','$city','$state','$country','$zip','$status')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $lead_owner, $company, $fname, $lname, $email, $phone, $semail, $website, $title, $description, $lead_source, $lead_status, $industry, $street, $city, $state, $zip, $country, $status){

		$lead_owner = $this->dbs->real_escape_string($lead_owner);
		$company = $this->dbs->real_escape_string($company);
		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$title = $this->dbs->real_escape_string($title);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		$zip = $this->dbs->real_escape_string($zip);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_lead SET lead_owner='$lead_owner', company='$company', fname='$fname', lname='$lname', email='$email', phone='$phone', semail='$semail', website='$website', title='$title', description='$description', lead_source='$lead_source', lead_status='$lead_status', industry='$industry', street='$street', city='$city', state='$state', zip='$zip', country='$country', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_lead WHERE id=$id");
		return $delete_data;
	}

	//crm_lead List View function
	public function list_crm_lead(){
		$list_crm_lead = mysqli_query($this->dbs, "SELECT * FROM crm_lead");
		return $list_crm_lead;
	}

	//crm_lead List View with status function
	public function list_crm_lead_status(){
		$list_crm_lead = mysqli_query($this->dbs, "SELECT * FROM crm_lead WHERE id!=1 AND status = 1");
		return $list_crm_lead;
	}	

	//Data particular one record read Function while update - crm_lead
	public function get_one_crm_lead($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_lead WHERE id=$id");
		return $get_data;
	}	
}

?>