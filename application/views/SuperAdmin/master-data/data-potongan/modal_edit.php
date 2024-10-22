
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach($get_potongan as $r): ?>
<div class="modal" id="editModal<?php echo $r->id_potongan?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Potongan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_potongan/editPotongan/'.$r->id_potongan; ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">
        <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Nama Potongan</span>
        </div>
        <input type="text" name="nama_potongan" id="nama_potongan" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= $r->nama_potongan;?>" required>
    
    </div>
      </div>
      <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Jumlah</span>
        </div>
        <input type="text" name="jumlah" id="jumlah" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= $r->jumlah;?>" required>
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