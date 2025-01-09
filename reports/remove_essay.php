<?php 
	include '../includes/connection.php';
	$personal_id = trim($_POST['personal_id']);
	$get_name = mysqli_query($con, "SELECT essay_file FROM personal_data WHERE personal_id = '$personal_id'");
	$fetch_name = $get_name->fetch_array();
	$file= $fetch_name['essay_file'];
	unlink("../uploads/".$file);
	mysqli_query($con,"UPDATE personal_data SET essay_file = '' WHERE personal_id = '$personal_id'");
?>