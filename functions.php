<?php
session_start();

function loginProcess($conn,$post,$dept){
	foreach($post AS $var=>$value)
		$$var = mysqli_real_escape_string($conn, $value);

    if($dept=='HR'){
		$sql=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '2'");
		$rows=$sql->num_rows;
		if($rows==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else {
			$fetch = $sql->fetch_array();
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['department'] = 'HR';
			$_SESSION['usertype'] = getUsertype($conn, $fetch['usertype_id']);

			echo "<script>window.location = 'humanresource/home.php';</script>";
		}
	} else  if($dept=='HR_dev'){
		$sql=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '5'");
		$rows=$sql->num_rows;
		if($rows==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else {
			$fetch = $sql->fetch_array();
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['department'] = 'HR';
			$_SESSION['usertype'] = getUsertype($conn, $fetch['usertype_id']);

			echo "<script>window.location = 'humanresource_dev/home.php';</script>";
		}
	}else if($dept=='Time Keeping'){
		$sql=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '4'");
		//echo "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '3'";
		$fetch = $sql->fetch_array();
		$rows=$sql->num_rows;
		if($rows==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else {
			
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['department'] = 'Time Keeping';
			$_SESSION['usertype'] = getUsertype($conn, $fetch['usertype_id']);

			echo "<script>window.location = 'timekeeping/index.php';</script>";
		}
	}
	 else if($dept=='IT'){
		$sql=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '1'");
		$rows=$sql->num_rows;
		

		$pass=md5($password);

		$sql1=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$pass' AND department_id = '1'");
		$rows1=$sql1->num_rows;
		
		if($rows==0 && $rows1==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else if($rows>0){
			$fetch = $sql->fetch_array();
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['department'] = 'IT';
			$_SESSION['usertype'] = getUsertype($conn, $fetch['usertype_id']);
			echo "<script>window.location = 'itservices/index.php';</script>";
		} else if($rows1>0){
			$fetch1 = $sql1->fetch_array();
			$_SESSION['userid'] = $fetch1['user_id'];
			$_SESSION['fullname'] = $fetch1['fullname'];
			$_SESSION['username'] = $fetch1['username'];
			$_SESSION['department'] = 'IT';
			$_SESSION['usertype'] = getUsertype($conn, $fetch1['usertype_id']);
			echo "<script>window.location = 'itservices/index.php';</script>";
		}
	} else if($dept=='Procurement'){
		$sql=$conn->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '3'");
		//echo "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password' AND department_id = '3'";
		$fetch = $sql->fetch_array();
		$rows=$sql->num_rows;
		if($rows==0){
			echo "<script>alert('Username and password not existing. Please contact IT administrator'); window.location = 'index.php'; </script>";
		} else {
			
			$_SESSION['userid'] = $fetch['user_id'];
			$_SESSION['fullname'] = $fetch['fullname'];
			$_SESSION['username'] = $fetch['username'];
			$_SESSION['department'] = 'Procurement';
			$_SESSION['usertype'] = getUsertype($conn, $fetch['usertype_id']);

			echo "<script>window.location = 'procurement/index.php';</script>";
		}
	}
}

function getUsertype($conn, $usertypeid){
	$sql=$conn->query("SELECT usertype_name FROM tbl_usertype WHERE usertype_id = '$usertypeid'");
	$fetch=$sql->fetch_array();
	$usertype=$fetch['usertype_name'];
	return $usertype;
}
?>