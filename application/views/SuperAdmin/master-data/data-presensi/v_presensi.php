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
            <h1 class="h3 mb-0 text-gray-800">Data Presensi</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Data Presensi</a></li>
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
                    <a class="btn btn-outline-primary"  href="<?php echo base_url().'dashboard/index'?>" >Kembali</a>
                    <!-- <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a> -->
                    <a class="btn btn-outline-warning" href="<?php echo base_url().'c_presensi/export_excel/'.$noFinger.'/'.$startDate.'/'.$endDate?>"><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                    
                  </div>
              </div>
              <?php if($this->session->userdata('role') == 'Pegawai'){?>

                <?php }else{?>
                  <div class="row">
                      <div class="col-lg-6 mb-4">
                          <div class="card shadow mb-4">
                              <div class="card-header py-9">
                                  <h6 class="m-0 font-weight-bold text-primary">Upload Presensi</h6>
                              </div>
                              <div class="card-body"> <!-- Menambahkan card-body untuk memisahkan konten dari header -->
                                  <?php if (isset($error)): ?>
                                      <div style="color: red;"><?php echo $error; ?></div>
                                  <?php endif; ?>
                                  
                                  <form id="uploadForm" method="post" enctype="multipart/form-data" action="<?php echo base_url('c_presensi/upload'); ?>">
                                      <div class="input-group mb-3">
                                          <input type="file" name="file_excel" class="form-control" required>
                                          <div class="input-group-append">
                                              <button class="btn btn-outline-success" type="submit">
                                                  <i class="fa fa-upload"></i>&nbsp;Upload
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                              </div> <!-- Tutup card-body -->
                          </div>
                      </div>
                  </div>
                  <?php }?>
              

           
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Data Presensi</h6>
                </div>
                
                <div class="card-body">
                <div id="loading" style="display: none; text-align: center;">
                  <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
              </div>
                <div class="table-responsive">
                <div class="row mb-3">
                  <div class="col-lg-6">
                  <form id="filterForm" method="GET" action="<?php echo base_url('c_presensi/index'); ?>">
                    <div class="input-group mb-3">
                        <input type="date" id="startDate" name="start_date" class="form-control" placeholder="Tanggal Awal">
                        <input type="date" id="endDate" name="end_date" class="form-control" placeholder="Tanggal Akhir">
                        <?php if($this->session->userdata('role') == 'Pegawai'){?>
                          <input type="text" id="noFinger" name="no_finger" class="form-control" value="<?php echo $this->session->userdata('no_finger')?>" placeholder="Nomor Finger" hidden>
                          <input type="text" id="noFinger" name="no_finger" class="form-control" value="<?php echo $this->session->userdata('no_finger')?>" placeholder="Nomor Finger" disabled>
                          <?php }else{?>
                            <input type="text" id="noFinger" name="no_finger" class="form-control" placeholder="Nomor Finger">
                            <?php } ?>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>

                  </div>
              </div>
                <table id="example" class="table table-bordered Datatables">
                    <thead>
                        <tr style="font-size: smaller;">
                            <th>No.</th>
                            <th>Nomor&nbsp;Finger</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Scan&nbsp;Masuk</th>
                            <th>Scan&nbsp;Pulang</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($get_presensi as $n ){
                        ?>
                        <tr style="font-size: smaller;">
                            <td><?= $no++; ?></td>
                            <td><?= $n->no_finger;?></td>
                            <td><?= $n->nm_karyawan;?></td>
                            <td><?= $n->tgl_presensi; ?></td>
                            <td><span class="badge badge-success"><?= $n->scan_masuk; ?></span></td>
                            <td><span class="badge badge-danger"><?= $n->scan_pulang; ?></span></td>
                            <td>
                            
                             
                              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id?>" style="color:white;"><i class="fa fa-edit" ></i>&nbsp;Edit</a>
                              <button class="btn btn-danger btn-sm" onclick="deletePresensi('<?php echo $n->id; ?>')">Hapus</button>                            
                            
                               
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
<script>
      document.getElementById('uploadForm').onsubmit = function(e) {
    e.preventDefault(); // Mencegah form dari pengiriman default

    const formData = new FormData(this);
    Swal.fire({
        title: 'Mengupload...',
        html: 'Mohon tunggu, sedang mengupload data.',
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        Swal.close(); // Tutup SweetAlert loading
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message
            }).then(() => {
                location.reload(); // Muat ulang halaman setelah notifikasi
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message // Tampilkan pesan error dari server
            });
        }
    })
    .catch(error => {
        Swal.close(); // Tutup SweetAlert loading
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat mengupload data.'
        });
        console.error('Error:', error); // Tambahkan log kesalahan ke console
    });
};



    </script>

<script src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
  <script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>

<script>
new DataTable('#example');

</script>

<script>
function deletePresensi(id) {
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
            window.location.href = "<?php echo base_url('c_presensi/delete/'); ?>" + id;
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