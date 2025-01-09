<?php
include '../includes/connection.php';

$other_id = trim($_POST['other_id']);


$get_name = mysqli_query($con, "SELECT other_file FROM other_files WHERE other_id = '$other_id'");
$fetch_name = $get_name->fetch_array();
$file= utf8_decode($fetch_name['other_file']);
unlink("../uploads/".$file);
mysqli_query($con, "DELETE FROM other_files WHERE other_id = '$other_id'");
