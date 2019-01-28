<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shift extends CI_Model {

	private $table = 'attendance_shift';
	private $filters = [];

	public function search($filters) {
		foreach ($filters as $field => $value) {
			$this->filters[$field] = $value;
		}
		return $this;
	}

	public function get() {
		$res = FALSE;
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

	public function get_shift($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		if ($query->num_rows() != 1) {
			return FALSE;
		}
		return $query->row();
	}

	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return TRUE;
	}

	public function delete($id) {
		// Soft delete only, just set active status to 0
		$this->db->set('status', 0);
		$this->db->where('id', $id);
		$this->db->update($this->table);
		return;
	}


}