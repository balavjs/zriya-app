
<?php

require_once "db_config.php";

class DB_time_accounts
{
	// DB Construct Function
	function __construct(){
		$conn = mysqli_connect(db_host,db_user,db_pass,db_name);
		$this->dbs = $conn;

		if(mysqli_connect_errno()){
			echo "Error connecting DB". mysqli_connect_errno();
		}		
	}
/*
	//Data Insertion Function
	public function insert($emp_id, $emp_name, $project_name, $work_date, $in_time, $out_time, $status){

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$emp_id = $this->dbs->real_escape_string($emp_id);
		$emp_name = $this->dbs->real_escape_string($emp_name);
		$project_name = $this->dbs->real_escape_string($project_name);
		$work_date = $this->dbs->real_escape_string($work_date);
		$in_time = $this->dbs->real_escape_string($in_time);
		$out_time = $this->dbs->real_escape_string($out_time);
		
		if($count_row == 0){				
			$insert_data = mysqli_query($this->dbs, "INSERT INTO time_accounts(emp_id,emp_name,project_name,work_date,in_time,out_time,status)VALUES('$emp_id','$emp_name','$project_name','$work_date','$in_time','$out_time','$status')");
			return $insert_data;
		}
		else		{
			//echo "Email already exist. &nbsp;";
		}
	}
*/

	//Data Insertion Function
	public function insert($emp_id, $email, $project_name, $acc_cust, $work_date, $hour, $in_time, $out_time, $off_day, $dstatus, $status){

		$insert_data = mysqli_query($this->dbs, "INSERT INTO time_accounts(emp_id,email,status)VALUES('$emp_id', '$email', '$status')");
		//return $insert_data;

		if($insert_data == true){		

			$last_id = mysqli_insert_id($this->dbs);
			$arrayd = sizeof($project_name); 

			for($i=0;$i<$arrayd;$i++) {

				$project_name[$i] = $this->dbs->real_escape_string($project_name[$i]);
				$acc_cust[$i] = $this->dbs->real_escape_string($acc_cust[$i]);

			$insert_data1 = mysqli_query($this->dbs,"INSERT INTO time_accounts_detail(time_acc_id, emp_id, project_name, acc_cust, work_date, hour, in_time, out_time, off_day, dstatus) VALUES ('$last_id','$emp_id','$project_name[$i]','$acc_cust[$i]','$work_date[$i]','$hour[$i]','$in_time[$i]','$out_time[$i]','$off_day[$i]','$dstatus[$i]')"); 
				//return $insert_data1;
			}		
			return $insert_data1;
			
		}
		
	}

/*
	//Data updation Function
	public function update($id, $emp_id, $emp_name, $project_name, $work_date, $in_time, $out_time, $status){

		$emp_id = $this->dbs->real_escape_string($emp_id);
		$emp_name = $this->dbs->real_escape_string($emp_name);
		$project_name = $this->dbs->real_escape_string($project_name);
		$work_date = $this->dbs->real_escape_string($work_date);
		$in_time = $this->dbs->real_escape_string($in_time);
		$out_time = $this->dbs->real_escape_string($out_time);
		
		$update_data = mysqli_query($this->dbs, "UPDATE time_accounts SET emp_id='$emp_id', emp_name='$emp_name', project_name='$project_name', work_date='$work_date', in_time='$in_time', out_time='$out_time', status='$status' WHERE id='$id'");
		return $update_data;
	}
*/

//Data updation Function
	public function update($id, $id1, $emp_id, $project_name, $acc_cust, $work_date, $hour, $in_time, $out_time, $off_day, $dstatus, $status){		
		
		$update_data = mysqli_query($this->dbs, "UPDATE time_accounts SET emp_id='$emp_id', status='$status' WHERE id='$id'");
		//return $update_data;

		if($update_data == true){	

						
			$last_id = mysqli_insert_id($this->dbs);			

			$arrayd = sizeof($project_name); 

			for($i=0;$i<$arrayd;$i++) {

				$project_name[$i] = $this->dbs->real_escape_string($project_name[$i]);
				$acc_cust[$i] = $this->dbs->real_escape_string($acc_cust[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE time_acc_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data1 = mysqli_query($this->dbs,"INSERT INTO time_accounts_detail(time_acc_id, emp_id, project_name, acc_cust, work_date, hour, in_time, out_time, off_day, dstatus) VALUES ('$id','$emp_id','$project_name[$i]','$acc_cust[$i]','$work_date[$i]','$hour[$i]','$in_time[$i]','$out_time[$i]','$off_day[$i]','$dstatus[$i]')"); 
				}
				else{
					$update_data1 = mysqli_query($this->dbs,"UPDATE time_accounts_detail SET project_name='$project_name[$i]', acc_cust='$acc_cust[$i]', work_date='$work_date[$i]', hour='$hour[$i]', in_time='$in_time[$i]', out_time='$out_time[$i]', off_day='$off_day[$i]', dstatus='$dstatus[$i]' WHERE time_acc_id='$id' AND id='$id1[$i]'"); 
				//return $insert_data2;
				}
			}

			return $update_data;
		}

		
	}

	//Data updation Function
	public function update1($id, $id1, $emp_id, $project_name, $acc_cust, $work_date, $hour, $in_time, $out_time, $off_day, $dstatus, $status){		
		
		$update_data = mysqli_query($this->dbs, "UPDATE time_accounts SET emp_id='$emp_id' WHERE id='$id'");
		//return $update_data;

		if($update_data == true){	

						
			$last_id = mysqli_insert_id($this->dbs);			

			$arrayd = sizeof($project_name); 

			for($i=0;$i<$arrayd;$i++) {

				$project_name[$i] = $this->dbs->real_escape_string($project_name[$i]);
				$acc_cust[$i] = $this->dbs->real_escape_string($acc_cust[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE time_acc_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data1 = mysqli_query($this->dbs,"INSERT INTO time_accounts_detail(time_acc_id, emp_id, project_name, acc_cust, work_date, hour, in_time, out_time, off_day, dstatus) VALUES ('$id','$emp_id','$project_name[$i]','$acc_cust[$i]','$work_date[$i]','$hour[$i]','$in_time[$i]','$out_time[$i]','$off_day[$i]','$dstatus[$i]')"); 
				}
				else{
					$update_data1 = mysqli_query($this->dbs,"UPDATE time_accounts_detail SET project_name='$project_name[$i]', acc_cust='$acc_cust[$i]', work_date='$work_date[$i]', hour='$hour[$i]', in_time='$in_time[$i]', out_time='$out_time[$i]', off_day='$off_day[$i]' WHERE time_acc_id='$id' AND id='$id1[$i]'"); 
				//return $insert_data2;
				}
			}

			return $update_data;
		}

		
	}


	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM time_accounts WHERE id=$id");
		return $delete_data;
	}

	//Data Deletion function
	public function time_acc_det_delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM time_accounts_detail WHERE id=$id");
		return $delete_data;
	}

	//time_accounts List View function
	public function list_time_accounts(){
		$list_time_accounts = mysqli_query($this->dbs, "SELECT * FROM time_accounts");
		return $list_time_accounts;
	}

	//time_accounts List View with status function
	public function list_time_accounts_status(){
		$list_time_accounts = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE id!=1 AND status = 1");
		return $list_time_accounts;
	}
	

	//Data particular one record read Function while update - time_accounts
	public function get_one_time_accounts($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE id=$id");
		return $get_data;
	}	

	public function get_one_time_accounts_status($time_acc_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE id=$time_acc_id");
		return $get_data;
	}

	//time_accounts List View function
	public function list_time_accounts_emp(){
		$list_time_accounts = mysqli_query($this->dbs, "SELECT * FROM time_accounts GROUP BY emp_id");
		return $list_time_accounts;
	}

	//Data particular one record read Function while update - company
	public function list_time_accounts_user_status($emp_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE emp_id=$emp_id");
		return $get_data;
	}

	//Data particular one record read Function while update - company
	public function list_time_accounts_user_status_my($emp_id,$month,$year){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts WHERE MONTH(date) = '$month' AND YEAR(date) = '$year' AND emp_id = '$emp_id'");
		return $get_data;
	}	

	//Data particular one record read Function while update - company
	public function list_time_accounts_details($emp_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE emp_id=$emp_id");
		return $get_data;
	}

	//Data particular one record read Function while update - company
	public function list_time_accounts_my($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE time_acc_id=$id ORDER BY work_date ASC ");
		return $get_data;
	}

	//Data particular one record read Function while update - time_accounts
	public function list_time_accounts_my_sum($id){
		$get_data = mysqli_query($this->dbs, "SELECT SUM(hour) as tothour FROM time_accounts_detail WHERE time_acc_id=$id");
		return $get_data;
	}
	
	//Data particular one record read Function while update - time_accounts
	public function get_one_user_my($emp_id,$month,$year){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE MONTH(work_date) = '$month' AND YEAR(work_date) = '$year' AND emp_id = '$emp_id' ORDER BY work_date ASC ");
		return $get_data;
	}	
	
	//Data particular one record read Function while update - time_accounts
	public function get_one_user_y($emp_id,$year){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM time_accounts_detail WHERE YEAR(work_date) = '$year' AND off_day != 'None' AND emp_id = '$emp_id'");
		return $get_data;
	}	

}

?>