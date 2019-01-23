<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_main extends CI_Model {
	
	private $user = null;

	public function __construct() {
		parent::__construct();
	}

	public function setUser($id) {
		$this->user = $id;
		return $this;
	}

	public function in() {
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$datetime = nice_date($date, 'Y-m-d').' '.$time;
		$timein_note = $this->input->post('timein_note');
		
		$data = [
			'user_id' => $this->user,
			'timein' => $datetime,
			'timein_note' => $timein_note,
		];
		
		$this->attendance_model->insert($data);
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
		];
		$this->attendance_model->update($id, $data);
	}

	public function is_timein() {

		$this->db->where('user_id', $this->user);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timeout', NULL);
		$query = $this->db->get('attendance');
		return (bool) $query->num_rows();
	}

	public function break_start() {
		$att_id = $this->input->post('attendance_id');
		$data = [
			'attendance_id' => $att_id,
			'type' => $this->input->post('type'),
			'break_start_time' => date('H:i'),
		];

		$this->attendancemeta_model->insert($att_id, $data);
	}

	public function break_end() {
		$id = $this->input->post('id');
		$data = [
			'break_end_time' => date('H:i'),
		];

		$this->attendancemeta_model->update($id, $data);
	}

	

}