<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php foreach($get_shift_karyawan as $r): ?>
<div class="modal" id="editModal<?php echo $r->no_finger?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Jadwal Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_shift/editKaryawanShift/'.$r->id_karyawan_shift; ?>" method="post">

        <div class="modal-body">
          <input type="text" name="no_finger" id="no_finger" class="form-control" value="<?= $r->no_finger;?>" hidden>

          <!-- Nama Karyawan -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                </div>
                <select name="nm_karyawan" id="nm_karyawan" class="form-control">
                  <option value="<?php echo $r->no_finger?>"><?php echo $r->nm_karyawan?></option>
                  <?php foreach ($get_karyawan as $row) { ?>
                    <option value="<?php echo $row->no_finger?>"><?php echo $row->nm_karyawan?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- Shift -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Shift</span>
                </div>
                <select name="id_shift" id="id_shift" class="form-control">
                  <option value="<?php echo $r->id_shift?>"><?php echo $r->shift_name?></option>
                  <?php foreach ($get_shift as $row) { ?>
                    <option value="<?php echo $row->id_shift?>"><?php echo $row->shift_name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- Tanggal -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Tanggal</span>
                </div>
                <input type="date" name="shift_date" id="shift_date" class="form-control" value="<?php echo $r->shift_date?>" required>
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

<script>
    $('.select2').select2();
</script>
