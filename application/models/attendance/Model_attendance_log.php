<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Model_attendance_log extends CI_Model {

	private $table = 'attendance_logs';
	private $filters = [];

	public function insert($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


}