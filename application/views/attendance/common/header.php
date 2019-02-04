<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3w Attendance</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-datetimepicker.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/dashboard.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/style.css'); ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo site_url('assets/js/html5shiv.min.js'); ?>"></script>
      <script src="<?php echo site_url('assets/js/respond.min.js'); ?>"></script>
    <![endif]-->
  </head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">3w Attendance</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Attendance
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('attendance/viewAttendance'); ?>">My Records</a></li>
						<li><a href="<?php echo site_url('attendance/in'); ?>">Time In/Out</a></li>
					</ul>
				</li>
	            <li><a href="<?php echo site_url("settings"); ?>">Settings</a></li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	    <div class="content-wrapper">
	    	
	    
	
