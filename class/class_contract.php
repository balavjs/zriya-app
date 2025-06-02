
<?php

require_once "db_config.php";

class DB_contract
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
	public function insert($token, $name, $email, $file, $entry_date){		

		$name = $this->dbs->real_escape_string($name);
					
		$insert_data = mysqli_query($this->dbs, "INSERT INTO contract(token,name,email,file,entry_date)VALUES('$token','$name','$email','$file','$entry_date')");
		return $insert_data;
		
	}

	//Data updation Function
	public function update($id, $name, $email, $file){

		$name = $this->dbs->real_escape_string($name);
		
		$update_data = mysqli_query($this->dbs, "UPDATE contract SET name='$name', email='$email', file='$file' WHERE id='$id'");
		return $update_data;
	}

	//Data updation Function
	public function user_update($id, $token, $message, $status){

		$message = $this->dbs->real_escape_string($message);
		
		$update_data = mysqli_query($this->dbs, "UPDATE contract SET token='$token', message='$message', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data updation Function
	public function user_update_accept($id, $token, $sign, $update_date, $status){
		
		$update_data = mysqli_query($this->dbs, "UPDATE contract SET token='$token', sign='$sign', update_date='$update_date', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM contract WHERE id=$id");
		return $delete_data;
	}

	//contract List View function
	public function list_contract(){
		$list_contract = mysqli_query($this->dbs, "SELECT * FROM contract");
		return $list_contract;
	}

	//contract List View with status function
	public function list_contract_status(){
		$list_contract = mysqli_query($this->dbs, "SELECT * FROM contract WHERE id!=1 AND status = 1");
		return $list_contract;
	}
	

	//Data particular one record read Function while update - contract
	public function get_one_contract($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM contract WHERE id=$id");
		return $get_data;
	}	
}

?>