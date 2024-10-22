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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="loading">
  <div class="spinner"></div>
</div>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
  </div>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#">Data Karyawan</a></li>
  </ol>

  <?php
  $success = $this->session->flashdata('success');
  $error = $this->session->flashdata('error');
  $this->session->unset_userdata('success');
  $this->session->unset_userdata('error');
  ?>

  <!-- Flash Messages -->
  <?php if(!empty($success)): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo $success; ?>',
        showConfirmButton: true
      });
    </script>
  <?php endif; ?>

  <?php if(!empty($error)): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo $error; ?>',
        showConfirmButton: true
      });
    </script>
  <?php endif; ?>

  <div class="row mb-3">
    <div class="col">
      <a class="btn btn-outline-primary" href="<?php echo base_url().'dashboard/index'?>" >Kembali</a>
      <!-- <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a> -->
      <a class="btn btn-outline-warning" href="<?php echo base_url().'c_resign/export_excel'?>"><i class="fa fa-print"></i>&nbsp;Export To Excel</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9 mb-4">
      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-9">
          <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-bordered Datatables">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No Finger</th>
                  <th>Nomor Induk Pegawai</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_karyawan_resign as $n ){
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->nik; ?></td>
                  <td><?= $n->nm_karyawan; ?></td>
                  <td><?= $n->status_karyawan; ?></td>
                  <td><?= $n->end_date; ?></td>
                  
                
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
<script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>
<script>
  new DataTable('#example');
</script>

<script>
function deleteKaryawan(no_finger) {
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
            window.location.href = "<?php echo base_url('c_karyawan/delete_karyawan/'); ?>" + no_finger;
        }
    });
}
</script>
<script>
  // Tampilkan loading saat halaman dimuat
  $(window).on('load', function() {
    // Hilangkan loading setelah halaman selesai dimuat
    $('#loading').fadeOut('slow');
  });
</script>