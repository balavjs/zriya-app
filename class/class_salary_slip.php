
<?php

require_once "db_config.php";

class DB_salary_slip
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
	public function insert($emp_id, $sal_date, $month, $year, $currency, $gsalary, $advance, $vat, $nsalary, $sal_type, $name, $quantity, $price, $total){		

		$insert_data = mysqli_query($this->dbs, "INSERT INTO salary_slip(emp_id,sal_date,month,year,currency,gsalary,advance,vat,nsalary)VALUES('$emp_id','$sal_date','$month','$year','$currency','$gsalary','$advance','$vat','$nsalary')");

		//return $insert_data;

		$last_id = mysqli_insert_id($this->dbs);

		if($insert_data == true){		

			$arrayd = sizeof($sal_type); 

			for($i=0;$i<$arrayd;$i++) {

			$insert_data2 = mysqli_query($this->dbs,"INSERT INTO salary_slip_detail(salary_slip_id,sal_type,name,quantity,price,total) VALUES ('$last_id','$sal_type[$i]','$name[$i]','$quantity[$i]','$price[$i]','$total[$i]')"); 
				//return $insert_data2;
			}		

			return $insert_data;
		}		
		
	}

	//Data updation Function
	public function update($id, $id1, $emp_id, $sal_date, $month, $year, $currency, $gsalary, $advance, $vat, $nsalary, $sal_type, $name, $quantity, $price, $total){
		
		$update_data = mysqli_query($this->dbs, "UPDATE salary_slip SET sal_date='$sal_date', month='$month', year='$year', currency='$currency', gsalary='$gsalary', advance='$advance', vat='$vat', nsalary='$nsalary' WHERE id='$id'");
		//return $update_data;

		if($update_data == true){

			$arrayd = sizeof($sal_type); 

			for($i=0;$i<$arrayd;$i++) {

				$check_data = mysqli_query($this->dbs, "SELECT * FROM salary_slip_detail WHERE salary_slip_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data2 = mysqli_query($this->dbs,"INSERT INTO salary_slip_detail(salary_slip_id, sal_type, name, quantity, price, total) VALUES ('$id','$sal_type[$i]','$name[$i]','$quantity[$i]','$price[$i]','$total[$i]')"); 
				}
				else{
					$update_data1 = mysqli_query($this->dbs,"UPDATE salary_slip_detail SET sal_type='$sal_type[$i]', name='$name[$i]', quantity='$quantity[$i]', price='$price[$i]', total='$total[$i]' WHERE salary_slip_id ='$id' AND id='$id1[$i]'"); 						
				}
			}		

			return $update_data;
		}
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM salary_slip WHERE id=$id");
		return $delete_data;
	}

	//salary_slip List View function
	public function list_salary_slip(){
		$list_salary_slip = mysqli_query($this->dbs, "SELECT * FROM salary_slip");
		return $list_salary_slip;
	}

	//salary_slip List View with status function
	public function list_salary_slip_status(){
		$list_salary_slip = mysqli_query($this->dbs, "SELECT * FROM salary_slip WHERE id!=1 AND status = 1");
		return $list_salary_slip;
	}
	

	//Data particular one record read Function while update - salary_slip
	public function get_one_salary_slip($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM salary_slip WHERE id=$id");
		return $get_data;
	}	

	//Data particular one record read Function while update - salary_slip
	public function get_one_salary_slip_detail($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM salary_slip_detail WHERE salary_slip_id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - salary_slip
	public function get_one_emp_salary_slip($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM salary_slip WHERE emp_id=$id ORDER BY month ASC, year ASC");
		return $get_data;
	}

	//Data particular one record read Function while update - salary_slip
	public function get_one_emp_salary_slip_limit($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM salary_slip WHERE emp_id=$id ORDER BY month DESC, year DESC LIMIT 3");
		return $get_data;
	}
}

?>