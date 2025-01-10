<?php
	include('../includes/connection.php'); 
    include('../includes/functions.php');
	$employee_name = $_POST['employee_name'];
    $query1=mysqli_query($con,"SELECT * FROM personal_data WHERE personal_id = '$employee_name'");
	$row=mysqli_fetch_array($query1); 
	$sss = getInfo($con, 'sss', 'additional_info', 'personal_id', $row['personal_id']);
	$philhealth = getInfo($con, 'philhealth', 'additional_info', 'personal_id', $row['personal_id']);
	$pagibig = getInfo($con, 'pagibig', 'additional_info', 'personal_id', $row['personal_id']);
	$tin = getInfo($con, 'tin', 'additional_info', 'personal_id', $row['personal_id']);
	//$designation = getPosition($con,$row['personal_id']);
	//$end_contract = getInfo($con, 'end_date', 'job_history', 'personal_id', $row['personal_id']);
	$job_history = getInfo($con, 'j_position', 'job_history', 'personal_id',$row['personal_id']);
	$designation = getCurrentJob($con, $row['personal_id'], $job_history);
	$end_contract = getCurrentEnddate($con, $row['personal_id'], $job_history);
	$corporate_name = getInfo($con, 'bu_name', 'business_unit', 'bu_id', $row['applied_company']);
	if($row['emp_status']=='Regular'){
		$date_reg=date("F d, Y",strtotime(getDateReg($con,$row['personal_id'])));
	}else{
		$date_reg='';
	}
	$salary_current = getInfo($con, 'salary', 'job_history', 'personal_id', $row['personal_id']);
	$salary=getCurrentSalary($con,$row['personal_id'],$salary_current);
	$department = getInfo($con, 'dept_name', 'department', 'dept_id', $row['current_dept']);
	$allowance = getInfo($con, 'amount', 'allowance', 'personal_id', $row['personal_id']);
	
	//$current_sup = getAmendmentSupInfo($con, 'current_sup', 'amendment', 'personal_id', $row['personal_id']);

	//if($current_sup != 0){
		//$fname=getInfo($con, 'fname', 'personal_data', 'personal_id', $current_sup);
		//$lname=getInfo($con, 'lname', 'personal_data', 'personal_id', $current_sup);
		// $current_supervisor=getAmendmentSupInfo($con, 'current_sup', 'amendment', 'personal_id', $row['personal_id']);
		// $sup_designation=getCurrentJob($con, $current_sup, $job_history);
	//}else{
		// $fname=getInfo($con, 'fname', 'personal_data', 'personal_id', $row['current_supervisor']);
		// $lname=getInfo($con, 'lname', 'personal_data', 'personal_id', $row['current_supervisor']);
		$current_supervisor=$row['current_supervisor'];
		$sup_designation=getCurrentJob($con, $row['current_supervisor'], $job_history);
	//}
	

	//$gen_man=getInfo($con, 'personal_id', 'personal_data', 'personal_id', '160');
	//$exec_dir=getInfo($con, 'personal_id', 'personal_data', 'personal_id', '162');
	//$sql=mysqli_query($con,"SELECT * FROM personal_data WHERE current_dept!=0 AND ((fname LIKE '%Eric%' AND lname LIKE '%Jabiniar%') OR (fname LIKE '%Merry Michelle%' AND lname LIKE '%Dato%') OR personal_id='$current_supervisor') ORDER BY lname ASC");
	$sql=mysqli_query($con,"SELECT * FROM personal_data WHERE status='Active' ORDER BY lname ASC");
	$options = "<option value=''>NONE</option>";
	while($rows=mysqli_fetch_array($sql)){
		$fullname = sanitize(strtoupper($rows['fname'].' '.substr($rows['mname'], 0, 1).'. '.$rows['lname'].' '.$rows['name_ext']));
		$options .= "<option value='".$rows['personal_id']."' ".(($rows['personal_id']==$current_supervisor)? 'selected' : '').">".$fullname."</option>";
	}

    $return = array('bday' => date("F d, Y",strtotime($row['bdate'])), 'civil_status' => $row['civil_status'], 'date_hired' => (!empty($row['date_hired'])) ? date("F d, Y",strtotime($row['date_hired'])) : '', 'corporate_name' => $corporate_name, 'sss' => $sss, 'philhealth' => $philhealth, 'pagibig' => $pagibig,'tin' => $tin, 'designation' => $designation,'end_contract' => $end_contract, 'date_reg' => $date_reg, 'department' => $department, 'salary' => $salary, 'allowance' => $allowance, 'emp_status' => $row['emp_status'], 'current_supid' =>  $current_supervisor, 'sup_designation' => strtoupper($sup_designation), 'options'=>$options); 
    echo json_encode($return);
?>