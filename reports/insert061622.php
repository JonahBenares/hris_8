<?php
	//error_reporting(0);
	include '../includes/connection.php';

	foreach($_POST as $var=>$value)
	$$var =  $value;
	$height_esc = mysqli_real_escape_string($con,$_POST['height']);
	$weight_esc = mysqli_real_escape_string($con,$_POST['weight']);
	$today = date('Y-m-d');
	$full_post=$fname . " " . $mname . " " . $lname;

	$getExisting=$con->query("SELECT lname, fname, mname FROM personal_data WHERE CONCAT(fname, ' ', mname, ' ', lname) = '$full_post' AND status = 'Active'");
	$rows_exist=$getExisting->num_rows;

	if($rows_exist==0){

	mysqli_query($con,"INSERT INTO personal_data(date_encoded, lname,fname,mname,name_ext,sex,civil_status,permanent_address,provincial_address,pre_city,pre_prov,perm_city,perm_prov,bdate,place_birth,contact_no,nationality,religion,status,emp_status,applied_company) VALUES ('$today','$lname','$fname','$mname','$name_ext','$sex','$civil_status','$permanent_address','$provincial_address','$pre_city','$pre_prov','$perm_city','$perm_prov','$bdate','$place_birth','$contact_no','$nationality','$religion','$status','$emp_status','$company')");

	$sql = mysqli_query($con, "SELECT personal_id FROM personal_data ORDER BY personal_id DESC LIMIT 1");
	$fetch = $sql->fetch_array();
	$personal_id = $fetch['personal_id'];	

	mysqli_query($con,"INSERT INTO position (personal_id, position_applied,sal_from,sal_to,date_applied,date_available) VALUES ('$personal_id', '$position_applied','$sal_from','$sal_to','$date_applied','$date_available')");

	
	mysqli_query($con,"INSERT INTO family_background (personal_id,father_name,fa_bday,occupation,mother_name,m_bday,m_occupation,name_spouse,n_bday,n_occupation,employers_name_address) VALUES('$personal_id','$father_name','$fa_bday','$occupation','$mother_name','$m_bday','$m_occupation','$name_spouse','$n_bday','$n_occupation','$employers_name_address')");


	$ctrx1 = count($siblings_name);
	for($x=0; $x<$ctrx1;$x++){
		$sibname = $siblings_name[$x];
		$sibday = $siblings_bday[$x];
		$sibemp = $siblings_employer[$x];
		$siboccupation = $siblings_occupation[$x];
		if(!empty($sibname)){
			mysqli_query($con,"INSERT INTO siblings (personal_id,siblings_name,siblings_occupation, emp_na_add,siblings_bday) VALUES('$personal_id','$sibname','$siboccupation','$sibemp','$sibday')");
		}
		
    }

    $ctrx2 = count($child_name);
    for($x1=0; $x1<$ctrx2;$x1++){
		$chiname = $child_name[$x1];
		$chibday = $child_bday[$x1];
		if(!empty($chiname)){
			mysqli_query($con,"INSERT INTO children (personal_id,child_name,child_bday) VALUES('$personal_id','$chiname','$chibday')");
		}

	}

	mysqli_query($con,"INSERT INTO educational_background (personal_id,college,course,ed_from,ed_to,date_graduated,highschool,h_course,h_from,h_to,h_date_graduated,elementary,e_course,e_from,e_to,e_date_graduated,post_grad,p_course,p_from,p_to,p_date_graduated) VALUES('$personal_id','$college','$course','$ed_from','$ed_to','$date_graduated','$highschool','$h_course','$h_from','$h_to','$h_date_graduated','$elementary','$e_course','$e_from','$e_to','$e_date_graduated','$post_grad','$p_course','$p_from','$p_to','$p_date_graduated')");

	$ctrx3 = count($name_address_employer);
	for($x3=0; $x3<$ctrx3;$x3++){
		$empname = $name_address_employer[$x3];
		$emppos = $em_position[$x3];
		$empfrom = $em_from[$x3];
		$empto = $em_to[$x3];
		$emprem = $em_remarks[$x3];
		if(!empty($empname)){
			mysqli_query($con,"INSERT INTO employment_history (personal_id,name_address_employer,em_position,em_from,em_to,em_remarks) VALUES('$personal_id','$empname','$emppos','$empfrom','$empto','$emprem')");
		}
	}	

		mysqli_query($con,"INSERT INTO additional_info (personal_id,tin,sss,philhealth,pagibig,height,weight,dialect,drivers_license,date_issued_licensed_number,special_skills,illness,own_bus,nature_bus,profession, license_no) VALUES ('$personal_id','$tin','$sss','$philhealth','$pagibig','$height_esc','$weight_esc','$dialect','$drivers_license','$date_issued_licensed_number','$special_skills','$illness','$own_bus','$nature_bus', '$profession', '$license_no')");

	$ctrx4 = count($c_name);
	for($x2=0; $x2<$ctrx4;$x2++){
		$charname = $c_name[$x2];
		$charemp = $c_employer[$x2];
		$charpos = $c_position[$x2];
		$charrel = $c_relationship[$x2];
		$charcon = $c_contact_no[$x2];
		if(!empty($charname)){
			mysqli_query($con,"INSERT INTO character_reference (personal_id,c_name,c_employer,c_position,c_relationship,c_contact_no) VALUES('$personal_id','$charname','$charemp','$charpos','$charrel','$charcon')");
		}
		
	}

	mysqli_query($con,"INSERT INTO person_to_contact (personal_id,p_name,p_relationship,p_contact_no,address) VALUES('$personal_id','$p_name','$p_relationship','$p_contact_no','$address')");

echo $personal_id;
} else {
	echo 'Error';
}
	/*if(preg_match("/image/", $_FILES['image']['type'])) {
		if(copy($_FILES['image']['tmp_name'], $image)) {
			$_SESSION['image'] = $image;
			mysqli_query($con, "INSERT INTO sketch (image,created) VALUES ('$image,'$created')");
		}
		else {
			echo "<script type='text/javascript'>alert('Please Only Upload GIF, JPG, PNG!');</script>";
		}
	}


	/*mysqli_query($con,"INSERT INTO sketch(image,created) VALUES('$image','$created')");*/


	/*echo "<script type='text/javascript'>alert('Successfully Fill Up!');</script>";
	echo "<script>document.location='home.php'</script>";*/
?>