
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach($get_jbt as $r): ?>
<div class="modal" id="editModal<?php echo $r->id_jbt?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_jabatan/editJabatan/'.$r->id_jbt; ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">
        <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Kode Jabatan</span>
        </div>
        <input type="text" name="kd_jbt" id="kd_jbt" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= $r->kd_jbt;?>" required>
    
    </div>
      </div>
      <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Nama Jabatan</span>
        </div>
        <input type="text" name="nm_jbt" id="nm_jbt" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= $r->nm_jbt;?>" required>
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