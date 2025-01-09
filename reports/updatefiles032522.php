<?php
include '../includes/connection.php';
foreach($_POST as $var=>$value)
$$var = mysqli_real_escape_string($con, $value);
	$select = $con->query("SELECT fname, lname, resume_file, map_file FROM personal_data WHERE personal_id = '$id'");
	$fetch = $select->fetch_array();
	$fname = $fetch['fname'];
	$lname = $fetch['lname'];
	
	if(!empty($_FILES["resume_file"]["name"])){
		$r = explode(".", $_FILES["resume_file"]["name"]);
		$rext = $r[1];
		$rfile = $lname."_".$fname."_"."Resume".".".$rext;
		move_uploaded_file($_FILES['resume_file']['tmp_name'], "../uploads/" . utf8_decode($rfile));
		mysqli_query($con,"UPDATE personal_data SET resume_file = '$rfile' WHERE personal_id = '$id'");
	} 
	if(!empty($_FILES["map_file"]["name"])){
		$m = explode(".",$_FILES["map_file"]["name"]);
		$mext = $m[1];
		$mfile = $lname."_".$fname."_"."Map".".".$mext;
		move_uploaded_file($_FILES['map_file']['tmp_name'], "../uploads/" . utf8_decode($mfile));
		mysqli_query($con,"UPDATE personal_data SET map_file = '$mfile' WHERE personal_id = '$id'");
	} 

	if(!empty($_FILES["essay_file"]["name"])){
		$es = explode(".",$_FILES["essay_file"]["name"]);
		$esext = $es[1];
		$esfile = $lname."_".$fname."_"."Essay".".".$esext;
		move_uploaded_file($_FILES['essay_file']['tmp_name'], "../uploads/" . utf8_decode($esfile));
		mysqli_query($con,"UPDATE personal_data SET essay_file = '$esfile' WHERE personal_id = '$id'");
	} 

	if(!empty($_FILES["photo_upload"]["name"])){
		$ph = explode(".",$_FILES["photo_upload"]["name"]);
		$phext = $ph[1];
		$phfile = $lname."_".$fname."_"."Photo".".".$phext;
		move_uploaded_file($_FILES['photo_upload']['tmp_name'], "../uploads/" . utf8_decode($phfile));
		mysqli_query($con,"UPDATE personal_data SET photo_upload = '$phfile' WHERE personal_id = '$id'");
	} 

	if(!isset($counterX) || $counterX == ''){
		if($counter==0) $ctrx = 1;
		else $ctrx = $counter;
	} 
	else{
		$ctrx = $counterX;
	}
	
	$check_cert = $con->query("SELECT file_id FROM certificate WHERE personal_id = '$id'");
	$rows_cert = $check_cert->num_rows;
	if($rows_cert == $ctrx){
		for($x=1; $x<=$ctrx;$x++){
			$c="cert_file".$x;
			$cerid="cert_id".$x;
			$cername = 'cert_name'.$x;
			$cename=$$cername; //certificate name
			$cid=$$cerid;
			if(!empty($_FILES[$c]["name"])){
				$cerfile = $_FILES[$c]['tmp_name'];
				$cert = $_FILES[$c]["name"];
				$c = explode(".", $cert); //certificate file
				$ext = $c[1];
				$cfile = $lname."_".$fname."_".$cename.$x.".".$ext;
				move_uploaded_file($_FILES['cert_file'.$x]['tmp_name'], "../uploads/" . utf8_decode($cfile));
				mysqli_query($con,"UPDATE certificate SET cert_file='$cfile',cert_name='$cename' WHERE file_id = '$cid'");
			} else if(!empty($cename)){
				mysqli_query($con,"UPDATE certificate SET cert_name='$cename' WHERE file_id = '$cid'");
			}
		}	
	} else if($ctrx>$rows_cert){
		for($x=1; $x<=$ctrx;$x++){
			$c="cert_file".$x;
			$cerid="cert_id".$x;
			$cername = 'cert_name'.$x;
			$cename=$$cername; //certificate name
			$cid=$$cerid;
			if(!empty($_FILES[$c]["name"])){
				$cerfile = $_FILES[$c]['tmp_name'];
				$cert = $_FILES[$c]["name"];
				$c = explode(".", $cert); //certificate file
				$ext = $c[1];
				$cfile = $lname."_".$fname."_".$cename.$x.".".$ext;
				$select1 = mysqli_query($con,"SELECT file_id FROM certificate WHERE file_id = '$cid'");
				$row1 = mysqli_num_rows($select1);
				if($row1>0){
					move_uploaded_file($_FILES['cert_file'.$x]['tmp_name'], "../uploads/" . utf8_decode($cfile));
					mysqli_query($con,"UPDATE certificate SET cert_file='$cfile',cert_name='$cename' WHERE file_id = '$cid'");
					//$q="UPDATE certificate cert_file='$cfile',cert_name='$cename' WHERE file_id = '$cid'";
				} else {
					move_uploaded_file($_FILES['cert_file'.$x]['tmp_name'], "../uploads/" . utf8_decode($cfile));
					mysqli_query($con,"INSERT INTO certificate (personal_id,cert_file,cert_name) VALUES ('$id','$cfile','$cename')");
					//$q="INSERT INTO certificate (personal_id,cert_file,cert_name) VALUES ('$id','$cfile','$cename')";
				}
			} else if(!empty($cename)){
				mysqli_query($con,"UPDATE certificate SET cert_name='$cename' WHERE file_id = '$cid'");
			}
		}
	}
	if(!isset($counterX1) || $counterX1 == ''){
		if($counter1==0) $ctrx1 = 1;
		else $ctrx1 = $counter1;
	} else{
		$ctrx1 = $counterX1;
	}

	$check_eval = $con->query("SELECT eval_id FROM evaluation WHERE personal_id = '$id'");
	$rows_eval = $check_eval->num_rows;
	if($rows_eval == $ctrx1){
		for($x1=1; $x1<=$ctrx1;$x1++){
			$e = "eval_file".$x1;
			$evid="eval_id".$x1;
			$evaperiod = 'eval_period'.$x1;
			$evperiod=$$evaperiod; //evaluation name
			$eid=$$evid;
			if(!empty($_FILES[$e]["name"])){
				$evafile = $_FILES[$e]['tmp_name'];
				$eval = $_FILES[$e]["name"];
				$e = explode(".",$eval);
				$eext = $e[1];
				$efile = $lname."_".$fname."_".$evperiod.$x1.".".$eext;
				move_uploaded_file($_FILES['eval_file'.$x1]['tmp_name'], "../uploads/" . utf8_decode($efile));
				mysqli_query($con,"UPDATE evaluation SET eval_file = '$efile',eval_period='$evperiod' WHERE eval_id = '$eid'");
			} else if(!empty($evperiod)){
				mysqli_query($con,"UPDATE evaluation SET eval_period='$evperiod' WHERE eval_id = '$eid'");
			}
		}
	} else if($ctrx1>$rows_eval){
		for($x1=1; $x1<=$ctrx1;$x1++){
			$e = "eval_file".$x1;
			$evid="eval_id".$x1;
			$evaperiod = 'eval_period'.$x1;
			$evperiod=$$evaperiod; //evaluation name
			$eid=$$evid;
			if(!empty($_FILES[$e]["name"])){
				$evafile = $_FILES[$e]['tmp_name'];
				$eval = $_FILES[$e]["name"];
				$e = explode(".",$eval);
				$eext = $e[1];
				$efile = $lname."_".$fname."_".$evperiod.$x1.".".$eext;
				$select1 = mysqli_query($con,"SELECT eval_id FROM evaluation WHERE eval_id = '$eid'");
				$row1 = mysqli_num_rows($select1);
				if($row1>0){
				 move_uploaded_file($_FILES['eval_file'.$x1]['tmp_name'], "../uploads/" . utf8_decode($efile));
				 mysqli_query($con,"UPDATE evaluation SET eval_file = '$efile',eval_period='$evperiod' WHERE eval_id = '$eid'");
				} else {
					move_uploaded_file($_FILES['eval_file'.$x1]['tmp_name'], "../uploads/" . utf8_decode($efile));
					mysqli_query($con,"INSERT INTO evaluation (personal_id,eval_file,eval_period) VALUES ('$id','$efile','$evperiod')");
				}
			} else if(!empty($evperiod)){
				mysqli_query($con,"UPDATE evaluation SET eval_period='$evperiod' WHERE eval_id = '$eid'");
			}
		}
	}

	if(!isset($counterX2) || $counterX2 == ''){		
		if($counter2==0) $ctrx2 = 1;
		else $ctrx2 = $counter2;
	} 
	else{
		$ctrx2 = $counterX2;
	}

	$check_other = $con->query("SELECT other_id FROM other_files WHERE personal_id = '$id'");
	$row_other = $check_other->num_rows;
	if($row_other == $ctrx2){
		for($x2=1; $x2<=$ctrx2;$x2++){
			$o = "other_file".$x2;
			$otherid="other_id".$x2;
			$othername = 'other_name'.$x2;
			$ot_name=$$othername; //evaluation name
			$oid=$$otherid;
			if(!empty($_FILES[$o]["name"])){
				$otherfile = $_FILES[$o]['tmp_name'];
				$other = $_FILES[$o]["name"];
				$o = explode(".",$other);
				$oext = $o[1];
				$ofile = $lname."_".$fname."_".$ot_name.$x2.".".$oext;
				move_uploaded_file($_FILES['other_file'.$x2]['tmp_name'], "../uploads/" . utf8_decode($ofile));
				mysqli_query($con,"UPDATE other_files SET other_file = '$ofile',other_name='$ot_name' WHERE other_id = '$oid'");
			} else if(!empty($ot_name)){
				mysqli_query($con,"UPDATE other_files SET other_name ='$ot_name' WHERE other_id = '$oid'");
			}
		}
	} else if($ctrx2>$row_other){
		for($x2=1; $x2<=$ctrx2;$x2++){
			$o = "other_file".$x2;
			$otherid="other_id".$x2;
			$othername = 'other_name'.$x2;
			$ot_name=$$othername; //evaluation name
			$oid=$$otherid;
			if(!empty($_FILES[$o]["name"])){
				$otherfile = $_FILES[$o]['tmp_name'];
				$other = $_FILES[$o]["name"];
				$o = explode(".",$other);
				$oext = $o[1];
				$ofile = $lname."_".$fname."_".$ot_name.$x2.".".$oext;
				$select2 = mysqli_query($con,"SELECT other_id FROM other_files WHERE other_id = '$oid'");
				$row2 = mysqli_num_rows($select2);
				if($row2>0){
				 move_uploaded_file($_FILES['other_file'.$x2]['tmp_name'], "../uploads/" . utf8_decode($ofile));
				 mysqli_query($con,"UPDATE other_files SET other_file = '$ofile',other_name='$ot_name' WHERE other_id = '$oid'");
				} else {
					move_uploaded_file($_FILES['other_file'.$x2]['tmp_name'], "../uploads/" . utf8_decode($ofile));
					mysqli_query($con,"INSERT INTO other_files (personal_id,other_file,other_name) VALUES ('$id','$ofile','$ot_name')");
				}
			} else if(!empty($ot_name)){
				mysqli_query($con,"UPDATE other_files SET other_name ='$ot_name' WHERE other_id = '$oid'");
			}
		}
	}
?>