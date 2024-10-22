<!-- Import CSS DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css">

<!-- Import jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Import JS DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>

<?php foreach($get_payroll as $r): ?>
<div class="modal" id="editModal<?php echo $r->id?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Komponen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" name="autoSumForm" autocomplete="off" action="<?php echo base_url().'c_komponen/editKomponen/'.$r->id; ?>" method="post">
      <form name="autoSumForm">


      <div class="modal-body">
          <div class="row justify-content-center">

            <!-- Dropdown Nama Karyawan dengan Pencarian -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Nama Karyawan</span>
                </div>
                <select name="no_finger" id="no_finger" class="form-control ">
                  <option value="<?= $r->no_finger?>"><?= $r->nm_karyawan;?></option>
                  <?php foreach($get_karyawan as $n) { ?>
                    <option value="<?php echo $n->no_finger; ?>"><?php echo $n->nm_karyawan; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <!-- Kategori Gaji -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Kategori Gaji</span>
                </div>
                <select name="kategori" id="kategori" class="form-control">
                  <option value="<?=$r->kategori?>"><?=$r->kategori?></option>
                  <option value="Harian">Harian</option>
                  <option value="Bulanan">Bulanan</option>
                </select>
              </div>
            </div>

            <!-- Gaji Pokok -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Gaji Pokok</span>
                </div>
                <input type="number" name="gp" id="gp" class="form-control" value="<?= $r->gp;?>" required>
              </div>
            </div>

            <!-- Tunjangan Transport -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Tunjangan Transport</span>
                </div>
                <input type="number" name="t_transport" id="t_transport" class="form-control" value="<?= $r->t_transport;?>" required>
              </div>
            </div>

            <!-- Tunjangan Kehadiran -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Tunjangan Kehadiran</span>
                </div>
                <input type="number" name="t_kehadiran" id="t_kehadiran" class="form-control" value="<?= $r->t_kehadiran;?>" required>
              </div>
            </div>

            <!-- Tunjangan Jabatan -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Tunjangan Jabatan</span>
                </div>
                <input type="number" name="t_jabatan" id="t_jabatan" class="form-control" value="<?= $r->t_jabatan;?>" required>
              </div>
            </div>

            <!-- Potongan Jamsostek -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Potongan Jamsostek</span>
                </div>
                <input type="number" name="p_jamsostek" id="p_jamsostek" class="form-control"  value="<?= $r->p_jamsostek;?>" required>
              </div>
            </div>

            <!-- Potongan BPJS -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Potongan BPJS</span>
                </div>
                <input type="number" name="p_bpjs" id="p_bpjs" class="form-control" value="<?= $r->p_bpjs;?>" required>
              </div>
            </div>

            <!-- Potongan Alpha -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Potongan Alpha</span>
                </div>
                <input type="number" name="p_alpha" id="p_alpha" class="form-control" value="<?= $r->p_alpha;?>" required>
              </div>
            </div>

            <!-- Potongan Piutang -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Potongan Piutang</span>
                </div>
                <input type="number" name="p_piutang" id="p_piutang" class="form-control" value="<?= $r->p_piutang;?>" required>
              </div>
            </div>

            <!-- Lembur -->
            <div class="col-md-9 mb-3">
              <div class="input-group input-group-default">
                <div class="input-group-prepend">
                  <span class="input-group-text">Lembur</span>
                </div>
                <input type="number" name="t_lemburan" id="t_lemburan" class="form-control" value="<?= $r->t_lemburan;?>" required>
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