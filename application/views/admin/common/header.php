<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>3w Attendance</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    
    <!-- Bootstrap Timepicker -->
	<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-datetimepicker.min.css'); ?>">

	<!-- Datatables -->
	<link rel="stylesheet" href="<?php echo site_url('assets/plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap.min.css'); ?>" />
   
	<link rel="stylesheet" href="<?php echo site_url('assets/css/dashboard.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/style.css'); ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo site_url('assets/js/html5shiv.min.js'); ?>"></script>
      <script src="<?php echo site_url('assets/js/respond.min.js'); ?>"></script>
    <![endif]-->

    <script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/moment.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/plugins/datatables/datatables.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/plugins/datatables/DataTables-1.10.18/js/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/script.js'); ?>"></script>
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
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('admin/attendance/'); ?>">Attendance</a></li>
						<li><a href="<?php echo site_url('admin/breaks'); ?>">Breaks</a></li>
						<li><a href="<?php echo site_url('admin/shifts'); ?>">Shifts</a></li>
					</ul>
				</li>
	            <li><a href="#">Settings</a></li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	    <div class="content-wrapper">
	    	
	
