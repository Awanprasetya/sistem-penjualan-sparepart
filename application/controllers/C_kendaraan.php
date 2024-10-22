<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_kendaraan extends CI_Controller{
 
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
        $data['title'] = "DATA KENDARAAN";
        $data['get_kendaraan'] = $this->Master_data->get_data('tb_kendaraan')->result();
        $data['get_jenis_kendaraan'] = $this->Master_data->get_kendaraan_by_jenis();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-kendaraan/index',$data);
        $this->load->view('SuperAdmin/master-data/data-kendaraan/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-kendaraan/modal_edit',$data);
        $this->load->view('__footer');

    }
    public function insertKendaraan(){
        $merk = $this->input->post('merk');
        $nama = $this->input->post('nama');
        $tipe = $this->input->post('tipe');
        $harga = $this->input->post('harga');

        $data = array(
            'id' => ' ',
            'merk' => $merk,
            'nama' => $nama,
            'tipe' => $tipe,
            'harga' => $harga,
        );


        $this->Master_data->insert_data($data,'tb_kendaraan');
        $this->session->set_flashdata('alert_1', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');

        redirect(base_url().'c_kendaraan/index');
    }
    function editKendaraan($id){
        $where=array('id' => $id);
        $merk = $this->input->post('merk');
        $nama = $this->input->post('nama');
        $tipe = $this->input->post('tipe');
        $harga = $this->input->post('harga');

        $data = array(
            'merk' => $merk,
            'nama' => $nama,
            'tipe' => $tipe,
            'harga' => $harga,

        );
        $this->Master_data->update_data($where,$data,'tb_kendaraan');
        $this->session->set_flashdata('alert_1', '<div class="alert alert-success">Data  Berhasil Dirubah <i class="fa fa-check"></i></div>');
        redirect(base_url().'c_kendaraan/index');
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
    function delete($id)
	{
		$where = array('id' => $id);
		$this->Master_data->delete_data($where,'tb_kendaraan');
        $this->session->set_flashdata('alert_1', '<div class="alert alert-success">Data Kendaraan Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_kendaraan/index');
	}
}