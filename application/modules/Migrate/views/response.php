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
			<?php tree_view($response)?>

			<br><p><a href="<?=base_url()?>">Back</a></p>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>
