<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_riwayat_gaji extends CI_Controller{
 
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
   
    public function index() {
        $data['title'] = "DATA Riwayat Gaji";
        $startDate = $this->input->get('startDate'); 
        $startYears = $this->input->get('startYears');
    
        // Inisialisasi $tb_payroll_saved agar selalu ada
        $data['tb_payroll_saved'] = [];
    
        // Hanya jalankan pencarian jika form sudah disubmit
        if (!empty($startDate) && !empty($startYears)) {
            // Panggil data berdasarkan filter yang diisi
            $data['tb_payroll_saved'] = $this->Master_data->get_payroll_saved($startDate, $startYears);
    
            // Cek apakah ada data yang ditemukan
            if (!empty($data['tb_payroll_saved'])) {
                // Jika data ditemukan, set flashdata success
                $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Ditemukan <i class="fa fa-check"></i></div>');
            } else {
                // Jika tidak ada data, set flashdata error
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Tidak Ditemukan <i class="fa fa-times"></i></div>');
            }
        }
    
        // Load views
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/payroll/riwayat-payroll/v_riwayat', $data);
        $this->load->view('__footer');
    }
    
    

    
    function v_penggajian(){
        $data['title'] = "DATA PENGGAJIAN";
        // Default tanggal periode (26 bulan sebelumnya hingga 25 bulan berikutnya)
        $currentDate = date('Y-m-d');
        $defaultStartDate = date('Y-m-d', strtotime('first day of -1 month +25 days')); // Tanggal 26 bulan lalu
        $defaultEndDate = date('Y-m-d', strtotime('first day of this month +24 days')); // Tanggal 25 bulan ini

        // Ambil filter tanggal dari input, jika tidak ada gunakan default
        $startDate = $this->input->get('start_date') ?: $defaultStartDate;
        $endDate = $this->input->get('end_date') ?: $defaultEndDate;

        $data['get_payroll_karyawan'] = $this->Master_data->get_payroll_karyawan($startDate,$endDate);
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/payroll/penggajian/v_penggajian',$data);
        $this->load->view('__footer');

    }
    function save_payroll(){
        $data['title'] = "SIMPAN DATA PENGGAJIAN";
        // Default tanggal periode (26 bulan sebelumnya hingga 25 bulan berikutnya)
        $currentDate = date('Y-m-d');
        $defaultStartDate = date('Y-m-d', strtotime('first day of -1 month +25 days')); // Tanggal 26 bulan lalu
        $defaultEndDate = date('Y-m-d', strtotime('first day of this month +24 days')); // Tanggal 25 bulan ini

        // Ambil filter tanggal dari input, jika tidak ada gunakan default
        $startDate = $this->input->get('start_date') ?: $defaultStartDate;
        $endDate = $this->input->get('end_date') ?: $defaultEndDate;

        $data['get_payroll_karyawan'] = $this->Master_data->get_payroll_karyawan($startDate,$endDate);

        foreach ($data['get_payroll_karyawan'] as $payroll) {
            $this->db->insert('tb_payroll_saved', [
                'id' => '',
                'no_finger' => $payroll->no_finger,
                'total_presensi' => $payroll->total_presensi,
                'gaji_bruto' => $payroll->gaji_bruto,
                'gp' => $payroll->gp,
                'total_gaji' => $payroll->total_gaji,
                'tgl_simpan' => date('Y-m-d')
            ]);
        }
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/payroll/penggajian/v_penggajian',$data);
        $this->load->view('__footer');

    }
    public function insertPayroll(){
        $no_finger = $this->input->post('no_finger');
        $p_jamsostek = $this->input->post('jumlah');

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