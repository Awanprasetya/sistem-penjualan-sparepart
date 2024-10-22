<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_department extends CI_Controller{
 
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
        $data['title'] = "DATA DEPARTMENT";
        $data['get_department'] = $this->Master_data->get_data('tb_department')->result();
        $data['get_jenis_kendaraan'] = $this->Master_data->get_kendaraan_by_jenis();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-department/v_department',$data);
        $this->load->view('SuperAdmin/master-data/data-department/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-department/modal_edit',$data);
        $this->load->view('__footer');

    }
    public function insertDepartment(){
        $kd_dept = $this->input->post('kd_dept');
        $nm_dept = $this->input->post('nm_dept');

        $data = array(
            'id_dept' => ' ',
            'kd_dept' => $kd_dept,
            'nm_dept' => $nm_dept
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_department');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');

        }
      

        redirect(base_url().'c_department/index');
    }
    function editDepartment($id_dept){
        $where=array('id_dept' => $id_dept);
        $kd_dept = $this->input->post('kd_dept');
        $nm_dept = $this->input->post('nm_dept');

        $data = array(
            'kd_dept' => $kd_dept,
            'nm_dept' => $nm_dept,

        );
        $this->Master_data->update_data($where,$data,'tb_department');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data  Berhasil Dirubah <i class="fa fa-check"></i></div>');
        redirect(base_url().'c_department/index');
    }
    public function filter_data() {
        $merk = $this->input->post('merk');
        $nama = $this->input->post('nama');
        $tipe = $this->input->post('tipe');
        $data['get_jenis_kendaraan'] = $this->Master_data->get_kendaraan_by_jenis();
        $data['results'] = $this->Master_data->filter_kendaraan($merk, $nama, $tipe);
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-kendaraan/v_filter',$data);
        $this->load->view('__footer');
    }
    function delete($id_dept)
	{
		$where = array('id_dept' => $id_dept);
		$this->Master_data->delete_data($where,'tb_department');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Department Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_department/index');
	}
}