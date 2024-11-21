<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();        
        $this->load->model('M_login');
        $this->load->library('form_validation');
    }

    public function index() {
        // Cek apakah pengguna sudah login
        if ($this->session->userdata('username')) {
            redirect('dashboard'); // Redirect ke dashboard jika sudah login
        }
        $this->load->view('login'); // Tampilkan halaman login
    }

    public function authenticate() {
        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke halaman login
            $this->session->set_flashdata('error', 'Username dan Password wajib diisi.');
            redirect('login');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            // Ambil data pengguna dari database
            $user = $this->M_login->get_user_by_username($username);
			if ($user) {
				log_message('info', 'User ditemukan: ' . json_encode($user));
			} else {
				log_message('info', 'User tidak ditemukan.');
			}


            if ($user && (password_verify($password, $user->password) || $user->password == md5($password))) {
                // Regenerasi sesi untuk keamanan
                session_regenerate_id();

                // Set data sesi
                $sess_data = [
                    'username' => $user->username,
                    'role'     => $user->role,
                    'status'   => "1"
                ];
                $this->session->set_userdata($sess_data);

                // Set flashdata untuk pesan sukses
                $this->session->set_flashdata('alert_1', 
                    '<div class="alert alert-success alert-dismissible" role="alert">
                        Selamat <b>' . htmlspecialchars($user->username) . '</b>, Anda Berhasil Masuk Kedalam Sistem Bank Sampah
                        <i class="fa fa-check"></i>
                    </div>'
                );

                redirect('dashboard'); // Redirect ke dashboard
            } else {
                // Jika login gagal
                $this->session->set_flashdata('error', 'Username atau Password salah.');
                redirect('login');
            }
        }
    }

    public function logout() {
        // Hancurkan sesi dan redirect ke halaman login
        $this->session->sess_destroy();
        redirect('login');
    }
}
