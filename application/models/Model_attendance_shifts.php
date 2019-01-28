<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Model_attendance_shifts extends CI_Model {

	private $table = 'attendance_shifts';
	private $filters = [];

	public function search($search='') {
		if (is_array($search)) {
			foreach ($search as $key => $value) {
				$this->filters[$key] = $value;
			}
		}
		return $this;
	}

	public function get() {
		if ($this->filters) {
			$this->db->where($this->filters);
		}
		return $this->db->get($this->table)->result();
	}

	public function current($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('loggedin', 1);
		return $this->db->get($this->table)->row();
	}


	public function insert($data) {
		if (!$this->db->insert($this->table, $data))
			return false;
		return true;
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		if (!$this->db->update($this->table, $data))
			return false;
		return true;
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		if (!$this->db->delete($this->table))
			return false;
		return true;
	}

	public function get_shift_details($att_id) {
		$res = false;
		$this->db->select('
			details.*,
			break.label
		');
		$this->db->from('attendance_details as details');
		$this->db->join('attendance_break_types as break', 'break.id = details.type_id');
		$this->db->where('details.attendance_id', $att_id);
		$this->db->order_by('details.id', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() < 1) {
			return false;	
		}
		return $query->result();
	}

}
