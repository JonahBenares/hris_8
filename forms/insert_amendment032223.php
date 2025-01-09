<?php
	include '../includes/connection.php';
	foreach($_POST as $var=>$value)
	$$var = $value;
	$amend_id = $amendment_id;
	if($amend_id==''){
		$sql = mysqli_query($con,"SELECT * FROM amendment");
		$count_id = mysqli_num_rows($sql);
		if($count_id==0){
			$amendment_id=1;
		}else{
			$max = mysqli_query($con,"SELECT MAX(amendment_id) AS amend_id FROM amendment");
			$fetch = mysqli_fetch_array($max);
			$max_id =$fetch['amend_id'];
			$amendment_id=$max_id+1;
		}

		$count= count($_POST['change_name']);
		for($x=0; $x<$count;$x++){
			$change_name = $_POST['change_name'][$x];
			$change_from = $_POST['change_from'][$x];
			$change_to = $_POST['change_to'][$x];
			if(!empty($change_from) || !empty($change_to)){
				mysqli_query($con,"INSERT INTO amendment_details (amendment_id,change_name,change_from,change_to) VALUES('$amendment_id','$change_name','$change_from','$change_to')");
			}
		}

		if(!empty($_POST['change_namer'])){
			if(!isset($_POST['counterX1'])){
				$ctrx1 = $_POST['counter1'];
			} else {
				$ctrx1 = $_POST['counterX1'];
			}
			for($y=0; $y<$ctrx1;$y++){
				$change_name1 = $_POST['change_namer'][$y];
				$change_from1 = $_POST['change_frome'][$y];
				$change_to1 = $_POST['change_toe'][$y];
				if(!empty($change_from1) || !empty($change_to1)){
					mysqli_query($con,"INSERT INTO amendment_details (amendment_id, change_name,change_from,change_to) VALUES('$amendment_id','$change_name1','$change_from1','$change_to1')");
				}
		    }
	    }

	    $change_reason='';
		if(!empty($reason)){
			$reas='';
			foreach($reason AS $reasons){
				$reas .= $reasons .", ";
			}
			$change_reason=substr($reas, 0, -2);
		}
		$save_date=date("Y-m-d");
		mysqli_query($con,"INSERT INTO amendment (amendment_id,personal_id, date_prepared, date_effectivity, change_reason, remarks, dept_head,saved,save_date,saved_by) VALUES('$amendment_id','$employee_name','$date_prepared','$date_effectivity','$change_reason','$remarks','$current_supid','1','$save_date','$user_id')");
		echo $amendment_id;
	}else{
		$count= count($_POST['change_name']);
		for($x=0; $x<$count;$x++){
			$amend_det_id = $_POST['amendment_details_id'][$x];
			$change_name = $_POST['change_name'][$x];
			$change_from = $_POST['change_from'][$x];
			$change_to = $_POST['change_to'][$x];
			if(!empty($change_from) || !empty($change_to)){
				mysqli_query($con,"UPDATE amendment_details SET change_name='$change_name',change_from='$change_from',change_to='$change_to' WHERE amend_det_id='$amend_det_id'");
			}
		}

		if(!empty($_POST['change_namer'])){
			if(!isset($_POST['counterX1'])){
				$ctrx1 = $_POST['counter1'];
			} else {
				$ctrx1 = $_POST['counterX1'];
			}
			for($y=0; $y<$ctrx1;$y++){
				$change_name1 = $_POST['change_namer'][$y];
				$change_from1 = $_POST['change_frome'][$y];
				$change_to1 = $_POST['change_toe'][$y];
				if(!empty($change_from1) || !empty($change_to1)){
					mysqli_query($con,"INSERT INTO amendment_details (amendment_id, change_name,change_from,change_to) VALUES('$amend_id','$change_name1','$change_from1','$change_to1')");
				}
		    }
	    }

	    $change_reason='';
		if(!empty($reason)){
			$reas='';
			foreach($reason AS $reasons){
				$reas .= $reasons .", ";
			}
			$change_reason=substr($reas, 0, -2);
		}
		$save_date=date("Y-m-d");
		mysqli_query($con,"UPDATE amendment SET personal_id='$employee_name', date_prepared='$date_prepared', date_effectivity='$date_effectivity', change_reason='$change_reason', remarks='$remarks', dept_head='$current_supid', draft='0', draft_date='', saved='1', save_date = '$save_date', saved_by='$user_id' WHERE amendment_id = '$amend_id'");
		echo $amend_id;
	}
 ?>