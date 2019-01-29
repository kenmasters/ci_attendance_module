<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller { 

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->view('admin/common/header');
		$this->load->view('settings');
		$this->load->view('attendance/common/footer');
	}
}