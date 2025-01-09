<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		mysqli_query($con,"INSERT INTO personal_data (fname,lname,mname,name_ext,current_bu,supervisor, status) VALUES ('$fname','$lname','$mname','$next','$buname','1', 'Active')");
		echo "<script type='text/javascript'>alert('Successfully Saved!');</script>";
		echo "<script>document.location='supervisor.php'</script>";
?>