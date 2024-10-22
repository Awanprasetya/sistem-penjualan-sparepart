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

      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_master_shift/insertShift' ?>" method="post">

        <div class="modal-body">

          <!-- Shift Input -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Shift</span>
                </div>
                <input type="text" name="shift" id="shift" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- Start Time Input -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Start Time</span>
                </div>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- End Time Input -->
          <div class="d-flex justify-content-center">
            <div class="col-md-7">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">End Time</span>
                </div>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
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
