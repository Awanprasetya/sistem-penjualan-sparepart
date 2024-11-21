<div class="modal" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-bordered" action="<?php echo base_url().'c_penjualan/insertPenjualan' ?>" method="post">

        <div class="modal-body">
          <div class="form-group">
            <label for="no_faktur">Nomor Faktur</label>
            <input type="text" name="no_faktur" id="no_faktur" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nm_konsumen">Nama Konsumen</label>
            <input type="text" name="nm_konsumen" id="nm_konsumen" class="form-control" required>
          </div>

          <div id="barang-wrapper">
          <div class="barang-item">
            <div class="row">
              <div class="col-md-6">
                <label for="kd_barang">Nama Barang</label>
                <select name="kd_barang[]" class="form-control kd_barang">
                  <?php foreach($get_barang as $n) { ?>
                    <option 
                      value="<?php echo $n->kd_barang; ?>" 
                      data-harga="<?php echo $n->harga_jual; ?>">
                      <?php echo $n->nm_barang; ?> - Stok (<?php echo $n->stok; ?>)
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="harga_satuan">Harga Satuan</label>
                <input type="number" name="harga_satuan[]" class="form-control harga_satuan" readonly>
              </div>
              <div class="col-md-3">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1">
              </div>
              <div class="col-md-3 mt-2">
                <label for="harga_total">Harga Total</label>
                <input type="number" name="harga_total[]" class="form-control harga_total" readonly>
              </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-barang">Hapus</button>
            <hr>
          </div>
        </div>


          <button type="button" id="add-barang" class="btn btn-primary btn-sm">Tambah Barang</button>
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
 $(document).ready(function () {
  // Tambah barang baru
  $('#add-barang').click(function () {
    const barangTemplate = `
      <div class="barang-item">
        <div class="row">
          <div class="col-md-6">
            <label for="kd_barang">Nama Barang</label>
            <select name="kd_barang[]" class="form-control kd_barang">
              <?php foreach ($get_barang as $n) { ?>
                <option 
                  value="<?php echo $n->kd_barang; ?>" 
                  data-harga="<?php echo $n->harga_jual; ?>" 
                  data-stok="<?php echo $n->stok; ?>">
                  <?php echo $n->nm_barang; ?> - Stok (<?php echo $n->stok; ?>)
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="number" name="harga_satuan[]" class="form-control harga_satuan" readonly>
          </div>
          <div class="col-md-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1">
          </div>
          <div class="col-md-3 mt-2">
            <label for="harga_total">Harga Total</label>
            <input type="number" name="harga_total[]" class="form-control harga_total" readonly>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm mt-2 remove-barang">Hapus</button>
        <hr>
      </div>
    `;
    $('#barang-wrapper').append(barangTemplate);
  });

  // Hapus barang
  $(document).on('click', '.remove-barang', function () {
    $(this).closest('.barang-item').remove();
  });

  // Update harga satuan dan total saat barang atau jumlah berubah
  $(document).on('change', '.kd_barang, .jumlah', function () {
    const $item = $(this).closest('.barang-item');
    const hargaJual = $item.find('.kd_barang :selected').data('harga');
    const stokTersedia = $item.find('.kd_barang :selected').data('stok');
    const jumlah = parseInt($item.find('.jumlah').val()) || 1;

    // Validasi stok
    if (jumlah > stokTersedia) {
      alert('Jumlah melebihi stok tersedia! Stok tersedia: ' + stokTersedia);
      $item.find('.jumlah').val(stokTersedia); // Set ke stok maksimum
      $item.find('.harga_total').val(hargaJual * stokTersedia);
    } else {
      $item.find('.harga_satuan').val(hargaJual);
      $item.find('.harga_total').val(hargaJual * jumlah);
    }
  });
});

$('#submit-form').click(function (e) {
  let valid = true;

  $('.barang-item').each(function () {
    const stokTersedia = $(this).find('.kd_barang :selected').data('stok');
    const jumlah = parseInt($(this).find('.jumlah').val()) || 0;

    if (jumlah > stokTersedia) {
      alert('Jumlah barang melebihi stok tersedia. Periksa kembali.');
      valid = false;
      return false; // Keluar dari loop jika ada stok kurang
    }
  });

  if (!valid) {
    e.preventDefault(); // Batalkan submit jika stok kurang
  }
});

</script>