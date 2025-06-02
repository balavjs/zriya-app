
<?php

require_once "db_config.php";

class DB_company
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
	public function insert($name, $email, $phone, $address, $comp_name, $cont_name, $cont_email, $cont_phone, $reg_no, $vat_no, $status){

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM company WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$name = $this->dbs->real_escape_string($name);
		$email = $this->dbs->real_escape_string($email);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$comp_name = $this->dbs->real_escape_string($comp_name);
		$cont_name = $this->dbs->real_escape_string($cont_name);
		$cont_email = $this->dbs->real_escape_string($cont_email);
		$cont_phone = $this->dbs->real_escape_string($cont_phone);
		$reg_no = $this->dbs->real_escape_string($reg_no);
		$vat_no = $this->dbs->real_escape_string($vat_no);
		
		if($count_row == 0){				
			$insert_data = mysqli_query($this->dbs, "INSERT INTO company(name,email,phone,address,comp_name,cont_name,cont_email,cont_phone,reg_no,vat_no,status)VALUES('$name','$email','$phone','$address','$comp_name','$cont_name','$cont_email','$cont_phone','$reg_no','$vat_no','$status')");
			return $insert_data;
		}
		else		{
			//echo "Email already exist. &nbsp;";
		}
	}

	//Data updation Function
	public function update($id, $name, $phone, $address, $comp_name, $cont_name, $cont_email, $cont_phone, $reg_no, $vat_no, $status){

		$name = $this->dbs->real_escape_string($name);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$comp_name = $this->dbs->real_escape_string($comp_name);
		$cont_name = $this->dbs->real_escape_string($cont_name);
		$cont_email = $this->dbs->real_escape_string($cont_email);
		$cont_phone = $this->dbs->real_escape_string($cont_phone);
		$reg_no = $this->dbs->real_escape_string($reg_no);
		$vat_no = $this->dbs->real_escape_string($vat_no);
		
		$update_data = mysqli_query($this->dbs, "UPDATE company SET name='$name', phone='$phone', address='$address', comp_name='$comp_name', cont_name='$cont_name', cont_email='$cont_email', cont_phone='$cont_phone', reg_no='$reg_no', vat_no='$vat_no', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM company WHERE id=$id");
		return $delete_data;
	}

	//company List View function
	public function list_company(){
		$list_company = mysqli_query($this->dbs, "SELECT * FROM company");
		return $list_company;
	}

	//company List View with status function
	public function list_company_status(){
		$list_company = mysqli_query($this->dbs, "SELECT * FROM company WHERE id!=1 AND status = 1");
		return $list_company;
	}
	

	//Data particular one record read Function while update - company
	public function get_one_company($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM company WHERE id=$id");
		return $get_data;
	}	
}

?>