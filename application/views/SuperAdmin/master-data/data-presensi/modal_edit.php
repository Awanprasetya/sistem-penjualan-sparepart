<?php foreach($get_presensi as $r): ?>
<div class="modal" id="editModal<?php echo $r->id?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_presensi/editPresensi/'.$r->id; ?>" method="post">

        <div class="modal-body">
          <!-- Tambahkan d-flex justify-content-center untuk memusatkan -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Tanggal </span>
                </div>
                <input type="date" name="tgl_presensi" id="tgl_presensi" class="form-control" value="<?php echo $r->tgl_presensi?>" required>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Scan Masuk</span>
                </div>
                <input type="time" name="scan_masuk" id="scan_masuk" class="form-control" value="<?php echo $r->scan_masuk?>" required>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group input-group-default mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Scan Pulang</span>
                </div>
                <input type="time" name="scan_pulang" id="scan_pulang" class="form-control" value="<?php echo $r->scan_pulang?>" required>
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
<?php endforeach; ?>

<script>
    $('.select2').select2();
</script>
