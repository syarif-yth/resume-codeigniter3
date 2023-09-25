
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title><?=$title?> - Resume</title>

	<link href="<?=base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/helper.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/style.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/template.css" rel="stylesheet">

	<?php if($assets_css) $this->load->view('assets/'.$assets_css);?>
</head>

<body class="fix-header fix-sidebar">
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10">
		</svg>
	</div>
	
	<div id="main-wrapper">
		<div class="header">
			<nav class="navbar top-navbar navbar-expand-md navbar-light">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?=base_url()?>">
						<img src="<?=base_url()?>assets/img/codeigniter.png" alt="codeigniter" class="dark-logo" width="20">
						<span>CodeIgniter</span>
					</a>
				</div>
				
				<div class="navbar-collapse">
					<ul class="navbar-nav mr-auto mt-md-0">
						<li class="nav-item">
							<a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
								<i class="mdi mdi-menu"></i>
							</a>
						</li>
						<li class="nav-item m-l-10">
							<a class="nav-link sidebartoggler hidden-sm-down text-muted" href="javascript:void(0)">
								<i class="ti-menu"></i>
							</a>
						</li>
					</ul>
					
					<ul class="navbar-nav my-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted" href="#">
								<img src="<?=base_url().$avatar?>" alt="user" class="profile-pic">
								<span><?=$user_display?></span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="left-sidebar">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="m-b-50">
						<li class="nav-devider"></li>
						<li class="nav-label">HOME</li>
						<li class="<?=$class_dashboard?>">
							<a href="<?=base_url()?>dashboard">
								<i class="fa fa-tachometer"></i>
								<span class="hide-menu">Dashboard</span>
							</a>
						</li>

						<li class="<?=$class_resume?>">
							<a href="#">
								<i class="fa fa-file"></i>
								<span class="hide-menu">Resume</span>
							</a>
						</li>

						<li class="<?=$class_users?>">
							<a href="<?=base_url()?>users">
								<i class="fa fa-users"></i>
								<span class="hide-menu">Users</span>
							</a>
						</li>

						<li class="nav-devider"></li>
						<li class="nav-label">ACCOUNT</li>

						<li class="<?=$class_profile?>">
							<a href="#">
								<i class="fa fa-user"></i>
								<span class="hide-menu">Profile</span>
							</a>
						</li>

						<li class="<?=$class_setting?>">
							<a href="#">
								<i class="fa fa-gear"></i>
								<span class="hide-menu">Setting</span>
							</a>
						</li>

						<li>
							<a href="<?=base_url()?>">
								<i class="fa fa-sign-out"></i>
								<span class="hide-menu">Logout</span>
							</a>
						</li>

						<li class="nav-devider"></li>
						<li class="nav-label">EXTRA</li>

						<li class="<?=$class_usage?>">
							<a href="#">
								<i class="fa fa-question-circle"></i>
								<span class="hide-menu">Usage</span>
							</a>
						</li>

						<li class="<?=$class_contact?>">
							<a href="#">
								<i class="fa fa-address-book"></i>
								<span class="hide-menu">Contact</span>
							</a>
						</li>

						<li class="<?=$class_donate?>">
							<a href="#">
								<i class="fa fa-paypal"></i>
								<span class="hide-menu">Donate</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		
		<div class="page-wrapper p-b-10">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h3 class="text-primary"><?=$title?></h3> 
				</div>
				<div class="col-md-7 align-self-center">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="javascript:void(0)"><?=$breadcrumb?></a>
						</li>
						<li class="breadcrumb-item active"><?=$title?></li>
					</ol>
				</div>
			</div>

			<div class="container-fluid" id="container">
				<?=$this->load->view($content)?>
			</div>
			
    </div>

		<footer class="footer">
			© 2023 All rights reserved. Developer by <a href="https://syarif-yth.github.io">Syarif YTH</a>
		</footer>
	</div>

	<script src="<?=base_url()?>vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/popper.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>vendor/jquery/jquery.slimscroll.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/sidebarmenu.js"></script>
	<script src="<?=base_url()?>vendor/sticky-kit-master/dist/sticky-kit.min.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/scripts.js"></script>

	<?php if($assets_js) $this->load->view('assets/'.$assets_js);?>
</body>

</html>
