<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		 mysqli_query($con,"UPDATE business_unit SET bu_name ='$bu_name' WHERE bu_id = '$id'");
	    echo "<script>alert('Successfully Updated!');</script>";
	    echo "<script>document.location='bus_unit.php'</script>";
?>