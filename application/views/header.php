<!DOCTYPE html>
<html>
<head>
	<!-- SPELLS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/angular-material.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-style.css" />

  	<!-- SPELLS -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
	<nav class="navbar-fixed-top navbartop" flex="100">
		<div layout="row" layout-align="center start" class="ng-scope layout-row layout-align-center-start navbar ">
			<div><a href="<?php echo base_url()."home/";?>">Beranda</a></div>
	        <div><a  href="<?php echo base_url()."forum/";?>">Forum Kuliner</a></div>
	        <div><a  href="<?php echo base_url()."gallery/";?>">Galeri Kuliner</a></div>
	        <div><a  href="<?php echo base_url()."lapak/";?>">Lapak Kuliner</a></div>
	        
		</div>
	</nav>
	<div id="main" layout="row">
		<div flex="100">