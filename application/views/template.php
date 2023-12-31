
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri_first = $this->uri->segment(1);
$title = ucfirst($uri_first);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title></title>

	<link href="<?=base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>vendor/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
	<link href="<?=base_url()?>vendor/toastr/toastr.min.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/helper.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/style.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/template.css" rel="stylesheet">

	<?php $path = APPPATH.'views/assets/css/'.$uri_first.'.php';
	if(file_exists($path)) {
		$this->load->view('assets/css/'.$uri_first);
	} ?>
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
						<li class="nav-item m-l-10">		
							<div class="checkbox-wrapper-14 m-t-17 m-l-20">
								<label for="dark-theme" class="small">Dark Theme</label>
								<input id="dark-theme" type="checkbox" class="switch">
							</div>
						</li>

						<li class="nav-item">
							<a class="nav-link text-muted" href="<?=base_url()?>profile">
								<div class="display-user" id="display-user">
									<span></span><br>
									<small></small>
								</div>
								<img src="" alt="avatar" class="profile-pic" id="avatar-pic">
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="left-sidebar">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="m-b-10 navgroup">
						
					</ul>

					<ul id="sidebarnav" class="m-b-50">
						<li class="nav-devider"></li>
						<li class="nav-label">EXTRA</li>

						<li>
							<a href="javascript:void(0)" onclick="navLogout()">
								<i class="fa fa-sign-out"></i>
								<span class="hide-menu">Logout</span>
							</a>
						</li>

						<li class="">
							<a href="#">
								<i class="fa fa-coffee"></i>
								<span class="hide-menu">Donate</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		
		<!-- <div class="scroller"> -->
			<div class="page-wrapper p-b-10">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-primary" id="title-breadcrumb"></h3> 
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item" id="breadcrumb-nav"></li>
							<li class="breadcrumb-item active" id="breadcrumb-active"></li>
						</ol>
					</div>
				</div>

				<div class="container-fluid" id="container">
					<?=$this->load->view($content)?>
				</div>
			</div>

		
			<footer class="footer">
				<text>© 2023 All rights reserved. Developer by <a href="https://syarif-yth.github.io">Syarif YTH</a></text>
			</footer>
		<!-- </div> -->
	</div>

	<script>
	var navAktif = '<?=$uri_first?>';
	</script>

	<script src="<?=base_url()?>vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/popper.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>vendor/jquery/jquery.slimscroll.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/sidebarmenu.js"></script>
	<script src="<?=base_url()?>vendor/sticky-kit-master/dist/sticky-kit.min.js"></script>
	<script src="<?=base_url()?>vendor/jquery-confirm/jquery-confirm.min.js"></script>
	<script src="<?=base_url()?>vendor/toastr/toastr.min.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/scripts.js"></script>
	<script src="<?=base_url()?>assets/js/global.js"></script>
	<script src="<?=base_url()?>assets/js/app.js"></script>
	
</body>
</html>
