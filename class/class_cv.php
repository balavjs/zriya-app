
<?php

require_once "db_config.php";

class DB_cv
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
	public function insert($name, $email, $phone, $address, $position, $business_unit, $cv, $status){

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM cv WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$name = $this->dbs->real_escape_string($name);
		$email = $this->dbs->real_escape_string($email);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$position = $this->dbs->real_escape_string($position);
		
		if($count_row == 0){				
			$insert_data = mysqli_query($this->dbs, "INSERT INTO cv(name,email,phone,address,position,business_unit,cv,status)VALUES('$name','$email','$phone','$address','$position','$business_unit','$cv','$status')");
			return $insert_data;
		}
		else		{
			//echo "Email already exist. &nbsp;";
		}
	}

	//Data updation Function
	public function update($id, $name, $email, $phone, $address, $position, $business_unit, $cv, $status){

		$name = $this->dbs->real_escape_string($name);
		$email = $this->dbs->real_escape_string($email);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		$position = $this->dbs->real_escape_string($position);
		
		$update_data = mysqli_query($this->dbs, "UPDATE cv SET name='$name', phone='$phone', address='$address', position='$position', business_unit='$business_unit', cv='$cv', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM cv WHERE id=$id");
		return $delete_data;
	}

	//cv List View function
	public function list_cv(){
		$list_cv = mysqli_query($this->dbs, "SELECT * FROM cv");
		return $list_cv;
	}

	//cv List View with status function
	public function list_cv_status(){
		$list_cv = mysqli_query($this->dbs, "SELECT * FROM cv WHERE id!=1 AND status = 1");
		return $list_cv;
	}
	

	//Data particular one record read Function while update - cv
	public function get_one_cv($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM cv WHERE id=$id");
		return $get_data;
	}	
}

?>