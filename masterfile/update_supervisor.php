<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		 mysqli_query($con,"UPDATE personal_data SET fname ='$fname',lname='$lname',mname='$mname',name_ext='$next',current_bu='$buname' WHERE personal_id = '$id'");
	    echo "<script>alert('Successfully Updated!');</script>";
	    echo "<script>document.location='supervisor.php'</script>";
?>