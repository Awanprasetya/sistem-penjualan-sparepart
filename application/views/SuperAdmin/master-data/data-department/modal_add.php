
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="modal" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Departemen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_department/insertDepartment' ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">
        <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Kode Departemen</span>
        </div>
        <input type="text" name="kd_dept" id="kd_dept" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" required>
    </div>
      </div>
      <div class="col-md-9 ml-3">
      <div class="input-group input-group-default mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Nama Departemen</span>
        </div>
        <input type="text" name="nm_dept" id="nm_dept" class="form-control " style="width: 100%;" tabindex="-1" aria-hidden="true" required>
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
