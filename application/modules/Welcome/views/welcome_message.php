<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/welcome.css">
</head>
<body>

	<div id="container">
		<h1>Welcome to CodeIgniter HMVC!</h1>

		<div id="body">
			<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

			<p>If you would like to edit this page you'll find it located at:</p>
			<code>application/modules/Welcome/views/welcome_message.php</code>

			<p>The corresponding controller for this page is found at:</p>
			<code>application/modules/Welcome/controllers/Welcome.php</code><br>

			<p>This code was integrated REST API, for using please migrate table the key api in <a href="migrate">Migrate</a> for Database name "<?=$dbName?>", if you dont want use key api in your system, ignore this step.</p><br>

			<p>If you dont want use key api, edit "rest_enable_keys" to value "false" in file located at:</p>
			<code>application/config/rest.php</code>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>
