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
		if($this->is_timein()) redirect('attendance/timeout');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');

		$this->db->where('user_id', $this->user);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timein <', date('Y-m-d 23:59'));
		$query = $this->db->get('attendance');
		

		if ($this->input->post('timein')) {
			$date = $this->input->post('date');
			$time = $this->input->post('time');
			$datetime = nice_date($date, 'Y-m-d').' '.$time;
			$timein_note = $this->input->post('timein_note');
		

			// do loggedin
			$data = [
				'user_id' => $this->user,
				'timein_note' => $timein_note,
				'timein' => $datetime,
			];

			$this->db->insert('attendance', $data);
			redirect('attendance/timeout');

		}

		$this->load->view('layouts/header');
		$this->load->view('timein', $this->data);
		$this->load->view('layouts/footer');

	}
	
	public function time_out() {

		if(!$this->is_timein()) redirect('attendance/timein');

		$this->data['current_date'] = date('D, d M Y');
		$this->data['current_time'] = date('H:i');

		$this->db->order_by('id', 'DESC');;
		$this->db->where('user_id', $this->user);
		$this->db->where('timein >', date('Y-m-d 00:00'));
		$this->db->where('timein <', date('Y-m-d 23:59'));
		$query = $this->db->get('attendance');

		$todays_break = $this->db
						->where('break_end_time > ', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->result();

		$active_break = $this->db
						->where('break_end_time', '00:00')
						->order_by('id', 'DESC')
						->get('attendance_meta')->row();
		
		$this->data['dtr'] = $query->row();
		$this->data['todays_break'] = $todays_break;
		$this->data['on_break'] = false;

		if ($active_break) {
				$this->data['break_id'] = $active_break->id;
				$this->data['on_break'] = true;
				$this->data['break_start_time'] = $active_break->break_start_time;
				$this->data['break_type'] = $active_break->type;
		}
		
		if ($this->input->post('timeout')) {
			// do loggedout
			$attendance_id = $this->input->post('attendance_id');
			$date = $this->input->post('date');
			$time = $this->input->post('time');
			$datetime = nice_date($date, 'Y-m-d').' '.$time;
			$timeout_note = $this->input->post('timeout_note');

			$data = [
				'timeout_note' => $timeout_note,
				'timeout' => $datetime,
			];

			$this->db->update('attendance', $data, ['id' => $attendance_id]);
			redirect('attendance/timein');

		}

		$this->load->view('layouts/header');
		$this->load->view('timeout', $this->data);
		$this->load->view('layouts/footer');
	
		
	}

	public function start_break_time() {
		// Add break time for specific punchin
		$data = [
			'attendance_id' => $this->input->post('attendance_id'),
			'type' => $this->input->post('type'),
			'break_start_time' => date('H:i'),
		];

		$this->db->insert('attendance_meta', $data);
		redirect($this->agent->referrer());
		
	}

	public function end_break_time() {
		// End break time for specific punchin
		$data = [
			'break_end_time' => date('H:i'),
		];

		$this->db->update('attendance_meta', $data, ['id' => $this->input->post('id')]);
		redirect($this->agent->referrer());
		
	}
}
