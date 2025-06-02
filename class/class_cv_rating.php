
<?php

require_once "db_config.php";

class DB_cv_rating
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
	public function insert($cv_id, $tech_rating, $tech_comment, $eng_rating, $eng_comment, $hr_rating, $hr_comment, $experience, $team, $willing, $notice, $hvts, $profile_nature, $area, $lang, $value, $lang_comment, $domain, $personal_detail, $comment, $status){

		$tech_comment = $this->dbs->real_escape_string($tech_comment);
		$eng_comment = $this->dbs->real_escape_string($eng_comment);
		$hr_comment = $this->dbs->real_escape_string($hr_comment);
		$experience = $this->dbs->real_escape_string($experience);	
		$team = $this->dbs->real_escape_string($team);	
		$willing = $this->dbs->real_escape_string($willing);	
		$hvts = $this->dbs->real_escape_string($hvts);	
		$profile_nature = $this->dbs->real_escape_string($profile_nature);	
		$area = $this->dbs->real_escape_string($area);	
		$domain = $this->dbs->real_escape_string($domain);	
		$personal_detail = $this->dbs->real_escape_string($personal_detail);	
		$comment = $this->dbs->real_escape_string($comment);		
					
		$insert_data = mysqli_query($this->dbs, "INSERT INTO cv_rating(cv_id, tech_rating, tech_comment, eng_rating, eng_comment, hr_rating, hr_comment, experience, team, willing, notice, hvts, profile_nature, area, domain, personal_detail, comment, status)VALUES('$cv_id', '$tech_rating', '$tech_comment', '$eng_rating', '$eng_comment', '$hr_rating', '$hr_comment', '$experience', '$team', '$willing', '$notice', '$hvts', '$profile_nature', '$area', '$domain', '$personal_detail', '$comment', '$status')");

			if($insert_data == true){				
				
				$arrayd = sizeof($lang); 

				for($i=0;$i<$arrayd;$i++) {

				$lang[$i] = $this->dbs->real_escape_string($lang[$i]);
				$lang_comment[$i] = $this->dbs->real_escape_string($lang_comment[$i]);

				$insert_data1 = mysqli_query($this->dbs,"INSERT INTO cv_rating_lang(cv_id, lang, value, lang_comment) VALUES ('$cv_id','$lang[$i]','$value[$i]','$lang_comment[$i]')"); 
					//return $insert_data2;
				}		

				return $insert_data;
			}
		//return $insert_data;		
	}

	//Data updation Function
	public function update($id, $id1, $cv_id, $tech_rating, $tech_comment, $eng_rating, $eng_comment, $hr_rating, $hr_comment, $experience, $team, $willing, $notice, $hvts, $profile_nature, $area, $lang, $value, $lang_comment, $domain, $personal_detail, $comment, $status){

		$tech_comment = $this->dbs->real_escape_string($tech_comment);
		$eng_comment = $this->dbs->real_escape_string($eng_comment);
		$hr_comment = $this->dbs->real_escape_string($hr_comment);
		$experience = $this->dbs->real_escape_string($experience);	
		$team = $this->dbs->real_escape_string($team);	
		$willing = $this->dbs->real_escape_string($willing);	
		$hvts = $this->dbs->real_escape_string($hvts);	
		$profile_nature = $this->dbs->real_escape_string($profile_nature);	
		$area = $this->dbs->real_escape_string($area);	
		$domain = $this->dbs->real_escape_string($domain);	
		$personal_detail = $this->dbs->real_escape_string($personal_detail);	
		$comment = $this->dbs->real_escape_string($comment);
		
		$update_data = mysqli_query($this->dbs, "UPDATE cv_rating SET cv_id='$cv_id', tech_rating='$tech_rating', tech_comment='$tech_comment', eng_rating='$eng_rating', eng_comment='$eng_comment', hr_rating='$hr_rating', hr_comment='$hr_comment', experience='$experience', team='$team', willing='$willing', notice='$notice', hvts='$hvts', profile_nature='$profile_nature', area='$area', domain='$domain', personal_detail='$personal_detail', comment='$comment', status='$status' WHERE cv_id='$id'");

			if($update_data == true){							

				$arrayd = sizeof($lang); 

				for($i=0;$i<$arrayd;$i++) {

				$lang[$i] = $this->dbs->real_escape_string($lang[$i]);
				$lang_comment[$i] = $this->dbs->real_escape_string($lang_comment[$i]);

				$update_data1 = mysqli_query($this->dbs,"UPDATE cv_rating_lang SET lang='$lang[$i]', value='$value[$i]', lang_comment='$lang_comment[$i]' WHERE cv_id ='$id' AND id='$id1[$i]'"); 
					//return $insert_data2;
				}		

				return $update_data;
			}
		//return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM cv_rating WHERE cv_id=$id");
		//return $delete_data;
		if($delete_data == true){
			$delete_data1 = mysqli_query($this->dbs, "DELETE FROM cv_rating_lang WHERE cv_id=$id");
			return $delete_data;
		}
	}

	//cv_rating List View function
	public function list_cv_rating(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating");
		return $list_cv_rating;
	}

	//cv_rating List View with status function
	public function list_cv_rating_status(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating WHERE id!=1 AND status = 1");
		return $list_cv_rating;
	}
	

	//Data particular one record read Function while update - cv_rating
	public function get_one_cv_rating($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM cv_rating WHERE id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - cv_rating
	public function get_one_cv_id_rating($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM cv_rating WHERE cv_id=$id");
		return $get_data;
	}	
	//Data particular one record read Function while update - cv_rating
	public function get_one_cv_id_rating_lang($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM cv_rating_lang WHERE cv_id=$id");
		return $get_data;
	}

	//cv_rating List View function
	public function list_cv_rating_tech(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating GROUP BY tech_rating ORDER BY tech_rating ASC");
		return $list_cv_rating;
	}

	//cv_rating List View function
	public function list_cv_rating_eng(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating GROUP BY eng_rating ORDER BY eng_rating ASC");
		return $list_cv_rating;
	}

	//cv_rating List View function
	public function list_cv_rating_hr(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating GROUP BY hr_rating ORDER BY hr_rating ASC");
		return $list_cv_rating;
	}

	//cv_rating List View function
	public function list_cv_rating_language(){
		$list_cv_rating = mysqli_query($this->dbs, "SELECT * FROM cv_rating_lang GROUP BY lang ORDER BY lang ASC");
		return $list_cv_rating;
	}
}

?>