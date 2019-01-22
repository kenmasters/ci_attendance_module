<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_Main extends CI_Model {

	public $user = null;

	public function setUser($id) {
		// will retrieve user by id and set user prop
		// $this->user = $user;
		return $this;
	}

	public function in() {
		// $this->attendance_model->insert($data);
		return 1;
	}

	public function out() {
		// $this->attendance_model->update($id, $data);
	}

}