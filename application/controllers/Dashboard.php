<?php 
 
class Dashboard extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('Master_data');
        $this->load->helper('url');
		if($this->session->userdata('status') != 1){
			redirect(base_url("Login"));
		}
	}
 
	function index(){
		$this->load->view('__header');
		if ($this->session->userdata('role') == "SuperAdmin") 
		{
			$this->load->view('dashboard_sa');
		} else if ($this->session->userdata('role') == "Admin") {
			$this->load->view('dashboard_a');
		}else{
			$this->load->view('dashboard_k');
		}
		$this->load->view('__footer');
	}

}