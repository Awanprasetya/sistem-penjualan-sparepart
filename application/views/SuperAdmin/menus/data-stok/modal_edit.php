
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach($get_barang as $r): ?>
<div class="modal" id="editModal<?php echo $r->kd_barang?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_barang/editBarang/'.$r->kd_barang; ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">
        <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nama Barang</span>
                </div>
                <input type="text" name="nm_barang" id="nm_barang" class="form-control" value="<?php echo $r->nm_barang?>" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Harga Beli</span>
                </div>
                <input type="text" name="harga_beli" id="harga_beli" class="form-control" value="<?php echo $r->harga_beli?>" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Harga Jual</span>
                </div>
                <input type="text" name="harga_jual" id="harga_jual" class="form-control" value="<?php echo $r->harga_jual?>" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Satuan</span>
                </div>
               <select name="satuan" id="satuan" class="form-control">
               <option value="<?php echo $r->satuan?>"><?php echo $r->satuan?></option>
                <option value="PCS">PCS</option>
                <option value="BOX">BOX</option>

               </select>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Kategori</span>
                </div>
               <select name="kategori" id="kategori" class="form-control">
                 <option value="<?php echo $r->kategori?>"><?php echo $r->kategori?></option>
                <option value="Chipset">Chipset</option>
                <option value="PSU">PSU</option>
                <option value="Monitor">Monitor</option>
                <option value="RAM">RAM</option>
                <option value="VGA">VGA</option>


               </select>
              </div>
            </div>
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;?>