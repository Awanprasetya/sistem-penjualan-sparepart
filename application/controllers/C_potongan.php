<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_potongan extends CI_Controller{
 
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
        $data['title'] = "DATA POTONGAN";
        $data['get_potongan'] = $this->Master_data->get_data('tb_potongan')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-potongan/v_potongan',$data);
        $this->load->view('SuperAdmin/master-data/data-potongan/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-potongan/modal_edit',$data);
        $this->load->view('__footer');

    }
    public function insertPotongan(){
        $nama_potongan = $this->input->post('nama_potongan');
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'id_potongan' => ' ',
            'nama_potongan' => $nama_potongan,
            'jumlah' => $jumlah
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_potongan');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');

        }
      

        redirect(base_url().'c_potongan/index');
    }


    function editPotongan($id_potongan){
        $where=array('id_potongan' => $id_potongan);
        $nama_potongan = $this->input->post('nama_potongan');
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'nama_potongan' => $nama_potongan,
            'jumlah' => $jumlah,

        );
        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_potongan');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data  Berhasil Dirubah <i class="fa fa-check"></i></div>');
    
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data  Gagal Dirubah <i class="fa fa-un-check"></i></div>');

        }
        redirect(base_url().'c_potongan/index');
    }
    function delete($id_potongan)
	{
		$where = array('id_potongan' => $id_potongan);
		$this->Master_data->delete_data($where,'tb_potongan');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Department Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_potongan/index');
	}
}