<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="example" border="1">
    <thead style="background-color: #007BFF; color: white; border: 1px solid black;">
    <tr style="font-size:small;">
                  <th>No.</th>
                  <th>No&nbsp;Finger</th>
                  <th>Nama</th>
                  <th>Tahun</th>
                  <th>Jatah&nbsp;Cuti</th>
                  <th>Sisa&nbsp;Cuti</th>
                  <th>Status</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_cuti as $n ){
                ?>
                <tr style="font-size:x-small;">
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->nm_karyawan; ?></td>
                  <td><?= $n->tahun; ?></td>
                  <td><?= $n->jatah_cuti; ?></td>
                  <td><?= $n->sisa_cuti; ?></td>
                  <td style="font-size: 15px;"><?php if($n->status_cuti == 'Masih Ada Cuti'){ ?>
                    <span class="badge badge-pill badge-success"><?php echo $n->status_cuti?></span>
                  <?php }else{?>
                    <span class="badge badge-pill badge-danger"><?php echo $n->status_cuti?></span>

                    <?php }?>
                  </td>
                  <!-- <td>
                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id_cuti?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteCuti('<?php echo $n->id_cuti; ?>')">Hapus</button>
                  </td>
                 -->
                </tr>
                <?php } ?>
              </tbody>
            </table>