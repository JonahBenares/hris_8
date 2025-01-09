<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		mysqli_query($con,"INSERT INTO location (location_name) VALUES ('$location_name')");
		echo "<script type='text/javascript'>alert('Successfully Saved!');</script>";
		echo "<script>document.location='location.php'</script>";
?>