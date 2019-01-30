<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_attendance extends CI_Model {
	
	private $user_id = null;

	public function __construct() {
		parent::__construct();
		$this->load->model('attendance/model_attendance_shifts', 'model_shifts');
		$this->load->model('attendance/model_attendance_details', 'model_shift_details');
	}

	public function setUser($id) {
		$this->user_id = $id;
		return $this;
	}

	public function in($notes="") {
		$datetime = time();
		$data = [
			'user_id' => $this->user_id,
			'timein' => $datetime,
			'timein_note' => $notes,
			'loggedin' => 1,
		];
		
		$this->model_shifts->insert($data);
	}

	public function out($notes="") {
		$att_id = $this->current()->id;
		$datetime = time();
		$data = [
			'timeout_note' => $notes,
			'timeout' => $datetime,
			'loggedin' => 0,
		];

		// End current break when user logs out
		$current_break_id = $this->current_break()->id;
		if ($current_break_id) {
			$this->doEnd($current_break_id);
		}

		$this->model_shifts->update($att_id, $data);
	}

	public function doAdd($type_id, $notes='') {
		$att_id = $this->current()->id;
		$data = [
			'attendance_id' => $att_id,
			'type_id' => $type_id,
			'start' => now(),
			'start_note' => $notes,
			'status' => 1
		];
		return $this->model_shift_details->insert($att_id, $data);
	}

	public function doEnd($id, $notes='') {
		$data = [
			'end' => time(),
			'end_note' => $notes,
			'status' => 0
		];
		return $this->model_shift_details->update($id, $data);
	}

	public function get() {
		return $this->model_shifts->search(['user_id'=>$this->user_id])->get();
	}

	public function current() {
		return $this->model_shifts->current($this->user_id);
	}

	public function get_current_shift_details() {
		$att_id = $this->current()->id;
		return $this->model_shifts->get_shift_details($att_id);
	}

	public function get_details($att_id) {
		return $this->model_shifts->get_shift_details($att_id);
	}

	public function current_break() {
		$att_id = $this->current()->id;
		return $this->model_shift_details->current($att_id);
	}

	public function get_attendance_list($filters=[]) {
		if (!empty($filters))
			return $this->model_shifts->search($filters)->get_user_attendance_list($this->user_id);
		return $this->model_shifts->get_user_attendance_list($this->user_id);
	}
}