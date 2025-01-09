<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		 mysqli_query($con,"UPDATE location SET location_name ='$location_name' WHERE location_id = '$id'");
	    echo "<script>alert('Successfully Updated!');</script>";
	    echo "<script>document.location='location.php'</script>";
?>