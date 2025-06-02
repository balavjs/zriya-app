
<?php

require_once "db_config.php";

class DB_crm_contact
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
	public function insert($contact_owner, $lead_source, $fname, $lname, $acc_name, $vendor_name, $email, $semail, $phone, $sphone, $title, $department, $description, $street, $city, $state, $zip, $country, $status){		

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM crm_contact WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$contact_owner = $this->dbs->real_escape_string($contact_owner);
		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$acc_name = $this->dbs->real_escape_string($acc_name);
		$vendor_name = $this->dbs->real_escape_string($vendor_name);
		$title = $this->dbs->real_escape_string($title);
		$department = $this->dbs->real_escape_string($department);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		
		if($count_row == 0){
			$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_contact(contact_owner, lead_source, fname, lname, acc_name, vendor_name, email, semail, phone, sphone, title, department, description, street, city, state, zip, country, status)VALUES('$contact_owner','$lead_source','$fname','$lname','$acc_name','$vendor_name','$email','$semail','$phone','$sphone','$title','$department','$description','$street','$city','$state','$zip','$country','$status')");
			return $insert_data;
		}
		else{
			
		}
		
	}

	//Data updation Function
	public function update($id, $contact_owner, $lead_source, $fname, $lname, $acc_name, $vendor_name, $email, $semail, $phone, $sphone, $title, $department, $description, $street, $city, $state, $zip, $country, $status){

		$contact_owner = $this->dbs->real_escape_string($contact_owner);
		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$acc_name = $this->dbs->real_escape_string($acc_name);
		$vendor_name = $this->dbs->real_escape_string($vendor_name);
		$title = $this->dbs->real_escape_string($title);
		$department = $this->dbs->real_escape_string($department);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_contact SET contact_owner='$contact_owner', lead_source='$lead_source', fname='$fname', lname='$lname', acc_name='$acc_name', vendor_name='$vendor_name', email='$email', semail='$semail', phone='$phone', sphone='$sphone', title='$title', department='$department', description='$description', street='$street', city='$city', state='$state', zip='$zip', country='$country', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_contact WHERE id=$id");
		return $delete_data;
	}

	//crm_contact List View function
	public function list_crm_contact(){
		$list_crm_contact = mysqli_query($this->dbs, "SELECT * FROM crm_contact");
		return $list_crm_contact;
	}

	//crm_contact List View with status function
	public function list_crm_contact_status(){
		$list_crm_contact = mysqli_query($this->dbs, "SELECT * FROM crm_contact WHERE id!=1 AND status = 1");
		return $list_crm_contact;
	}	

	//Data particular one record read Function while update - crm_contact
	public function get_one_crm_contact($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_contact WHERE id=$id");
		return $get_data;
	}	
}

?>