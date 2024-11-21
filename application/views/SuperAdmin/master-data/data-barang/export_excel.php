<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="example" border="1">
              <thead>
                <tr style="font-size:small;">
                  <th>No.</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Satuan</th>
                  <th>Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_barang as $n ){
                ?>
                <tr style="font-size:small;">
                  <td><?= $no++; ?></td>
                  <td><?= $n->kd_barang;?></td>
                  <td><?= $n->nm_barang; ?></td>
                  <td><?= number_format($n->harga_beli);?></td>
                  <td><?= number_format($n->harga_jual); ?></td>
                  <td><?= $n->satuan; ?></td>
                  <td><?= $n->kategori; ?></td>
                  
                  <td>
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->kd_barang?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser('<?php echo $n->kd_barang; ?>')">Hapus</button>
                  </td>
                
                </tr>
                <?php } ?>
              </tbody>
            </table>