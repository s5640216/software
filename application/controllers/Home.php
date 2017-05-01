<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . '/controllers/common/common.php';
class Home extends Common {

	
	public function index()
	{
		echo "目前啟動的路徑為 : software\application\controllers\Home.php";
		echo "<br>";
		echo "<a href='" . base_url() . "login/login/logout'>點我登出 ";
	}
}
