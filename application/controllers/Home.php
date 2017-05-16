<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include_once APPPATH . '/controllers/common/common.php';
class Home extends CI_Controller {

	
	public function index()
	{
		$this->layout->view('home/home');
	}
}
