<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_komponen extends CI_Controller{
 
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
        $data['title'] = "DATA KOMPONEN";
        $data['get_payroll'] = $this->Master_data->get_karyawan_komponen();
        $data['get_karyawan'] = $this->Master_data->get_karyawan_order_asc();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/payroll/komponen/v_komponen',$data);
        $this->load->view('SuperAdmin/master-data/payroll/komponen/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/payroll/komponen/modal_edit',$data);
        $this->load->view('__footer');

    }
    
    public function insertKomponen(){
        $no_finger = $this->input->post('no_finger');
        $p_jamsostek = $this->input->post('p_jamsostek');
        $p_bpjs = $this->input->post('p_bpjs');
        $kategori = $this->input->post('kategori');
        $t_transport = $this->input->post('t_transport');
        $t_kehadiran = $this->input->post('t_kehadiran');
        $t_jabatan = $this->input->post('t_jabatan');
        $gp = $this->input->post('gp');
        $p_alpha = $this->input->post('p_alpha');
        $p_piutang = $this->input->post('p_piutang');
        $t_lemburan = $this->input->post('t_lemburan');


        $data = array(
            'id' => ' ',
            'no_finger' => $no_finger,
            'p_jamsostek' => $p_jamsostek,
            'p_bpjs' => $p_bpjs,
            'kategori' => $kategori,
            't_transport' => $t_transport,
            't_kehadiran' => $t_kehadiran,
            't_jabatan' => $t_jabatan,
            'gp' => $gp,
            'p_alpha' => $p_alpha,
            'p_piutang' => $p_piutang,
            't_lemburan' => $t_lemburan,

        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_payroll');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');

        }
      

        redirect(base_url().'c_komponen/index');
    }


    function editKomponen($id){
        $where=array('id' => $id);
        $no_finger = $this->input->post('no_finger');
        $p_jamsostek = $this->input->post('p_jamsostek');
        $p_bpjs = $this->input->post('p_bpjs');
        $kategori = $this->input->post('kategori');
        $t_transport = $this->input->post('t_transport');
        $t_kehadiran = $this->input->post('t_kehadiran');
        $t_jabatan = $this->input->post('t_jabatan');
        $gp = $this->input->post('gp');
        $p_alpha = $this->input->post('p_alpha');
        $p_piutang = $this->input->post('p_piutang');
        $t_lemburan = $this->input->post('t_lemburan');

        $data = array(
            'no_finger' => $no_finger,
            'p_jamsostek' => $p_jamsostek,
            'p_bpjs' => $p_bpjs,
            'kategori' => $kategori,
            't_transport' => $t_transport,
            't_kehadiran' => $t_kehadiran,
            't_jabatan' => $t_jabatan,
            'gp' => $gp,
            'p_alpha' => $p_alpha,
            'p_piutang' => $p_piutang,
            't_lemburan' => $t_lemburan,

        );
        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_payroll');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data  Berhasil Dirubah <i class="fa fa-check"></i></div>');
    
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data  Gagal Dirubah <i class="fa fa-un-check"></i></div>');

        }
        redirect(base_url().'c_komponen/index');
    }

    public function reset() {
        // Mengatur field lemburan ke 0 untuk seluruh karyawan
        $data = array(
            't_lemburan' => 0, // Ganti 'lemburan' dengan nama field yang sesuai
            'p_alpha' => 0,
            'p_piutang' => 0,
        );
    
        // Update field lemburan di tabel gaji
        $this->db->update('tb_payroll', $data);
    
        // Set flashdata untuk notifikasi
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data  Berhasil Direset <i class="fa fa-check"></i></div>');
    
        // Redirect kembali ke halaman sebelumnya
        redirect(base_url().'c_komponen'); // Sesuaikan dengan controller dan method yang sesuai
    }
    
    
    function delete($id)
	{
		$where = array('id' => $id);
		$this->Master_data->delete_data($where,'tb_payroll');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_komponen/index');
	}
}