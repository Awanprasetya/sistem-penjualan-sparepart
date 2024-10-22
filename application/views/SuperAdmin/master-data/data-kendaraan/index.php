<link href="<?php echo base_url('assets/DataTables/datatables.min.css');?>" rel="stylesheet">

<div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kendaraan</h1>
          </div>
          <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">Data Kendaraan</a></li>
          </ol>
        
          <?php echo $this->session->flashdata('alert_1');?>
            <div class="row mb-3">
                <div class="col">
                    <a class="btn btn-outline-primary"  href="<?php echo base_url().'dashboard/index'?>" >Kembali</a>
                    <a class="btn btn-outline-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                    <a class="btn btn-outline-warning" ><i class="fa fa-print"></i>&nbsp;Export To Excel</a> 
                    </form>
                </div>
            </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-10 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-9">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kendaraan </h6>
                </div>
                <div class="card-body">
                <form method="post" action="<?php echo base_url('c_kendaraan/filter_data'); ?>">
                    <div class="row mb-3">
                        <div class="col">
                    <label for="filter_merk">Filter :</label>
                    <select name="merk" id="merk"  tabindex="-1" aria-hidden="true" >        
                         <option value="">Pilih</option>
                        <option value="HONDA">HONDA</option>
                        <option value="YAMAHA">YAMAHA</option>
                    </select>  
                    <label for="filter_nama">-</label >
                    <select name="nama" id="nama"  tabindex="-1" aria-hidden="true" >   
                    <option value="">Pilih</option>
                        <?php foreach($get_jenis_kendaraan as $gj){?>
                        <option value="<?= $gj->nama?>"><?= $gj->nama?></option>
                        <?php }?>
                    </select>  
                    <label for="filter_tipe">-</label >
                    <select name="tipe" id="tipe"  tabindex="-1" aria-hidden="true" >   
                    <option value="">Pilih</option>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>  
                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </form>
                </div>
                </div>
                    <div class="table-responsive">
                <table id="example" class="table table-bordered Datatables">
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
                      foreach($get_kendaraan as $n ){
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

