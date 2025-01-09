<?php
include '../includes/connection.php';

$eval_id = trim($_POST['eval_id']);


$get_name = mysqli_query($con, "SELECT eval_file FROM evaluation WHERE eval_id = '$eval_id'");
$fetch_name = $get_name->fetch_array();
$file= $fetch_name['eval_file'];
unlink("../uploads/".$file);
mysqli_query($con, "DELETE FROM evaluation WHERE eval_id = '$eval_id'");
