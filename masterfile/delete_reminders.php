<?php
include'../includes/connection.php';
	$con->query("DELETE FROM `reminders` WHERE `reminder_id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script type='text/javascript'>alert('Record Successfully Deleted!');</script>";
	echo "<script>document.location='../masterfile/thingstodo.php'</script>";
?>