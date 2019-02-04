<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shifts extends CI_Controller {

	private $data = [];
	public function __construct() {
		parent::__construct();
		$this->load->model('attendance/model_shift', 'model_shift');
	}

	public function index() {
		$shifts = $this->model_shift->get();
		$this->data['shifts'] = $shifts;
		$this->load->view('admin/common/header');
		$this->load->view('admin/attendance/shift/index', $this->data);
		$this->load->view('admin/common/footer');
	}

	public function add() {
		$this->form_validation->set_rules('label', 'Label', 'required');
		$this->form_validation->set_rules('start', 'Start', 'required');
		$this->form_validation->set_rules('end', 'End', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() !== FALSE) {
			$data['label'] = $this->input->post('label');
			$data['start'] = $this->input->post('start');
			$data['end'] = $this->input->post('end');
			$data['status'] = $this->input->post('status');
			if ($this->model_shift->insert($data)) {
				$this->session->set_flashdata('shift_added', 'Shift has been added');
				redirect(site_url('admin/attendance/shifts'));
				exit(0);
			}
		} else {
			$this->load->view('admin/common/header');
			$this->load->view('admin/attendance/shift/add', $this->data);
			$this->load->view('admin/common/footer');
		}
	}

	public function edit($id) {
		$params = ['id'=>$id];
		$shift = $this->model_shift->get_shift($id);
		if (!$shift) show_404();
		$this->form_validation->set_rules('label', 'Label', 'required');
		$this->form_validation->set_rules('start', 'Start', 'required');
		$this->form_validation->set_rules('end', 'End', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->data['shift'] = $shift;
		if ($this->form_validation->run() !== FALSE) {
			$data['label'] = $this->input->post('label');
			$data['start'] = $this->input->post('start');
			$data['end'] = $this->input->post('end');
			$data['status'] = $this->input->post('status');
			$q = $this->model_shift->update($id, $data);
			$this->session->set_flashdata('shift_updated', 'Shift has been updated');
			redirect($this->agent->referrer());
			exit(0);
		} else {
			$this->load->view('admin/common/header');
			$this->load->view('admin/attendance/shift/edit', $this->data);
			$this->load->view('admin/common/footer');
		}
	}

	public function delete($id) {
		$this->model_shift->delete($id);
		$this->session->set_flashdata('shift_deleted', 'Shift has been deleted');
		redirect(site_url("admin/attendance/shifts"));
		exit(0);
	}

}