<?php 
session_start();
$id=$_SESSION['userid'];
$default_date = date('Y-m-d');
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		$rem_date=date('Y-m-d', strtotime($reminder_date));
		mysqli_query($con,"INSERT INTO reminders (reminder_date, notes, created_by, date_created) VALUES ('$rem_date','$notes','$id','$default_date')");
		echo "<script type='text/javascript'>alert('Successfully Saved!');</script>";
		echo "<script>document.location='thingstodo.php'</script>";
?>