<?php
function filterEmployee($con,$post){

		foreach($post AS $var=>$value)
			$$var = mysqli_real_escape_string($con,$value);


		$array_pd = array();
		/*$array_fb = array();*/
		/*$array_sch = array();*/
		/*$array_eh = array();*/
		/*$array_ai = array();*/

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
		}if(!empty($status)){
			$array_pd['status'] = $status;
		} if(!empty($gender)){
			$array_pd['gender'] = $gender;
		} if(!empty($age_from)){
			$array_pd['age_from'] = $age_from;
		} if(!empty($age_to)){
			$array_pd['age_to'] = $age_to;
		} if(!empty($department)){
			$array_pd['department'] = $department;
		} if(!empty($business_unit)){
			$array_pd['business_unit'] = $business_unit;
		} if(!empty($location)){
			$array_pd['location'] = $location;
		} if(!empty($emp_status)){
			$array_pd['emp_status'] = $emp_status;
		} 


		/*if(!empty($family_name)){
			$array_fb['family_name'] = $family_name;
		} if(!empty($family_occ)){
			$array_fb['family_occ'] = $family_occ;
		}
*/
/*
		if(!empty($school_info)){
			$array_sch['school_info'] = $school_info;
		} 
*//*
		if(!empty($emp_info)){
			$array_eh['emp_info'] = $emp_info;
		} */

		/*if(!empty($id_number)){
			$array_ai['id_number'] = $id_number;
		}if(!empty($other_info)){
			$array_ai['other_info'] = $other_info;
		}*/

		$join='';

		
		$query="SELECT DISTINCT(pd.personal_id), pd.lname, pd.fname, pd.mname, pd.name_ext, pd.bdate, pd.contact_no, pd.permanent_address, pd.provincial_address, pd.place_birth, pd.emp_status, pd.contact_no, pd.email, pd.nationality, pd.religion, pd.status, p.position_applied, p.date_applied, pd.supervisor, pd.status, pd.current_location,pd.date_hired FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id AND pd.supervisor='0'";

		//echo $query;
		
	   /* if(!empty($array_fb)){
				$query.= " LEFT JOIN family_background fb ON p.personal_id = fb.personal_id LEFT JOIN siblings sb ON p.personal_id = sb.personal_id LEFT JOIN children ch ON p.personal_id = ch.personal_id";
		}*/
	/*	if(!empty($array_sch)){
				$query.= " LEFT JOIN educational_background eb ON p.personal_id = eb.personal_id";
		}
		if(!empty($array_eh)){
				$query.= " LEFT JOIN employment_history eh ON p.personal_id = eh.personal_id";
		}
		if(!empty($array_ai)){
				$query.= " LEFT JOIN additional_info ai ON p.personal_id = ai.personal_id";
		}*/

		$query .= " WHERE";

		foreach($array_pd AS $key=>$val){
			$$key=$val;
			if($key == 'fullname') {
				$query .= " CONCAT(pd.fname, ' ', pd.mname, ' ', pd.lname, ' ', pd.name_ext) LIKE '%$fullname%' AND";
			}

			if($key == 'position') {
				$query .= " p.position_applied LIKE '%$position%' AND";
			}
			if($key == 'department') {
				$query .= " pd.current_dept = '$department' AND";
			}
			if($key == 'business_unit') {
				$query .= " pd.current_bu = '$business_unit' AND";
			}
			if($key == 'location') {
				$query .= " pd.current_location = '$location' AND";
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
			
			if($key == 'status'){
				$query .= " status = '$status' AND";
			}
			if($key == 'emp_status'){
				$query .= " emp_status = '$emp_status' AND";
			}
			if($key == 'gender'){
				$query .= " sex = '$gender' AND";
			}if($key == 'age_from'){
				if(!empty($age_to)){
					$query .= " (pd.age BETWEEN '$age_from' AND '$age_to') AND";
				} else {
					$query .= " (pd.age BETWEEN '$age_from' AND '$age_from') AND";
				}
			}
			
		}

		/*foreach($array_fb AS $key=>$val){
			$$key=$val;
			if($key == 'family_name') {
				$query .= " (fb.father_name LIKE '%$family_name%' OR fb.mother_name LIKE '%$family_name%' OR fb.name_spouse LIKE '%$family_name%' OR sb.siblings_name LIKE '%$family_name%' OR ch.child_name LIKE '%$family_name%') AND";
			} if($key == 'family_occ'){
				$query .= " (fb.occupation LIKE '%$family_occ%' OR fb.m_occupation LIKE '%$family_occ%' OR fb.n_occupation LIKE '%$family_occ%' OR sb.siblings_occupation LIKE '%$family_occ%') AND";
			}
		
		}
*/
		/*foreach($array_sch AS $key=>$val){
			$$key=$val;
			if($key == 'school_info') {
				$query .= " (eb.college LIKE '%$school_info%' OR eb.highschool LIKE '%$school_info%' OR eb.elementary LIKE '%$school_info%' OR eb.course LIKE '%$school_info%') AND";
			} 
		
		}
*/
	/*	foreach($array_eh AS $key=>$val){
			$$key=$val;
			if($key == 'emp_info') {
				$query .= " (eh.name_address_employer LIKE '%$emp_info%' OR eh.em_position LIKE '%$emp_info%') AND";
			} 
		
		}
*/
	/*	foreach($array_ai AS $key=>$val){
			$$key=$val;
			if($key == 'id_number') {
				$query .= " (ai.tin LIKE '%$id_number%' OR ai.sss LIKE '%$id_number%' OR ai.philhealth LIKE '%$id_number%' OR ai.pagibig LIKE '%$id_number%' OR ai.drivers_license LIKE '%$id_number%') AND";
			} if($key == 'other_info') {
				$query .= " (ai.dialect LIKE '%$other_info%' OR ai.special_skills LIKE '%$other_info%' OR ai.illness LIKE '%$other_info%' OR ai.nature_bus LIKE '%$other_info%') AND";
			}
		
		}*/
		
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
		} if(!empty($status)){
			$filters .= "Status: ". $status .", ";
		} if(!empty($gender)){
			$filters .= "Gender: ". $gender .", ";
		} if(!empty($age_from)){
			$filters .= "Age from: ". $age_from .", ";
		} if(!empty($age_to)){
			$filters .= "Age to: ". $age_to .", ";
		} if(!empty($department)){
			$filters .= "Department: ". getInfo($con, 'dept_name', 'department', 'dept_id', $department) .", ";
		} if(!empty($business_unit)){
			$filters .= "Business Unit: ". getInfo($con, 'bu_name', 'business_unit', 'bu_id', $business_unit) .", ";
		}  if(!empty($location)){
			$filters .= "Location: ". getInfo($con, 'location_name', 'location', 'location_id', $location) .", ";
		} if(!empty($emp_status)){
			$filters .= "Employment Status: ". $emp_status .", ";
		} 


		/*if(!empty($family_name)){
			$filters .= "Name of Family members: ". $family_name .", ";
		} if(!empty($family_occ)){
			$filters .= "Occupation of Family members: ". $family_occ .", ";
		}*/


		/*if(!empty($school_info)){
			$filters .= "School Information: ". $school_info .", ";
		} */
/*
		if(!empty($emp_info)){
			$filters .= "Employement History Information: ". $emp_info .", ";
		} */

	/*	if(!empty($id_number)){
			$filters .= "ID Numbers: ". $id_number .", ";
		}if(!empty($other_info)){
			$filters .= "Other information: ". $other_info .", ";
		}*/

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

function checkTmp_allowance($conn,$id){
	$select = $conn->query("SELECT personal_id FROM allowance_tmp WHERE personal_id = '$id'");
	$rows = $select->num_rows;
	return $rows;
}

function checkTmp_discipline($conn,$id){
	$select = $conn->query("SELECT personal_id FROM disciplinary_action_tmp WHERE personal_id = '$id'");
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
	$get = $conn->query("SELECT $column FROM $table WHERE $id = '$value_id'") or die(mysql_error());
	$fetch = $get->fetch_array();
	return $fetch[$column];
	
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

function getGenderCount($con,$dept,$column, $gender){
	$get = $con->query("SELECT personal_id FROM personal_data WHERE sex='$gender' AND $column = '$dept' AND status = 'Active'");
	$rows=$get->num_rows;
	return $rows;
}
function getPosition($con, $personal_id){
	$get = $con->query("SELECT * FROM job_history WHERE personal_id = '$personal_id' ORDER BY  history_id ASC LIMIT 1");
	$fetch = $get->fetch_array();
	$j_position=$fetch['j_position'];
	return $fetch['j_position'];
}
function getTenure($con, $personal_id,$month){
	$get = $con->query("SELECT date_hired FROM personal_data WHERE personal_id = '$personal_id'");
	$fetch = $get->fetch_array();
	$date1 = $fetch['date_hired'];
    $date2 = $month;
    $diff = abs(strtotime($date2) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $tenure = $years." year/s and ".$months." month/s";
	return $tenure;
}
function getDateReg($con, $personal_id){
	$get = $con->query("SELECT effective_date FROM job_history WHERE personal_id = '$personal_id' AND emp_status = 'Regular' ORDER BY  effective_date ASC LIMIT 1");
	$fetch = $get->fetch_array();
	$effective_date=$fetch['effective_date'];
	return $fetch['effective_date'];
}

function getDateReg_projbase($con, $personal_id){
	$get = $con->query("SELECT effective_date FROM job_history WHERE personal_id = '$personal_id' AND emp_status = 'Project Based' ORDER BY  effective_date DESC LIMIT 1");
	$fetch = $get->fetch_array();
	$effective_date=$fetch['effective_date'];
	return $fetch['effective_date'];
}

function getEntrySal($con, $personal_id){
	$get = $con->query("SELECT salary,per_day FROM job_history WHERE personal_id = '$personal_id' ORDER BY  effective_date ASC LIMIT 1");
	$fetch = $get->fetch_array();
	if($fetch['salary']!='0.00'){
		$salary=$fetch['salary'];
		return $salary;
	}else {
		$per_day=$fetch['per_day'];
		return $per_day;
	}
}

function getAgeCount($con, $dept, $column, $agefrom, $ageto){
	$ageCount=0;
	$get = $con->query("SELECT personal_id, bdate FROM personal_data WHERE $column = '$dept'");
	while($fetch = $get->fetch_array()){
		$age = computeAge($fetch['bdate']);
		if($age>=$agefrom && $age <= $ageto){
			//echo $agefrom . " to " . $ageto . " = " . $age."<br>";
			$ageCount++;
		}

	}
	return $ageCount;
	//return count($ageCount);
	//$rows=$get->num_rows;
	//return $rows;
}

function getEmpStatusCount($con,$dept,$column, $empstatus){
	$get = $con->query("SELECT personal_id FROM personal_data WHERE emp_status='$empstatus' AND $column = '$dept'");
	$rows=$get->num_rows;
	return $rows;
}

function searchEngine($con, $keyword){
	$key1=mysqli_real_escape_string($con,$keyword);
	$x=1;
	$keyarray = explode(" ", $key1);
 	foreach($keyarray AS $key){
	$results=array();
	
		$getAI= $con->query("SELECT personal_id FROM additional_info WHERE tin LIKE '%$key%' OR sss LIKE '%$key%' OR philhealth LIKE '%$key%' OR pagibig LIKE '%$key%' OR height LIKE '%$key%' OR weight LIKE '%$key%' OR dialect LIKE '%$key%' OR drivers_license LIKE '%$key%' OR date_issued_licensed_number LIKE '%$key%' OR special_skills LIKE '%$key%' OR illness LIKE '%$key%' OR own_bus LIKE '%$key%' OR nature_bus LIKE '%$key%'");
		$rowsAI=$getAI->num_rows;
		if($rowsAI!=0){
			while($fetchAI = $getAI->fetch_array()){
				$results[]=$fetchAI['personal_id'];
			}
		}

		$getCR= $con->query("SELECT personal_id FROM character_reference WHERE c_name LIKE '%$key%' OR c_employer LIKE '%$key%' OR c_position LIKE '%$key%' OR c_relationship LIKE '%$key%' OR c_contact_no LIKE '%$key%'");
		$rowsCR=$getCR->num_rows;
		if($rowsCR!=0){
			while($fetchCR = $getCR->fetch_array()){
				$results[]=$fetchCR['personal_id'];
			}
		}

		$getCH= $con->query("SELECT personal_id FROM children WHERE child_name LIKE '%$key%' OR child_bday LIKE '%$key%'");
		$rowsCH=$getCH->num_rows;
		if($rowsCH!=0){
			while($fetchCH = $getCH->fetch_array()){
				$results[]=$fetchCH['personal_id'];
			}
		}

		$getEB= $con->query("SELECT personal_id FROM educational_background WHERE college LIKE '%$key%' OR course LIKE '%$key%' OR ed_from LIKE '%$key%' OR ed_to LIKE '%$key%' OR date_graduated LIKE '%$key%' OR highschool LIKE '%$key%' OR h_course LIKE '%$key%' OR h_from LIKE '%$key%' OR h_to LIKE '%$key%' OR h_date_graduated LIKE '%$key%' OR elementary LIKE '%$key%' OR e_course LIKE '%$key%' OR e_from LIKE '%$key%' OR e_to LIKE '%$key%' OR e_date_graduated LIKE '%$key%' OR post_grad LIKE '%$key%' OR p_course LIKE '%$key%' OR p_from LIKE '%$key%' OR p_to LIKE '%$key%' OR p_date_graduated LIKE '%$key%'");
		$rowsEB=$getEB->num_rows;
		if($rowsEB!=0){
			while($fetchEB = $getEB->fetch_array()){
				$results[]=$fetchEB['personal_id'];
			}
		}

		$getEH= $con->query("SELECT personal_id FROM employment_history WHERE name_address_employer LIKE '%$key%' OR em_position LIKE '%$key%' OR em_from LIKE '%$key%' OR em_to LIKE '%$key%' OR em_remarks LIKE '%$key%'");
		$rowsEH=$getEH->num_rows;
		if($rowsEH!=0){
			while($fetchEH = $getEH->fetch_array()){
				$results[]=$fetchEH['personal_id'];
			}
		}

		$getEvH= $con->query("SELECT personal_id FROM evaluation_history WHERE eval_date LIKE '%$key%' OR score LIKE '%$key%' OR eval_type LIKE '%$key%'");
		$rowsEvH=$getEvH->num_rows;
		if($rowsEvH!=0){
			while($fetchEvH = $getEvH->fetch_array()){
				$results[]=$fetchEvH['personal_id'];
			}
		}

		$getFB= $con->query("SELECT personal_id FROM family_background WHERE father_name LIKE '%$key%' OR occupation LIKE '%$key%' OR mother_name LIKE '%$key%' OR m_occupation LIKE '%$key%' OR name_spouse LIKE '%$key%' OR n_occupation LIKE '%$key%' OR employers_name_address LIKE '%$key%'");
		$rowsFB=$getFB->num_rows;
		if($rowsFB!=0){
			while($fetchFB = $getFB->fetch_array()){
				$results[]=$fetchFB['personal_id'];
			}
		}

		$getPD= $con->query("SELECT pd.personal_id FROM personal_data pd INNER JOIN cities c ON c.id = pd.pre_city INNER JOIN provinces p ON p.id = pd.pre_prov WHERE pd.lname LIKE '%$key%' OR pd.fname LIKE '%$key%' OR pd.mname LIKE '%$key%' OR pd.name_ext LIKE '%$key%' OR pd.sex LIKE '%$key%' OR pd.civil_status LIKE '%$key%' OR pd.permanent_address LIKE '%$key%' OR pd.provincial_address LIKE '%$key%' OR pd.place_birth LIKE '%$key%' OR pd.contact_no LIKE '%$key%' OR pd.nationality LIKE '%$key%' OR pd.religion LIKE '%$key%' OR pd.status LIKE '%$key%' OR pd.bio_num LIKE '%$key%' OR pd.emp_num LIKE '%$key%' OR pd.emp_status LIKE '%$key%' OR c.name LIKE '%$key%' OR p.name LIKE '%$key%'");
		$rowsPD=$getPD->num_rows;
		if($rowsPD!=0){
			while($fetchPD = $getPD->fetch_array()){
				$results[]=$fetchPD['personal_id'];
			}
		}

		$getPC= $con->query("SELECT personal_id FROM person_to_contact WHERE p_name LIKE '%$key%' OR p_relationship LIKE '%$key%' OR p_contact_no LIKE '%$key%' OR address LIKE '%$key%'");
		$rowsPC=$getPC->num_rows;
		if($rowsPC!=0){
			while($fetchPC = $getPC->fetch_array()){
				$results[]=$fetchPC['personal_id'];
			}
		}

		$getPos= $con->query("SELECT personal_id FROM position WHERE position_applied LIKE '%$key%'");
		$rowsPos=$getPos->num_rows;
		if($rowsPos!=0){
			while($fetchPos = $getPos->fetch_array()){
				$results[]=$fetchPos['personal_id'];
			}
		}

		$getSib= $con->query("SELECT personal_id FROM siblings WHERE siblings_name LIKE '%$key%' OR siblings_occupation LIKE '%$key%' OR emp_na_add LIKE '%$key%'");
		$rowsSib=$getSib->num_rows;
		if($rowsSib!=0){
			while($fetchSib = $getSib->fetch_array()){
				$results[]=$fetchSib['personal_id'];
			}
		}

	
		$res[]=$results;

	}
	$ct= count($res);
	//echo $ct;
	if($ct==1){
		return array_unique($res[0]);
	} else if($ct==2){
		return array_intersect(array_unique($res[0]), array_unique($res[1]));
	} else if($ct==3){
		return array_intersect(array_unique($res[0]), array_unique($res[1]), array_unique($res[2]));
	} else if($ct==4){
		return array_intersect(array_unique($res[0]), array_unique($res[1]), array_unique($res[2]), array_unique($res[3]));
	} else if($ct==5){
		return array_intersect(array_unique($res[0]), array_unique($res[1]), array_unique($res[2]), array_unique($res[3]), array_unique($res[4]));
	} else if($ct==6){
		return array_intersect(array_unique($res[0]), array_unique($res[1]), array_unique($res[2]), array_unique($res[3]), array_unique($res[4]), array_unique($res[5]));
	}

	
}

function employeeCount($con){
	$getEmp = $con->query("SELECT count(personal_id) as ct FROM personal_data");
	$fetchEmp = $getEmp->fetch_array();
	return $fetchEmp['ct'];
}

function getMaxEval($con){
	$select = $con->query("SELECT personal_id FROM evaluation_history");
	while($fetch=$select->fetch_array()){
		$ct[]=$fetch['personal_id'];
	}
	$vals=array_count_values($ct);
	$val=max($vals);
	return $val;
}

function getEvalData($con,$personal_id,$param){
	$get = $con->query("SELECT * FROM evaluation_history WHERE personal_id = '$personal_id' ORDER BY evalhist_id ASC");
	$rows=$get->num_rows;
	if($rows!=0){
	while($fetch = $get->fetch_array()){
		if($param=='score'){
			if(!empty($fetch['score'])) { $score = $fetch['score']; }
			else { $score =''; }
			$eval[]=$score;
		}

		if($param=='eval_date'){
			if(!empty($fetch['eval_date'])) { $eval_date = $fetch['eval_date']; }
			else { $eval_date =''; }
			$eval[]=$eval_date;
		}

		if($param=='adjustment'){
		if(!empty($fetch['adjustment'])) { $adjustment = $fetch['adjustment']; }
		else { $adjustment =''; }
			$eval[]=$adjustment;
		}

		if($param=='per_day'){
		if(!empty($fetch['per_day'])) { $per_day = $fetch['per_day']; }
		else { $per_day =''; }
			$eval[]=$per_day;
		}

		if($param=='effective_date'){
		if(!empty($fetch['effective_date'])) { $effective_date = $fetch['effective_date']; }
		else { $effective_date =''; }
			$eval[]=$effective_date;
		}
		
		}
	} else {
		if($param=='score'){
			$eval[]="";
		}

		if($param=='eval_date'){
			$eval[]="";
		}

		if($param=='adjustment'){
		$eval[]="";
		}

		if($param=='per_day'){
		$eval[]="";
		}

		if($param=='effective_date'){
		$eval[]="";
		}
		

	}

	return $eval;
}

function getEvalperUser($con, $personal_id){
	$get=$con->query("SELECT evalhist_id FROM evaluation_history WHERE personal_id = '$personal_id'");
	$rows = $get->num_rows;
	return $rows;
	//echo "SELECT eval_id FROM evaluation_history WHERE personal_id = '$personal_id'";
}

function dateDifference($date_1 , $date_2)
{
    $datetime2 = date_create($date_2);
	$datetime1 = date_create($date_1 );
	$interval = date_diff($datetime2, $datetime1);
   
    return $interval->format('%R%a');
   
}

function getDateEval($con, $date_hired, $days){
	$due = date('Y-m-d', strtotime($date_hired. ' + '.$days.' days'));
	return $due;
}

function computeAge($birthdate){
  $birthDate = explode("-", $birthdate);
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
    ? ((date("Y") - $birthDate[0]))
    : (date("Y") - $birthDate[0]));
  return $age;
}

/*function getCurrentPosition($con, $personal_id, $status){
	if($status == 'Active'){
		$getCurrent = $con->query("SELECT j_position FROM job_history WHERE personal_id = '$personal_id' ORDER BY effective_date DESC LIMIT 1");
		$fetchCurrent = $getCurrent->fetch_array();
		$position = $fetchCurrent['j_position'];
	} else if($status == 'Inactive'){
		$getApplied = $con->query("SELECT position_applied FROM position WHERE personal_id = '$personal_id'");
		$fetchApplied = $getApplied->fetch_array();
		$position = $fetchApplied['position_applied'];
	} else {
		$position='';
	}

	return $position;
}*/
function getCurrentApplied($con, $personal_id, $applied){
	if(!empty($applied)){
		$getApplied = $con->query("SELECT position_applied FROM position WHERE personal_id = '$personal_id'");
		$fetchApplied = $getApplied->fetch_array();
		$position = $fetchApplied['position_applied'];
	} 
	else {
		$position='';
	}

	return $position;
}

function getCurrentJob($con, $personal_id, $job){
	if(!empty($job)) {
		$getCurrent = $con->query("SELECT j_position FROM job_history WHERE personal_id = '$personal_id' ORDER BY effective_date DESC LIMIT 1");
		$fetchCurrent = $getCurrent->fetch_array();
		$position = $fetchCurrent['j_position'];
	}
	else {
		$position='';
	}
	return $position;
}

function getCurrentEnddate($con, $personal_id, $job){
	if(!empty($job)) {
		$getCurrent = $con->query("SELECT end_date FROM job_history WHERE personal_id = '$personal_id' ORDER BY effective_date DESC LIMIT 1");
		$fetchCurrent = $getCurrent->fetch_array();
		$end_date = $fetchCurrent['end_date'];
	}
	else {
		$end_date='';
	}
	return $end_date;
}

function getCurrentBu($con, $personal_id, $bu_id){
	if($bu_id!=0) {
		$getCurrent = $con->query("SELECT bu_id FROM job_history WHERE personal_id = '$personal_id' ORDER BY effective_date DESC LIMIT 1");
		$fetchCurrent = $getCurrent->fetch_array();
		$bu_name = $fetchCurrent['bu_id'];
	}
	else {
		$bu_name='';
	}
	return $bu_name;
}

function getCurrentSalary($con, $personal_id, $salary){
	if(!empty($salary)) {
		$getCurrent = $con->query("SELECT adjustment, per_day FROM evaluation_history WHERE personal_id = '$personal_id' ORDER BY effective_date DESC LIMIT 1");
		$fetchCurrent = $getCurrent->fetch_array();
		if($fetchCurrent['per_day']==''){
			$salary = $fetchCurrent['adjustment'];
		}else {
			$salary = $fetchCurrent['per_day'];
		}
	}
	else {
		$salary='';
	}
	return $salary;
}

function sanitize($string){
    $string = str_replace('Ã±', 'ñ', $string);
    return $string;
}
?>