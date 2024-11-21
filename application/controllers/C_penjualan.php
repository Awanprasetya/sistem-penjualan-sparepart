<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class C_penjualan extends CI_Controller{
 
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
        $data['title'] = "DATA PENJUALAN";
        $data['get_penjualan'] = $this->Master_data->get_data_penjualan();
        $data['get_barang'] = $this->Master_data->get_data('tb_barang')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/menus/data-penjualan/v_penjualan',$data);
        $this->load->view('SuperAdmin/menus/data-penjualan/modal_add',$data);
        $this->load->view('__footer');

    }

    function v_detail($no_faktur){
        $data['title'] = "Detail Nomor Faktur";
        $data['get_data_penjualan_by_id'] = $this->Master_data->get_data_penjualan_by_id($no_faktur);
        $data['get_barang'] = $this->Master_data->get_data('tb_barang')->result();
        $this->load->view('__header');
        $this->load->view('SuperAdmin/menus/data-penjualan/v_detail',$data);
        $this->load->view('SuperAdmin/menus/data-penjualan/modal_add',$data);
        $this->load->view('__footer');

    }
   
    public function insertPenjualan()
    {
        $kd_barang = $this->input->post('kd_barang'); // Array kode barang
        $jumlah = $this->input->post('jumlah'); // Array jumlah barang
    
        $error_stok = [];
        foreach ($kd_barang as $key => $kode) {
            $stok = $this->db->get_where('tb_barang', ['kd_barang' => $kode])->row()->stok;
    
            if ($jumlah[$key] > $stok) {
                $error_stok[] = "Barang dengan kode $kode memiliki stok tidak mencukupi. Stok tersedia: $stok, jumlah diminta: {$jumlah[$key]}";
            }
        }
    
        if (!empty($error_stok)) {
            $this->session->set_flashdata('error', implode('<br>', $error_stok));
            redirect(base_url().'c_penjualan/index'); // Redirect ke halaman tambah penjualan
            return;
        }
    
        // Jika validasi lolos, simpan data
        foreach ($kd_barang as $key => $kode) {
            $data = [
                'kd_barang' => $kode,
                'jumlah' => $jumlah[$key],
                'harga_satuan' => $this->input->post('harga_satuan')[$key],
                'harga_total' => $this->input->post('harga_total')[$key],
                'no_faktur' => $this->input->post('no_faktur'),
                'nm_konsumen' => $this->input->post('nm_konsumen'),
            ];
            $this->Master_data->insert_data($data,'tb_penjualan');
    
            // Kurangi stok
            $this->db->set('stok', 'stok - ' . $jumlah[$key], FALSE)
                     ->where('kd_barang', $kode)
                     ->update('tb_barang');
        }
    
        $this->session->set_flashdata('success', 'Data penjualan berhasil disimpan.');
        redirect(base_url().'c_penjualan/index');
    }
    
    

    function editBarang($kd_barang){
        $where=array('kd_barang' => $kd_barang);
        $nm_barang = $this->input->post('nm_barang');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $satuan = $this->input->post('satuan');
        $kategori = $this->input->post('kategori');

        $data = array(
            'nm_barang' => $nm_barang,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'satuan' => $satuan,
            'kategori' => $kategori,

        );

        if(!empty($data)){
            $this->Master_data->update_data($where,$data,'tb_barang');
            $this->session->set_flashdata('success', 'Data  Berhasil Dirubah');

        }else{
            $this->session->set_flashdata('error', 'Data  Gagal Dirubah');

        }
       
        redirect(base_url().'c_barang/index');
    }

    function delete($no_faktur)
    {
        $where = array('no_faktur' => $no_faktur);
        
        if ($where ) {
            // Jika penghapusan berhasil
            $this->Master_data->delete_data($where, 'tb_penjualan');
    
            $this->session->set_flashdata('success', 'Data barang Berhasil Dihapus');
        } else {
            // Jika penghapusan gagal
            $this->session->set_flashdata('error', 'Data barang Gagal Dihapus ');
        }
    
        redirect(base_url().'c_penjualan/index');
    }
    function export_excel(){
        $date = date('Y-m-d H:i:s');
        $data['title']= "Data Barang $date ";
        $data['get_barang'] = $this->Master_data->get_data('tb_barang')->result();
        $this->load->view('SuperAdmin/master-data/data-barang/export_excel',$data);
    
    }
}