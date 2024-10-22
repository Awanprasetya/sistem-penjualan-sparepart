
<style>
  /* Gradient background untuk tabel */
  #example {
    background: linear-gradient(to right, #4e73df, #2e59d9); /* Gradient biru */
    color: white;
  }
  #example thead {
    background: linear-gradient(to right, #4e73df, #2e59d9); /* Warna header tabel */
  }
  #example tbody tr {
    background: rgba(255, 255, 255, 0.1); /* Efek transparan untuk baris tabel */
  }
  #example tbody tr:hover {
    background: rgba(255, 255, 255, 0.2); /* Efek hover saat baris disorot */
  }

  /* Ubah warna teks untuk tabel */
  #example th, #example td {
    color: white; /* Menjaga warna teks putih */
  }
  #example td {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Border bawah baris tabel */
  }
   /* Mengubah ukuran tombol pada tabel */
   #example .btn {
    padding: 10px 20px; /* Mengubah ukuran tombol */
    font-size: 14px; /* Mengatur ukuran teks dalam tombol */
    border-radius: 25px; /* Membuat tombol berbentuk rounded */
  }

  /* Menambahkan padding lebih pada tombol action */
  #example .btn-sm {
    padding: 8px 15px; /* Ukuran tombol kecil */
    font-size: 13px; /* Ukuran font lebih kecil */
    border-radius: 25px; /* Menjaga bentuk rounded */
  }

  /* Menambahkan efek hover pada tombol */
  #example .btn:hover {
    opacity: 0.9; /* Efek transparansi saat tombol dihover */
    transition: 0.3s; /* Animasi halus saat hover */
  }

  /* Mengatur warna tombol untuk aksi */
  #example .btn-primary {
    background-color:mediumseagreen;
    border-color: #4e73df;
  }
  #example .btn-warning {
    background-color: #f6c23e;
    border-color: #f6c23e;
  }
  #example .btn-danger {
    background-color: #e74a3b;
    border-color: #e74a3b;
  }

  /* Menjaga agar tombol tetap konsisten saat loading atau disabled */
  #example .btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
  #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.8);
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .spinner {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
<link href="<?php echo base_url('assets/DataTables/datatables.min.css');?>" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="loading">
  <div class="spinner"></div>
</div>
<div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Riwayat Gaji</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Riwayat Gaji</a></li>
          </ol>
          <?php
          $success = $this->session->flashdata('success');
          $error = $this->session->flashdata('error');

          // Hapus flashdata secara manual
          $this->session->unset_userdata('success');
          $this->session->unset_userdata('error');
          ?>
          <?php if(!empty($success)): ?>
            <?php echo $success; ?>
						
						<?php endif; ?>

						<!-- Cek apakah flashdata 'error' ada dan tidak kosong -->
						<?php if(!empty($error)): ?>
              <?php echo $error; ?>
	          <?php endif; ?>
          <?php echo $this->session->flashdata('success');?>
            <div class="row mb-3">
                <div class="col">
                    <a class="btn btn-outline-primary"  href="<?php echo base_url().'c_payroll/index'?>" >Kembali</a>
                    <a class="btn btn-outline-warning" ><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                </div>
            </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Riwayat Gaji</h6>
                </div>
                <div class="card-body">
               
               
                <div class="table-responsive">
                <div class="row mb-3">
                  <div class="col-lg-6">
                  <form id="filterForm" method="GET" action="<?php echo base_url('c_riwayat_gaji/'); ?>">
                    <div class="input-group mb-3">
                        <select name="startDate" id="startDate" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desemeber</option>
                        </select>
                        <select name="startYears" id="startYears" class="form-control">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                

                  </div>
              </div>
  <table id="example" class="table table-bordered Datatables">
    <thead>
      <tr>
        <th style="font-size: 12px; text-align: center;">No.</th>
        <th style="font-size: 12px; text-align: center;">Nomor&nbsp;Finger</th>
        <th style="font-size: 12px; text-align: center;">Nama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
        <th style="font-size: 12px; text-align: center;">Departemen</th>
        <th style="font-size: 12px; text-align: center;">Jabatan</th>
        <th style="font-size: 12px; text-align: center;">Status</th>
        <th style="font-size: 12px; text-align: center;">Kategori&nbsp;Gaji</th>
        <th style="font-size: 12px; text-align: center;">Gaji&nbsp;Pokok</th>
        <th style="font-size: 12px; text-align: center;">T.Transpor</th>
        <th style="font-size: 12px; text-align: center;">T.Kehadiran</th>
        <th style="font-size: 12px; text-align: center;">T.Jabatan</th>
        <th style="font-size: 12px; text-align: center;">Total&nbsp;Presensi</th>
        <th style="font-size: 12px; text-align: center;">Gaji&nbsp;Bruto</th>
        <th style="font-size: 12px; text-align: center;">P.Jamsostek</th>
        <th style="font-size: 12px; text-align: center;">P.BPJS&nbsp;Kesehatan</th>
        <th style="font-size: 12px; text-align: center;">P.Alpha</th>
        <th style="font-size: 12px; text-align: center;">P.Piutang</th>
        <th style="font-size: 12px; text-align: center;">Total&nbsp;Gaji</th>
        <th style="font-size: 12px; text-align: center;">Lemburan</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      foreach($tb_payroll_saved as $n ){
      ?>
        <tr>
          <td style="font-size: 12px;"><?= $no++; ?></td>
          <td style="font-size: 12px;"><?=$n->no_finger;?></td>
          <td style="font-size: 12px;"><?=$n->nm_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->nm_dept;?></td>
          <td style="font-size: 12px;"><?=$n->nm_jbt;?></td>
          <td style="font-size: 12px;"><?=$n->status_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->kategori;?></td>
          <td style="font-size: 12px;"><?=number_format($n->gp);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_transport);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_kehadiran);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_jabatan);?></span></td>
          <td style="font-size: 12px;"><?=number_format($n->total_presensi);?></td>
          <td style="font-size: 12px;"><?=number_format($n->gaji_bruto);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->potongan_jamsostek);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->potongan_bpjs_kesehatan);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->p_alpha);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->p_piutang);?></span></td>
          <td style="font-size: 12px;"><?=number_format($n->total_gaji);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_lemburan);?></span></td>
          <!-- <td style="font-size: 12px;">
              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
              <button class="btn btn-danger btn-sm" onclick="deleteKomponen('<?php echo $n->id; ?>')">Hapus</button>
          </td> -->

        </tr>
      <?php }?>
    </tbody>
  </table>
</div>
                </div>
              </div>          
            </div>

            
          </div>
		 <!-- oontent row 2-->

</div> <!-- /.container-fluid -->
<!-- end of content-->
</div>
<script src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
  <script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>

<script>
new DataTable('#example');

</script>

<script>
function deleteKomponen(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data ini tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke fungsi delete di controller
            window.location.href = "<?php echo base_url('c_komponen/delete/'); ?>" + id;
        }
    })
}
</script>
<script>
  // Tampilkan loading saat halaman dimuat
  $(window).on('load', function() {
    // Hilangkan loading setelah halaman selesai dimuat
    $('#loading').fadeOut('slow');
  });
</script>