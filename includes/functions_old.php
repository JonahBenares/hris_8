<?php
function filterEmployee($con,$post){

		foreach($post AS $var=>$value)
			$$var = mysqli_real_escape_string($con,$value);


		$array_pd = array();
		$array_fb = array();
		$array_sch = array();
		$array_eh = array();
		$array_ai = array();

		if(!empty($fullname)){
			$array_pd['fullname'] = $fullname;
		} if(!empty($position)){
			$array_pd['position'] = $position;
		} if(!empty($salary_from)){
			$array_pd['salary_from'] = $salary_from;
		} if(!empty($salary_to)){
			$array_pd['salary_to'] = $salary_to; 
		} if(!empty($bday_from)){
			$array_pd['bday_from'] = $bday_from;
		} if(!empty($bday_to)){
			$array_pd['bday_to'] = $bday_to;
		} if(!empty($applied_from)){
			$array_pd['applied_from'] = $applied_from;
		} if(!empty($applied_to)){
			$array_pd['applied_to'] = $applied_to;
		}if(!empty($available_from)){
			$array_pd['available_from'] = $available_from;
		} if(!empty($available_to)){
			$array_pd['available_to'] = $available_to;
		}if(!empty($others)){
			$array_pd['others'] = $others;
		} if(!empty($status)){
			$array_pd['status'] = $status;
		} 


		if(!empty($family_name)){
			$array_fb['family_name'] = $family_name;
		} if(!empty($family_occ)){
			$array_fb['family_occ'] = $family_occ;
		}


		if(!empty($school_info)){
			$array_sch['school_info'] = $school_info;
		} 

		if(!empty($emp_info)){
			$array_eh['emp_info'] = $emp_info;
		} 

		if(!empty($id_number)){
			$array_ai['id_number'] = $id_number;
		}if(!empty($other_info)){
			$array_ai['other_info'] = $other_info;
		}

		$join='';

		
		$query="SELECT DISTINCT(pd.personal_id), pd.lname, pd.fname, pd.mname, pd.name_ext, pd.bdate, pd.contact_no, pd.permanent_address, pd.provincial_address, pd.place_birth, pd.contact_no, pd.email, pd.nationality, pd.religion, pd.status, p.position_applied, p.date_applied FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id";
	    if(!empty($array_fb)){
				$query.= " LEFT JOIN family_background fb ON p.personal_id = fb.personal_id LEFT JOIN siblings sb ON p.personal_id = sb.personal_id LEFT JOIN children ch ON p.personal_id = ch.personal_id";
		}
		if(!empty($array_sch)){
				$query.= " LEFT JOIN educational_background eb ON p.personal_id = eb.personal_id";
		}
		if(!empty($array_eh)){
				$query.= " LEFT JOIN employment_history eh ON p.personal_id = eh.personal_id";
		}
		if(!empty($array_ai)){
				$query.= " LEFT JOIN additional_info ai ON p.personal_id = ai.personal_id";
		}


		$query .= " WHERE";

		foreach($array_pd AS $key=>$val){
			$$key=$val;
			if($key == 'fullname') {
				$query .= " CONCAT(pd.fname, ' ', pd.mname, ' ', pd.lname, ' ', pd.name_ext) LIKE '%$fullname%' AND";
			}
			if($key == 'position') {
				$query .= " p.position_applied LIKE '%$position%' AND";
			}
			if($key == 'salary_from') {
				if(!empty($salary_to)){
					$query .= " (p.expected_salary BETWEEN '$salary_from' AND '$salary_to') AND";
				} else {
					$query .= " (p.expected_salary BETWEEN '$salary_from' AND '$salary_from') AND";
				}
			}
			if($key == 'bday_from'){
				$bdayfrom = date('Y-m-d', strtotime($bday_from));
				if(!empty($bday_to)){
					$bdayto= date('Y-m-d', strtotime($bday_to));
					$query .= " (pd.bdate BETWEEN '$bdayfrom' AND '$bdayto') AND";
				} else {
					$query .= " (pd.bdate BETWEEN '$bdayfrom' AND '$bdayfrom') AND";
				}
			}
			if($key == 'applied_from'){
				$appliedfrom = date('Y-m-d', strtotime($applied_from));
				if(!empty($applied_to)){
					$appliedto= date('Y-m-d', strtotime($applied_to));
					$query .= " (p.date_applied BETWEEN '$appliedfrom' AND '$appliedto') AND";
				} else {
					$query .= " (p.date_applied BETWEEN '$appliedfrom' AND '$appliedfrom') AND";
				}
			}
			if($key == 'available_from'){
				$availfrom = date('Y-m-d', strtotime($available_from));
				if(!empty($available_to)){
					$availto= date('Y-m-d', strtotime($available_to));
					$query .= " (p.date_available BETWEEN '$availfrom' AND '$availto') AND";
				} else {
					$query .= " (p.date_available BETWEEN '$availfrom' AND '$availfrom') AND";
				}
			}
			if($key == 'others'){
				$query .= " (pd.permanent_address LIKE '%$others%' OR pd.provincial_address LIKE '%$others%' OR pd.place_birth LIKE '%$others%' OR pd.contact_no LIKE '%$others%' OR pd.nationality LIKE '%$others%' OR pd.religion LIKE '%$others%') AND";
			}
			if($key == 'status'){
				$query .= " status = '$status' AND";
			}
			
		}

		foreach($array_fb AS $key=>$val){
			$$key=$val;
			if($key == 'family_name') {
				$query .= " (fb.father_name LIKE '%$family_name%' OR fb.mother_name LIKE '%$family_name%' OR fb.name_spouse LIKE '%$family_name%' OR sb.siblings_name LIKE '%$family_name%' OR ch.child_name LIKE '%$family_name%') AND";
			} if($key == 'family_occ'){
				$query .= " (fb.occupation LIKE '%$family_occ%' OR fb.m_occupation LIKE '%$family_occ%' OR fb.n_occupation LIKE '%$family_occ%' OR sb.siblings_occupation LIKE '%$family_occ%') AND";
			}
		
		}

		foreach($array_sch AS $key=>$val){
			$$key=$val;
			if($key == 'school_info') {
				$query .= " (eb.college LIKE '%$school_info%' OR eb.highschool LIKE '%$school_info%' OR eb.elementary LIKE '%$school_info%' OR eb.course LIKE '%$school_info%') AND";
			} 
		
		}

		foreach($array_eh AS $key=>$val){
			$$key=$val;
			if($key == 'emp_info') {
				$query .= " (eh.name_address_employer LIKE '%$emp_info%' OR eh.em_position LIKE '%$emp_info%') AND";
			} 
		
		}

		foreach($array_ai AS $key=>$val){
			$$key=$val;
			if($key == 'id_number') {
				$query .= " (ai.tin LIKE '%$id_number%' OR ai.sss LIKE '%$id_number%' OR ai.philhealth LIKE '%$id_number%' OR ai.pagibig LIKE '%$id_number%' OR ai.drivers_license LIKE '%$id_number%') AND";
			} if($key == 'other_info') {
				$query .= " (ai.dialect LIKE '%$other_info%' OR ai.special_skills LIKE '%$other_info%' OR ai.illness LIKE '%$other_info%' OR ai.nature_bus LIKE '%$other_info%') AND";
			}
		
		}
		
			$q = substr($query,-3);
			
			$q1 = substr($query,-5);

			if($q == 'AND'){
				
				$q = substr($query,0,-3);
			} else if($q1 == 'WHERE') {
				$q = substr($query,0,-5);
			} else {
				$q = $query;
			}
			
		
		return $q;
	}

function filtersApplied($con,$post){
		foreach($post AS $var=>$value)
			$$var = mysqli_real_escape_string($con,$value);


		$filters='';
		if(!empty($fullname)){
			$filters .= "Name: ". $fullname .", ";
		} if(!empty($position)){
			$filters .= "Position: ". $position .", ";
		} if(!empty($salary_from)){
			$filters .= "Salary from: ". $salary_from .", ";
		} if(!empty($salary_to)){
			$filters .= "Salary to: ". $salary_to .", ";
		} if(!empty($bday_from)){
			$filters .= "Birthday from: ". $bday_from .", ";
		} if(!empty($bday_to)){
			$filters .= "Birthday to: ". $bday_to .", ";
		} if(!empty($applied_from)){
			$filters .= "Date Applied from: ". $applied_from .", ";
		} if(!empty($applied_to)){
			$filters .= "Date Applied to: ". $applied_to .", ";
		}if(!empty($available_from)){
			$filters .= "Availability date from: ". $available_from .", ";
		} if(!empty($available_to)){
			$filters .= "Availability date to: ". $available_to .", ";
		}if(!empty($others)){
			$filters .= "Other personal information: ". $others .", ";
		} if(!empty($status)){
			$filters .= "Status: ". $status .", ";
		} 


		if(!empty($family_name)){
			$filters .= "Name of Family members: ". $family_name .", ";
		} if(!empty($family_occ)){
			$filters .= "Occupation of Family members: ". $family_occ .", ";
		}


		if(!empty($school_info)){
			$filters .= "School Information: ". $school_info .", ";
		} 

		if(!empty($emp_info)){
			$filters .= "Employement History Information: ". $emp_info .", ";
		} 

		if(!empty($id_number)){
			$filters .= "ID Numbers: ". $id_number .", ";
		}if(!empty($other_info)){
			$filters .= "Other information: ". $other_info .", ";
		}

		$filters =  substr($filters,0,-2);;
		return $filters;

}

function checkTmp($conn,$id){
	$select = $conn->query("SELECT personal_id FROM tmp_table WHERE personal_id = '$id'");
	$rows = $select->num_rows;
	return $rows;
}


function checkTmp_job($conn,$id){
	$select = $conn->query("SELECT personal_id FROM job_history_tmp WHERE personal_id = '$id'");
	$rows = $select->num_rows;
	return $rows;
}

function checkTmp_eval($conn,$id){
	$select = $conn->query("SELECT personal_id FROM evaluation_history_tmp WHERE personal_id = '$id'");
	$rows = $select->num_rows;
	return $rows;
}

function getData($conn, $column, $table, $id){
	$get = $conn->query("SELECT $column FROM $table WHERE personal_id = '$id'");
	//echo "SELECT $column FROM $table WHERE personal_id = '$id'";
	$fetch = $get->fetch_array();
	return $fetch[$column];
	
}

function getInfo($conn, $column, $table, $id, $value_id){
	$get = $conn->query("SELECT $column FROM $table WHERE $id = '$value_id'");
	$fetch = $get->fetch_array();
	return $fetch[$column];
	;
}

function getSupID($conn,$name){
	$get = $conn->query("SELECT personal_id FROM personal_data WHERE CONCAT(fname, ' ', mname, ' ', lname, ' ', name_ext) = '$name'");
	
	$fetch = $get->fetch_array();
	$supid=$fetch['personal_id'];
	return $supid;
}

function getSupName($conn, $supid){
	$get = $conn->query("SELECT CONCAT(fname, ' ', mname, ' ', lname, ' ', name_ext) AS fullname FROM personal_data WHERE personal_id = '$supid'");
	$fetch = $get->fetch_array();
	return $fetch['fullname'];
}
?>