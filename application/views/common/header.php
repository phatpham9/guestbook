<!doctype html>
<html lang="en">
<head>
	<title>K15T1 Guestbook</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/responsive.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.min.js"></script>
</head>
<body>
	<!-- Container -->
	<div id="container">
		<!--<div class="loader">
			<img id="loading" src="<?php echo site_url(); ?>assets/images/kollar-loader.gif">
			<img id="center-logo" alt="" src="<?php echo site_url(); ?>assets/images/logo-big.png">
		</div>-->
		<!-- Header -->
		<header>
			<div class="main-header clearfix">
				<!-- Logo -->
				<div id="logo">
					<a href="<?php echo site_url(); ?>">
						<img alt="" src="<?php echo site_url(); ?>assets/images/logo.png">
					</a>
				</div>
				<!-- End Logo -->
			</div>
			<!-- Navigation -->
			<?php $this->load->view('common/nav'); ?>
			<!-- End Navigation -->
		</header>
		<!-- End Header -->