



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="loading">
  <div class="spinner"></div>
</div>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title;?></h1>
  </div>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="#"><?php echo $title;?></a></li>
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
      <a class="btn btn-outline-primary" href="<?php echo base_url().'dashboard'?>" >Kembali</a>
      <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
      <a class="btn btn-outline-warning" href="<?php echo base_url().'c_user_manage/export_excel'?>"><i class="fa fa-print"></i>&nbsp;Export To Excel</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-9">
          <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-bordered Datatables">
              <thead>
                <tr style="font-size:small;">
                  <th>No.</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Satuan</th>
                  <th>Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_barang as $n ){
                ?>
                <tr style="font-size:small;">
                  <td><?= $no++; ?></td>
                  <td><?= $n->kd_barang;?></td>
                  <td><?= $n->nm_barang; ?></td>
                  <td><?= number_format($n->harga_beli);?></td>
                  <td><?= number_format($n->harga_jual); ?></td>
                  <td><?= $n->satuan; ?></td>
                  <td><?= $n->kategori; ?></td>
                  
                  <td>
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->kd_barang?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser('<?php echo $n->kd_barang; ?>')">Hapus</button>
                  </td>
                
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
function deleteUser(kd_barang) {
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
            window.location.href = "<?php echo base_url('c_barang/delete/'); ?>" + kd_barang;
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