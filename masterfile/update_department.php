<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		$sheet_name = $dept_name;
		if( strlen( $sheet_name ) > 25 ) {
		   $sheet_names = substr( $sheet_name, 0, 25 ) . '...';
		}
		mysqli_query($con,"UPDATE department SET dept_name ='$dept_name', sheet_name='$sheet_names' WHERE dept_id = '$id'");
	    echo "<script>alert('Successfully Updated!');</script>";
	    echo "<script>document.location='department.php'</script>";
?>