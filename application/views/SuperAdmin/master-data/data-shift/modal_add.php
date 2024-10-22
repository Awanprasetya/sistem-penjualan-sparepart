<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="modal" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jadwal Shift Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_shift/insertShiftKaryawan' ?>" method="post">
        <div class="modal-body">

          <!-- Nama Karyawan -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nama Karyawan</span>
                </div>
                <select name="no_finger" id="no_finger" class="form-control select2" style="width: 100%;">
                  <?php foreach ($get_karyawan as $row) { ?>
                      <option value="<?php echo $row->no_finger; ?>"><?php echo $row->nm_karyawan; ?></option>
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
                <select name="id_shift" id="id_shift" class="form-control" style="width: 100%;">
                  <?php foreach ($get_shift as $row) { ?>
                      <option value="<?php echo $row->id_shift; ?>"><?php echo $row->shift_name; ?></option>
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
                <input type="date" name="shift_date" id="shift_date" class="form-control" style="width: 100%;" required>
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

<script>
    $('.select2').select2();
</script>
