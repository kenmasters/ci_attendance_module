<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Model_attendance_details extends CI_Model {

	private $table = 'attendance_details';
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

	public function insert($att_id, $data) {
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		if (!$this->db->update($this->table, $data)) return FALSE;
		return TRUE;

	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		return;
	}

	// Get current break for a specific attendance
	// Return obj current break or FALSE if no active break 
	public function current($att_id) {
		$this->db->select('
			details.*,
			break.label
		');
		$this->db->from('attendance_details as details');
		$this->db->join('attendance_break_types as break', 'break.id = details.type_id');
		$this->db->where('details.attendance_id', $att_id);
		$this->db->where('details.status', 1);
		$this->db->order_by('details.id', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() < 1)
			return FALSE;
		return $query->row();
	}
}
