<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Model_break extends CI_Model {

	private $table = 'attendance_break_types';
	private $filters = [];

	public function search($filters) {
		foreach ($filters as $field => $value) {
			$this->filters[$field] = $value;
		}
		return $this;
	}

	public function get() {
		$res = '';
		if ($this->filters) {
			$this->db->where($this->filters);
		}
		$query = $this->db->get($this->table);
		if ($query->num_rows() == 1) {
			$res = $query->row();
		} elseif ( $query->num_rows() > 1) {
			$res =  $query->result();
		}
		return $res;
	}

	public function insert($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}

	public function delete($id) {
		$this->db->set('status', 0);
		$this->db->where('id', $id);
		$this->db->update($this->table);
		return;
	}

	public function get_break($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		if ($query->num_rows() < 1)
			return false; 
		return $query->row();
	}

	public function get_active() {
		$this->db->where('status', true);
		$query = $this->db->get($this->table);
		return $query->result();
	}


}