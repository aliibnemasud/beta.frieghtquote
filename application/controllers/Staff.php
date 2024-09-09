<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('General_m');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['employee'] = $this->General_m->get_staff();
		$this->load->view('employee_view', $data);
	}

	public function save_employee()
	{
		$data['f_name'] = $this->input->post("f_name");
		$data['l_name'] = $this->input->post("l_name");
		$data['position'] = $this->input->post("pos");
		$data['email'] = $this->input->post("email_add");
		$data['extension'] = $this->input->post("extension");
		$data['direct_phone'] = $this->input->post("direct_phone");
		$data['cell_phone'] = $this->input->post("cell_phone");
		$data['extension'] = $this->input->post("extension");
		$data['workstation'] = $this->input->post("workstation");

		$target_dir = "assets/upload/";
		$target_file = $target_dir . strtotime(date("Y-m-d h:i:s")) . basename($_FILES["file_upload"]["name"]);
		$fileTmpPath = $_FILES['file_upload']['tmp_name'];
		$data['image'] = $target_file;
		$upload_result = move_uploaded_file($fileTmpPath, $target_file);
		$data = $this->General_m->save_staff($data);
		redirect("staff");
	}

	public function update_employee()
	{
		$id = $this->input->post("hidden_edit_id");
		$data['f_name'] = $this->input->post("edit_f_name");
		$data['l_name'] = $this->input->post("edit_l_name");
		$data['position'] = $this->input->post("edit_pos");
		$data['email'] = $this->input->post("edit_email_add");
		$data['extension'] = $this->input->post("edit_extension");
		$data['direct_phone'] = $this->input->post("edit_direct_phone");
		$data['cell_phone'] = $this->input->post("edit_cell_phone");
		$data['extension'] = $this->input->post("edit_extension");
		$data['workstation'] = $this->input->post("edit_workstation");

		if ($_FILES["edit_file_upload"]['name'] != "") {
			$target_dir = "assets/upload/";
			$name = strtotime(date("Y-m-d h:i:s")) . strtotime(date("Y-m-d h:i:s"));
			$target_file = $target_dir . $name . basename($_FILES["edit_file_upload"]["name"]);
			$fileTmpPath = $_FILES['edit_file_upload']['tmp_name'];
			$data['image'] = $target_file;
			$upload_result = move_uploaded_file($fileTmpPath, $target_file);
		}

		$data = $this->General_m->update_staff($data, $id);
		redirect("staff");
	}

	public function delete_user()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->delete_staff($id);
		echo (json_encode($data));
	}
}
ini_set('display_errors', 0);
