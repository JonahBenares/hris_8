<?php
	include '../includes/connection.php';
	foreach($_POST as $var=>$value)
	$$var = mysqli_real_escape_string($con, $value);
	mysqli_query($con,"UPDATE personal_data SET retrieve = '1' WHERE personal_id = '$_GET[id]'");
	echo "<script type='text/javascript'>alert('Successfully Retreived!');</script>";
	$redirect = $_SERVER['HTTP_REFERER'];
	echo "<script>document.location='$redirect'</script>";
?>