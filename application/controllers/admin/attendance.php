<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
	private $adminID = 10;
	private $data = [];
	public function __construct() {
		parent::__construct();
		$this->load->model('attendance/model_attendance', 'model_attendance');
		$this->load->model('attendance/model_attendance_log', 'model_attendance_log');
		$this->load->model('attendance/model_attendance_shifts', 'model_attendance_shifts');
		$this->load->model('attendance/model_user', 'model_users');
	}

	private function _dbseed() {
		include APPPATH.'/third_party/faker/autoload.php';
		// $this->db->truncate('users');
		$faker = Faker\Factory::create();
		for($i=0; $i<500; $i++) {
			$fake_users[] = [
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
			];
		}
		$this->db->insert_batch('users', $fake_users);
	}

	public function index() {
		$this->data['users'] = [];
		$this->load->view('admin/common/header');
		$this->load->view("admin/attendance/dashboard", $this->data);
		$this->load->view('admin/common/footer');
	}

	public function get_users() {

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$list = $this->model_users->get_users();


		$recordsTotal = $this->model_users->count_all();
		$recordsFiltered = $this->model_users->count_filtered();

		$data = array();
		foreach($list as $r) {
			$records = site_url("/admin/users/{$r->id}/viewRecords");
		   $data[] = array(
		        $r->first_name,
		        $r->last_name,
		        "<a class='btn btn-xs btn-default' href='{$records}'>View Records</a>"
		   );
		}
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => $data
		);
		echo json_encode($output);
		exit(0);
	}

	public function user($uid) {
		$attendance = $this->model_attendance_shifts->search(['user_id'=>$uid])->get();
		if (!$attendance) show_404();

		echo 'view/search/edit  attendance of user' . $uid;
		$this->data['uid'] = $uid;
		$this->load->view('admin/common/header');
		$this->load->view('admin/attendance/viewUserAttendance', $this->data);
		$this->load->view('admin/common/footer');
	}

	public function editRecord($uid, $id) {
		$attendance = $this->model_attendance_shifts->search(['user_id'=>$uid,'id'=>$id])->get();
		if (!$attendance) show_404();
		$this->form_validation->set_rules('timein', 'Time In', 'required');
		$this->form_validation->set_rules('timein_notes', 'Time In Notes', 'trim|xss_clean');
		$this->form_validation->set_rules('timeout_notes', 'Time Out Notes', 'trim|xss_clean');
		if($this->form_validation->run() !== false) {
			$data = [
				'timein' => strtotime($this->input->post('timein')),
				'timeout' => strtotime($this->input->post('timeout')),
				'timein_note' => $this->input->post('timein_notes'),
				'timeout_note' => $this->input->post('timeout_notes'),
			];
			$prevdata = [
				'timein' => $attendance->timein,
				'timeout' => $attendance->timeout,
				'attendance_id' => $attendance->id,
				'user_id' => $this->adminID,
			];
			$updated = $this->model_attendance_shifts->update($id, $data);
			if ($updated) {
				$this->model_attendance_log->insert($prevdata);
				$this->session->set_flashdata('record_updated', 'Record has been updated');
				redirect($this->agent->referrer());
				exit(0);
			}
		} else {
			$this->data['attendance'] = $attendance;
			$this->load->view('admin/common/header');
			$this->load->view('admin/attendance/edit', $this->data);
			$this->load->view('admin/common/footer');
		}
	}

	public function listUserAttendance($uid) {
		$user = $this->model_users->find($uid);
		if (!$user) show_404();
		$user_attendance = $this->model_attendance->setUser($uid);
		$min = $this->input->get('min');
		$max = $this->input->get('max');
		$filters = [];

		if ($min && $max && ($min>$max)) {
			$err = [
					'status' => 1,
					'msg' => 'Max date should not be lower than Min date'
			];
			$this->session->set_flashdata('err', $err);
			redirect($this->agent->referrer());
			exit(0);
		}

		if ($min) {
			$filters['timein >='] = strtotime($min);
		}

		if ($max){
			$filters['timein <='] = strtotime($max);
		}

		$user_attendance_list = $user_attendance->get_attendance_list($filters);
		
		$this->data['user_attendance_list'] = $user_attendance_list;
		$att_id = $this->input->get('attendance');
		$this->data['selected'] = $att_id;
		if (isset($att_id)) {
			$this->data['attendance_details'] = $this->model_attendance->get_details($att_id);
		}

		$this->data['page_title'] = $user->first_name .' '. $user->last_name;
		$this->load->view('admin/common/header');
		$this->load->view('attendance/user', $this->data);
		$this->load->view('admin/common/footer');
	}

}