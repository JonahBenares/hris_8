<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		$sheet_name = $dept_name;
		if( strlen( $sheet_name ) > 25 ) {
		   $sheet_names = substr( $sheet_name, 0, 25 ) . '...';
		}
		mysqli_query($con,"INSERT INTO department (dept_name,sheet_name) VALUES ('$dept_name','$sheet_names')");
		echo "<script type='text/javascript'>alert('Successfully Saved!');</script>";
		echo "<script>document.location='department.php'</script>";
?>