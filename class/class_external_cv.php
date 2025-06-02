
<?php

require_once "db_config.php";

class DB_external_cv
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
	public function insert($cv_id, $profile_image, $summary, $technical, $project, $education, $institution, $subject, $marks, $pass_year, $company, $year, $position, $description, $title, $tdescription, $header_image, $footer_text){
		
		$summary = $this->dbs->real_escape_string($summary);
		$technical = $this->dbs->real_escape_string($technical);
		$experience = $this->dbs->real_escape_string($experience);
		$project = $this->dbs->real_escape_string($project);		
						
		$insert_data = mysqli_query($this->dbs, "INSERT INTO external_cv(cv_id,profile_image,summary,technical,project,header_image,footer_text)VALUES('$cv_id','$profile_image','$summary','$technical','$project','$header_image','$footer_text')");
		//return $insert_data;

		if($insert_data == true){		

			$last_id = mysqli_insert_id($this->dbs);
			$arrayd = sizeof($education); 

			for($i=0;$i<$arrayd;$i++) {

				$education[$i] = $this->dbs->real_escape_string($education[$i]);
				$institution[$i] = $this->dbs->real_escape_string($institution[$i]);
				$subject[$i] = $this->dbs->real_escape_string($subject[$i]);
				$marks[$i] = $this->dbs->real_escape_string($marks[$i]);
				$pass_year[$i] = $this->dbs->real_escape_string($pass_year[$i]);

				$insert_data1 = mysqli_query($this->dbs,"INSERT INTO external_cv_edu(cv_id, education, institution, subject, marks, pass_year) VALUES ('$last_id','$education[$i]','$institution[$i]','$subject[$i]','$marks[$i]','$pass_year[$i]')"); 
				//return $insert_data1;

			}
					
			$arrayd1 = sizeof($company); 

			for($i=0;$i<$arrayd1;$i++) {

				$company[$i] = $this->dbs->real_escape_string($company[$i]);
				$year[$i] = $this->dbs->real_escape_string($year[$i]);
				$position[$i] = $this->dbs->real_escape_string($position[$i]);
				$description[$i] = $this->dbs->real_escape_string($description[$i]);

				$insert_data2 = mysqli_query($this->dbs,"INSERT INTO external_cv_exp(cv_id, company, year, position, description) VALUES ('$last_id','$company[$i]','$year[$i]','$position[$i]','$description[$i]')"); 
				//return $insert_data2;
			}

			$arrayd2 = sizeof($title); 

			for($i=0;$i<$arrayd2;$i++) {

				$title[$i] = $this->dbs->real_escape_string($title[$i]);
				$tdescription[$i] = $this->dbs->real_escape_string($tdescription[$i]);

				$insert_data2 = mysqli_query($this->dbs,"INSERT INTO external_cv_other(cv_id, title, tdescription) VALUES ('$last_id','$title[$i]','$tdescription[$i]')"); 
				//return $insert_data2;
			}
					
		return $insert_data;
			
		}
		
	}

	//Data updation Function
	public function update($id, $id1, $id2, $id3, $cv_id, $profile_image, $summary, $technical, $project, $education, $institution, $subject, $marks, $pass_year, $company, $year, $position, $description, $title, $tdescription, $header_image, $footer_text){

		$summary = $this->dbs->real_escape_string($summary);
		$technical = $this->dbs->real_escape_string($technical);
		$experience = $this->dbs->real_escape_string($experience);
		$project = $this->dbs->real_escape_string($project);
		
		$update_data = mysqli_query($this->dbs, "UPDATE external_cv SET cv_id='$cv_id', profile_image='$profile_image', summary='$summary', technical='$technical', project='$project', header_image='$header_image', footer_text='$footer_text' WHERE id='$id'");
		//return $update_data;

		if($update_data == true){			

			$arrayd = sizeof($education); 

			for($i=0;$i<$arrayd;$i++) {

				$education[$i] = $this->dbs->real_escape_string($education[$i]);
				$institution[$i] = $this->dbs->real_escape_string($institution[$i]);
				$subject[$i] = $this->dbs->real_escape_string($subject[$i]);
				$marks[$i] = $this->dbs->real_escape_string($marks[$i]);
				$pass_year[$i] = $this->dbs->real_escape_string($pass_year[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_edu WHERE cv_id='$id' AND id='$id1[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data1 = mysqli_query($this->dbs,"INSERT INTO external_cv_edu(cv_id, education, institution, subject, marks, pass_year) VALUES ('$id','$education[$i]','$institution[$i]','$subject[$i]','$marks[$i]','$pass_year[$i]')"); 
				}
				else{
					$update_data1 = mysqli_query($this->dbs,"UPDATE external_cv_edu SET education='$education[$i]', institution='$institution[$i]', subject='$subject[$i]', marks='$marks[$i]', pass_year='$pass_year[$i]' WHERE cv_id='$id' AND id='$id1[$i]'"); 
				}				
			}			

			$arrayd1 = sizeof($company);

			for($i=0;$i<$arrayd1;$i++) {

				$company[$i] = $this->dbs->real_escape_string($company[$i]);
				$year[$i] = $this->dbs->real_escape_string($year[$i]);
				$position[$i] = $this->dbs->real_escape_string($position[$i]);
				$description[$i] = $this->dbs->real_escape_string($description[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_exp WHERE cv_id='$id' AND id='$id2[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data2 = mysqli_query($this->dbs,"INSERT INTO external_cv_exp(cv_id, company, year, position, description) VALUES ('$id','$company[$i]','$year[$i]','$position[$i]','$description[$i]')"); 
				}
				else{
					$update_data2 = mysqli_query($this->dbs,"UPDATE external_cv_exp SET company='$company[$i]', year='$year[$i]', position='$position[$i]', description='$description[$i]' WHERE cv_id='$id' AND id='$id2[$i]'"); 
				}
			}	

			$arrayd2 = sizeof($title);

			for($i=0;$i<$arrayd2;$i++) {

				$title[$i] = $this->dbs->real_escape_string($title[$i]);
				$tdescription[$i] = $this->dbs->real_escape_string($tdescription[$i]);

				$check_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_other WHERE cv_id='$id' AND id='$id3[$i]'");
				$count_row = $check_data->num_rows;

				if($count_row == 0){
					$insert_data2 = mysqli_query($this->dbs,"INSERT INTO external_cv_other(cv_id, title, tdescription) VALUES ('$id','$title[$i]','$tdescription[$i]')"); 
				}
				else{

					$update_data2 = mysqli_query($this->dbs,"UPDATE external_cv_other SET title='$title[$i]', tdescription='$tdescription[$i]' WHERE cv_id='$id' AND id='$id3[$i]'"); 
				};
			}	

			return $update_data;		
			
		}
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM external_cv WHERE id=$id");
		//return $delete_data;
		if($delete_data == true){
			$delete_data1 = mysqli_query($this->dbs, "DELETE FROM external_cv_edu WHERE cv_id=$id");
			//return $delete_data;

			if($delete_data1 == true){
				$delete_data2 = mysqli_query($this->dbs, "DELETE FROM external_cv_exp WHERE cv_id=$id");
				//return $delete_data;
				if($delete_data2 == true){
					$delete_data3 = mysqli_query($this->dbs, "DELETE FROM external_cv_other WHERE cv_id=$id");
					return $delete_data;
				}
			}
		}
	}

	//external_cv List View function
	public function list_external_cv(){
		$list_external_cv = mysqli_query($this->dbs, "SELECT * FROM external_cv");
		return $list_external_cv;
	}	

	//Data particular one record read Function while update - external_cv
	public function get_one_external_cv($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM external_cv WHERE id=$id");
		return $get_data;
	}	

	//Data particular one record read Function while update - external_cv_education
	public function get_one_external_cv_edu($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_edu WHERE cv_id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - external_cv_experience
	public function get_one_external_cv_exp($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_exp WHERE cv_id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - external_cv_other
	public function get_one_external_cv_other($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM external_cv_other WHERE cv_id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - cv
	public function get_one_cv_id($cv_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM cv WHERE id=$cv_id");
		return $get_data;
	}
}

?>