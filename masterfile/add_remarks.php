<?php
	include '../includes/connection.php';
	foreach($_POST as $var=>$value)
	$$var = mysqli_real_escape_string($con, $value);
	/*if(!isset($status)){
		mysqli_query($con,"UPDATE personal_data SET remarks = '$remarks' WHERE personal_id = '$personal_id'");
		mysqli_query($con,"UPDATE personal_data SET retrieve = '0' WHERE personal_id = '$personal_id'");
	}else {*/
		if(!empty($status)){
			$stats = $status;
		}else {
			$stats ='';
		}
		mysqli_query($con,"UPDATE personal_data SET emp_status = '$stats', remarks = '$remarks' WHERE personal_id = '$personal_id'");
		mysqli_query($con,"UPDATE personal_data SET retrieve = '0' WHERE personal_id = '$personal_id'");
	//}
	echo "<script type='text/javascript'>alert('Successfully Added!');</script>";
	$redirect = $_SERVER['HTTP_REFERER'];
	echo "<script>document.location='$redirect'</script>";
?>