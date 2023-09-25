<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title>Recovery - Resume</title>

  <link href="<?=base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/helper.css" rel="stylesheet">
  <link href="<?=base_url()?>vendor/elaadmin/css/style.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/css/login.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
	
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10">
		</svg>
	</div>
	
	<div id="main-wrapper">
		<div class="unix-login">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-lg-4">
						<div class="login-content card mt-5 mb-3">
							<div class="login-form">
								<a href="<?=base_url()?>">
									<img src="<?=base_url()?>assets/img/codeigniter.png">
								</a>
								<p><center>Enter your email address and we will send you instructions on how to reset your password.</center></p><br>
								<form id="recovery-form">
									<div class="form-group">
										<label>Email Addrress</label>
										<input type="email" name="email" class="form-control" placeholder="Email Address">
									</div>
									
									<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-10">Reset Password</button>
									<div class="register-link m-t-10 text-center">
										<p><a href="<?=base_url()?>">Log In</a><br>
										<a href="<?=base_url()?>signup">Sign Up</a></p>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="<?=base_url()?>vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/popper.min.js"></script>
	<script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>vendor/jquery/jquery.slimscroll.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/sidebarmenu.js"></script>
	<script src="<?=base_url()?>vendor/sticky-kit-master/dist/sticky-kit.min.js"></script>
	<script src="<?=base_url()?>vendor/elaadmin/js/scripts.js"></script>
	<script src="<?=base_url()?>assets/js/global.js"></script>
	<script src="<?=base_url()?>assets/js/auth.js"></script>

</body>
</html>
