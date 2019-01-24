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
			redirect('attendance/timeout');
			exit(0);
		}

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		
		if ($this->input->post('timein')) {
			$this->model_attendance->setUser($this->user)->in();
			redirect('attendance/timeout');
			exit(0);
		}

		$this->load->view('attendance/common/header');
		$this->load->view('attendance/timein', $this->data);
		$this->load->view('attendance/common/footer');

	}
	
	public function out() {

		if (!$this->model_attendance->setUser($this->user)->is_timein())
			redirect('attendance/timein');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');

		$attendance_current = $this->model_attendance->setUser($this->user)->current();
		
		$this->data['attendance_current'] = $attendance_current;

		// get todays break

		$todays_break = $this->db
						->where('attendance_id', $attendance_current->id)
						->where('break_end_time > ', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_details')->result();

		// check if user has active break

		$active_break = $this->db
						->where('attendance_id', $attendance_current->id)
						->where('break_end_time', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_details')->row();
		
		$this->data['todays_break'] = $todays_break;
		$this->data['on_break'] = false;

		if ($active_break) {
				$this->data['break_id'] = $active_break->id;
				$this->data['on_break'] = true;
				$this->data['break_start_time'] = $active_break->break_start_time;
				$this->data['break_type'] = $active_break->type_id;
		}
		
		if ($this->input->post('timeout')) {
			$this->model_attendance->setUser($this->user)->out();
			redirect('attendance/timein');
			exit(0);
		}

		$this->load->view('attendance/common/header');
		$this->load->view('attendance/timeout', $this->data);
		$this->load->view('attendance/common/footer');
	
	}


	public function breakStart() {
		$this->model_attendance->break_start();
		redirect($this->agent->referrer());
		exit(0);
	}

	public function breakEnd() {
		$this->model_attendance->break_end();
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
