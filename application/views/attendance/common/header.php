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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <!-- Bootstrap Timepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">

	<link rel="stylesheet" href="https://getbootstrap.com/docs/3.4/examples/dashboard/dashboard.css">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/style.css'); ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('admin/attendance/breaks'); ?>">Breaks</a></li>
						<li><a href="<?php echo site_url('admin/attendance/shifts'); ?>">Shifts</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Attendance
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('attendance/in'); ?>">Time In/Out</a></li>
					</ul>
				</li>
	            <li><a href="#">Profile</a></li>
	            <li><a href="#">Help</a></li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	
