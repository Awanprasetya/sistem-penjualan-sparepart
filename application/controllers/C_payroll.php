<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_payroll extends CI_Controller{
 
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
        $data['get_payroll'] = $this->Master_data->get_data('tb_payroll')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/payroll/menu_payroll',$data);
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
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
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
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $bulan = date('F Y', strtotime($endDate));
        $data['get_payroll_karyawan'] = $this->Master_data->get_payroll_karyawan($startDate,$endDate);
        $query = $this->db->get('tb_payroll_saved');
        foreach ($data['get_payroll_karyawan'] as $payroll) {

            if($query->num_rows() > 0){
                $this->session->set_flashdata('error', '<div class="alert alert-danger">Data Gaji Karyawan bulan <b> ' . $bulan . ' </b> sudah ada di database <i class="fa fa-times"></i></div>');

            }else{
                $this->db->insert('tb_payroll_saved', [
                    'id' => '',
                    'no_finger' => $payroll->no_finger,
                    'total_presensi' => $payroll->total_presensi,
                    'gaji_bruto' => $payroll->gaji_bruto,
                    't_jabatan' => $payroll->t_jabatan,
                    't_kehadiran' => $payroll->t_kehadiran,
                    't_transport' => $payroll->t_transport,
                    'potongan_jamsostek' => $payroll->potongan_jamsostek,
                    'potongan_bpjs_kesehatan' => $payroll->potongan_bpjs_kesehatan,
                    't_lemburan' => $payroll->t_lemburan,
                    'p_alpha' => $payroll->p_alpha,
                    'p_piutang' => $payroll->p_piutang,
                    'gp' => $payroll->gp,
                    'total_gaji' => $payroll->total_gaji,
                    'tgl_simpan' => $endDate
                ]);
                $this->session->set_flashdata('success', '<div class="alert alert-success">Data Gaji Karyawan bulan <b> ' . $bulan . ' </b> Berhasil disimpan <i class="fa fa-check"></i></div>');

            }
          
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

    function export_excel($startDate,$endDate){
        $bulan = date('F', strtotime($endDate));
        $data['title'] = "Data Payroll Bulan $bulan";
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
       
        $data['get_payroll_karyawan'] = $this->Master_data->get_payroll_karyawan($startDate,$endDate);
        $this->load->view('SuperAdmin/master-data/payroll/penggajian/export_excel',$data);

    }
    function delete($id_potongan)
	{
		$where = array('id_potongan' => $id_potongan);
		$this->Master_data->delete_data($where,'tb_potongan');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Department Berhasil Dihapus <i class="fa fa-check"></i></div>');
		redirect(base_url().'c_potongan/index');
	}
}