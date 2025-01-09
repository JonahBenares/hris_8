<?php
include('../includes/connection.php');


function check_exist($conn,$id){
	$select=$conn->query("SELECT personal_id FROM tmp_table WHERE personal_id = '$id'");
	$rows = $select->num_rows;
	return $rows;
}

if(isset($_POST['stat'])){
 	$data=explode("=",$_POST['stat']);
 	$id=$data[1];
 	$stat1=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET status='$stat1' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, status) VALUES ('$id','$stat1')");    
 	}
 
 }

 if(isset($_POST['emp_stat'])){
 	$data=explode("=",$_POST['emp_stat']);
 	$id=$data[1];
 	$stat=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET status='Active', emp_status = '$stat' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, status, emp_status) VALUES ('$id','Active', '$stat')");    
 	}
 
 }

 if(isset($_POST['email'])){
 	$data=explode("=",$_POST['email']);
 	$id=$data[1];
 	$email=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET email='$email' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, email) VALUES ('$id','$email')");
 	}    
 
 }

 if(isset($_POST['emp_num'])){
 	$data=explode("=",$_POST['emp_num']);
 	$id=$data[1];
 	$empno=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET emp_num='$empno' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, emp_num) VALUES ('$id','$empno')");
 	}    
 
 }

  if(isset($_POST['date_hired'])){
 	$data=explode("=",$_POST['date_hired']);
 	$id=$data[1];
 	$date=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET date_hired='$date' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, date_hired) VALUES ('$id','$date')");
 	}    
 
 }


  if(isset($_POST['bio_num'])){
 	$data=explode("=",$_POST['bio_num']);
 	$id=$data[1];
 	$bio=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET bio_num='$bio' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, bio_num) VALUES ('$id','$bio')");
 	}    
 
 }

 if(isset($_POST['separated'])){
 	$data=explode("=",$_POST['separated']);
 	$id=$data[1];
 	$datesepar=$data[0];
 	if(check_exist($con, $id) > 0){
 		$save_temp = $con->query("UPDATE tmp_table SET date_separated='$datesepar' WHERE personal_id = '$id'");
 	} else {
 		$save_temp = $con->query("INSERT INTO tmp_table (personal_id, date_separated) VALUES ('$id','$datesepar')");
 	}    
 
 }
 ?>