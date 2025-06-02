
<?php

require_once "db_config.php";

class DB_crm_vendor
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
	public function insert($vendor_owner, $vendor_name, $email, $phone, $website, $gl_account, $category, $description, $street, $city, $state, $zip, $country, $status){		

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM crm_vendor WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$vendor_owner = $this->dbs->real_escape_string($vendor_owner);
		$vendor_name = $this->dbs->real_escape_string($vendor_name);
		$category = $this->dbs->real_escape_string($category);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		
		if($count_row == 0){			
			$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_vendor(vendor_owner, vendor_name, email, phone, website, gl_account, category, description, street, city, state, zip, country, status)VALUES('$vendor_owner', '$vendor_name', '$email', '$phone', '$website', '$gl_account', '$category', '$description', '$street', '$city', '$state', '$zip', '$country', '$status')");
			return $insert_data;
		}
		else{
		}
		
	}

	//Data updation Function
	public function update($id, $vendor_owner, $vendor_name, $phone, $website, $gl_account, $category, $description, $street, $city, $state, $zip, $country, $status){

		$vendor_owner = $this->dbs->real_escape_string($vendor_owner);
		$vendor_name = $this->dbs->real_escape_string($vendor_name);
		$category = $this->dbs->real_escape_string($category);
		$description = $this->dbs->real_escape_string($description);
		$street = $this->dbs->real_escape_string($street);
		$city = $this->dbs->real_escape_string($city);
		$state = $this->dbs->real_escape_string($state);
		$country = $this->dbs->real_escape_string($country);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_vendor SET vendor_owner='$vendor_owner', vendor_name='$vendor_name', phone='$phone', website='$website', gl_account='$gl_account', category='$category', description='$description', street='$street', city='$city', state='$state', zip='$zip', country='$country', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_vendor WHERE id=$id");
		return $delete_data;
	}

	//crm_vendor List View function
	public function list_crm_vendor(){
		$list_crm_vendor = mysqli_query($this->dbs, "SELECT * FROM crm_vendor");
		return $list_crm_vendor;
	}

	//crm_vendor List View with status function
	public function list_crm_vendor_status(){
		$list_crm_vendor = mysqli_query($this->dbs, "SELECT * FROM crm_vendor WHERE id!=1 AND status = 1");
		return $list_crm_vendor;
	}	

	//Data particular one record read Function while update - crm_vendor
	public function get_one_crm_vendor($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_vendor WHERE id=$id");
		return $get_data;
	}	
}

?>