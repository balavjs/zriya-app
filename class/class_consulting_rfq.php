
<?php

require_once "db_config.php";

class DB_consulting_rfq
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
	public function insert($rfq_no, $inv_cnt, $year, $signed, $name, $description, $status){		

		$signed = $this->dbs->real_escape_string($signed);
		$name = $this->dbs->real_escape_string($name);
		$description = $this->dbs->real_escape_string($description);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO consulting_rfq(rfq_no,inv_cnt,year,signed,name,description,status)VALUES('$rfq_no','$inv_cnt','$year','$signed','$name','$description','$status')");
		return $insert_data;

		/*
		$last_id = mysqli_insert_id($this->dbs);
		$year1 = date('y');

		if($insert_data == true){				
			$insert_data1 = mysqli_query($this->dbs,"UPDATE consulting_rfq SET rfq_no='C-RFQ-'\"$year1\"'-000".$last_id."' WHERE id = '$last_id'");
			return $insert_data;
		}
		*/
	}

	//Data updation Function
	public function update($id, $signed, $name, $description, $status){

		$signed = $this->dbs->real_escape_string($signed);
		$name = $this->dbs->real_escape_string($name);
		$description = $this->dbs->real_escape_string($description);
		
		$update_data = mysqli_query($this->dbs, "UPDATE consulting_rfq SET signed='$signed', name='$name', description='$description', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM consulting_rfq WHERE id=$id");
		return $delete_data;
	}

	//consulting_rfq List View function
	public function list_consulting_rfq(){
		$list_consulting_rfq = mysqli_query($this->dbs, "SELECT * FROM consulting_rfq");
		return $list_consulting_rfq;
	}

	//consulting_rfq List View function
	public function consulting_rfq_last1(){
		$consulting_rfq = mysqli_query($this->dbs, "SELECT * FROM consulting_rfq ORDER BY id DESC LIMIT 1");
		return $consulting_rfq;
	}

	//consulting_rfq List View function
	public function consulting_rfq_year($y1){
		$consulting_rfq = mysqli_query($this->dbs, "SELECT * FROM consulting_rfq WHERE year='$y1' ORDER BY id DESC LIMIT 1");
		return $consulting_rfq;
	}

	//consulting_rfq List View with status function
	public function list_consulting_rfq_status(){
		$list_consulting_rfq = mysqli_query($this->dbs, "SELECT * FROM consulting_rfq WHERE id!=1 AND status = 1");
		return $list_consulting_rfq;
	}
	

	//Data particular one record read Function while update - consulting_rfq
	public function get_one_consulting_rfq($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM consulting_rfq WHERE id=$id");
		return $get_data;
	}	
}

?>