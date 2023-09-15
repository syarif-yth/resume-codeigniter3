<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Migrate</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/welcome.css">
</head>
<body>

	<div id="container">
		<h1>Migrate System</h1>

		<div id="body">
			<p>This migration is supported by the presence of a database '<strong><i><?=$dbName?>.</i></strong>'</p>

			<p>Click this link if you are ready to migrate system:</p>
			<code><a href="<?=base_url()?>migrate/process">Migrate</a></code>

			<p>Or you can rename the database to you want:</p>
			<code>application/config/database.php</code>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>
