<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title>Login - Resume</title>

  <?=$this->load->view('assets/css/auth');?>
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
								<form>
									<div class="form-group">
										<label>Username</label>
										<input type="username" name="username" class="form-control" placeholder="Username">
										<small class="form-control-feedback text-danger" id="err-username"></small>
									</div>

									<div class="form-group">
										<label>Password</label>
										<div class="input-group">
											<input type="password" name="password" class="form-control" placeholder="Password">
											<span class="input-group-btn">
													<button class="btn btn-flat" type="button" onclick="showPass(this)">
														<i class="fa fa-eye"></i>
													</button>
											</span>
										</div>
										<small class="form-control-feedback text-danger" id="err-password"></small>
									</div>

									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember"> Remember me
										</label>
										<label class="pull-right">
											<a href="<?=base_url()?>recovery">Forgot Password?</a>
										</label>
									</div>
									
									<button type="submit" class="btn btn-primary btn-flat m-b-10 m-t-10">Log in</button>
									<div class="register-link m-t-10 text-center">
										<p>Don't have account ? <a href="<?=base_url()?>signup"> Sign Up Here</a></p>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?=$this->load->view('assets/js/auth');?>
	<script src="<?=base_url()?>assets/js/auth/login.js"></script>

</body>
</html>
