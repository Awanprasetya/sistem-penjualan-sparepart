<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
class Master_data extends CI_Model{	
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	function get_data($table){
		return $this->db->get($table);
	}

	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
		
	}

	function delete_data($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	function get_data_penjualan(){
		$sql = "SELECT p.id_penjualan, p.no_faktur, p.nm_konsumen,b.nm_barang,sum(p.jumlah) as jumlah,p.harga_satuan,SUM(p.harga_total) as total FROM tb_penjualan p
				LEFT JOIN tb_barang b on b.kd_barang = p.kd_barang
				WHERE 1
				GROUP BY p.no_faktur";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_data_penjualan_by_id($no_faktur){
		$sql="SELECT p.id_penjualan, p.no_faktur, p.nm_konsumen,b.nm_barang,p.jumlah,p.harga_satuan,p.harga_total  FROM tb_penjualan p
			LEFT JOIN tb_barang b on b.kd_barang = p.kd_barang
			WHERE no_faktur = '$no_faktur'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}