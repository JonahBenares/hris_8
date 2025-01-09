<?php
	include '../includes/connection.php';
	include('../includes/functions.php');
    require_once('../includes/phpexcel/Classes/PHPExcel/IOFactory.php');
    $exportfilename="http://cenpripower.com/HRIS/humanresource/export/employeelist-report.xlsx";
    $file = "employeelist-report";
    $objPHPExcel = new PHPExcel();
	$keyword = $_GET['keyword'];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Employee List Report");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Fullname");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Designation");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Department");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', "Business Unit");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', "Employee Status");
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', "Remarks");

    if($keyword=='word'){
    	$filter = str_replace("%20"," ",$_GET['filter']);
    	$sql="";
    	if($filter!=''){
            $sql.=" pd.fname LIKE '%$filter%' OR";
            $sql.=" pd.lname LIKE '%$filter%' OR";
            $sql.=" pd.mname LIKE '%$filter%' OR";
            $sql.=" pd.name_ext LIKE '%$filter%' OR";
            $sql.=" pd.sex LIKE '%$filter%' OR";
            $sql.=" pd.civil_status LIKE '%$filter%' OR";
            $sql.=" pd.permanent_address LIKE '%$filter%' OR";
            $sql.=" pd.provincial_address LIKE '%$filter%' OR";
            $sql.=" pd.place_birth LIKE '%$filter%' OR";
            $sql.=" pd.contact_no LIKE '%$filter%' OR";
            $sql.=" pd.nationality LIKE '%$filter%' OR";
            $sql.=" pd.religion LIKE '%$filter%' OR";
            $sql.=" pd.status LIKE '%$filter%' OR";
            $sql.=" pd.bio_num LIKE '%$filter%' OR";
            $sql.=" pd.emp_num LIKE '%$filter%' OR";
            $sql.=" pd.emp_status LIKE '%$filter%' OR";
            $sql.=" c.name LIKE '%$filter%' OR";
            $sql.=" p.name LIKE '%$filter%' OR";
            $sql.=" fb.father_name LIKE '%$filter%' OR";
            $sql.=" fb.occupation LIKE '%$filter%' OR";
            $sql.=" fb.mother_name LIKE '%$filter%' OR";
            $sql.=" fb.m_occupation LIKE '%$filter%' OR";
            $sql.=" fb.name_spouse LIKE '%$filter%' OR";
            $sql.=" fb.n_occupation LIKE '%$filter%' OR";
            $sql.=" fb.employers_name_address LIKE '%$filter%' OR";
            $sql.=" eh.eval_date LIKE '%$filter%' OR";
            $sql.=" eh.score LIKE '%$filter%' OR";
            $sql.=" eh.eval_type LIKE '%$filter%' OR";
            $sql.=" emph.name_address_employer LIKE '%$filter%' OR";
            $sql.=" emph.em_position LIKE '%$filter%' OR";
            $sql.=" emph.em_from LIKE '%$filter%' OR";
            $sql.=" emph.em_to LIKE '%$filter%' OR";
            $sql.=" emph.em_remarks LIKE '%$filter%' OR";
            $sql.=" eb.college LIKE '%$filter%' OR";
            $sql.=" eb.course LIKE '%$filter%' OR";
            $sql.=" eb.ed_from LIKE '%$filter%' OR";
            $sql.=" eb.ed_to LIKE '%$filter%' OR";
            $sql.=" eb.date_graduated LIKE '%$filter%' OR";
            $sql.=" eb.highschool LIKE '%$filter%' OR";
            $sql.=" eb.h_course LIKE '%$filter%' OR";
            $sql.=" eb.h_from LIKE '%$filter%' OR";
            $sql.=" eb.h_to LIKE '%$filter%' OR";
            $sql.=" eb.h_date_graduated LIKE '%$filter%' OR";
            $sql.=" eb.elementary LIKE '%$filter%' OR";
            $sql.=" eb.e_course LIKE '%$filter%' OR";
            $sql.=" eb.e_from LIKE '%$filter%' OR";
            $sql.=" eb.e_to LIKE '%$filter%' OR";
            $sql.=" eb.e_date_graduated LIKE '%$filter%' OR";
            $sql.=" eb.post_grad LIKE '%$filter%' OR";
            $sql.=" eb.p_course LIKE '%$filter%' OR";
            $sql.=" eb.p_from LIKE '%$filter%' OR";
            $sql.=" eb.p_to LIKE '%$filter%' OR";
            $sql.=" eb.p_date_graduated LIKE '%$filter%' OR";
            $sql.=" ch.child_name LIKE '%$filter%' OR";
            $sql.=" ch.child_bday LIKE '%$filter%' OR";
            $sql.=" cr.c_name LIKE '%$filter%' OR";
            $sql.=" cr.c_employer LIKE '%$filter%' OR";
            $sql.=" cr.c_position LIKE '%$filter%' OR";
            $sql.=" cr.c_relationship LIKE '%$filter%' OR";
            $sql.=" cr.c_contact_no LIKE '%$filter%' OR";
            $sql.=" ai.tin LIKE '%$filter%' OR";
            $sql.=" ai.sss LIKE '%$filter%' OR";
            $sql.=" ai.philhealth LIKE '%$filter%' OR";
            $sql.=" ai.pagibig LIKE '%$filter%' OR";
            $sql.=" ai.height LIKE '%$filter%' OR";
            $sql.=" ai.weight LIKE '%$filter%' OR";
            $sql.=" ai.dialect LIKE '%$filter%' OR";
            $sql.=" ai.drivers_license LIKE '%$filter%' OR";
            $sql.=" ai.date_issued_licensed_number LIKE '%$filter%' OR";
            $sql.=" ai.special_skills LIKE '%$filter%' OR";
            $sql.=" ai.illness LIKE '%$filter%' OR";
            $sql.=" ai.own_bus LIKE '%$filter%' OR";
            $sql.=" ai.nature_bus LIKE '%$filter%' OR";
            $sql.=" ptc.p_name LIKE '%$filter%' OR";
            $sql.=" ptc.p_relationship LIKE '%$filter%' OR";
            $sql.=" ptc.p_contact_no LIKE '%$filter%' OR";
            $sql.=" ptc.address LIKE '%$filter%' OR";
            $sql.=" po.position_applied LIKE '%$filter%' OR";
            $sql.=" si.siblings_name LIKE '%$filter%' OR";
            $sql.=" si.siblings_occupation LIKE '%$filter%' OR";
            $sql.=" si.emp_na_add LIKE '%$filter%' OR";
        }

        $query=substr($sql,0,-3);
    	$getPD= $con->query("SELECT * FROM personal_data pd INNER JOIN cities c ON c.id = pd.pre_city INNER JOIN provinces p ON p.id = pd.pre_prov LEFT JOIN family_background fb ON pd.personal_id = fb.personal_id LEFT JOIN evaluation_history eh ON pd.personal_id = eh.personal_id LEFT JOIN employment_history emph ON pd.personal_id = emph.personal_id LEFT JOIN educational_background eb ON pd.personal_id = eb.personal_id LEFT JOIN children ch ON pd.personal_id = ch.personal_id LEFT JOIN character_reference cr ON pd.personal_id = cr.personal_id LEFT JOIN additional_info ai ON pd.personal_id = ai.personal_id LEFT JOIN person_to_contact ptc ON pd.personal_id = ptc.personal_id LEFT JOIN position po ON pd.personal_id = po.personal_id LEFT JOIN siblings si ON pd.personal_id = si.personal_id WHERE ".$query." GROUP BY lname ORDER BY lname ASC");
    	$num = 3;
    	$styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        foreach(range('A','F') as $columnID){
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
		while($fetchPD = $getPD->fetch_array()){
			$fullname = sanitize(utf8_encode($fetchPD['lname'].' ,'.$fetchPD['fname'].' '.$fetchPD['name_ext'].' ,'.$fetchPD['mname']));
			$department1 = getInfo($con, 'dept_name', 'department', 'dept_id', $fetchPD['current_dept']);
			$location1 = getInfo($con, 'location_name', 'location', 'location_id', $fetchPD['current_location']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $fullname);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $fetchPD['position_applied']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $department1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $location1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $fetchPD['emp_status']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $fetchPD['remarks']);

			$objPHPExcel->getActiveSheet()->getStyle('A'.$num.':F'.$num)->applyFromArray($styleArray);
			$num++;
		}
    }else{
    	$fullname = str_replace("%20"," ",$_GET['fullname']);
		$position = str_replace("%20"," ",$_GET['position']);
		$gender = ($_GET['gender']!='') ? $_GET['gender'] : '';
		$department = ($_GET['department']!='') ? $_GET['department'] : '';
		$business_unit = ($_GET['business_unit']!='') ? $_GET[''] : '';
		$location = ($_GET['location']!='') ? $_GET['location'] : '';
		$age_from = ($_GET['age']!='') ? $_GET['age'] : '';
		$age_to = ($_GET['to']!='') ? $_GET['to'] : '';
		$salary_from = ($_GET['salary']!='') ? $_GET['salary'] : '';
		$salary_to = ($_GET['to']!='') ? $_GET['to'] : '';
		$bday_from = ($_GET['bday']!='') ? $_GET['bday'] : '';
		$bday_to = ($_GET['to']!='') ? $_GET['to'] : '';
		$applied_from = ($_GET['applied']!='') ? $_GET['applied'] : '';
		$applied_to = ($_GET['to']!='') ? $_GET['to'] : '';
		$available_from = ($_GET['available']!='') ? $_GET['available'] : '';
		$available_to = ($_GET['to']!='') ? $_GET['to'] : '';
		$status = ($_GET['status']!='') ? $_GET['status'] : '';
		$emp_status = ($_GET['emp_status']!='') ? $_GET['emp_status'] : '';
		$sql="";

		if($fullname!=''){
            $sql.= " CONCAT(pd.fname, ' ', pd.mname, ' ', pd.lname, ' ', pd.name_ext) LIKE '%$fullname%' AND";
        }

        if($position!='') {
			$sql .= " p.position_applied LIKE '%$position%' AND";
		}

		if($department != '') {
			$sql .= " pd.current_dept = '$department' AND";
		}

		if($business_unit != '') {
			$sql .= " pd.current_bu = '$business_unit' AND";
		}

		if($location != '') {
			$sql .= " pd.current_location = '$location' AND";
		}

		if($salary_from != '') {
			if(!empty($salary_to)){
				$sql .= " (p.expected_salary BETWEEN '$salary_from' AND '$salary_to') AND";
			} else {
				$sql .= " (p.expected_salary BETWEEN '$salary_from' AND '$salary_from') AND";
			}
		}

		if($bday_from != ''){
			$bdayfrom = date('Y-m-d', strtotime($bday_from));
			if(!empty($bday_to)){
				$bdayto= date('Y-m-d', strtotime($bday_to));
				$sql .= " (pd.bdate BETWEEN '$bdayfrom' AND '$bdayto') AND";
			} else {
				$sql .= " (pd.bdate BETWEEN '$bdayfrom' AND '$bdayfrom') AND";
			}
		}

		if($applied_from != ''){
			$appliedfrom = date('Y-m-d', strtotime($applied_from));
			if(!empty($applied_to)){
				$appliedto= date('Y-m-d', strtotime($applied_to));
				$sql .= " (p.date_applied BETWEEN '$appliedfrom' AND '$appliedto') AND";
			} else {
				$sql .= " (p.date_applied BETWEEN '$appliedfrom' AND '$appliedfrom') AND";
			}
		}

		if($available_from != ''){
			$availfrom = date('Y-m-d', strtotime($available_from));
			if(!empty($available_to)){
				$availto= date('Y-m-d', strtotime($available_to));
				$sql .= " (p.date_available BETWEEN '$availfrom' AND '$availto') AND";
			} else {
				$sql .= " (p.date_available BETWEEN '$availfrom' AND '$availfrom') AND";
			}
		}
		
		if($status != ''){
			$sql .= " pd.status = '$status' AND";
		}

		if($emp_status != ''){
			$sql .= " pd.emp_status = '$emp_status' AND";
		}

		if($gender != ''){
			$sql .= " pd.sex = '$gender' AND";
		}

		if($age_from != ''){
			if(!empty($age_to)){
				$sql .= " (pd.age BETWEEN '$age_from' AND '$age_to') AND";
			} else {
				$sql .= " (pd.age BETWEEN '$age_from' AND '$age_from') AND";
			}
		}

        $query=substr($sql,0,-3);

   /*     $getPD= $con->query("SELECT DISTINCT(pd.personal_id), pd.lname, pd.fname, pd.mname, pd.name_ext, pd.bdate, pd.contact_no, pd.permanent_address, pd.provincial_address, pd.place_birth, pd.emp_status, pd.contact_no, pd.email, pd.nationality, pd.religion, pd.status, p.position_applied, p.date_applied, pd.supervisor, pd.status, pd.current_location,pd.date_hired,pd.current_dept,pd.current_location,pd.current_bu FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id AND pd.supervisor='0' WHERE (".$query.")");*/

        $getPD= $con->query("SELECT DISTINCT(pd.personal_id), pd.lname, pd.fname, pd.mname, pd.name_ext, pd.bdate, pd.contact_no, pd.permanent_address, pd.provincial_address, pd.place_birth, pd.emp_status, pd.contact_no, pd.email, pd.nationality, pd.religion, pd.status, p.position_applied, p.date_applied, pd.supervisor, pd.status, pd.current_location,pd.date_hired,pd.current_dept,pd.current_location,pd.current_bu,pd.remarks FROM personal_data pd LEFT JOIN position p ON p.personal_id = pd.personal_id AND pd.supervisor='0' WHERE ".$query." ORDER BY lname ASC");

        $num = 3;
    	$styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        foreach(range('A','D') as $columnID){
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        while($fetchPD = $getPD->fetch_array()){

        	//$fullname = utf8_encode($fetchPD['lname'].' ,'.$fetchPD['fname'].' '.$fetchPD['name_ext'].' ,'.$fetchPD['mname']);

        	$fullname = sanitize(utf8_encode($fetchPD['lname'].' ,'.$fetchPD['fname'].' '.$fetchPD['name_ext'].' ,'.$fetchPD['mname']));

			$department1 = getInfo($con, 'dept_name', 'department', 'dept_id', $fetchPD['current_dept']);
			$location1 = getInfo($con, 'location_name', 'location', 'location_id', $fetchPD['current_location']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$num, $fullname);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$num, $fetchPD['position_applied']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$num, $department1);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$num, $location1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$num, $fetchPD['emp_status']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$num, $fetchPD['remarks']);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$num.':F'.$num)->applyFromArray($styleArray);
			$num++;
        }
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setName('Arial Black')->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	ob_end_clean();
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="employeelist-report.xlsx"');
    $objWriter->save('php://output');
	/*if (file_exists($exportfilename))
			unlink($exportfilename);
	$objWriter->save(dirname(__FILE__)."/export"."/".$file.".xlsx");
	unset($objPHPExcel);
	unset($objWriter);   
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="employeelist-report.xlsx"');
	readfile($exportfilename);*/
?>