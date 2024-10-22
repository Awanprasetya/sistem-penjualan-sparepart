<link href="<?php echo base_url('assets/DataTables/datatables.min.css');?>" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tunjangan</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Data Tunjangan</a></li>
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
                    <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                    <a class="btn btn-outline-warning" ><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                </div>
            </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-10 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Data Tunjangan</h6>
                </div>
                <div class="card-body">
               
               
                    <div class="table-responsive">
                <table id="example" class="table table-bordered Datatables">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tunjangan</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($get_tunjangan as $n ){
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $n->nama_tunjangan;?></td>
                            <td><?= number_format($n->jumlah,1); ?></td>
                            <td>
                            
                             
                              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id_tunjangan?>" style="color:white;"><i class="fa fa-edit" ></i>&nbsp;Edit</a>
                              <button class="btn btn-danger btn-sm" onclick="deleteTunjangan('<?php echo $n->id_tunjangan; ?>')">Hapus</button>                            
                            
                               
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
function deleteTunjangan(id_tunjangan) {
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
            window.location.href = "<?php echo base_url('c_potongan/delete/'); ?>" + id_tunjangan;
        }
    })
}
</script>