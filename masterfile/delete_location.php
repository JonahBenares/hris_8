<?php
include'../includes/connection.php';
	$con->query("DELETE FROM `location` WHERE `location_id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script type='text/javascript'>alert('Record Successfully Deleted!');</script>";
	echo "<script>document.location='location.php'</script>";
?>