<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		mysqli_query($con,"INSERT INTO business_unit (bu_name) VALUES ('$bu_name')");
		echo "<script type='text/javascript'>alert('Successfully Saved!');</script>";
		echo "<script>document.location='bus_unit.php'</script>";
?>