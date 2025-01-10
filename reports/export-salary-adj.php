<?php 
    //include('header.php');
    include('../includes/connection.php');
    include('../includes/functions.php');
    require_once('../vendor\autoload.php');
    $today=date('Y-m-d');
    // require_once '../includes/phpexcel/Classes/PHPExcel/IOFactory.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writerxlsx;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerxlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as drawing; // Instead PHPExcel_Worksheet_Drawing
	use PhpOffice\PhpSpreadsheet\Style\Alignment as alignment; // Instead alignment
	use PhpOffice\PhpSpreadsheet\Style\Border as border;
	use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup as pagesetup; // Instead PHPExcel_Worksheet_PageSetup
	use PhpOffice\PhpSpreadsheet\IOFactory as io_factory; // Instead PHPExcel_IOFactory

    // $exportfilename="http://cenpripower.com/HRIS/humanresource/export/salary-adjustment-summary-".$today.".xlsx";
    $exportfilename="../../export/salary-adjustment-summary-".$today.".xlsx";
    // $file = "salary-adjustment-summary-".$today;
	// $objPHPExcel = new PHPExcel();
	$objPHPExcel = new Spreadsheet();
	$month=date('Y-m-d');
	$col_count = 'A';
	$row_count = 'H';
	$sheet_no = 0;
	if($_GET['filter_by'] == 'Department') { 
		$getFilter = $con->query("SELECT * FROM department ORDER by dept_name ASC");
		$sheet_name='sheet_name';
		$where_col = ' current_dept';
		$where_id = 'dept_id';
	}
	else if($_GET['filter_by'] == 'Business Unit') {
		$getFilter = $con->query("SELECT * FROM business_unit ORDER by bu_name ASC");
		$sheet_name='bu_name';
		$where_col = ' current_bu';
		$where_id = 'bu_id';

	} else if($_GET['filter_by'] == 'Location'){
		$getFilter = $con->query("SELECT * FROM location ORDER by location_name ASC");
		$sheet_name='location_name';
		$where_col = ' current_location';
		$where_id = 'location_id';
	}


	/*if(isset($_GET['bu_unit']))  $bu_unit=$_GET['bu_unit'];
    else $bu_unit="";
	$q = '';
   	if(!empty($bu_unit)){
   		$q .= " OR current_bu = '".$bu_unit."'";
   	}*/
	
	while($fetchFilter = $getFilter->fetch_array()){
			$objWorkSheet = $objPHPExcel->createSheet($sheet_no);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setTitle($fetchFilter[$sheet_name]);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("A1", "Salary Adjustment Summary");
			$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("A2", "Name of Employee");
			$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("B2", "Position");
			$objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("C2", "Profession");
			$objPHPExcel->getActiveSheet()->getStyle("C2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("D2", "License Number");
			$objPHPExcel->getActiveSheet()->getStyle("D2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("E2", "Date of Employment");
			$objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("F2", "Tenure");
			$objPHPExcel->getActiveSheet()->getStyle("F2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("G2", "Status");
			$objPHPExcel->getActiveSheet()->getStyle("G2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("H2", "Date of Regularization");
			$objPHPExcel->getActiveSheet()->getStyle("H2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("I2", "Entry Salary");
			$objPHPExcel->getActiveSheet()->getStyle("I2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("J2", "PE Result");
			$objPHPExcel->getActiveSheet()->getStyle("J2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("K2", "Date of PE");
			$objPHPExcel->getActiveSheet()->getStyle("K2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("L2", "Salary Adjustment");
			$objPHPExcel->getActiveSheet()->getStyle("L2")->getFont()->setBold(true);
			$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("M2", "Effective Date");
			$objPHPExcel->getActiveSheet()->getStyle("M2")->getFont()->setBold(true);

			$getPD=$con->query("SELECT personal_id, lname, fname, mname, name_ext,emp_status,date_hired FROM personal_data WHERE current_location != '3' AND status = 'Active' AND $where_col= '$fetchFilter[$where_id]' ORDER BY lname ASC");
				$row_count2='3';

				while($fetchPD=$getPD->fetch_array()){
					$sqlii = mysqli_query($con, "SELECT * FROM job_history WHERE personal_id = '$fetchPD[personal_id]' ORDER BY effective_date DESC LIMIT 1");
                    $rowww = mysqli_fetch_array($sqlii);
			       	$name = sanitize(utf8_encode($fetchPD['lname'].', '.$fetchPD['fname'].', '.$fetchPD['mname'].', '.$fetchPD['name_ext']));
			       	if(empty($rowww['j_position'])){
						$position = getPosition($con,$fetchPD['personal_id']);
			       	}else {
			       		$position = getCurrentJob($con,$fetchPD['personal_id'],$rowww['j_position']);
			       	}
					$date_hired = $fetchPD['date_hired'];
					$tenure = getTenure($con,$fetchPD['personal_id'],$month);
					$emp_status = $fetchPD['emp_status'];
					if($rowww['emp_status']=='Regular'){
						$date_reg = getDateReg($con,$fetchPD['personal_id']);
					}else {
						$date_reg = getDateReg_projbase($con,$fetchPD['personal_id']);
					}
					if($rowww['salary']!='0.00'){
						$entry_sal = getEntrySal($con,$fetchPD['personal_id']); 
					}else {
						$entry_sal = getEntrySal($con,$fetchPD['personal_id']); 
					}
					$profession = getInfo($con, "profession", "additional_info", "personal_id", $fetchPD['personal_id']);
					$license_no = getInfo($con, "license_no", "additional_info", "personal_id", $fetchPD['personal_id']);


					$count_eval=getEvalperUser($con, $fetchPD['personal_id']);


					if($count_eval == 1 || $count_eval==0){ 

							$score = getEvalData($con,$fetchPD['personal_id'],'score');
				            if(empty($score[0])) $score ="";
				            else $score=$score[0];

				            $eval_date = getEvalData($con,$fetchPD['personal_id'],'eval_date');
				            if(empty($eval_date[0])) $eval_date ="";
				            else $eval_date=$eval_date[0];

				            $adjustment = getEvalData($con,$fetchPD['personal_id'],'adjustment');
				            if(empty($adjustment[0])) $adjustment ="";
				            else $adjustment=number_format($adjustment[0],2);

				            $per_day = getEvalData($con,$fetchPD['personal_id'],'per_day');
				            if(empty($per_day[0])) $per_day ="";
				            else $per_day=number_format($per_day[0],2);

				            $effective_date = getEvalData($con,$fetchPD['personal_id'],'effective_date');
				            if(empty($effective_date[0])) $effective_date ="";
				            else $effective_date=$effective_date[0];
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("A".$row_count2, $name);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("B".$row_count2, $position);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("C".$row_count2, $profession);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("D".$row_count2, $license_no);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("E".$row_count2, date('M d Y', strtotime($date_hired)));
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("F".$row_count2, $tenure);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("G".$row_count2, $emp_status);
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("H".$row_count2, ($date_reg!='') ? date('M d Y', strtotime($date_reg)) : '');
						$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("I".$row_count2, $entry_sal);
				    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("J".$row_count2, $score);
				    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("K".$row_count2, ($eval_date!='' && $eval_date!='-') ? date('M Y',strtotime($eval_date)) : '');
				    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("L".$row_count2, (!empty($per_day)) ? $per_day : $adjustment);
				    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("M".$row_count2, (!empty($effective_date)) ? date('M d Y', strtotime($effective_date)) : '');
				    	
				 	} else if($count_eval>1){
				 		for($a=0;$a<$count_eval;$a++){

				 			$score = getEvalData($con,$fetchPD['personal_id'],'score');
				            if(empty($score[$a])) $score ="";
				            else $score=$score[$a];

				            $eval_date = getEvalData($con,$fetchPD['personal_id'],'eval_date');
				            if(empty($eval_date[$a])) $eval_date ="";
				            else $eval_date=$eval_date[$a];

				            $adjustment = getEvalData($con,$fetchPD['personal_id'],'adjustment');
				            if(empty($adjustment[$a])) $adjustment ="";
				            else $adjustment=number_format($adjustment[$a],2);

				            $per_day = getEvalData($con,$fetchPD['personal_id'],'per_day');
				            if(empty($per_day[$a])) $per_day ="";
				            else $per_day=number_format($per_day[$a],2);

				            $effective_date =getEvalData($con,$fetchPD['personal_id'],'effective_date');
				            if(empty($effective_date[$a])) $effective_date ="";
				            else $effective_date=$effective_date[$a];

				 			if($a==0){
				 				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("A".$row_count2, $name);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("B".$row_count2, $position);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("C".$row_count2, $profession);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("D".$row_count2, $license_no);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("E".$row_count2, date('M d Y', strtotime($date_hired)));
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("F".$row_count2, $tenure);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("G".$row_count2, $emp_status);
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("H".$row_count2, ($date_reg!='') ? date('M d Y', strtotime($date_reg)) : '');
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("I".$row_count2, $entry_sal);
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("J".$row_count2, $score);
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("K".$row_count2, ($eval_date!='' && $eval_date!='-') ? date('M Y',strtotime($eval_date)) : '');
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("L".$row_count2, ($per_day!=0) ? $per_day : $adjustment);
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("M".$row_count2, (!empty($effective_date)) ? date('M d Y', strtotime($effective_date)) : '');

				 			} else {
				 				$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("A".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("B".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("C".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("D".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("E".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("F".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("G".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("H".$row_count2, "");
								$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("I".$row_count2, "");
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("J".$row_count2, $score);
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("K".$row_count2, ($eval_date!='' && $eval_date!='-') ? date('M Y', strtotime($eval_date)) : '');
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("L".$row_count2, ($per_day!=0) ? $per_day : $adjustment);
						    	$objPHPExcel->setActiveSheetIndex($sheet_no)->setCellValue("M".$row_count2, (!empty($effective_date)) ? date('M d Y', strtotime($effective_date)) : '');
				 			}
				 			$row_count2++;
				 		}
				 	}
				 	$row_count2++;
				 	
				}

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$col_count.'1')->getFont()->setBold(true);
		$sheet_no++;
	}

	// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	// ob_end_clean();
    // // We'll be outputting an excel file
    // header('Content-type: application/vnd.ms-excel');
    // header('Content-Disposition: attachment; filename="salary-adjustment-'.$today.'.xlsx"');
    // $objWriter->save('php://output');
	/*if (file_exists($exportfilename))
			unlink($exportfilename);
			$objWriter->save('php://output');
	unset($objPHPExcel);
	unset($objWriter);   
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="salary-adjustment-'.$today.'.xlsx');
	readfile($exportfilename);*/

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="salary-adjustment-'.$today.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = io_factory::createWriter($objPHPExcel, 'Xlsx');
    ob_get_clean();
    $objWriter->save('php://output');
?>