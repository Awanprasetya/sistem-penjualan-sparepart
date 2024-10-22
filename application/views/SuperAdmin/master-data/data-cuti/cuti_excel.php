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
                  <th>Tanggal&nbsp;Mulai</th>
                  <th>Tanggal&nbsp;Selesai</th>
                  <th>Jumlah&nbsp;Hari</th>
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
                  <td><?= $n->tanggal_mulai; ?></td>
                  <td><?= $n->tanggal_selesai; ?></td>
                  <td><?= $n->jumlah_hari; ?></td>
                 
                
                </tr>
                <?php } ?>
              </tbody>
            </table>