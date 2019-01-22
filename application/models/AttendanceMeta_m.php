<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class AttendanceMeta_m extends CI_Model {

	public $table = 'attendance_meta';
	public $user = 1;

	public function get_entries() {
		return 1;
	}

	public function start_break_time() {
		$data = [
			'attendance_id' => $this->input->post('attendance_id'),
			'type' => $this->input->post('type'),
			'break_start_time' => date('H:i'),
		];

		$this->db->insert($this->table, $data);
	}

	public function end_break_time() {
		$data = [
			'break_end_time' => date('H:i'),
		];

		$this->db->update($this->table, $data, ['id' => $this->input->post('id')]);
	}
}
