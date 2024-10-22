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
			$data['get_karyawan_group_dept']= $this->Master_data->get_karyawan_group_dept();
			$data['get_karyawan_resign_dept']= $this->Master_data->get_karyawan_resign_dept();
			$this->load->view('dashboard_sa',$data);
		} else if ($this->session->userdata('role') == "Admin") {
			$data['get_karyawan_group_dept']= $this->Master_data->get_karyawan_group_dept();
			$data['get_karyawan_resign_dept']= $this->Master_data->get_karyawan_resign_dept();
			$this->load->view('dashboard_a',$data);
		}else{
			$this->load->view('dashboard_k');
		}
		$this->load->view('__footer');
	}

}