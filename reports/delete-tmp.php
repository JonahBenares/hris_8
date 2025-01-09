<?php
include '../includes/connection.php';
if(!empty($_POST["id"])) {
	$id=$_POST['id'];
	$deletePD = $con->query("DELETE FROM tmp_table WHERE personal_id = '$id'");
	$deleteJH = $con->query("DELETE FROM job_history_tmp WHERE personal_id = '$id'");
	$deleteEH = $con->query("DELETE FROM evaluation_history_tmp WHERE personal_id = '$id'");
	$deleteAL = $con->query("DELETE FROM allowance_tmp WHERE personal_id = '$id'");
	$deleteDA = $con->query("DELETE FROM disciplinary_action_tmp WHERE personal_id = '$id'");
	$deleteREM = $con->query("DELETE FROM reminders_tmp WHERE personal_id = '$id'");
}