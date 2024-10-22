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

    function get_kendaraan_by_jenis(){
        $sql = "SELECT * FROM `tb_kendaraan` WHERE 1 GROUP BY nama";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function filter_kendaraan($merk, $nama, $tipe){
        if($merk == "" && $nama == "" && $tipe == ""){
            $sql = "SELECT k.id, k.merk, k.nama, k.tipe, k.harga FROM `tb_kendaraan` k 
            WHERE 1 ";
            $query = $this->db->query($sql);
        }else{
            $sql = "SELECT k.id, k.merk, k.nama, k.tipe, k.harga FROM `tb_kendaraan` k 
            WHERE k.merk = '$merk' and k.nama='$nama' and k.tipe='$tipe' ";
            $query = $this->db->query($sql);
            
        }
        return $query->result();
       

    }

	function get_data_diri($no_finger){
		$sql = "SELECT * FROM tb_data_diri 
		LEFT JOIN tb_kontrak tbk on tbk.no_finger = tb_data_diri.no_finger
		LEFT JOIN tb_karyawan tk on tk.no_finger = tb_data_diri.no_finger
		LEFT JOIN tb_department tbd on tbd.kd_dept = tb_data_diri.kd_dept
		LEFT JOIN tb_jabatan tbj on tbj.kd_jbt = tb_data_diri.kd_jbt
		WHERE tk.no_finger = $no_finger";
        $query = $this->db->query($sql);
        return $query->result();
	}
	function get_kontrak_temp($no_finger){
		$sql = "SELECT * FROM tb_kontrak_temp WHERE no_finger = $no_finger order by id desc";
        $query = $this->db->query($sql);
        return $query->result();
	}

	function get_karyawan_order_asc(){
		$sql = "SELECT * FROM tb_karyawan WHERE 1 order by nm_karyawan asc";
        $query = $this->db->query($sql);
        return $query->result();
	}

	function get_shift_karyawan(){
		$sql = "SELECT tbs.id_shift, tbks.id_karyawan_shift, tbks.no_finger, tbk.nik,tbk.nm_karyawan,tbs.shift_name, tbks.shift_date FROM `tb_karyawan_shift` tbks 
		LEFT JOIN tb_karyawan tbk on tbk.no_finger = tbks.no_finger
		LEFT JOIN tb_shift tbs on tbs.id_shift = tbks.id_shift
		WHERE 1";
        $query = $this->db->query($sql);
        return $query->result();
	}

	function get_karyawan_presensi($no_finger, $start_date, $end_date) {
		// Gunakan prepared statement untuk keamanan terhadap SQL Injection
		$sql = "SELECT 
					tbp.id, 
					tbp.no_finger, 
					tbk.nm_karyawan,  
					tbp.tgl_presensi, 
					tbp.scan_masuk, 
					tbp.scan_pulang 
				FROM tb_presensi tbp 
				LEFT JOIN tb_karyawan tbk ON tbk.no_finger = tbp.no_finger
				WHERE tbp.no_finger = ? 
				AND tbp.tgl_presensi BETWEEN ? AND ?
				group by tgl_presensi";
		
		// Jalankan query dengan parameter untuk menghindari SQL Injection
		$query = $this->db->query($sql, array($no_finger, $start_date, $end_date));
		
		return $query->result();
	}

	function get_karyawan_komponen(){
		$sql = "SELECT *,k.nm_karyawan, k.awal_masuk, dd.status_karyawan FROM tb_payroll p 
		LEFT JOIN tb_karyawan k on k.no_finger = p.no_finger
		LEFT JOIN tb_data_diri dd on dd.no_finger = k.no_finger
		WHERE 1";
        $query = $this->db->query($sql);
        return $query->result();
	}

	function get_payroll_karyawan($startDate, $endDate){
		$sql="SELECT 
				k.no_finger, 
				k.nm_karyawan, 
				tbj.nm_jbt,
				tbd.nm_dept,
				tdd.status_karyawan,
				tdd.norek,
				tdd.bank,
				p.kategori,
				p.gp, 
				p.t_transport,
				p.t_kehadiran,
				p.t_jabatan,
				p.t_lemburan,
				(p.gp * (p.p_jamsostek / 100) ) as potongan_jamsostek,
				(p.gp * (p.p_bpjs / 100)  ) as potongan_bpjs_kesehatan,
				p.p_alpha * 92000 as p_alpha,
				p.p_piutang, 
				COUNT(DISTINCT tbp.tgl_presensi) as total_presensi,
				CASE 
					WHEN p.kategori = 'harian' THEN 
						((p.gp * COUNT(DISTINCT tbp.tgl_presensi)) + p.t_jabatan + p.t_transport + p.t_kehadiran)
					WHEN p.kategori = 'bulanan' THEN 
						(p.gp + p.t_jabatan + p.t_transport + p.t_kehadiran)
				END AS gaji_bruto,
				-- Total Gaji berdasarkan kategori
				CASE 
					WHEN p.kategori = 'harian' THEN 
						((p.gp * COUNT(DISTINCT tbp.tgl_presensi)) + p.t_jabatan + p.t_transport + p.t_kehadiran + p.t_lemburan - (p.gp * (p.p_jamsostek /100)) - p.p_alpha * 92000 - p.p_piutang)
					WHEN p.kategori = 'bulanan' THEN 
						(p.gp + p.t_jabatan + p.t_transport + p.t_kehadiran + p.t_lemburan - (p.gp * (p.p_jamsostek / 100)) - p.p_alpha * 92000 - p.p_piutang)
				END AS total_gaji,
				-- Perhitungan Total Gaji untuk Dua Minggu Sekali
				CASE 
					WHEN p.kategori = 'harian' THEN 
						(((p.gp * COUNT(DISTINCT tbp.tgl_presensi)) + p.t_jabatan + p.t_transport + p.t_kehadiran  - (p.gp * (p.p_jamsostek /100)) - (p.p_alpha * 92000 - p.p_piutang)) / 2 + p.t_lemburan)
					WHEN p.kategori = 'bulanan' THEN 
						((p.gp + p.t_jabatan + p.t_transport + p.t_kehadiran  - (p.gp * (p.p_jamsostek / 100)) - (p.p_alpha * 92000 - p.p_piutang )) / 2 + p.t_lemburan)
				END AS week1, 
				CASE  
					WHEN p.kategori = 'harian' THEN 
						(((p.gp * COUNT(DISTINCT tbp.tgl_presensi)) + p.t_jabatan + p.t_transport + p.t_kehadiran - (p.gp * (p.p_jamsostek /100)) - (p.p_alpha * 92000 - p.p_piutang)) / 2 )
					WHEN p.kategori = 'bulanan' THEN 
						((p.gp + p.t_jabatan + p.t_transport + p.t_kehadiran - (p.gp * (p.p_jamsostek / 100)) - (p.p_alpha * 92000 - p.p_piutang)) / 2)
				END AS week2
			FROM tb_payroll p
			LEFT JOIN tb_karyawan k ON k.no_finger = p.no_finger
			LEFT JOIN tb_presensi tbp ON tbp.no_finger = k.no_finger
			LEFT JOIN tb_data_diri tdd ON tdd.no_finger = k.no_finger
			LEFT JOIN tb_department tbd ON tbd.kd_dept = tdd.kd_dept
			LEFT JOIN tb_jabatan tbj ON tbj.kd_jbt = tdd.kd_jbt
			WHERE tbp.tgl_presensi BETWEEN ? AND ? 
			GROUP BY k.no_finger, k.nm_karyawan, p.kategori, p.gp, p.t_transport, p.t_kehadiran, p.t_lemburan, p.p_jamsostek, p.p_alpha, p.p_piutang;
			";
			$query = $this->db->query($sql, array($startDate, $endDate));
			return $query->result();
	}

	function get_payroll_saved($startDate,$startYears){
		$sql = "SELECT *, tbk.nm_karyawan, tbd.nm_dept, tbj.nm_jbt, tbp.kategori, tdd.kd_dept 
            FROM tb_payroll_saved tps 
            LEFT JOIN tb_karyawan tbk ON tbk.no_finger = tps.no_finger
            LEFT JOIN tb_data_diri tdd ON tdd.no_finger = tps.no_finger
            LEFT JOIN tb_department tbd ON tbd.kd_dept = tdd.kd_dept
            LEFT JOIN tb_jabatan tbj ON tbj.kd_jbt = tdd.kd_jbt
            LEFT JOIN tb_payroll tbp ON tbp.no_finger = tps.no_finger
            WHERE MONTH(tps.tgl_simpan) = ? AND YEAR(tps.tgl_simpan) = ?
            GROUP BY tps.no_finger ";
		$query = $this->db->query($sql, array($startDate,$startYears));
		return $query->result();
	}

	public function get_karyawan_non_resign(){
		$sql = "SELECT tbk.id_karyawan, tbk.no_finger, tbk.nm_karyawan, tbk.nik, tbk.awal_masuk, tdd.status_karyawan FROM tb_karyawan tbk 
				LEFT JOIN tb_data_diri tdd on tdd.no_finger = tbk.no_finger
				WHERE tdd.status_karyawan != 'RESIGN'";
        $query = $this->db->query($sql);
        return $query->result();
	}

	public function get_karyawan_resign(){
		$sql = "SELECT tbk.id_karyawan, tbk.no_finger, tbk.nm_karyawan, tbk.nik, tbk.awal_masuk, tdd.status_karyawan, tbk.end_date FROM tb_karyawan tbk 
				LEFT JOIN tb_data_diri tdd on tdd.no_finger = tbk.no_finger
				WHERE tdd.status_karyawan = 'RESIGN'";
        $query = $this->db->query($sql);
        return $query->result();
	}

	public function get_sisa_cuti_by_year($tahun){
		$sql ="SELECT * FROM v_sisa_cuti WHERE tahun = '$tahun'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function get_karyawan_group_dept(){
        $sql = "SELECT d.nm_dept, count(dd.id_data_diri) as jumlah FROM tb_data_diri dd
				LEFT JOIN tb_jabatan j on j.kd_jbt = dd.kd_jbt
				LEFT JOIN tb_department d on d.kd_dept = dd.kd_dept
				WHERE 1 GROUP BY d.kd_dept";
        $query = $this->db->query($sql);
        return $query->result();
    }
	public function get_karyawan_resign_dept(){
        $sql = "SELECT dd.status_karyawan, count(dd.id_data_diri) as jumlah FROM tb_data_diri dd
				LEFT JOIN tb_jabatan j on j.kd_jbt = dd.kd_jbt
				LEFT JOIN tb_department d on d.kd_dept = dd.kd_dept
				WHERE dd.status_karyawan = 'RESIGN' GROUP BY d.kd_dept";
        $query = $this->db->query($sql);
        return $query->result();
    }
	
}