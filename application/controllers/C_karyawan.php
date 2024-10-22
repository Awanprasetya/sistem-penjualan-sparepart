<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_karyawan extends CI_Controller{
 
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
        $data['title'] = "DATA KARYAWAN";
        $data['get_karyawan'] = $this->Master_data->get_karyawan_non_resign();
        $data['get_data_diri'] = $this->Master_data->get_data('tb_data_diri')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-karyawan/v_karyawan',$data);
        $this->load->view('SuperAdmin/master-data/data-karyawan/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-karyawan/modal_edit',$data);
        $this->load->view('SuperAdmin/master-data/data-karyawan/modal_data_diri',$data);
        $this->load->view('__footer');

    }
    public function insertKaryawan(){
        $no_finger = $this->input->post('no_finger');
        $nm_karyawan = $this->input->post('nm_karyawan');
        $nik = $this->input->post('nik');
        $awal_masuk = $this->input->post('awal_masuk');

        $data = array(
            'id_karyawan' => ' ',
            'no_finger' => $no_finger,
            'nm_karyawan' => $nm_karyawan,
            'nik' => $nik,
            'awal_masuk' => $awal_masuk
        );
        $data2 = array(
            'id_data_diri' => ' ',
            'no_finger' => $no_finger,
            'nm_karyawan' => $nm_karyawan
        );


        $this->Master_data->insert_data($data,'tb_karyawan');
        $this->Master_data->insert_data($data2,'tb_data_diri');
        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');

        redirect(base_url().'c_karyawan/index');
    }
    //edit karyawan
    function editKaryawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $no_finger = $this->input->post('no_finger');
        $nm_karyawan = $this->input->post('nm_karyawan');
        $nik = $this->input->post('nik');
        $awal_masuk = $this->input->post('awal_masuk');
        if(!empty($nm_karyawan)){
            $data = array(
                'no_finger' => $no_finger,
                'nik' => $nik,
                'awal_masuk' => $awal_masuk,
                'nm_karyawan' => $nm_karyawan,
            );
            $data2 = array(
                'nm_karyawan' => $nm_karyawan,
            );
            $this->Master_data->update_data($where,$data,'tb_karyawan');
            $this->Master_data->update_data($where,$data2,'tb_data_diri');
            $this->session->set_flashdata('success', 'Data Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Data Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/index');
    }
    // public function filter_data() {
    //     $merk = $this->input->post('merk');
    //     $nama = $this->input->post('nama');
    //     $tipe = $this->input->post('tipe');
    //     $data['get_jenis_kendaraan'] = $this->Master_data->get_kendaraan_by_jenis();
    //     $data['results'] = $this->Master_data->filter_kendaraan($merk, $nama, $tipe);
    //     $this->load->view('__header');
    //     $this->load->view('SuperAdmin/master-data/data-kendaraan/v_filter',$data);
    //     $this->load->view('__footer');
    // }
    public function delete_karyawan($no_finger){
        // Cek apakah data karyawan ada berdasarkan no_finger
        $where = array('no_finger' => $no_finger);
         $this->Master_data->delete_data($where, 'tb_karyawan');
    
            $this->session->set_flashdata('success', 'Data karyawan berhasil dihapus.');
        
    
        redirect(base_url().'c_karyawan/index');
    }
    
    function v_detail($no_finger){
        $data['title'] = "DETAIL KARYAWAN";
        $data['get_kontrak_temp']= $this->Master_data->get_kontrak_temp($no_finger);
        $data['get_jabatan']= $this->Master_data->get_data('tb_jabatan')->result();
        $data['get_department']= $this->Master_data->get_data('tb_department')->result();
        $data['get_karyawan'] = $this->Master_data->get_data('tb_karyawan')->result();
        $data['get_data_diri'] = $this->Master_data->get_data_diri($no_finger);
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-karyawan/detail',$data);
        $this->load->view('__footer');

    }
    function v_detail_kontrak($no_finger){
        $data['title'] = "DETAIL KARYAWAN";
        $data['get_karyawan'] = $this->Master_data->get_data('tb_karyawan')->result();
        $data['get_data_diri'] = $this->Master_data->get_data_diri($no_finger);
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-karyawan/detail',$data);
        $this->load->view('__footer');

    }
    //Edit Nama Karyawan
    function edit_nama_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $nm_karyawan = $this->input->post('nm_karyawan');
        if(!empty($nm_karyawan)){
            $data = array(
                'nm_karyawan' => $nm_karyawan,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->Master_data->update_data($where,$data,'tb_karyawan');
            $this->session->set_flashdata('success', 'Nama Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Nama Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    //Edit Nama Karyawan
    function edit_jabatan_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $kd_jbt = $this->input->post('kd_jbt');
        if(!empty($kd_jbt)){
            $data = array(
                'kd_jbt' => $kd_jbt,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Jabatan Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Jabatan Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    //Edit Dept Karyawan
    function edit_dept_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $kd_dept = $this->input->post('kd_dept');
        if(!empty($kd_dept)){
            $data = array(
                'kd_dept' => $kd_dept,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Departemen Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Departemen Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    //Edit Status Karyawan
    function edit_status_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $status_karyawan = $this->input->post('status_karyawan');
        if(!empty($status_karyawan)){
            $data = array(
                'status_karyawan' => $status_karyawan,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Status Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Status Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    function edit_kontrak_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $kontrak = $this->input->post('kontrak');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data = array(
            'kontrak' => $kontrak,
            'start_date' => $start_date,
            'end_date' => $end_date,
        );
        $data_temp = array(
            'id' => ' ',
            'no_finger' => $no_finger,
            'kontrak' => $kontrak,
            'start_date' => $start_date,
            'end_date' => $end_date,
        );
        if(!empty($data) && !empty($data_temp)){
          
            $this->Master_data->update_data($where,$data,'tb_karyawan');
            $this->Master_data->insert_data($data_temp,'tb_kontrak_temp');
            $this->session->set_flashdata('success', 'Kontrak Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Kontrak Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
    //Edit No.KTP Karyawan
    function edit_no_ktp_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $no_ktp = $this->input->post('no_ktp');
        if(!empty($no_ktp)){
            $data = array(
                'no_ktp' => $no_ktp,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'No.KTP Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Nomor KTP Karyawan Gagal Dirubah.');
        }
       
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    //Edit Alamat Karyawan
    function edit_alamat_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $alamat = $this->input->post('alamat');
        if(!empty($alamat)){
            $data = array(
                'alamat' => $alamat,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Alamat Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Alamat Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

    //Edit status menikah Karyawan
    function edit_status_menikah_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $status_menikah = $this->input->post('status_menikah');
        if(!empty($status_menikah)){
            $data = array(
                'status_menikah' => $status_menikah,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Status Menikah Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Status Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
     //Edit Email Karyawan
     function edit_email_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $email = $this->input->post('email');
        if(!empty($email)){
            $data = array(
                'email' => $email,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Email Karyawan Berhasil Dirubah.');
        }else{
            $this->session->set_flashdata('error', 'Email Karyawan Gagal Dirubah.');
        }
      
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }

     //Edit agama Karyawan
     function edit_agama_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $agama = $this->input->post('agama');
        if (!empty($agama)) {
            $data = array(
                'agama' => $agama,
            );
            
            // Update data karyawan dengan kondisi $where
            $this->Master_data->update_data($where, $data, 'tb_data_diri');
            $this->session->set_flashdata('success', 'Agama Karyawan Berhasil Dirubah.');
        } else {
            // Jika input 'agama' kosong, tampilkan pesan error
            $this->session->set_flashdata('error', 'Agama tidak boleh kosong.');
        }
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
 //Edit Tgl_lahir Karyawan   
    function edit_tgl_lahir_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        $tgl_lahir = $this->input->post('tgl_lahir');
       
        if (!empty($tgl_lahir)) {
            $data = array(
                'tgl_lahir' => $tgl_lahir,
            );
            // Update data karyawan dengan kondisi $where
             $this->Master_data->update_data($where, $data, 'tb_data_diri');
            $this->session->set_flashdata('success', 'Tanggal Lahir Karyawan Berhasil Dirubah.');
           
        } else {
            // Jika input 'jk' kosong, tampilkan pesan error
            $this->session->set_flashdata('error', 'Tanggal Lahir tidak boleh kosong');
        }
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
    //Edit Jenis Kelamin Karyawan   
    function edit_jk_karyawan($no_finger){
        $where = array('no_finger' => $no_finger);
        $jk = $this->input->post('jk');  // Ambil inputan 'jk' dari form
       
    
        // Cek apakah input 'jk' ada isinya
        if (!empty($jk)) {
            $data = array(
                'jk' => $jk,  // Masukkan 'jk' ke dalam array data
            );
            // Update data karyawan dengan kondisi $where
             $this->Master_data->update_data($where, $data, 'tb_data_diri');
            $this->session->set_flashdata('success', 'Jenis Kelamin Karyawan Berhasil Dirubah.');
           
        } else {
            // Jika input 'jk' kosong, tampilkan pesan error
            $this->session->set_flashdata('error', 'Jenis Kelamin tidak boleh kosong.');
        }
    
        // Redirect kembali ke halaman detail karyawan
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
    function edit_tmp_lahir_karyawan($no_finger){
        $where = array('no_finger' => $no_finger);
        $tmp_lahir = $this->input->post('tmp_lahir');  // Ambil inputan 'jk' dari form
       
    
        // Cek apakah input 'jk' ada isinya
        if (!empty($tmp_lahir)) {
            $data = array(
                'tmp_lahir' => $tmp_lahir,  // Masukkan 'jk' ke dalam array data
            );
            // Update data karyawan dengan kondisi $where
             $this->Master_data->update_data($where, $data, 'tb_data_diri');
            $this->session->set_flashdata('success', 'Tempat Lahir Karyawan Berhasil Dirubah.');
           
        } else {
            // Jika input 'jk' kosong, tampilkan pesan error
            $this->session->set_flashdata('error', 'Tempat Lahir tidak boleh kosong.');
        }
    
        // Redirect kembali ke halaman detail karyawan
        redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
    }
    


    //Edit Photo Karyawan
    function edit_photo_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        
        $photo_path		=$_FILES['photo_path'];
        $config['upload_path'] = './assets/foto';
        $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf|mp4';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('photo_path')){
            echo "Upload Gagal"; 
            $this->session->set_flashdata('error', 'Photo Karyawan Gagal Dirubah.');
            redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
            die();
            
        }else{
            $photo_path=$this->upload->data('file_name');
            $data = array(
                'photo_path' => $photo_path,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'Photo Karyawan Berhasil Dirubah.');
            redirect(base_url().'c_karyawan/v_detail/'.$no_finger);

        }
       
    }
     //Edit Photo Karyawan
     function edit_file_karyawan($no_finger){
        $where=array('no_finger' => $no_finger);
        
        $attachement_file		=$_FILES['attachement_file'];
        $config['upload_path'] = './assets/foto';
        $config['allowed_types'] = 'jpg|png|gif|jpeg|pdf|mp4';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('attachement_file')){
            echo "Upload Gagal"; 
            $this->session->set_flashdata('error', 'File Karyawan Gagal Dirubah.');
            redirect(base_url().'c_karyawan/v_detail/'.$no_finger);
            die();
            
        }else{
            $attachement_file=$this->upload->data('file_name');
            $data = array(
                'attachment_file' => $attachement_file,
            );
            $this->Master_data->update_data($where,$data,'tb_data_diri');
            $this->session->set_flashdata('success', 'File Karyawan Berhasil Dirubah.');
            redirect(base_url().'c_karyawan/v_detail/'.$no_finger);

        }
       
    }

    function export_excel(){
        $date = date('Y-m-d H:i:s');
        $data['title']= "Data Karyawan $date ";
        $data['get_karyawan_lengkap'] = $this->Master_data->get_data('v_karyawan_lengkap')->result();
        $this->load->view('SuperAdmin/master-data/data-karyawan/export_excel',$data);

    }

}