<?php
error_reporting(0);
include'../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con,$value);
		mysqli_query($con,"UPDATE position SET position_applied = '$position_applied', sal_from = '$sal_from',sal_to = '$sal_to', date_applied = '$date_applied', date_available = '$date_available' WHERE personal_id = '$id'");

		mysqli_query($con,"UPDATE personal_data SET lname = '$lname',fname = '$fname',mname = '$mname',name_ext = '$name_ext', 
			sex = '$sex', civil_status = '$civil_status', permanent_address = '$permanent_address', 
			provincial_address = '$provincial_address',pre_city = '$pre_city',pre_prov = '$pre_prov',perm_city = '$perm_city',perm_prov = '$perm_prov', bdate = '$bdate', place_birth = '$place_birth', contact_no = '$contact_no', nationality = '$nationality', religion = '$religion', applied_company = '$company', emp_status = '$emp_status', status = '$status' WHERE personal_id = '$id'") or die(mysqli_error($con));

		mysqli_query($con,"UPDATE family_background SET father_name = '$father_name', fa_bday = '$fa_bday', occupation = '$occupation', mother_name = '$mother_name', m_bday = '$m_bday', m_occupation = '$m_occupation', name_spouse = '$name_spouse', n_bday = '$n_bday', n_occupation = '$n_occupation', employers_name_address = '$employers_name_address' WHERE personal_id = '$id'");

		$sql = mysqli_query($con,"SELECT * FROM siblings WHERE personal_id = '$id'");
		$row = mysqli_num_rows($sql);
		$ctrx1 = count($siblings_name);
		if($row == $ctrx1){
			for($x=0; $x<$ctrx1;$x++){
				$sibname = $siblings_name[$x];
				$sibday = $siblings_bday[$x];
				$sibemp = $emp_na_add[$x];
				$siboccupation = $siblings_occupation[$x];
				$sibids = $siblings_id[$x];
				if(!empty($sibname)){
					mysqli_query($con,"UPDATE siblings SET siblings_name = '$sibname', siblings_bday = '$sibday', siblings_occupation = '$siboccupation', emp_na_add = '$sibemp' WHERE personal_id = '$id' AND siblings_id = '$sibids'");
				}
		    }
	    }else {
	    	for($x=0; $x<$ctrx1;$x++){
				$sibname = $siblings_name[$x];
				$sibday = $siblings_bday[$x];
				$sibemp = $emp_na_add[$x];
				$siboccupation = $siblings_occupation[$x];
				$sibids = $siblings_id[$x];
				if(!empty($sibname)){
					$select = mysqli_query($con,"SELECT siblings_id FROM siblings WHERE siblings_id = '$sibids'");
					$row1 = mysqli_num_rows($select);
					if($row1 > 0){
						mysqli_query($con,"UPDATE siblings SET siblings_name = '$sibname', siblings_bday = '$sibday', siblings_occupation = '$siboccupation', emp_na_add = '$sibemp' WHERE personal_id = '$id' AND siblings_id = '$sibids'");
					}else {
						mysqli_query($con,"INSERT INTO siblings (personal_id,siblings_name,siblings_bday,siblings_occupation,emp_na_add) VALUES('$id','$sibname','$sibday','$siboccupation','$sibemp')");
					}
				}
		    }
	    }

		$sql1 = mysqli_query($con,"SELECT * FROM children WHERE personal_id = '$id'");
		$row2 = mysqli_num_rows($sql1);
		$ctrx2 = count($child_name);
		if($row2 == $ctrx2){
			for($x1=0; $x1<$ctrx2;$x1++){
				$chiname = $child_name[$x1];
				$chibday = $child_bday[$x1];
				$chiids = $children_id[$x1];
				if(!empty($chiname)){
					mysqli_query($con,"UPDATE children SET child_name = '$chiname', child_bday = '$chibday' WHERE personal_id = '$id' AND children_id = '$chiids'");
				}
		    }
	    }else {
	    	for($x1=0; $x1<$ctrx2;$x1++){
				$chiname = $child_name[$x1];
				$chibday = $child_bday[$x1];
				$chiids = $children_id[$x1];
				if(!empty($chiname)){
					$select1 = mysqli_query($con,"SELECT children_id FROM children WHERE children_id = '$chiids'");
					$row3 = mysqli_num_rows($select1);
					if($row3 > 0){
						mysqli_query($con,"UPDATE children SET child_name = '$chiname', child_bday = '$chibday' WHERE personal_id = '$id' AND children_id = '$chiids'");
					}else {
						mysqli_query($con,"INSERT INTO children (personal_id,child_name,child_bday) VALUES('$id','$chiname','$chibday')");
					}
				}
		    }
	    }

	    mysqli_query($con,"UPDATE educational_background SET college = '$college', course = '$course', ed_from = '$ed_from', ed_to = '$ed_to', date_graduated = '$date_graduated', highschool = '$highschool', h_course = '$h_course', h_from = '$h_from', h_to = '$h_to', h_date_graduated = '$h_date_graduated', elementary = '$elementary', e_course = '$e_course', e_from = '$e_from', e_to = '$e_to', e_date_graduated = '$e_date_graduated', post_grad = '$post_grad', p_course = '$p_course', p_from = '$p_from', p_to = '$p_to', p_date_graduated = '$p_date_graduated' WHERE personal_id = '$id'");

		$sql2 = mysqli_query($con,"SELECT * FROM employment_history WHERE personal_id = '$id'");
		$row4 = mysqli_num_rows($sql2);
		$ctrx3 = count($name_address_employer);
		if($row4 == $ctrx3){
			for($x3=0; $x3<$ctrx3;$x3++){
				$empname = $name_address_employer[$x3];
				$emppos = $em_position[$x3];
				$empfrom = $em_from[$x3];
				$empto = $em_to[$x3];
				$emprem = $em_remarks[$x3];
				$emid = $employment_id[$x3];
				if(!empty($empname)){
					mysqli_query($con,"UPDATE employment_history SET name_address_employer = '$empname', em_position = '$emppos', em_from = '$empfrom', em_to = '$empto', em_remarks = '$emprem' WHERE personal_id = '$id' AND employment_id = '$emid'");
				}
		    }
	    }else {
	    	for($x3=0; $x3<$ctrx3;$x3++){
				$empname = $name_address_employer[$x3];
				$emppos = $em_position[$x3];
				$empfrom = $em_from[$x3];
				$empto = $em_to[$x3];
				$emprem = $em_remarks[$x3];
				$emid = $employment_id[$x3];
				if(!empty($empname)){
					$select2 = mysqli_query($con,"SELECT employment_id FROM employment_history WHERE employment_id = '$emid'");
					$row5 = mysqli_num_rows($select2);
					if($row5 > 0){
						mysqli_query($con,"UPDATE employment_history SET name_address_employer = '$empname', em_position = '$emppos', em_from = '$empfrom', em_to = '$empto', em_remarks = '$emprem' WHERE personal_id = '$id' AND employment_id = '$emid'");
					}else {
						 mysqli_query($con,"INSERT INTO employment_history (personal_id,name_address_employer,em_position,em_from,em_to,em_remarks) 	VALUES('$id','$empname','$emppos','$empfrom','$empto','$emprem')");
					}
				}
		    }
	    }

	    $sql_add = mysqli_query($con,"SELECT * FROM additional_info WHERE personal_id = '$id'");
		$rowadd = mysqli_num_rows($sql_add);
		if($rowadd>0){
	    	mysqli_query($con,"UPDATE additional_info SET tin = '$tin', sss = '$sss', philhealth = '$philhealth', pagibig = '$pagibig', height = '$height', weight = '$weight', dialect = '$dialect', drivers_license = '$drivers_license', date_issued_licensed_number = '$date_issued_licensed_number', special_skills = '$special_skills', illness = '$illness', own_bus = '$own_bus', nature_bus = '$nature_bus', profession = '$profession', license_no = '$license_no' WHERE personal_id = '$id'");
		}else{
			mysqli_query($con,"INSERT INTO additional_info (personal_id,tin,sss,philhealth,pagibig,height,weight,dialect,drivers_license,date_issued_licensed_number,special_skills,illness,own_bus,nature_bus,profession,license_no) VALUES('$id','$tin','$sss','$philhealth','$pagibig','$height','$weight','$dialect','$drivers_license','$date_issued_licensed_number','$special_skills','$illness','$own_bus','$nature_bus','$profession','$license_no')");
		}

		$sql3 = mysqli_query($con,"SELECT * FROM character_reference WHERE personal_id = '$id'");
		$row6 = mysqli_num_rows($sql3);
		$ctrx4 = count($c_name);
		if($row6 == $ctrx4){
			for($x2=0; $x2<$ctrx4;$x2++){
				$charname = $c_name[$x2];
				$charemp = $c_employer[$x2];
				$charpos = $c_position[$x2];
				$charrel = $c_relationship[$x2];
				$charcon = $c_contact_no[$x2];
				$charids = $character_id[$x2];
				if(!empty($charname)){
					mysqli_query($con,"UPDATE character_reference SET c_name = '$charname', c_employer = '$charemp', c_position = '$charpos', c_relationship = '$charrel', c_contact_no = '$charcon' WHERE personal_id = '$id' AND character_id = '$charids'");
				}
		    }
	    }else {
	    	for($x2=0; $x2<$ctrx4;$x2++){
				$charname = $c_name[$x2];
				$charemp = $c_employer[$x2];
				$charpos = $c_position[$x2];
				$charrel = $c_relationship[$x2];
				$charcon = $c_contact_no[$x2];
				$charids = $character_id[$x2];
				if(!empty($charname)){
					$select3 = mysqli_query($con,"SELECT character_id FROM character_reference WHERE character_id = '$charids'");
					$row7 = mysqli_num_rows($select3);
					if($row7 > 0){
						mysqli_query($con,"UPDATE character_reference SET c_name = '$charname', c_employer = '$charemp', c_position = '$charpos', c_relationship = '$charrel', c_contact_no = '$charcon' WHERE personal_id = '$id' AND character_id = '$charids'");
					}else {
						mysqli_query($con,"INSERT INTO character_reference (personal_id,c_name,c_employer,c_position,c_relationship,c_contact_no) VALUES('$id','$charname','$charemp','$charpos','$charrel','$charcon')");
					}
				}
		    }
	    }
	    mysqli_query($con,"UPDATE person_to_contact SET p_name = '$p_name', p_relationship = '$p_relationship', p_contact_no = '$p_contact_no', address = '$address' WHERE personal_id = '$id'");		
?>