<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	public $user = 2; // user static ID


	public function __construct() {
		parent::__construct();
		$this->data = [];
		$this->load->model('attendance_main');
	}

	public function time_in() {
		if ($this->attendance_main->setUser($this->user)->is_timein())
			redirect('attendance/timeout');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		
		if ($this->input->post('timein')) {
			$this->attendance_main->setUser($this->user)->in();
			redirect('attendance/timeout');
		}

		$this->load->view('layouts/header');
		$this->load->view('timein', $this->data);
		$this->load->view('layouts/footer');

	}
	
	public function time_out() {

		if (!$this->attendance_main->setUser($this->user)->is_timein())
			redirect('attendance/timein');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');

		$attendance_current = $this->attendance_model->current($this->user);
		
		$this->data['attendance_current'] = $attendance_current;

		$todays_break = $this->db
						->where('attendance_id', $attendance_current->id)
						->where('break_end_time > ', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->result();

		$active_break = $this->db
						->where('attendance_id', $attendance_current->id)
						->where('break_end_time', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->row();
		
		$this->data['todays_break'] = $todays_break;
		$this->data['on_break'] = false;

		if ($active_break) {
				$this->data['break_id'] = $active_break->id;
				$this->data['on_break'] = true;
				$this->data['break_start_time'] = $active_break->break_start_time;
				$this->data['break_type'] = $active_break->type;
		}
		
		if ($this->input->post('timeout')) {
			$this->attendance_m->update();
			redirect('attendance/timein');
		}

		$this->load->view('layouts/header');
		$this->load->view('timeout', $this->data);
		$this->load->view('layouts/footer');
	
	}

	public function start_break_time() {
		$this->attendance_main->break_start();
		redirect($this->agent->referrer());
	}

	public function end_break_time() {
		$this->attendance_main->break_end();
		redirect($this->agent->referrer());
		
	}
}
