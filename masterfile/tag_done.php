<?php
	include '../includes/connection.php';
	foreach($_POST as $var=>$value)
	$$var = mysqli_real_escape_string($con, $value);
	mysqli_query($con,"UPDATE reminders SET done = '1' WHERE reminder_id = '$_GET[remid]'");
	echo "<script type='text/javascript'>alert('Successfully Tag As Done!');</script>";
	$redirect = $_SERVER['HTTP_REFERER'];
	echo "<script>document.location='$redirect'</script>";
?>