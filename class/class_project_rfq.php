
<?php

require_once "db_config.php";

class DB_project_rfq
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
	public function insert($rfq_no, $inv_cnt, $year, $signed, $aim, $deliverables, $cost, $name, $role, $user_id, $status){		

		$signed = $this->dbs->real_escape_string($signed);
		$aim = $this->dbs->real_escape_string($aim);
		$deliverables = $this->dbs->real_escape_string($deliverables);
		$cost = $this->dbs->real_escape_string($cost);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO project_rfq(rfq_no,inv_cnt,year,signed,aim,deliverables,cost,status)VALUES('$rfq_no','$inv_cnt','$year','$signed','$aim','$deliverables','$cost','$status')");
		//return $insert_data;

		$last_id = mysqli_insert_id($this->dbs);
		$year1 = date('y');

		if($insert_data == true){	

			$arrayd = sizeof($name); 

			for($i=0;$i<$arrayd;$i++) {

				$name[$i] = $this->dbs->real_escape_string($name[$i]);
				$role[$i] = $this->dbs->real_escape_string($role[$i]);

			$insert_data2 = mysqli_query($this->dbs,"INSERT INTO project_rfq_role(project_rfq_id, name, role) VALUES ('$last_id','$name[$i]','$role[$i]')"); 
				//return $insert_data2;
			}	

			$insert_data3 = mysqli_query($this->dbs,"INSERT INTO project_rfq_revision(project_rfq_id, user_id) VALUES ('$last_id','$user_id')");

			return $insert_data;
		}
		
	}

	//Data updation Function
	public function update($id, $id1, $signed, $aim, $deliverables, $cost, $name, $role, $user_id, $status){

		$signed = $this->dbs->real_escape_string($signed);
		$aim = $this->dbs->real_escape_string($aim);
		$deliverables = $this->dbs->real_escape_string($deliverables);
		$cost = $this->dbs->real_escape_string($cost);
		
		$update_data = mysqli_query($this->dbs, "UPDATE project_rfq SET signed='$signed', aim='$aim', deliverables='$deliverables', cost='$cost', status='$status' WHERE id='$id'");
		//return $update_data;

		if($update_data == true){			
				
			$insert_data3 = mysqli_query($this->dbs,"INSERT INTO project_rfq_revision(project_rfq_id, user_id) VALUES ('$id','$user_id')");

			$arrayd = sizeof($name); 

			for($i=0;$i<$arrayd;$i++) {

				$name[$i] = $this->dbs->real_escape_string($name[$i]);
				$role[$i] = $this->dbs->real_escape_string($role[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM project_rfq_role WHERE project_rfq_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data2 = mysqli_query($this->dbs,"INSERT INTO project_rfq_role(project_rfq_id, name, role) VALUES ('$id','$name[$i]','$role[$i]')"); 
				}
				else{
					$update_data1 = mysqli_query($this->dbs,"UPDATE project_rfq_role SET name='$name[$i]', role='$role[$i]' WHERE project_rfq_id='$id' AND id='$id1[$i]'"); 
					//return $update_data1;
				}
			
			}		

			return $update_data;
		}
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM project_rfq WHERE id=$id");
		return $delete_data;
	}

	//project_rfq List View function
	public function list_project_rfq(){
		$list_project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq");
		return $list_project_rfq;
	}

	//project_rfq List View function
	public function project_rfq_last1(){
		$project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq ORDER BY id DESC LIMIT 1");
		return $project_rfq;
	}

	//project_rfq List View function
	public function project_rfq_year($y1){
		$project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq WHERE year='$y1' ORDER BY id DESC LIMIT 1");
		return $project_rfq;
	}

	//project_rfq List View with status function
	public function list_project_rfq_status(){
		$list_project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq WHERE id!=1 AND status = 1");
		return $list_project_rfq;
	}	

	//Data particular one record read Function while update - project_rfq
	public function get_one_project_rfq($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM project_rfq WHERE id=$id");
		return $get_data;
	}	

	//finance_in_desc List View function
	public function list_project_rfq_role($id){
		$list_project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq_role WHERE project_rfq_id=$id");
		return $list_project_rfq;
	}

	//finance_in_desc List View function
	public function list_project_rfq_revision($id){
		$list_project_rfq = mysqli_query($this->dbs, "SELECT * FROM project_rfq_revision WHERE project_rfq_id=$id");
		return $list_project_rfq;
	}

	//project_rfq List View function
	public function list_cur_user($cur_user){
		$list_user = mysqli_query($this->dbs, "SELECT * FROM user WHERE id=$cur_user");
		return $list_user;
	}
	
}

?>