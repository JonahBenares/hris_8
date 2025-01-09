<?php
include 'includes/connection.php'; 
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['user_id']) || ($_SESSION['user_id'] == '')) {
    header("location: index.php");
    exit();
}

$user_id=$_SESSION['user_id'];
?>