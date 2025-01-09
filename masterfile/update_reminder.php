<?php 
include '../includes/connection.php';
	foreach($_POST as $var=>$value)
		$$var = mysqli_real_escape_string($con, $value);
		mysqli_query($con,"UPDATE reminders SET reminder_date ='$rem_date', notes='$notes' WHERE reminder_id = '$id'");
	    echo "<script>alert('Successfully Updated!');</script>";
	    echo "<script>document.location='thingstodo.php'</script>";
?>

