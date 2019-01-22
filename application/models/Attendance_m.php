<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Attendance_m extends CI_Model {

	public $table = 'attendance';
	public $user = 1;

	public function insert() {
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$datetime = nice_date($date, 'Y-m-d').' '.$time;
		$timein_note = $this->input->post('timein_note');
	
		$data = [
			'user_id' => $this->user,
			'timein_note' => $timein_note,
			'timein' => $datetime,
		];

		$this->db->insert($this->table, $data);
	}

	public function update() {
		$id = $this->input->post('attendance_id');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$datetime = nice_date($date, 'Y-m-d').' '.$time;
		$timeout_note = $this->input->post('timeout_note');

		$data = [
			'timeout_note' => $timeout_note,
			'timeout' => $datetime,
		];

		$this->db->update('attendance', $data, ['id' => $id]);
	}

	public function get_timein () {
		$this->db->order_by('id', 'DESC');;
		$this->db->where('user_id', $this->user);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timein <', date('Y-m-d 23:59'));
		return $this->db->get($this->table)->row();
	}

	public function breaks () {}

}
