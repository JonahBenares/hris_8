<?php
include '../includes/connection.php';
	
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
	

	$sql = mysqli_query($con,"SELECT fname, lname From personal_data where personal_id = '$id' ");
	$fetch = $sql->fetch_array();
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
			$ctrx = $counter;
		} 
		else{
			$ctrx = $counterX;
		}
	
		for($x=1; $x<=$ctrx;$x++){
			$c="cert_file".$x;
			if(!empty($_FILES[$c]["name"])){
				$cerfile = $_FILES[$c]['tmp_name'];
				$cert = $_FILES[$c]["name"];
				$cername = 'cert_name'.$x;
				$cename=$$cername; //certificate name
				$c = explode(".", $cert); //certificate file
				$ext = $c[1];
				$cfile = $lname."_".$fname."_".$cename.$x.".".$ext;
				move_uploaded_file($_FILES['cert_file'.$x]['tmp_name'], "../uploads/" . utf8_decode($cfile));
				$update=mysqli_query($con,"INSERT INTO certificate (personal_id,cert_file,cert_name) VALUES ('$id','$cfile','$cename')");
			}
		}
	

		if(!isset($counterX1) || $counterX1 == ''){
			$ctrx1 = $counter1;
		} 
		else{
			$ctrx1 = $counterX1;
		}
		for($x1=1; $x1<=$ctrx1;$x1++){
			$e = "eval_file".$x1;
			if(!empty($_FILES[$e]["name"])){
				$evafile = $_FILES[$e]['tmp_name'];
				$eval = $_FILES[$e]["name"];
				$evaperiod = 'eval_period'.$x1;
				$evperiod=$$evaperiod; //evaluation name

				
				$e = explode(".",$eval);
				$eext = $e[1];

				$efile = $lname."_".$fname."_".$evperiod.$x1.".".$eext;

				move_uploaded_file($_FILES['eval_file'.$x1]['tmp_name'], "../uploads/" . utf8_decode($efile));
				$update=mysqli_query($con,"INSERT INTO evaluation (personal_id,eval_file,eval_period) VALUES ('$id','$efile','$evperiod')");
			}
		}
		if(!isset($counterX2) || $counterX2 == ''){
			$ctrx2 = $counter2;
		} 
		else{
			$ctrx2 = $counterX2;
		}
		for($x2=1; $x2<=$ctrx2;$x2++){
			$o = "other_file".$x2;
			if(!empty($_FILES[$o]["name"])){
				$otfile = $_FILES[$o]['tmp_name'];
				$other = $_FILES[$o]["name"];
				$other_n = 'other_name'.$x2;
				$ot_n=$$other_n; //other name

				
				$o = explode(".",$other);
				$oext = $o[1];

				$ofile = $lname."_".$fname."_".$ot_n.$x2.".".$oext;

				move_uploaded_file($_FILES['other_file'.$x2]['tmp_name'], "../uploads/" . utf8_decode($ofile));
				$update=mysqli_query($con,"INSERT INTO other_files (personal_id,other_file,other_name) VALUES ('$id','$ofile','$ot_n')");
			}
		}

		/*echo json_encode($ctrx2);*/
	/*	echo "<script type='text/javascript'>alert('Files successfully saved!');</script>";
		echo '<script>document.location="app_emp.php"</script>';
	*/

?>