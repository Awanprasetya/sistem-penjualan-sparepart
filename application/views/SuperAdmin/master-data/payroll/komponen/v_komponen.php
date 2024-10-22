
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
            <h1 class="h3 mb-0 text-gray-800">Data Komponen</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Data Komponen</a></li>
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
                    <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                    <a class="btn btn-outline-warning" ><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                    <a class="btn btn-outline-secondary" onclick="resetFunction()"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Reset</a>
                    </div>
            </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Data Komponen</h6>
                </div>
                <div class="card-body">
               
               
                <div class="table-responsive">
  <table id="example" class="table table-bordered Datatables">
    <thead>
      <tr>
        <th style="font-size: 12px; text-align: center;">No.</th>
        <th style="font-size: 12px; text-align: center;">Nomor&nbsp;Finger</th>
        <th style="font-size: 12px; text-align: center;">Nama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
        <th style="font-size: 12px; text-align: center;">Status</th>
        <th style="font-size: 12px; text-align: center;">Kategori&nbsp;Gaji</th>
        <th style="font-size: 12px; text-align: center;">Gaji&nbsp;Pokok</th>
        <th style="font-size: 12px; text-align: center;">T.Transpor</th>
        <th style="font-size: 12px; text-align: center;">T.Kehadiran</th>
        <th style="font-size: 12px; text-align: center;">T.Jabatan</th>
        <th style="font-size: 12px; text-align: center;">P.Jamsostek</th>
        <th style="font-size: 12px; text-align: center;">P.BPJS</th>
        <th style="font-size: 12px; text-align: center;">P.Alpha</th>
        <th style="font-size: 12px; text-align: center;">P.Piutang</th>
        <th style="font-size: 12px; text-align: center;">Lemburan</th>
        <th style="font-size: 12px; text-align: center;">Action&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      foreach($get_payroll as $n ){
      ?>
        <tr>
          <td style="font-size: 12px;"><?= $no++; ?></td>
          <td style="font-size: 12px;"><?=$n->no_finger;?></td>
          <td style="font-size: 12px;"><?=$n->nm_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->status_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->kategori;?></td>
          <td style="font-size: 12px;"><?=number_format($n->gp);?></td>
          <td style="font-size: 12px;"><?=number_format($n->t_transport);?></td>
          <td style="font-size: 12px;"><?=number_format($n->t_kehadiran);?></td>
          <td style="font-size: 12px;"><?=number_format($n->t_jabatan);?></td>
          <td style="font-size: 12px;"><?=number_format($n->p_jamsostek);?></td>
          <td style="font-size: 12px;"><?=number_format($n->p_bpjs);?></td>
          <td style="font-size: 12px;"><?=number_format($n->p_alpha);?></td>
          <td style="font-size: 12px;"><?=number_format($n->p_piutang);?></td>
          <td style="font-size: 12px;"><?=number_format($n->t_lemburan);?></td>
          <td style="font-size: 12px;">
              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
              <button class="btn btn-danger btn-sm" onclick="deleteKomponen('<?php echo $n->id; ?>')">Hapus</button>
          </td>

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
<script>
  function resetFunction() {
    // Ambil ID karyawan atau data lain yang diperlukan // Ganti dengan ID yang sesuai jika perlu

    // Tampilkan konfirmasi sebelum mereset
    Swal.fire({
        title: 'Yakin ingin mereset data?',
        text: "Data akan dikosongkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Lakukan request ke controller untuk mereset lemburan
            window.location.href = "<?php echo base_url('c_komponen/reset/'); ?>" ;
        }
    });
}

</script>
