<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_attendance extends CI_Model {
	
	private $user_id = null;

	public function __construct() {
		parent::__construct();
		$this->load->model('model_attendance_shifts', 'model_shifts');
		$this->load->model('model_attendance_details', 'model_shift_details');
	}

	public function setUser($id) {
		$this->user_id = $id;
		return $this;
	}

	public function in() {
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$datetime = nice_date($date, 'Y-m-d').' '.$time;
		$timein_note = $this->input->post('timein_note');
		
		$data = [
			'user_id' => $this->user_id,
			'timein' => $datetime,
			'timein_note' => $timein_note,
			'loggedin' => 1,
		];
		
		$this->model_shifts->insert($data);
	}

	public function out() {
		$id = $this->input->post('attendance_id');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$datetime = nice_date($date, 'Y-m-d').' '.$time;
		$timeout_note = $this->input->post('timeout_note');

		$data = [
			'timeout_note' => $timeout_note,
			'timeout' => $datetime,
			'loggedin' => 0,
		];
		$this->model_shifts->update($id, $data);
	}

	public function is_timein() {
		return $this->model_shifts->current($this->user_id);	 
	}

	public function doAdd($type_id, $notes='') {
		$att_id = $this->current()->id;
		$data = [
			'attendance_id' => $att_id,
			'type_id' => $type_id,
			'start' => date('H:i'),
			'start_note' => $notes,
			'status' => 1
		];
		$this->model_shift_details->insert($att_id, $data);
	}

	public function doEnd($id, $notes='') {
		$data = [
			'end' => date('H:i'),
			'end_note' => $notes,
			'status' => 0
		];
		$this->model_shift_details->update($id, $data);
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

	public function current_break() {
		$att_id = $this->current()->id;
		return $this->model_shift_details->current($att_id);
	}

}