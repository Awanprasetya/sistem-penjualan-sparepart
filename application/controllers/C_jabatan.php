<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_jabatan extends CI_Controller{
 
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
        $data['title'] = "DATA JABATAN";
        $data['get_jbt'] = $this->Master_data->get_data('tb_jabatan')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-jabatan/v_jabatan',$data);
        $this->load->view('SuperAdmin/master-data/data-jabatan/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-jabatan/modal_edit',$data);
        $this->load->view('__footer');

    }
    public function insertJabatan(){
        $kd_jbt = $this->input->post('kd_jbt');
        $nm_jbt = $this->input->post('nm_jbt');

        $data = array(
            'id_jbt' => ' ',
            'kd_jbt' => $kd_jbt,
            'nm_jbt' => $nm_jbt
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_jabatan');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');

        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');
        }
       

        redirect(base_url().'c_jabatan/index');
    }
    function editJabatan($id_jbt){
        $where=array('id_jbt' => $id_jbt);
        $kd_jbt = $this->input->post('kd_jbt');
        $nm_jbt = $this->input->post('nm_jbt');

        $data = array(
            'kd_jbt' => $kd_jbt,
            'nm_jbt' => $nm_jbt,

        );
        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_jabatan');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Jabatan Berhasil Dirubah <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Jabatan Gagal Dirubah <i class="fa fa-uncheck"></i></div>');
        }
       
        redirect(base_url().'c_jabatan/index');
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
    function delete($id_jbt)
	{
		$where = array('id_jbt' => $id_jbt);
		$this->Master_data->delete_data($where,'tb_jabatan');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Jabatan Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_jabatan/index');
	}
}