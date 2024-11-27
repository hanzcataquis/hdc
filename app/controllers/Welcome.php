<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Welcome extends Controller {

	public function __construct() {
		parent::__construct();
		$this->call->database();
	}
	
	public function index() {
		$this->call->view('welcome_page');
	}

	public function about_us() {
		echo'About Us Page';
	}
}
?>