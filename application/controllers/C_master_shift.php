<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_master_shift extends CI_Controller{
 
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
        $data['title'] = "DATA SHIFT";
        $data['get_karyawan'] = $this->Master_data->get_data('tb_karyawan')->result();
        $data['get_shift'] = $this->Master_data->get_data('tb_shift')->result();
        $data['get_shift_karyawan'] = $this->Master_data->get_shift_karyawan();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/master-shift/v_data_shift',$data);
        $this->load->view('SuperAdmin/master-data/master-shift/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/master-shift/modal_edit',$data);
        $this->load->view('__footer');

    }

    public function insertShift() {
        $shift = $this->input->post('shift');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');

        $data = array(
            'id_shift' => ' ',
            'shift_name' => $shift,
            'start_time' => $start_time,
            'end_time' => $end_time
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_shift');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Disimpan <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gagal Disimpan <i class="fa fa-uncheck"></i></div>');

        }

       
        redirect('c_master_shift');
    }
  
    function editKaryawanShift($no_finger){
        $where=array('no_finger' => $no_finger);
        $id_shift = $this->input->post('id_shift');
        $shift_date = $this->input->post('shift_date');

        $data = array(
            'id_shift' => $id_shift,
            'shift_date' => $shift_date

        );
        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_karyawan_shift');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Dirubah <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Data  Gagal Dirubah <i class="fa fa-uncheck"></i></div>');
        }
       
        redirect(base_url().'c_shift');
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
    function delete($id_shift)
	{
		$where = array('id_shift' => $id_shift);
		$this->Master_data->delete_data($where,'tb_shift');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_master_shift/index');
	}
}