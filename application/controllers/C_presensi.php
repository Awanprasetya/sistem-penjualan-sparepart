<?php 

require 'vendor/autoload.php'; // Tambahkan ini
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
class C_presensi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Master_data'); // Pastikan model ini ada
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->database();
        
        if ($this->session->userdata('status') != 1) {
            redirect(base_url("Login"));
        }
    }

    function index() {
        $data['title'] = "DATA PRESENSI";
        
        $startDate = $this->input->get('start_date');
        $endDate = $this->input->get('end_date');
        $noFinger = $this->input->get('no_finger');
        $data['noFinger'] = $noFinger;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['get_presensi'] = $this->Master_data->get_karyawan_presensi($noFinger,$startDate,$endDate);
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-presensi/v_presensi', $data);
        $this->load->view('SuperAdmin/master-data/data-presensi/modal_edit', $data);
        $this->load->view('__footer');
    }

    
    // public function get_presensi() {
    //     $startDate = $this->input->get('start_date');
    //     $endDate = $this->input->get('end_date');
    //     $noFinger = $this->input->get('no_finger');
    
    //     if ($startDate && $endDate) {
    //         $this->db->where('tgl_presensi >=', $startDate);
    //         $this->db->where('tgl_presensi <=', $endDate);
    //     }
    
    //     if ($noFinger) {
    //         $this->db->like('no_finger', $noFinger);
    //     }
    
    //     $data['get_presensi'] = $this->db->get('tb_presensi')->result();
        
    //     $this->load->view('data_presensi', $data);
    // }

    // Edit Presensi
    public function editPresensi($id) {
        $where = array('id' => $id);
        $tgl_presensi = $this->input->post('tgl_presensi');
        $scan_masuk = $this->input->post('scan_masuk');
        $scan_pulang = $this->input->post('scan_pulang');

        $data = array(
            'id' => '',
            'tgl_presensi' => $tgl_presensi,
            'scan_masuk' => $scan_masuk,
            'scan_pulang' => $scan_pulang,
        );

        if(!empty($data)){

            $this->Master_data->update_data($where,$data,'tb_presensi');
            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Diubah <i class="fa fa-check"></i></div>');
        }else{
            $this->session->set_flashdata('success', '<div class="alert alert-danger">Data Gagal Diubah <i class="fa fa-un-check"></i></div>');

        }

        redirect(base_url().'c_presensi/index');

    }
    public function upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 2048; // Maksimal ukuran file 2MB

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_excel')) {
            $error = array('error' => $this->upload->display_errors());
            // Tampilkan error di view atau redirect
            $this->session->set_flashdata('error', $error['error']);
            redirect(base_url().'c_presensi/index');
        } else {
            $data = $this->upload->data();
            $filePath = './uploads/' . $data['file_name'];
            $this->import_data($filePath);
        }
    }

    private function import_data($filePath) {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $insertCount = 0; // Variabel untuk menghitung jumlah data yang berhasil diinsert
    
        foreach ($sheetData as $row) {
            if ($row['A'] != 'no_finger') { // Menghindari header
                $data = array(
                    'no_finger' => $row['A'],
                    'tgl_presensi' => date('Y-m-d', strtotime($row['B'])),
                    'scan_masuk' => $row['C'] ? date('H:i:s', strtotime($row['C'])) : NULL,
                    'scan_pulang' => $row['D'] ? date('H:i:s', strtotime($row['D'])) : NULL,
                );
                if ($this->db->insert('tb_presensi', $data)) {
                    $insertCount++; // Increment jika data berhasil diinsert
                }
            }
        }
    
        // Kembalikan response JSON
        if ($insertCount > 0) {
            echo json_encode(['success' => true, 'message' => "$insertCount data presensi berhasil diupload!"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tidak ada data yang berhasil diupload.']);
        }
        exit;
        redirect(base_url().'c_presensi/index');
    }
    

    public function success() {
        echo "Data presensi berhasil diupload!";
        $this->session->set_flashdata('success', '<div class="alert alert-success">Upload Data Berhasil Dihapus <i class="fa fa-check"></i></div>');
        redirect(base_url().'c_presensi/index');

    }



    function delete($id) {
        $where = array('id' => $id);
        $this->Master_data->delete_data($where, 'tb_presensi');
        $this->session->set_flashdata('success', '<div class="alert alert-success">Data Berhasil Dihapus <i class="fa fa-check"></i></div>');
        redirect(base_url().'c_presensi/index');
    }

    function export_excel($noFinger,$startDate,$endDate){
        $date = date(format: 'Y-m-d H:i:s');
        $data['title']= "Data Presensi Karyawan $date ";
        $data['noFinger'] = $noFinger;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['get_presensi'] = $this->Master_data->get_karyawan_presensi($noFinger,$startDate,$endDate);
        $this->load->view('SuperAdmin/master-data/data-presensi/export_excel',$data);
    
    }
}
