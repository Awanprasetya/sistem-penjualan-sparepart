<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_resign extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        $this->load->model('Master_data');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->database();
        
	
		if($this->session->userdata('status') != 1){
			redirect(base_url("Login"));
		}
		
	}
    function index(){
        $data['title'] = "DATA KARYAWAN RESIGN";
        $data['get_karyawan_resign'] = $this->Master_data->get_karyawan_resign();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-resign/v_resign',$data);
        $this->load->view('__footer');

    }
   
    function export_excel(){
        $date = date('Y-m-d H:i:s');
        $data['title']= "Data Karyawan Resign $date ";
        $data['get_karyawan_resign'] = $this->Master_data->get_karyawan_resign();
        $this->load->view('SuperAdmin/master-data/data-resign/export_excel',$data);

    }

}