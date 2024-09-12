<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quote extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('General_m');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index()
	{
		// $data = wp_get_current_user();
		// $data = json_decode(json_encode($data),TRUE);
		// die(print_r($data['data']['user_email']));
		// $data['company'] = $this->General_m->get_company();
		$this->load->view('request_view');
	}

	public function get_company()
	{
		$query = $this->input->get("q");
		if (empty($query)) {
			$query = '';
		}
		$companies = $this->General_m->get_company($query);
		foreach ($companies as &$company) {
			$company['label'] = $company['name'];
			$company['value'] = $company['name'];
		}
		echo json_encode($companies);
	}


	public function inbound()
	{
		// $data = wp_get_current_user();
		// $data = json_decode(json_encode($data),TRUE);
		// die(print_r($data['data']['user_email']));
		$data['company'] = $this->General_m->get_company();
		$this->load->view('request_view', $data);
	}

	public function outbound()
	{
		// $data = wp_get_current_user();
		// $data = json_decode(json_encode($data),TRUE);
		// die(print_r($data['data']['user_email']));
		$data['company'] = $this->General_m->get_company();
		$this->load->view('request_view_out', $data);
	}

	protected function getCountry($abbr)
	{
		if ($abbr == 'US') {
			return 'USA';
		}
		return $abbr;
	}

	public function save_employee()
	{
		$data = wp_get_current_user();
		$data = json_decode(json_encode($data), TRUE);
		$user_email = $data['data']['user_email'];
		$user_name = $data['data']['display_name'];
		$data_array = array();
		$data_array['origin_company'] = $this->input->post("orgin_company");
		$data_array['origin_city'] = $this->input->post("orgin_city");
		$data_array['origin_state'] = $this->input->post("orgin_state");
		$data_array['origin_country'] = $this->getCountry($this->input->post("orgin_country"));
		$data_array['origin_zip_code'] = $this->input->post("orgin_zip_code");
		$data_array['dest_company'] = $this->input->post("dest_company");
		$data_array['dest_city'] = $this->input->post("dest_city");
		$data_array['dest_state'] = $this->input->post("dest_state");
		$data_array['dest_country'] = $this->getCountry($this->input->post("dest_country"));
		$data_array['dest_zip_code'] = $this->input->post("dest_zip_code");
		$data_array['van_dump'] = $this->input->post("van_dump");
		$data_array['pallet'] = $this->input->post("pallet");
		$data_array['weight'] = $this->input->post("weight");
		$data_array['commodity'] = $this->input->post("commodity");
		$data_array['interco_facility'] = $this->input->post("interco_facility"); // Added this line step 2
		$data_array['user_id'] = $data['data']['ID'];
		$data_array['trader_date'] = date("Y-m-d H:i:s");

		$data = $this->General_m->save_employee($data_array);
		$data_array['sender'] = $data;
		$data_array['user_name'] = $user_name;
		$data_array['user_email'] = $user_email;

		// $to = "jinmeng@jin-site.com";
		// $to = "ITCfrtquote@Intercotradingco.com";
		$to = "bobs@itcscrap.com";
		$subject = 'ITC Freight Request -- ' . $data_array['origin_company'] . ' - ' . $data_array['origin_city'] . ' ' . $data_array['origin_state'] . ' ' . $data_array['origin_country'] . ' ' . $data_array['origin_zip_code'];
		$message = $this->load->view("Email", $data_array, TRUE);
		$headers = "From: " . strip_tags($user_email) . "\r\n";
		$headers .= "Reply-To: " . strip_tags($user_email) . "\r\n";
		// $headers .= "CC: jinmeng@jin-site.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		mail($to, $subject, $message, $headers);

		$data = json_encode($data);
		echo $data;
	}

	public function save_company()
	{
		$name = $this->input->post("name");
		$city = $this->input->post("city");
		$state = $this->input->post("state");
		$zip_code = $this->input->post("zip_code");
		$data = $this->General_m->save_company($name, $city, $state, $zip_code);
		echo (json_encode($data));
	}
}
ini_set('display_errors', 0);
