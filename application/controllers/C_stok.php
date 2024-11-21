<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_stok extends CI_Controller{
 
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
        $data['title'] = "DATA BARANG";
        $data['get_barang'] = $this->Master_data->get_data('tb_barang')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-barang/v_barang',$data);
        $this->load->view('SuperAdmin/master-data/data-barang/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-barang/modal_edit',$data);
        $this->load->view('__footer');

    }
   
    public function insertBarang(){
        $nm_barang = $this->input->post('nm_barang');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $satuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');

        $data = array(
            'kd_barang' => '',
            'nm_barang' => $nm_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'satuan' => $satuan,
            'kategori' => $kategori,
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_barang');
            $this->session->set_flashdata('success', 'Data  Berhasil Disimpan');
        }else{
            $this->session->set_flashdata('error', 'Data Gagal Disimpan');

        }
      

        redirect(base_url().'c_barang/index');
    }

    function editBarang($kd_barang){
        $where=array('kd_barang' => $kd_barang);
        $nm_barang = $this->input->post('nm_barang');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $satuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');

        $data = array(
            'nm_barang' => $nm_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'satuan' => $satuan,
            'kategori' => $kategori,

        );

        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_barang');
            $this->session->set_flashdata('success', 'Data  Berhasil Dirubah');

        }else{
            $this->session->set_flashdata('error', 'Data  Gagal Dirubah');

        }
       
        redirect(base_url().'c_barang/index');
    }

    function delete($kd_barang)
    {
        $where = array('kd_barang' => $kd_barang);
        
        if ($where ) {
            // Jika penghapusan berhasil
            $this->Master_data->delete_data($where, 'tb_barang');
    
            $this->session->set_flashdata('success', 'Data barang Berhasil Dihapus');
        } else {
            // Jika penghapusan gagal
            $this->session->set_flashdata('error', 'Data barang Gagal Dihapus ');
        }
    
        redirect(base_url().'c_barang/index');
    }
    function export_excel(){
        $date = date('Y-m-d H:i:s');
        $data['title']= "Data Barang $date ";
        $data['get_barang'] = $this->Master_data->get_data('tb_barang')->result();
        $this->load->view('SuperAdmin/master-data/data-barang/export_excel',$data);
    
    }
}