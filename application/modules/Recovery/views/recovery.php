<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title>Recovery - Resume</title>

  <?=$this->load->view('assets/css/auth')?>
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
								<form>
									<div class="form-group">
										<label>Email Address</label>
										<input type="email" name="email" class="form-control" placeholder="Email Address" required minlength="5">
									</div>
									
									<button type="submit" class="btn btn-primary btn-flat m-b-10 m-t-5">Send</button>
									<div class="register-link m-t-10 text-center">
										<a href="<?=base_url()?>">Log In</a>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?=$this->load->view('assets/js/auth')?>
	<script src="<?=base_url()?>assets/js/auth/recovery.js"></script>

</body>
</html>
