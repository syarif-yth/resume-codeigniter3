<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Recovery extends RestController 
{
	function __construct()
	{
		parent::__construct();
	}
}
?>
