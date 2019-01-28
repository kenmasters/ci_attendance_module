<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breaks extends CI_Controller {

	private $data = [];
	public function __construct() {
		parent::__construct();
		$this->load->model('attendance/model_break', 'model_break');
	}

	public function index() {

		$break_types = $this->model_break->get();
		// echo json_encode($break_types);
		// exit(0);
		$this->data['break_types'] = $break_types;

		$this->load->view('attendance/common/header');
		$this->load->view('admin/attendance/break/index', $this->data);
		$this->load->view('attendance/common/footer');

	}

	public function add() {
		$break  = new \stdClass();
		$break->label = '';
		$break->status = 0;
		$this->data['break'] = $break;
		$this->form_validation->set_rules('label', 'Label', 'required');
		if ($this->form_validation->run() !== FALSE) {
			var_dump($this->input->post());
			$data = [
				'label' => $this->input->post('label'),
				'status' => $this->input->post('status')?:0,
			];
			if ($this->model_break->insert($data)) {
				$this->session->set_flashdata('break_added', 'Break has been added');
				redirect(site_url('admin/attendance/breaks'));
				exit(0);
			}
		} else {
			$this->load->view('attendance/common/header');
			$this->load->view('admin/attendance/break/single', $this->data);
			$this->load->view('attendance/common/footer');
		}
	}

	public function edit($id) {
		$break = $this->model_break->get_break($id);
		if (!$break) show_404();
		$this->data['break'] = $break;
		$this->form_validation->set_rules('label', 'Label', 'required');
		if ($this->form_validation->run() !== FALSE) {
			$data = [
				'label' => $this->input->post('label'),
				'status' => $this->input->post('status'),
			];
			if ($this->model_break->update($id, $data)) {
				$this->session->set_flashdata('break_updated', 'Break has been updated');
				redirect($this->agent->referrer());
				exit(0);
			}
		} else {
			$this->load->view('attendance/common/header');
			$this->load->view('admin/attendance/break/single', $this->data);
			$this->load->view('attendance/common/footer');
		}
	}

	public function delete($id) {
		$this->model_break->delete($id);
		$this->session->set_flashdata('break_deleted', 'Break has been deleted');
		redirect(site_url("admin/attendance/breaks"));
		exit(0);
	}

}