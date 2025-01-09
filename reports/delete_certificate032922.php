<?php
include '../includes/connection.php';

$cert_id = trim($_POST['cert_id']);


$get_name = mysqli_query($con, "SELECT cert_file FROM certificate WHERE file_id = '$cert_id'");
$fetch_name = $get_name->fetch_array();
$file= $fetch_name['cert_file'];
unlink("../uploads/".$file);
mysqli_query($con, "DELETE FROM certificate WHERE file_id = '$cert_id'");
