<?php 
session_start();
if(empty($_SESSION)){
    echo "<script>alert('You are currently not logged in.'); window.location = '../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    
<!--Designed By ALpha-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="../assets/img/logo-cenpri.png" rel="icon">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>CENPRI - HRIS</title>
        <!-- Vendor styles -->
        <link rel="stylesheet" href="../assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="../assets/vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="../assets/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="../assets/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">
         <link rel="stylesheet" href="../assets/vendors/bower_components/flatpickr/dist/flatpickr.min.css" />

        <!-- App styles -->
        <link rel="stylesheet" href="../assets/css/app.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>