
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="modal" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_user_manage/insertUser' ?>" method="post">
      <form name="autoSumForm">


        <div class="modal-body">

        <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nomor Finger</span>
                </div>
                <select name="no_finger" id="no_finger" class="form-control">
                  <?php foreach($get_karyawan as $n){?>
                  <option value="<?php echo $n->no_finger?>"><?php echo $n->no_finger?> - <?php echo $n->nm_karyawan?></option>
                  <?php }?>
                </select>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                </div>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                </div>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                </div>
               <select name="role" id="role" class="form-control">
                <option value="SuperAdmin">SuperAdmin</option>
                <option value="Admin">Admin</option>
                <option value="Pegawai">Pegawai</option>

               </select>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="col-md-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Status</span>
                </div>
               <select name="status" id="status" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>

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
