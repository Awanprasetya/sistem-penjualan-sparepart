<link href="<?php echo base_url('assets/DataTables/datatables.min.css');?>" rel="stylesheet">

<div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Filter Data Kendaraan</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Filter Data Kendaraan</a></li>
          </ol>
        
            <div class="row mb-3">
                <div class="col">
                    <a class="btn btn-outline-primary"  href="<?php echo base_url().'c_kendaraan/'?>" >Kembali</a>
                    <a class="btn btn-outline-warning" ><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                    
                </div>
            </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-10 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Filter Data Kendaraan </h6>
                </div>
                <div class="card-body">
                
                    <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Merk</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($results as $n ){
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $n->merk; ?></td>
                            <td><?= $n->nama;?></td>
                            <td><?= $n->tipe;?></td>
                            <td><?= 'Rp.'.number_format($n->harga);?></td>
                            <td>
                            
                             
                              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id?>" style="color:white;"><i class="fa fa-edit" ></i>&nbsp;Edit</a>
                              <a class="btn btn-danger btn-sm" href="<?php echo base_url().'c_kendaraan/delete/'.$n->id;?>" onclick="return confirm('Yakin ingin menghapus data kendaraan ini :<?= $n->id; ?> ?');"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                            
                               
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

