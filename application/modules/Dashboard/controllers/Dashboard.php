<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	public function guzzle()
	{
		$this->load->library('Guzzle_PHP_HTTP');
		$client = new \GuzzleHttp\Client(['base_uri' => $this->api]);
		$res = $client->request('GET', 'users', 
			['headers' => 
				['authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2OTY0OTQ3ODcsInVzZXIiOnsibmlwIjoiMjAyMzA5MjIxNTU4MTIiLCJlbWFpbCI6InN5YXJpZi55dGhAZ21haWwuY29tIiwidXNlcm5hbWUiOiJhZG1pbl9hcHAifX0.d2pU80ffF55ZDiAFNi8Bn5uHnri2fzXsgen820cBXRs']
			]
		);
		echo $res->getBody(); 
	}

	public function index()
	{
		$view = $this->data_view();
		$this->load->view('template', $view);
	}

	private function data_view()
	{
		$data['avatar'] = 'assets/img/avatar-default.jpg';
		$data['name_display'] = 'Admin App';
		$data['user_display'] = 'administrator';
		$data['breadcrumb'] = 'Main';
		$data['class_dashboard'] = 'aktif';
		$data['content'] = 'dashboard';
		return $data;
	}
}
?>
