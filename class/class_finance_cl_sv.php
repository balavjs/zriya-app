
<?php

require_once "db_config.php";

class DB_finance_cl_sv
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
	public function insert($invoice_no, $receipt_no, $inv_cnt, $year, $signed, $inv_date, $terms, $due_date, $comp_id, $product_desc, $u_price, $qty, $price, $vat, $total, $pricetotal, $momtotal, $subtotal, $advance, $gtotal, $comment, $status){
		
		$signed = $this->dbs->real_escape_string($signed);
		$comp_id = $this->dbs->real_escape_string($comp_id);
		$comment = $this->dbs->real_escape_string($comment);
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO finance_cl_sv(invoice_no,receipt_no,inv_cnt,year,signed,inv_date,terms,due_date,comp_id,pricetotal,momtotal,subtotal,advance,gtotal,comment,status)VALUES('$invoice_no','$receipt_no','$inv_cnt','$year','$signed','$inv_date','$terms','$due_date','$comp_id','$pricetotal','$momtotal','$subtotal','$advance','$gtotal','$comment','$status')");
		//return $insert_data;

		$last_id = mysqli_insert_id($this->dbs);
		$year1 = date('y');

		if($insert_data == true){

			$arrayd = sizeof($product_desc); 

			for($i=0;$i<$arrayd;$i++) {

			$insert_data2 = mysqli_query($this->dbs,"INSERT INTO finance_cl_sv_desc(finance_cl_sv_id, product_desc, u_price, qty, price, vat, total) VALUES ('$last_id','$product_desc[$i]','$u_price[$i]','$qty[$i]','$price[$i]','$vat[$i]','$total[$i]')"); 
				//return $insert_data2;
			}		

			return $insert_data;
		}	

	
		else		{
			//echo "Email already exist. &nbsp;";
		}
	}
/*
	//Data updation Function
	public function update($id, $id1, $signed, $comp_id, $product_desc, $u_price, $qty, $price, $vat, $total, $subtotal, $advance, $gtotal, $comment, $status){

		$signed = $this->dbs->real_escape_string($signed);
		$comp_id = $this->dbs->real_escape_string($comp_id);
		$comment = $this->dbs->real_escape_string($comment);

		$update_data = mysqli_query($this->dbs, "UPDATE finance_cl_sv SET signed='$signed', comp_id='$comp_id', subtotal='$subtotal', advance='$advance', gtotal='$gtotal', comment='$comment', status='$status' WHERE id='$id' ");
		//return $update_data;

		if($update_data == true){			
				

				$arrayd = sizeof($product_desc); 

				for($i=0;$i<$arrayd;$i++) {

				$update_data1 = mysqli_query($this->dbs,"UPDATE finance_cl_sv_desc SET product_desc='$product_desc[$i]', u_price='$u_price[$i]', qty='$qty[$i]', price='$price[$i]', vat='$vat[$i]', total='$total[$i]' WHERE finance_cl_sv_id='$id' AND id='$id1[$i]'"); 
					//return $update_data1;
				}		

				return $update_data;
			}

	}
*/
	//Data updation Function
	public function update($id, $id1, $signed, $inv_date, $terms, $due_date, $comp_id, $p_status, $p_date, $p_comment, $product_desc, $u_price, $qty, $price, $vat, $total, $pricetotal, $momtotal, $subtotal, $advance, $gtotal, $comment, $status){

		$signed = $this->dbs->real_escape_string($signed);
		$comp_id = $this->dbs->real_escape_string($comp_id);
		$comment = $this->dbs->real_escape_string($comment);

		$update_data = mysqli_query($this->dbs, "UPDATE finance_cl_sv SET signed='$signed', inv_date='$inv_date', terms='$terms', due_date='$due_date', comp_id='$comp_id', p_status='$p_status', p_date='$p_date', p_comment='$p_comment', pricetotal='$pricetotal', momtotal='$momtotal', subtotal='$subtotal', advance='$advance', gtotal='$gtotal', comment='$comment', status='$status' WHERE id='$id' ");
		//return $update_data;

		if($update_data == true){	
			$arrayd = sizeof($product_desc); 

			for($i=0;$i<$arrayd;$i++) {
				
				$check_data = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv_desc WHERE finance_cl_sv_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data1 = mysqli_query($this->dbs,"INSERT INTO finance_cl_sv_desc(finance_cl_sv_id, product_desc, u_price, qty, price, vat, total) VALUES ('$id','$product_desc[$i]','$u_price[$i]','$qty[$i]','$price[$i]','$vat[$i]','$total[$i]')"); 
					//return $insert_data1;
				}
				else{
				$update_data1 = mysqli_query($this->dbs,"UPDATE finance_cl_sv_desc SET product_desc='$product_desc[$i]', u_price='$u_price[$i]', qty='$qty[$i]', price='$price[$i]', vat='$vat[$i]', total='$total[$i]' WHERE finance_cl_sv_id='$id' AND id='$id1[$i]'"); 
					//return $update_data1;
				}	
			}	

			return $update_data;
		}

	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM finance_cl_sv WHERE id=$id");
		//
		if($delete_data == true){
			$delete_data1 = mysqli_query($this->dbs, "DELETE FROM finance_cl_sv_desc WHERE finance_cl_sv_id=$id");
			return $delete_data;
		}
	}
	
	//Data Deletion function
	public function finance_cl_sv_det_delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM finance_cl_sv_desc WHERE id=$id");
		return $delete_data;
	}

	//finance_cl_sv List View function
	public function list_finance_cl_sv(){
		$list_finance_cl_sv = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv");
		return $list_finance_cl_sv;
	}

	public function list_finance_cl_sv_last1(){
		$list_finance_cl_sv = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv ORDER BY id DESC LIMIT 1");
		return $list_finance_cl_sv;
	}

	//finance_cl_sv List View function
	public function list_finance_cl_sv_year($y1){
		$list_finance_cl_sv = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv WHERE year='$y1' ORDER BY id DESC LIMIT 1");
		return $list_finance_cl_sv;
	}
	
	//finance_cl_sv List View with status function
	public function list_finance_cl_sv_status(){
		$list_finance_cl_sv = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv WHERE id!=1 AND status = 1");
		return $list_finance_cl_sv;
	}

	//finance_cl_sv_desc List View function
	public function list_finance_cl_sv_desc($id){
		$list_finance_cl_sv = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv_desc WHERE finance_cl_sv_id=$id");
		return $list_finance_cl_sv;
	}
	

	//Data particular one record read Function while update - finance_cl_sv
	public function get_one_finance_cl_sv($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM finance_cl_sv WHERE id=$id");
		return $get_data;
	}	

	//company List View function
	public function list_company(){
		$list_company = mysqli_query($this->dbs, "SELECT * FROM company");
		return $list_company;
	}
	
	//Data particular one record read Function while update - company
	public function get_one_company($comp_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM company WHERE id=$comp_id");
		return $get_data;
	}
	
}

?>