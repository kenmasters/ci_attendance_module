<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	// user static ID
	private $user = 5;
	private $data = [];

	public function __construct() {
		parent::__construct();
		$this->load->model('model_attendance');
	}

	public function index() {
		$this->load->view('attendance/common/header');
		$this->load->view('attendance/common/footer');
	}

	public function in() {
		if ($this->model_attendance->setUser($this->user)->is_timein()) {
			redirect('attendance/out');
			exit(0);
		}

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		
		if ($this->input->post('timein')) {
			$this->model_attendance->setUser($this->user)->in();
			redirect('attendance/out');
			exit(0);
		}

		$this->load->view('attendance/common/header');
		$this->load->view('attendance/timein', $this->data);
		$this->load->view('attendance/common/footer');

	}
	
	public function out() {

		$this->load->model('attendance/model_break', 'model_breaks');

		if (!$this->model_attendance->setUser($this->user)->is_timein())
			redirect('attendance/in');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		$this->data['breaks'] = $this->model_breaks->search(['status'=>1])->get();

		
		$this->data['attendance_current'] = $this->model_attendance->setUser($this->user)->current();
		$this->data['shift_details'] = $this->model_attendance->setUser($this->user)->get_current_shift_details();
		$this->data['current_break'] = $this->model_attendance->setUser($this->user)->current_break();
		
		if ($this->input->post('timeout')) {
			$this->model_attendance->setUser($this->user)->out();
			redirect('attendance/in');
			exit(0);
		}

		$this->load->view('attendance/common/header');
		$this->load->view('attendance/timeout', $this->data);
		$this->load->view('attendance/common/footer');
	}

	public function breakStart() {
		$type_id = $this->input->post('type');
		$notes = $this->input->post('notes');
		$this->model_attendance->setUser($this->user)->doAdd($type_id, $notes);
		redirect($this->agent->referrer());
		exit(0);
	}

	public function breakEnd() {
		$id = $this->input->post('id');
		$notes = $this->input->post('notes');
		$this->model_attendance->setUser($this->user)->doEnd($id, $notes);
		redirect($this->agent->referrer());
		exit(0);
	}

	public function user($uid) {
		$this->data['user_shifts'] = $this->model_attendance->setUser($uid)->get();
		$this->load->view('attendance/common/header');
		$this->load->view('attendance/user', $this->data);
		$this->load->view('attendance/common/footer');
	}
}
