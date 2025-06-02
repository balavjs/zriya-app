
<?php

require_once "db_config.php";

class DB_crm_account
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
	public function insert($acc_owner, $acc_name, $acc_site, $acc_no, $acc_type, $industry, $revenue, $rating, $email, $phone, $website, $ownership, $employees, $sic_code, $description, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_country, $ship_street, $ship_city, $ship_state, $ship_zip, $ship_country, $status){		

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM crm_account WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$acc_owner = $this->dbs->real_escape_string($acc_owner);
		$acc_name = $this->dbs->real_escape_string($acc_name);
		$acc_site = $this->dbs->real_escape_string($acc_site);
		$acc_no = $this->dbs->real_escape_string($acc_no);
		$employees = $this->dbs->real_escape_string($employees);
		$sic_code = $this->dbs->real_escape_string($sic_code);
		$description = $this->dbs->real_escape_string($description);
		$bill_street = $this->dbs->real_escape_string($bill_street);
		$bill_city = $this->dbs->real_escape_string($bill_city);
		$bill_state = $this->dbs->real_escape_string($bill_state);
		$bill_zip = $this->dbs->real_escape_string($bill_zip);
		$bill_country = $this->dbs->real_escape_string($bill_country);	
		$ship_street = $this->dbs->real_escape_string($ship_street);
		$ship_city = $this->dbs->real_escape_string($ship_city);
		$ship_state = $this->dbs->real_escape_string($ship_state);
		$ship_zip = $this->dbs->real_escape_string($ship_zip);
		$ship_country = $this->dbs->real_escape_string($ship_country);		

		if($count_row == 0){
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO crm_account(acc_owner, acc_name, acc_site, acc_no, acc_type, industry, revenue, rating, email, phone, website, ownership, employees, sic_code, description, bill_street, bill_city, bill_state, bill_zip, bill_country, ship_street, ship_city, ship_state, ship_zip, ship_country, status)VALUES('$acc_owner', '$acc_name', '$acc_site', '$acc_no', '$acc_type', '$industry', '$revenue', '$rating', '$email', '$phone', '$website', '$ownership', '$employees', '$sic_code', '$description', '$bill_street', '$bill_city', '$bill_state', '$bill_zip', '$bill_country', '$ship_street', '$ship_city', '$ship_state', '$ship_zip', '$ship_country', '$status')");
		return $insert_data;
		}
		else{

		}
		
	}

	//Data updation Function
	public function update($id, $acc_owner, $acc_name, $acc_site, $acc_no, $acc_type, $industry, $revenue, $rating, $phone, $website, $ownership, $employees, $sic_code, $description, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_country, $ship_street, $ship_city, $ship_state, $ship_zip, $ship_country, $status){

		$acc_owner = $this->dbs->real_escape_string($acc_owner);
		$acc_name = $this->dbs->real_escape_string($acc_name);
		$acc_site = $this->dbs->real_escape_string($acc_site);
		$acc_no = $this->dbs->real_escape_string($acc_no);
		$employees = $this->dbs->real_escape_string($employees);
		$sic_code = $this->dbs->real_escape_string($sic_code);
		$description = $this->dbs->real_escape_string($description);
		$bill_street = $this->dbs->real_escape_string($bill_street);
		$bill_city = $this->dbs->real_escape_string($bill_city);
		$bill_state = $this->dbs->real_escape_string($bill_state);
		$bill_zip = $this->dbs->real_escape_string($bill_zip);
		$bill_country = $this->dbs->real_escape_string($bill_country);	
		$ship_street = $this->dbs->real_escape_string($ship_street);
		$ship_city = $this->dbs->real_escape_string($ship_city);
		$ship_state = $this->dbs->real_escape_string($ship_state);
		$ship_zip = $this->dbs->real_escape_string($ship_zip);
		$ship_country = $this->dbs->real_escape_string($ship_country);
		
		$update_data = mysqli_query($this->dbs, "UPDATE crm_account SET acc_owner='$acc_owner', acc_name='$acc_name', acc_site='$acc_site', acc_no='$acc_no', acc_type='$acc_type', industry='$industry', revenue='$revenue', rating='$rating', phone='$phone', website='$website', ownership='$ownership', employees='$employees', sic_code='$sic_code', description='$description', bill_street='$bill_street', bill_city='$bill_city', bill_state='$bill_state', bill_zip='$bill_zip', bill_country='$bill_country', ship_street='$ship_street', ship_city='$ship_city', ship_state='$ship_state', ship_zip='$ship_zip', ship_country='$ship_country', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM crm_account WHERE id=$id");
		return $delete_data;
	}

	//crm_account List View function
	public function list_crm_account(){
		$list_crm_account = mysqli_query($this->dbs, "SELECT * FROM crm_account");
		return $list_crm_account;
	}

	//crm_account List View with status function
	public function list_crm_account_status(){
		$list_crm_account = mysqli_query($this->dbs, "SELECT * FROM crm_account WHERE id!=1 AND status = 1");
		return $list_crm_account;
	}	

	//Data particular one record read Function while update - crm_account
	public function get_one_crm_account($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM crm_account WHERE id=$id");
		return $get_data;
	}	
}

?>