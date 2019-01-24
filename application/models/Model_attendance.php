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
		echo 1;
	}

	public function break_start() {
		$att_id = $this->input->post('attendance_id');
		$type_id = $this->input->post('type');
		$data = [
			'attendance_id' => $att_id,
			'type_id' => $type_id,
			'break_start_time' => date('H:i'),
		];

		$this->model_shift_details->insert($att_id, $data);
	}

	public function break_end() {
		$id = $this->input->post('id');
		$data = [
			'break_end_time' => date('H:i'),
		];

		$this->model_shift_details->update($id, $data);
	}

	public function get() {
		return $this->model_shifts->search(['user_id'=>$this->user_id])->get();
	}

	public function current() {
		return $this->model_shifts->current($this->user_id);
	}

	

}