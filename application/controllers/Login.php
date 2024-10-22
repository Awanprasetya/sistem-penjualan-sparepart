<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('M_login');
	}

	function index(){
		$this->load->view('login');
	}
 
	function masuk(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$lihat = $this->M_login->status("v_user_login",$where);
		if($lihat->num_rows() > 0){
			foreach ($lihat->result() as $xx) {
                    $sess_data['username'] = $xx->username;
					$sess_data['nm_karyawan'] = $xx->nm_karyawan;
					$sess_data['no_finger'] = $xx->no_finger;
                    $sess_data['role'] = $xx->role;
					$sess_data['photo_path'] = $xx->photo_path;
					$sess_data['status'] = "1";
					$this->session->sess_regenerate();
                    $this->session->set_userdata($sess_data);
                }
				$this->session->set_flashdata('alert_1', '<div class="alert alert-success alert-dismissible" role="alert">Selamat <b>'.$xx->username.'</b>, Anda Berhasil Masuk Kedalam Sistem Bank Sampah <i class="fa fa-check"></i></div>');

			redirect(base_url("dashboard"));
 
		}else{
            $this->session->set_flashdata('error', 'Akun Non-Aktif atau Username & Password Salah');
			redirect(base_url('Login'));
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
	
}
