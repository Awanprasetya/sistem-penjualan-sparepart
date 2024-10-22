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
                  <th>No Finger</th>
                  <th>Nomor Induk Pegawai</th>
                  <th>Nama</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_karyawan_resign as $n ){
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->nik; ?></td>
                  <td><?= $n->nm_karyawan; ?></td>
                  <td><?= $n->status_karyawan; ?></td>
                  
                
                </tr>
                <?php } ?>
              </tbody>
            </table>
