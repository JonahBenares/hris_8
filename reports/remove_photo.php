<?php 
	include '../includes/connection.php';
	$personal_id = trim($_POST['personal_id']);
	$get_name = mysqli_query($con, "SELECT photo_upload FROM personal_data WHERE personal_id = '$personal_id'");
	$fetch_name = $get_name->fetch_array();
	$file= $fetch_name['photo_upload'];
	unlink("../uploads/".$file);
	mysqli_query($con,"UPDATE personal_data SET photo_upload = '' WHERE personal_id = '$personal_id'");
?>