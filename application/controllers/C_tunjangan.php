<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_tunjangan extends CI_Controller{
 
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
        $data['get_tunjangan'] = $this->Master_data->get_data('tb_tunjangan')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-tunjangan/v_tunjangan',$data);
        $this->load->view('SuperAdmin/master-data/data-tunjangan/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-tunjangan/modal_edit',$data);
        $this->load->view('__footer');

    }
    public function insertTunjangan(){
        $nama_tunjangan = $this->input->post('nama_tunjangan');
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'id_tunjangan' => ' ',
            'nama_tunjangan' => $nama_tunjangan,
            'jumlah' => $jumlah
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_tunjangan');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');

        }
      

        redirect(base_url().'c_tunjangan/index');
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