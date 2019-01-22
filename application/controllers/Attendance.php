<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	private $user = 1;

	public function __construct() {
		parent::__construct();
		$this->data = [];
	}

	public function is_timein() {
		$this->db->where('user_id', $this->user);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timeout', NULL);
		$query = $this->db->get('attendance');
		return (bool) $query->num_rows();
	}

	public function time_in() {
		if ($this->is_timein()) redirect('attendance/timeout');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');
		
		if ($this->input->post('timein')) {
			$this->attendance_m->insert();
			redirect('attendance/timeout');
		}

		$this->load->view('layouts/header');
		$this->load->view('timein', $this->data);
		$this->load->view('layouts/footer');

	}
	
	public function time_out() {

		if (!$this->is_timein()) redirect('attendance/timein');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');

		$todays_break = $this->db
						->where('break_end_time > ', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->result();

		$active_break = $this->db
						->where('break_end_time', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->row();
		
		$this->data['dtr'] = $this->attendance_m->get_timein();
		
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
		$this->attendancemeta_m->start_break_time();
		redirect($this->agent->referrer());
	}

	public function end_break_time() {
		$this->attendancemeta_m->end_break_time();
		redirect($this->agent->referrer());
		
	}
}
