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
                  <th>Jabatan</th>
                  <th>Departemen</th>
                  <th>Status Karyawan</th>
                  <th>Jenis Kelamin</th>
                  <th>tgl_lahir</th>
                  <th>tmp_lahir</th>
                  <th>Agama</th>
                  <th>Pendidikan</th>
                  <th>Status Menikah</th>
                  <th>Alamat</th>
                  <th>No KTP</th>
                  <th>No NPWP</th>
                  <th>No Jamsostek</th>
                  <th>No BPJS Ketenaga Kerjaan</th>
                  <th>Email</th>
                  <th>No Rekening</th>
                  <th>Bank</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_karyawan_lengkap as $n ){
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->nik; ?></td>
                  <td><?= $n->nm_karyawan; ?></td>
                  <td><?= $n->nm_jbt; ?></td>
                  <td><?= $n->nm_dept; ?></td>
                  <td><?= $n->status_karyawan; ?></td>
                  <td><?= $n->jk; ?></td>
                  <td><?= $n->tgl_lahir; ?></td>
                  <td><?= $n->tmp_lahir; ?></td>
                  <td><?= $n->agama; ?></td>
                  <td><?= $n->pendidikan; ?></td>
                  <td><?= $n->status_menikah; ?></td>
                  <td><?= $n->alamat; ?></td>
                  <td><?= $n->no_ktp; ?></td>
                  <td><?= $n->no_npwp; ?></td>
                  <td><?= $n->no_bpjs; ?></td>
                  <td><?= $n->no_bpjsk; ?></td>
                  <td><?= $n->email; ?></td>
                  <td style="mso-number-format:'\@';"><?= $n->norek; ?></td>
                  <td><?= $n->bank; ?></td>
                  
                 
                </tr>
                <?php } ?>
              </tbody>
            </table>