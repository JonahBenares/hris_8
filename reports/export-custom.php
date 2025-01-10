<?php 
    //include('header.php');
    include('../includes/connection.php');
    include('../includes/functions.php');
    require_once('../vendor\autoload.php');
    // require_once('../includes/phpexcel/Classes/PHPExcel/IOFactory.php');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writerxlsx;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerxlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as drawing; // Instead PHPExcel_Worksheet_Drawing
	use PhpOffice\PhpSpreadsheet\Style\Alignment as alignment; // Instead alignment
	use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup as pagesetup; // Instead PHPExcel_Worksheet_PageSetup
	use PhpOffice\PhpSpreadsheet\IOFactory as io_factory; // Instead PHPExcel_IOFactory

    $exportfilename="../../export/custom-report.xlsx";
    // $exportfilename="https://cenpripower.com/humanresource/export/custom-report.xlsx";
    // $file = "custom-report";
    // $objPHPExcel = new PHPExcel();
    $objPHPExcel = new Spreadsheet();
    // $exportfilename="custom-report.xlsx";

    if(isset($_POST['pd'])) $pd=$_POST['pd'];
    else $pd="";

    if(isset($_POST['ai'])) $ai=$_POST['ai'];
    else $ai="";

    if(isset($_POST['fb']))  $fb=$_POST['fb'];
    else $fb="";

    if(isset($_POST['ot']))  $ot=$_POST['ot'];
    else $ot="";

    if(isset($_POST['empstatus']))  $empstatus=$_POST['empstatus'];
    else $empstatus="";

    if(isset($_POST['bu_unit']))  $bu_unit=$_POST['bu_unit'];
    else $bu_unit="";

    if(isset($_POST['location']))  $location=$_POST['location'];
    else $location="";

    if(isset($_POST['dept']))  $dept=$_POST['dept'];
    else $dept="";

    if(isset($_POST['pos_app']))  $pos_app=$_POST['pos_app'];
    else $pos_app="";

    $sheet_no=0;
    $col_count='A';
    $row_count='1';
    if(!empty($pd)){
    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Personal Data and Add info");
    	
    	foreach($pd AS $value){
    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", $value);
    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
    		$col_count++;
    	}
    }

    if(!empty($ai)){
    	foreach($ai AS $value){
    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", $value);
    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
    		$col_count++;
    	}
    }

    if(!empty($ot)){
    	foreach($ot AS $value){
    	 	if($value=='emer_contact'){
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Name(Emergency Contact)');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Relationship(Emergency Contact)');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Contact Number(Emergency Contact)');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Address(Emergency Contact)');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    	}
   		}
   	}

    if(!empty($fb)){
	    	foreach($fb AS $value){
	    	 	if($value=='father_info'){
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Fathers Name');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Fathers Birthdate');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Fathers Age');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Fathers Occupation');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    	}
		    	if($value=='mother_info'){
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Mothers Name');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Mothers Birthdate');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Mothers Age');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Mothers Occupation');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
	    		}
	    		if($value=='spouse_info'){
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Spouse Name');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Spouse Birthdate');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Spouse Age');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Spouse Occupation');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
		    		$col_count++;
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Spouse Employers Name and Address');
		    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		}
	   		 }
	   	}

   	$sql = 'WHERE';
   	if(!empty($empstatus)){
   		$sql .= " status = '$empstatus' AND";
   	}

   	if(!empty($bu_unit)){
        $sql.=" current_bu = '$bu_unit' AND";
    }

    if(!empty($location)){
        $sql.=" current_location = '$location' AND";
    }

    if(!empty($dept)){
        $sql.=" current_dept = '$dept' AND";
    }

    if(!empty($pos_app)){
        $sql.=" position_applied = '$pos_app' AND";
    }

   	/*else if(!empty($bu_unit)){
   		$q .= "WHERE current_bu = '".$bu_unit."'";
   	}else if(!empty($empstatus) && !empty($bu_unit)) {
   		$q .= "WHERE status = '".$empstatus."' OR current_bu = '".$bu_unit."'";
   	}

   	else if(!empty($location)) {
   		$q .= "WHERE current_location = '".$location."'";
   	}else if(!empty($empstatus) && !empty($location)) {
   		$q .= "WHERE status = '".$empstatus."' OR current_location = '".$location."'";
   	}

   	else if(!empty($dept)) {
   		$q .= "WHERE current_dept = '".$dept."'";
   	}else if(!empty($empstatus) && !empty($dept)) {
   		$q .= "WHERE status = '".$empstatus."' OR current_dept = '".$dept."'";
   	}*/
   	 if($sql == 'WHERE'){
   		 $q=substr($sql, 0, -5);
   	} else {
   		$q=substr($sql, 0, -3);
   }
//  echo "SELECT DISTINCT(pd.personal_id), pd.*, pos.*, ai.*, fb.*, pt.* FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id LEFT JOIN additional_info ai ON pd.personal_id = ai.personal_id LEFT JOIN family_background fb ON pd.personal_id = fb.personal_id LEFT JOIN person_to_contact pt ON pd.personal_id = pt.personal_id $q ORDER BY pd.lname ASC";
	$getPD=$con->query("SELECT DISTINCT(pd.personal_id), pd.*, pos.*, ai.*, fb.*, pt.* FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id LEFT JOIN additional_info ai ON pd.personal_id = ai.personal_id LEFT JOIN family_background fb ON pd.personal_id = fb.personal_id LEFT JOIN person_to_contact pt ON pd.personal_id = pt.personal_id $q ORDER BY pd.lname ASC");
	$col_count2='A';
	$row_count2='2';
	while($fetchPD=$getPD->fetch_assoc()){
		$job_history = getInfo($con, 'j_position', 'job_history', 'personal_id',$fetchPD['personal_id']);
		$per_day = getInfo($con, 'per_day', 'evaluation_history', 'personal_id',$fetchPD['personal_id']);
		if($per_day==''){
			$salary = getInfo($con, 'adjustment', 'evaluation_history', 'personal_id',$fetchPD['personal_id']);
		}else {
			$salary = getInfo($con, 'per_day', 'evaluation_history', 'personal_id',$fetchPD['personal_id']);
		}
    	if(!empty($pd)){
    		if($fetchPD['bdate']!='0000-00-00'){ 
    			$age = computeAge($fetchPD['bdate']); 
    		}else {
    			$age = '';
    		}
	    	foreach($pd AS $value){
    			$string = sanitize(utf8_encode($fetchPD['lname']. ", ". $fetchPD['fname']. " " . $fetchPD['mname'] . " " . $fetchPD['name_ext']));
	    		if($value=='fullname') $val= sanitize(utf8_encode($fetchPD['lname']. ", ". $fetchPD['fname']. " " . $fetchPD['mname'] . " " . $fetchPD['name_ext']));
	    		if($value=='position_applied') $val=$fetchPD['position_applied'];
	    		if($value=='expected_salary') $val=$fetchPD['sal_from'] . " - " . $fetchPD['sal_to'];
	    		if($value=='date_applied') $val=$fetchPD['date_applied'];
	    		if($value=='date_available') $val=$fetchPD['date_available'];
	    		if($value=='age') $val= $age; //$fetchPD['age'];
	    		if($value=='sex') $val=$fetchPD['sex'];
	    		if($value=='civil_status') $val=$fetchPD['civil_status'];
	    		if($value=='present_add') $val=$fetchPD['permanent_address']. ", " .getInfo($con, 'name', 'cities', 'id',$fetchPD['pre_city']) . ", " . getInfo($con, 'name', 'provinces', 'id',$fetchPD['pre_prov']);
	    		if($value=='permanent_add') $val=$fetchPD['provincial_address']. ", " .getInfo($con, 'name', 'cities', 'id',$fetchPD['perm_city']). ", " .getInfo($con, 'name', 'provinces', 'id',$fetchPD['perm_prov']);
	    		if($value=='birthday') $val=$fetchPD['bdate'];
	    		if($value=='birthplace') $val=$fetchPD['place_birth'];
	    		if($value=='contact_number') $val=$fetchPD['contact_no'];
	    		if($value=='nationality') $val=$fetchPD['nationality'];
	    		if($value=='religion') $val=$fetchPD['religion'];
	    		if($value=='email') $val=$fetchPD['email'];
	    		if($value=='status') $val=$fetchPD['status'];
	    		if($value=='emp_status') $val=$fetchPD['emp_status'];
	    		if($value=='bio_no') $val=$fetchPD['bio_num'];
	    		if($value=='emp_no') $val=$fetchPD['emp_num'];
	    		if($value=='date_hired') $val=$fetchPD['date_hired'];
	    		if($value=='date_separated') $val=$fetchPD['date_separated'];
	    		if($value=='business_unit') $val=getinfo($con,'bu_name','business_unit','bu_id',$fetchPD['current_bu']);
	    		if($value=='department') $val=getinfo($con,'dept_name','department','dept_id',$fetchPD['current_dept']);
	    		if($value=='location') $val=getinfo($con,'location_name','location','location_id',$fetchPD['current_location']);
	    		if($value=='position') $val=getCurrentJob($con, $fetchPD['personal_id'], $job_history);
	    		if($value=='salary') $val=getCurrentSalary($con, $fetchPD['personal_id'], $salary);
	    		//if($value=='remarks') $val=$fetchPD['remarks'];
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
	    		$col_count2++;
	    	}
		}

    	if(!empty($ai)){
	    	foreach($ai AS $value){
	    		if($value=='tin') $val=$fetchPD['tin'];
	    		if($value=='sss') $val=$fetchPD['sss'];
	    		if($value=='philhealth') $val=$fetchPD['philhealth'];
	    		if($value=='pagibig') $val=$fetchPD['pagibig'];
	    		if($value=='drivers_license') $val=$fetchPD['drivers_license'];
	    		if($value=='height') $val=$fetchPD['height'];
	    		if($value=='weight') $val=$fetchPD['weight'];
	    		if($value=='dialect') $val=$fetchPD['dialect'];
	    		if($value=='special_skills') $val=$fetchPD['special_skills'];
	    		if($value=='nature_bus') $val=$fetchPD['nature_bus'];
	    		if($value=='illness') $val=$fetchPD['illness'];
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
	    		$col_count2++;
	    	}
	    }

	    if(!empty($fb)){
	    	foreach($fb AS $value){
	    		if($value=='father_info') {
		    		$val=utf8_encode($fetchPD['father_name']);
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['fa_bday'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		if(!empty($fetchPD['fa_bday'])){
		    			$val=computeAge($fetchPD['fa_bday']);
		    		}else {
		    			$val=$fetchPD['fa_age'];
		    		}
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['occupation'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
	    		} 
	    		if($value=='mother_info') {
		    		$val=utf8_encode($fetchPD['mother_name']);
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['m_bday'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		if(!empty($fetchPD['m_bday'])){
		    			$val=computeAge($fetchPD['m_bday']);
		    		}else {
		    			$val=$fetchPD['m_age'];
		    		}
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['m_occupation'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
	    		} 
	    		if($value=='spouse_info') {
		    		$val=utf8_encode($fetchPD['name_spouse']);
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['n_bday'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		if(!empty($fetchPD['n_bday'])){
		    			$val=computeAge($fetchPD['n_bday']);
		    		}else {
		    			$val=$fetchPD['n_age'];
		    		}
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['n_occupation'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['employers_name_address'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
	    		} 
	    		
	    	}
	    }

	    if(!empty($ot)){
	    	foreach($ot AS $value){
	    		if($value=='emer_contact') {
		    		$val=utf8_encode($fetchPD['p_name']);
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['p_relationship'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['p_contact_no'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
		    		$val=$fetchPD['address'];
		    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count2.$row_count2, $val);
		    		$col_count2++;
	    		}  
	    	}
	    }
    	$col_count2='A';
		$row_count2++;
    }

	if(!empty($fb)){
		foreach($fb AS $value){
			if($value=='sibling_info') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Siblings Information");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Name');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Birthdate');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Age');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Occupation');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Employers Name and Address');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$row_count++;
			}	
		}
	}
	$col_count3='A';
	$row_count3='2';	
	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_assoc()){
		if(!empty($fb)){
	    	foreach($fb AS $value){
    			if($value=='sibling_info') {
    				$fullname = sanitize(utf8_encode($fetchName['lname'] . ", ".$fetchName['fname']. " " . $fetchName['mname'] . " " . $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count3.$row_count3)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count3.":E".$row_count3);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count3.":E".$row_count3)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count3++;
    				$getSib = $con->query("SELECT * FROM siblings WHERE personal_id = '$fetchName[personal_id]'");
    				while($fetchSib = $getSib->fetch_array()){
    					$val=utf8_encode($fetchSib['siblings_name']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $val);
			    		$col_count3++;
			    		$val=$fetchSib['siblings_bday'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $val);
			    		$col_count3++;
			    		if(!empty($fetchSib['siblings_bday'])){
			    			$val=computeAge($fetchSib['siblings_bday']);
			    		}else {
			    			$val=$fetchSib['siblings_age'];
			    		}
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $val);
			    		$col_count3++;
			    		$val=$fetchSib['siblings_occupation'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $val);
			    		$col_count3++;
			    		$val=$fetchSib['emp_na_add'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count3.$row_count3, $val);
			    		$col_count3++;

			    		$col_count3='A';
						$row_count3++;
    				}
				}
			}
		}
	}

    if(!empty($fb)){
		foreach($fb AS $value){
			if($value=='child_info') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Children Information");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Name');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Birthday');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
			}
		}
	}

    $col_count4='A';
	$row_count4='2';

	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_assoc()){
		if(!empty($fb)){
    		foreach($fb AS $value){
			if($value=='child_info') {
    				$fullname = sanitize(utf8_encode($fetchName['lname'] . ", ".$fetchName['fname']. " " . $fetchName['mname'] . " " .  $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count4.$row_count4, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count4.$row_count4)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count4.":B".$row_count4);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count4.":B".$row_count4)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count4++;
    				$getChild = $con->query("SELECT * FROM children WHERE personal_id = '$fetchName[personal_id]'");
    				while($fetchChild = $getChild->fetch_array()){
    					$val=sanitize(utf8_encode($fetchChild['child_name']));
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count4.$row_count4, $val);
			    		$col_count4++;
			    		$val=$fetchChild['child_bday'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count4.$row_count4, $val);
			    		$col_count4++;

			    		$col_count4='A';
						$row_count4++;
    				}
				}
			}
		}
	}

   	if(!empty($ot)){
		foreach($ot AS $value){
			if($value=='educ_bg') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Educational Background");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'College');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Course');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'From');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'To');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Date Graduated');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;

	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Highschool');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Course');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'From');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'To');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Date Graduated');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;

	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Elementary');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Course');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'From');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'To');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Date Graduated');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;

	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Post Graduate');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Course');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'From');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'To');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Date Graduated');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
			}
		}
	}
	$col_count5='A';
	$row_count5='2';
	//$getEduc = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getEduc = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchEduc = $getEduc->fetch_assoc()){
		if(!empty($ot)){
    		foreach($ot AS $value){
			if($value=='educ_bg') {
    				$fullname = sanitize(utf8_encode($fetchEduc['lname'] . ", ". $fetchEduc['fname']. " " . $fetchEduc['mname'] . " " . $fetchEduc['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count5.$row_count5)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count5.":T".$row_count5);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count5.":T".$row_count5)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count5++;
    				$getEd = $con->query("SELECT * FROM educational_background WHERE personal_id = '$fetchEduc[personal_id]'");
    				while($fetchEd = $getEd->fetch_array()){
    					$val=sanitize(utf8_encode($fetchEd['college']));
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['course'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['ed_from'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['ed_to'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['date_graduated'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;

			    		$val=utf8_encode($fetchEd['highschool']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['h_course'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['h_from'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['h_to'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['h_date_graduated'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;

			    		$val=utf8_encode($fetchEd['elementary']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['e_course'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['e_from'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['e_to'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['e_date_graduated'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;

			    		$val=utf8_encode($fetchEd['post_grad']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['p_course'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['p_from'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['p_to'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;
			    		$val=$fetchEd['p_date_graduated'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count5.$row_count5, $val);
			    		$col_count5++;

			    		$col_count5='A';
						$row_count5++;
    				}
				}
			}
		}
	}

    if(!empty($ot)){
		foreach($ot AS $value){
			if($value=='emp_hist') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Employment History");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Name/Address Of Employer');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Position');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'From');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'To');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Remarks');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
			}	
		}
	}

	$col_count6='A';
	$row_count6='2';
	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_array()){
		if(!empty($ot)){
    		foreach($ot AS $value){
    			if($value=='emp_hist') {
    				$fullname =  sanitize(utf8_encode($fetchName['lname'] . ", ". $fetchName['fname']. " " . $fetchName['mname'] . " " . $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count6.$row_count6)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count6.":D".$row_count6);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count6.":D".$row_count6)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count6++;
    				$getEmp = $con->query("SELECT * FROM employment_history WHERE personal_id = '$fetchName[personal_id]'");
    				while($fetchEmp = $getEmp->fetch_array()){
    					$val=$fetchEmp['name_address_employer'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $val);
			    		$col_count6++;
			    		$val=$fetchEmp['em_position'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $val);
			    		$col_count6++;
			    		$val=$fetchEmp['em_from'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $val);
			    		$col_count6++;
			    		$val=$fetchEmp['em_to'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $val);
			    		$col_count6++;
			    		$val=$fetchEmp['em_remarks'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count6.$row_count6, $val);
			    		$col_count6++;

			    		$col_count6='A';
						$row_count6++;
    				}
				}
			}
		}
	}

    if(!empty($ot)){
		foreach($ot AS $value){
			if($value=='char_ref') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Character Reference");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Name');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Employer');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Position');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Relationship');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Contact Number');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
			}	
		}
	}

	$col_count7='A';
	$row_count7='2';
	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_array()){
		if(!empty($ot)){
	    	foreach($ot AS $value){
	    		if($value=='char_ref') {
    				$fullname = sanitize(utf8_encode($fetchName['lname'] . ", " . $fetchName['fname']. " " . $fetchName['mname'] . " "  . $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count7.$row_count7)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count7.":E".$row_count7);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count7.":E".$row_count7)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count7++;
    				$getChar = $con->query("SELECT * FROM character_reference WHERE personal_id = '$fetchName[personal_id]'");
    				while($fetchChar = $getChar->fetch_array()){
    					$val=sanitize(utf8_encode($fetchChar['c_name']));
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $val);
			    		$col_count7++;
			    		$val=$fetchChar['c_employer'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $val);
			    		$col_count7++;
			    		$val=$fetchChar['c_position'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $val);
			    		$col_count7++;
			    		$val=$fetchChar['c_relationship'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $val);
			    		$col_count7++;
			    		$val=$fetchChar['c_contact_no'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count7.$row_count7, $val);
			    		$col_count7++;

			    		$col_count7='A';
						$row_count7++;
    				}
				}
			}
		}
	}

    if(!empty($ot)){
		foreach($ot AS $value){
			if($value=='job_hist') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Job History");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Effective Date');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Job Position');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Department');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Business Unit');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Location');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Salary');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Supervisor');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
			}	
		}
	}

	$col_count8='A';
	$row_count8='2';
	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_array()){
		if(!empty($ot)){
	    	foreach($ot AS $value){
	    		if($value=='job_hist') {
    				$fullname = sanitize(utf8_encode($fetchName['lname'] .", ". $fetchName['fname']. " " . $fetchName['mname'] . " " . $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count8.$row_count8)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count8.":G".$row_count8);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count8.":G".$row_count8)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count8++;
    				$getJob = $con->query("SELECT * FROM job_history WHERE personal_id = '$fetchName[personal_id]' ORDER BY effective_date DESC");
    				while($fetchJob = $getJob->fetch_array()){
    					$val=$fetchJob['effective_date'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=$fetchJob['j_position'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=getInfo($con, 'dept_name', 'department', 'dept_id',$fetchJob['department_id']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=getInfo($con, 'bu_name', 'business_unit', 'bu_id',$fetchJob['bu_id']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=getInfo($con, 'location_name', 'location', 'location_id',$fetchJob['location_id']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=$fetchJob['salary'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=getSupName($con,$fetchJob['supervisor']);
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;

			    		$col_count8='A';
						$row_count8++;
    				}
				}	
			}
		}
	}


    if(!empty($ot)){
		foreach($ot AS $value){
			if($value=='eval_hist') {
				$sheet_no++;
				$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
				$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle("Evaluation History");
		    	$col_count='A';
		    	$row_count='1';

		    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Evaluation Date');
		    	$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Score');
				$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);
	    		$col_count++;
	    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count."1", 'Evaluation Type');
	    		$objPHPExcel->getActiveSheet()->getStyle($col_count."1")->getFont()->setBold(true);	
			}
		}
	}

	$col_count8='A';
	$row_count8='2';
	//$getName = $con->query("SELECT personal_id, fname, mname, lname, name_ext FROM personal_data $q ORDER BY lname ASC");
	$getName = $con->query("SELECT * FROM personal_data pd LEFT JOIN position pos ON pd.personal_id = pos.personal_id $q ORDER BY lname ASC");
	while($fetchName = $getName->fetch_array()){
		if(!empty($ot)){
	    	foreach($ot AS $value){
	    		if($value=='eval_hist') {
    				$fullname =  sanitize(utf8_encode($fetchName['lname'] . ", ". $fetchName['fname']. " " . $fetchName['mname'] . " " . $fetchName['name_ext']));
    				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $fullname);
    				$objPHPExcel->getActiveSheet()->getStyle($col_count8.$row_count8)->getFont()->setBold(true);
    				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row_count8.":C".$row_count8);
    				$objPHPExcel->getActiveSheet()->getStyle('A'.$row_count8.":C".$row_count8)->getAlignment()->setHorizontal(alignment::HORIZONTAL_CENTER);
    				$row_count8++;
    				$getEval = $con->query("SELECT * FROM evaluation_history WHERE personal_id = '$fetchName[personal_id]'");
    				while($fetchEval = $getEval->fetch_array()){
    					$val=date('M Y', strtotime($fetchEval['eval_date']));
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=$fetchEval['score'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		$col_count8++;
			    		$val=$fetchEval['eval_type'];
			    		$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue($col_count8.$row_count8, $val);
			    		
			    		$col_count8='A';
						$row_count8++;
    				}
				}	
			}
		}
	}
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$col_count.'1')->getFont()->setBold(true);
	// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// ob_end_clean();
    // // We'll be outputting an excel file
    // header('Content-type: application/vnd.ms-excel');
    // header('Content-Disposition: attachment; filename="custom-report.xls"');
    // $objWriter->save('php://output');
 		
 		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="custom-report.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = io_factory::createWriter($objPHPExcel, 'Xlsx');
        ob_get_clean();
        $objWriter->save('php://output');

	/*if (file_exists($exportfilename))
			unlink($exportfilename);
	$objWriter->save(dirname(__FILE__)."/export"."/".$file.".xlsx");
	unset($objPHPExcel);
	unset($objWriter);   
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="custom-report.xlsx"');
	readfile($exportfilename);*/
?>