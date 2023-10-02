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
								<p><center>Check your inbox email address and enter code activation for activate your account.</center></p><br>
								<form>
									<div class="form-group">
										<label>Code Activation</label>
										<input type="number" name="kode_aktifasi" id="kode_aktifasi" class="form-control" placeholder="Code Activation">
										<small class="form-control-feedback text-danger" id="err-kode_aktifasi"></small>
									</div>
									
									<button type="submit" class="btn btn-primary btn-flat m-b-10 m-t-5">Activate</button>
									<div class="register-link m-t-10 text-center">										
										<div id="count-group"></div>
										<div id="resend-button"></div>
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
	<script src="<?=base_url()?>assets/js/auth/activation.js"></script>
</body>
</html>
