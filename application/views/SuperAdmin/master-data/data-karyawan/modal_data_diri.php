<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php foreach($get_data_diri as $r): ?>
<div class="modal fade" id="datadiriModal<?php echo $r->no_finger?>" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Data Diri Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_karyawan/insertKaryawan' ?>" method="post">
        <div class="modal-body">
          <div class="container">
            <legend>Informasi Pribadi</legend>
            <hr/>
            <div class="row">
              <!-- Bagian Kiri -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Nomor Finger</label>
                  <div class="col-md-8">
                    <input type="text" name="no_finger" class="form-control" value="<?= $r->no_finger?>" required readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Nama</label>
                  <div class="col-md-8">
                    <input type="text" name="nm_karyawan" class="form-control" value="<?= $r->nm_karyawan?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Jenis Kelamin</label>
                  <div class="col-md-8">
                    <input type="text" name="jk" class="form-control" value="<?= $r->jk?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Nomor KTP</label>
                  <div class="col-md-8">
                    <input type="text" name="no_ktp" class="form-control" value="<?= $r->no_ktp?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Alamat</label>
                  <div class="col-md-8">
                    <input type="text" name="alamat" class="form-control" value="<?= $r->alamat?>" required>
                  </div>
                </div>
              </div>
              <!-- Bagian Kanan -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tanggal Lahir</label>
                  <div class="col-md-8">
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $r->tgl_lahir?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tempat Lahir</label>
                  <div class="col-md-8">
                    <input type="text" name="tmp_lahir" class="form-control" value="<?= $r->tmp_lahir?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. Telfon</label>
                  <div class="col-md-8">
                    <input type="text" name="no_telfon" class="form-control" value="<?= $r->no_telfon?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. NPWP</label>
                  <div class="col-md-8">
                    <input type="text" name="no_npwp" class="form-control" value="<?= $r->no_npwp?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. BPJS</label>
                  <div class="col-md-8">
                    <input type="text" name="no_bpjs" class="form-control" value="<?= $r->no_bpjs?>" required>
                  </div>
                </div>
              </div>
            </div>
          <legend>Status Karyawan</legend>
          <hr/>
            
            <div class="row">
              <!-- Bagian Kiri -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Start Date</label>
                  <div class="col-md-8">
                    <input type="date" name="no_finger" class="form-control" value="<?= $r->no_finger?>" required >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">End Date</label>
                  <div class="col-md-8">
                    <input type="date" name="nm_karyawan" class="form-control" value="<?= $r->nm_karyawan?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Kontrak Ke</label>
                  <div class="col-md-8">
                    <input type="num" name="kontrak" class="form-control" value="<?= $r->jk?>" required>
                  </div>
                </div>
               
              </div>
              <!-- Bagian Kanan -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tanggal Lahir</label>
                  <div class="col-md-8">
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $r->tgl_lahir?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tempat Lahir</label>
                  <div class="col-md-8">
                    <input type="text" name="tmp_lahir" class="form-control" value="<?= $r->tmp_lahir?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. Telfon</label>
                  <div class="col-md-8">
                    <input type="text" name="no_telfon" class="form-control" value="<?= $r->no_telfon?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. NPWP</label>
                  <div class="col-md-8">
                    <input type="text" name="no_npwp" class="form-control" value="<?= $r->no_npwp?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">No. BPJS</label>
                  <div class="col-md-8">
                    <input type="text" name="no_bpjs" class="form-control" value="<?= $r->no_bpjs?>" required>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-outline-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
