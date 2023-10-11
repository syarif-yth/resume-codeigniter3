<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="syarif-yth.github.io">
  <link rel="icon" href="<?=base_url()?>assets/img/codeigniter.png">
  <title>Reset - Resume</title>

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
								<p><center>Reset your password.</center></p><br>
								<form>
									<div class="form-group">
										<label>New Password</label>
										<div class="input-group">
											<input type="password" name="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;" required minlength="5">
											<span class="input-group-btn">
												<button class="btn btn-flat" type="button" onclick="showPass(this)">
													<i class="fa fa-eye"></i>
												</button>
											</span>
										</div>
									</div>

									<div class="form-group">
										<label>Confirm New Password</label>
										<div class="input-group">
											<input type="password" class="form-control" name="passconf" placeholder="&bull;&bull;&bull;&bull;&bull;" required minlength="5">
											<span class="input-group-btn">
												<button class="btn btn-flat" type="button" onclick="showConf(this)">
													<i class="fa fa-eye"></i>
												</button>
											</span>
										</div>
									</div>
									
									<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-10">Reset Password</button>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?=$this->load->view('assets/js/auth')?>
	<script src="<?=base_url()?>assets/js/auth/reset.js"></script>

</body>
</html>
