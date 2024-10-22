
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach($get_karyawan as $r): ?>
<div class="modal" id="editModal<?php echo $r->no_finger?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_karyawan/editKaryawan/'.$r->no_finger; ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">
        <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nomor Finger</span>
                </div>
                <input type="text" name="no_finger" id="no_finger" class="form-control"  value="<?php echo $r->no_finger ?>"required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">NIP</span>
                </div>
                <input type="text" name="nik" id="nik" class="form-control" value="<?php echo $r->nik ?>" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                </div>
                <input type="text" name="nm_karyawan" id="nm_karyawan" class="form-control" value="<?php echo $r->nm_karyawan ?>" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Awal Masuk</span>
                </div>
                <input type="date" name="awal_masuk" id="awal_masuk" class="form-control" value="<?php echo $r->awal_masuk ?>" required>
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