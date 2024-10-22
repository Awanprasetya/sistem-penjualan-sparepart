<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_user_manage extends CI_Controller{
 
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
        $data['title'] = "DATA USER";
        $data['get_user'] = $this->Master_data->get_data('v_user_login')->result();
        $data['get_karyawan'] = $this->Master_data->get_karyawan_order_asc();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/master-data/data-user-manage/v_user',$data);
        $this->load->view('SuperAdmin/master-data/data-user-manage/modal_add',$data);
        $this->load->view('SuperAdmin/master-data/data-user-manage/modal_edit',$data);
        $this->load->view('__footer');

    }
   
    public function insertUser(){
        $no_finger = $this->input->post('no_finger');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $status = $this->input->post('status');

        $data = array(
            'id' => ' ',
            'no_finger' => $no_finger,
            'username' => $username,
            'password' => md5($password),
            'role' => $role,
            'status' => $status,
        );

        if(!empty($data)){
            $this->Master_data->insert_data($data,'user');
            $this->session->set_flashdata('success', 'Data  Berhasil Disimpan');
        }else{
            $this->session->set_flashdata('error', 'Data Gagal Disimpan');

        }
      

        redirect(base_url().'c_user_manage/index');
    }

    function editUser($id){
        $where=array('id' => $id);
        $no_finger = $this->input->post('no_finger');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $status = $this->input->post('status');

        $data = array(
            'no_finger' => $no_finger,
            'username' => $username,
            'password' => md5($password),
            'role' => $role,
            'status' => $status,

        );

        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'user');
            $this->session->set_flashdata('success', 'Data  Berhasil Dirubah');

        }else{
            $this->session->set_flashdata('error', 'Data  Gagal Dirubah');

        }
       
        redirect(base_url().'c_user_manage/index');
    }

    function delete($id)
    {
        $where = array('id' => $id);
        
        if ($where ) {
            // Jika penghapusan berhasil
            $this->Master_data->delete_data($where, 'user');
    
            $this->session->set_flashdata('success', 'Data User Berhasil Dihapus');
        } else {
            // Jika penghapusan gagal
            $this->session->set_flashdata('error', 'Data Cuti Gagal Dihapus ');
        }
    
        redirect(base_url().'c_user_manage/index');
    }
    function export_excel(){
        $date = date('Y-m-d H:i:s');
        $data['title']= "Data User $date ";
        $data['get_user'] = $this->Master_data->get_data('user')->result();
        $this->load->view('SuperAdmin/master-data/data-user-manage/export_excel',$data);
    
    }
}