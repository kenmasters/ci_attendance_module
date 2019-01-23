<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Attendance_model extends CI_Model {

	private $table = 'attendance';
	private $filters = [];

	public function search($search) {
		if (is_array($search)) {
			foreach ($search as $key => $value) {
				$this->filters[$key] = $value;
			}
		}
		return $this;
	}

	public function get() {
		if ($this->filters) {
			$this->db->where($filters);
		}
		return $this->db->get($this->table)->result();
	}

	public function current($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timein <', date('Y-m-d 23:59'));
		return $this->db->get($this->table)->row();
	}


	public function insert($data) {
		$this->db->insert($this->table, $data);
	}

	public function update($id, $data) {
		$this->db->update($this->table, $data, ['id' => $id]);
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}
