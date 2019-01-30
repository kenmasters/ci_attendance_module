<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	// user static ID
	private $userid = 5;
	private $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->model('attendance/model_attendance');

		$this->data['userid'] = $this->userid;
	}

	// Helper method that do redirect and exit
	private function _redirect($url) {
		redirect($url);
		exit(0);
	}

	public function index() {
		$this->load->view('attendance/common/header', ['userid'=>$this->userid]);
		$this->load->view('attendance/common/footer');
	}

	public function in() {
		
		if ($this->model_attendance->setUser($this->userid)->current()) {
			$this->_redirect('attendance/out');
		}

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		
		if ($this->input->post('timein')) {
			$notes = $this->input->post('notes');
			$u_attendance = $this->model_attendance->setUser($this->userid)->in($notes);
			$this->_redirect('attendance/out');
		} else {
			$this->load->view('attendance/common/header', ['userid'=>$this->userid]);
			$this->load->view('attendance/timein', $this->data);
			$this->load->view('attendance/common/footer');
		}
	}
	
	public function out() {
		$this->load->model('attendance/model_break', 'model_breaks');
		if (!$this->model_attendance->setUser($this->userid)->current())
			$this->_redirect('attendance/in');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		$this->data['breaks'] = $this->model_breaks->search(['status'=>1])->get();
		$this->data['attendance_current'] = $this->model_attendance->setUser($this->userid)->current();
		$this->data['shift_details'] = $this->model_attendance->setUser($this->userid)->get_current_shift_details();
		$this->data['current_break'] = $this->model_attendance->setUser($this->userid)->current_break();
		
		if ($this->input->post('timeout')) {
			$notes = $this->input->post('notes');
			$this->model_attendance->setUser($this->userid)->out($notes);
			$this->_redirect(site_url('attendance/in'));
		} else {
			$this->load->view('attendance/common/header', ['userid'=>$this->userid]);
			$this->load->view('attendance/timeout', $this->data);
			$this->load->view('attendance/common/footer');
		}
		
	}

	public function breakStart() {
		$type_id = $this->input->post('type');
		$notes = $this->input->post('notes');
		if($this->model_attendance->setUser($this->userid)->doAdd($type_id, $notes))
			$this->_redirect($this->agent->referrer());
	}

	public function breakEnd() {
		$id = $this->input->post('id');
		$notes = $this->input->post('notes');
		if ($this->model_attendance->setUser($this->userid)->doEnd($id, $notes))
			$this->_redirect($this->agent->referrer());
	}

	public function user($uid) {
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
		
		$this->load->view('attendance/common/header', ['userid'=>$this->userid]);
		$this->load->view('attendance/user', $this->data);
		$this->load->view('attendance/common/footer');
	}
}
