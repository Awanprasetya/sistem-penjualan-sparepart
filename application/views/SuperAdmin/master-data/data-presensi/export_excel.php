<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

            <table id="example" border="1">
                <thead style="background-color: #007BFF; color: white; border: 1px solid black;">
                <tr>
                            <th>No.</th>
                            <th>Nomor&nbsp;Finger</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Scan&nbsp;Masuk</th>
                            <th>Scan&nbsp;Pulang</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($get_presensi as $n ){
                        ?>
                        <tr style="font-size: smaller;">
                            <td><?= $no++; ?></td>
                            <td><?= $n->no_finger;?></td>
                            <td><?= $n->nm_karyawan;?></td>
                            <td><?= $n->tgl_presensi; ?></td>
                            <td><span class="badge badge-success"><?= $n->scan_masuk; ?></span></td>
                            <td><span class="badge badge-danger"><?= $n->scan_pulang; ?></span></td>
                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>