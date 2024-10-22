<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_cuti extends CI_Controller{
 
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
        $data['title'] = "MENU CUTI";
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-cuti/menu_cuti',$data);
       // $this->load->view('SuperAdmin/master-data/data-cuti/modal_add',$data);
        //$this->load->view('SuperAdmin/master-data/data-cuti/modal_edit',$data);
        $this->load->view('__footer');

    }
    function v_cuti(){
        $data['title'] = "DATA Cuti";
        $data['get_cuti'] = $this->Master_data->get_data('v_cuti_karyawan')->result();
        $data['get_karyawan'] = $this->Master_data->get_karyawan_order_asc();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-cuti/v_cuti',$data);
        $this->load->view('SuperAdmin/master-data/data-cuti/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-cuti/modal_edit',$data);
        $this->load->view('__footer');

    }
    function v_sisa_cuti(){
        $data['title'] = "DATA Sisa Cuti";
        $tahun = $this->input->post('tahun');
        $data['get_cuti'] = $this->Master_data->get_sisa_cuti_by_year($tahun);
        $data['get_karyawan'] = $this->Master_data->get_karyawan_order_asc();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-cuti/v_sisa_cuti',$data);
        $this->load->view('__footer');

    }

    // function v_filter(){
    //     $data['title'] = "DATA Sisa Cuti";
       
    //     $data['get_karyawan'] = $this->Master_data->get_karyawan_order_asc();
    //     $this->load->view('__header');
    //     $this->load->view('SuperAdmin/master-data/data-cuti/v_sisa_cuti',$data);
    //     $this->load->view('__footer');

    // }
    public function insertCuti(){
        $no_finger = $this->input->post('no_finger');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        $tahun = $this->input->post('tahun');

        $data = array(
            'id_cuti' => ' ',
            'no_finger' => $no_finger,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tahun' => $tahun,
            'tgl_input' => date('Y-m-d H:i:s'),
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'tb_cuti');
            $this->session->set_flashdata('success', 'Data  Berhasil Dirubah');
        }else{
            $this->session->set_flashdata('error', 'Data Gagal Disimpan');

        }
      

        redirect(base_url().'c_cuti/v_cuti');
    }
    function editCuti($id_cuti){
        $where=array('id_cuti' => $id_cuti);
        $no_finger = $this->input->post('no_finger');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        $tahun = $this->input->post('tahun');

        $data = array(
            'no_finger' => $no_finger,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tahun' => $tahun,
            'tgl_input' => date('Y-m-d H:i:s'),

        );

        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_cuti');
            $this->session->set_flashdata('success', 'Data  Berhasil Dirubah');

        }else{
            $this->session->set_flashdata('error', 'Data  Gagal Dirubah');

        }
       
        redirect(base_url().'c_cuti/v_cuti');
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
    function delete($id_cuti)
{
    $where = array('id_cuti' => $id_cuti);
    
    if ($where ) {
        // Jika penghapusan berhasil
        $this->Master_data->delete_data($where, 'tb_cuti');

        $this->session->set_flashdata('success', 'Data Cuti Berhasil Dihapus');
    } else {
        // Jika penghapusan gagal
        $this->session->set_flashdata('error', 'Data Cuti Gagal Dihapus ');
    }

    redirect(base_url().'c_cuti/v_cuti');
}
function cuti_export_excel(){
    $date = date('Y-m-d H:i:s');
    $data['title']= "Data Cuti Karyawan $date ";
    $data['get_cuti'] = $this->Master_data->get_data('v_cuti_karyawan')->result();
    $this->load->view('SuperAdmin/master-data/data-cuti/cuti_excel',$data);

}
function sisa_cuti_export_excel(){
    $date = date(format: 'Y-m-d H:i:s');
    $data['title']= "Data Sisa Cuti Karyawan $date ";
    $data['get_cuti'] = $this->Master_data->get_data('v_sisa_cuti')->result();
    $this->load->view('SuperAdmin/master-data/data-cuti/sisa_cuti_excel',$data);

}
}