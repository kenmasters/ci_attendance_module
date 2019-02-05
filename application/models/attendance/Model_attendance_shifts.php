<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Attendance Model
 */
class Model_attendance_shifts extends CI_Model {

	private $table = 'attendance';
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
		$query = $this->db->get($this->table);
		$num_rows = $query->num_rows();
		if ($num_rows > 1) {
			return $query->result();
		} elseif ($num_rows == 1) {
			return $query->row();
		}
		return false;
	}

	public function current($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('loggedin', 1);
		$query = $this->db->get($this->table);
		if ($query->num_rows() < 1)
			return false; 
		return $query->row();
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
		$this->delete_details_of_shift($id);
		$this->db->delete($this->table);
		return;
	}

	private function delete_details_of_shift($id) {
		$this->db->where('attendance_id', $id);
		$this->db->delete('attendance_details');
		return;
	}

	public function get_shift_details($att_id) {
		$result = [];
		$this->db->select('
			details.*,
			break.label
		');
		$this->db->from('attendance_details as details');
		$this->db->join('attendance_break_types as break', 'break.id = details.type_id');
		$this->db->where('details.attendance_id', $att_id);
		$this->db->order_by('details.id', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() < 1 ) return false;
		$resource = $query->result_id;
		while ($row = @mysqli_fetch_object($resource)) {
			$row->duration_in_mins = ($row->end - $row->start) / 60;
			$result[$row->id] = $row;
		}
		return $result;
	}

	public function get_user_attendance_list($user_id) {
		$result = [];
		$this->db->where('loggedin', 0);
		$this->db->where('user_id', $user_id);
		if ($this->filters) {
			$this->db->where($this->filters);
		}
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get($this->table);
		if ($query->num_rows() < 1) return false;
		$resource = $query->result_id;
		while ($row = @mysqli_fetch_object($resource)) {
			$row->duration_in_hours = ($row->timeout - $row->timein) / 3600;
			$result[$row->id] = $row;
		}
		return $result;
	}

}
