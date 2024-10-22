<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="example" border="1">
    <thead style="background-color: #007BFF; color: white; border: 1px solid black;">
      <tr>
        <th style="font-size: 12px; text-align: center;">No.</th>
        <th style="font-size: 12px; text-align: center;">Nomor&nbsp;Finger</th>
        <th style="font-size: 12px; text-align: center;">Nama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
        <th style="font-size: 12px; text-align: center;">Departemen</th>
        <th style="font-size: 12px; text-align: center;">Jabatan</th>
        <th style="font-size: 12px; text-align: center;">Status</th>
        <th style="font-size: 12px; text-align: center;">Kategori&nbsp;Gaji</th>
        <th style="font-size: 12px; text-align: center;">Gaji&nbsp;Pokok</th>
        <th style="font-size: 12px; text-align: center;">T.Transpor</th>
        <th style="font-size: 12px; text-align: center;">T.Kehadiran</th>
        <th style="font-size: 12px; text-align: center;">T.Jabatan</th>
        <th style="font-size: 12px; text-align: center;">Total&nbsp;Presensi</th>
        <th style="font-size: 12px; text-align: center;">Gaji&nbsp;Bruto</th>
        <th style="font-size: 12px; text-align: center;">P.Jamsostek</th>
        <th style="font-size: 12px; text-align: center;">P.BPJS&nbsp;Kesehatan</th>
        <th style="font-size: 12px; text-align: center;">P.Alpha</th>
        <th style="font-size: 12px; text-align: center;">P.Piutang</th>
        <th style="font-size: 12px; text-align: center;">Total&nbsp;Gaji</th>
        <th style="font-size: 12px; text-align: center;">Lemburan</th>
        <th style="font-size: 12px; text-align: center;">Minggu&nbsp;1</th>
        <th style="font-size: 12px; text-align: center;">Minggu&nbsp;2</th>
        <th style="font-size: 12px; text-align: center;">Nomor&nbsp;Rekening</th>
        <th style="font-size: 12px; text-align: center;">BANK</th>
        
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      foreach($get_payroll_karyawan as $n ){
      ?>
        <tr>
          <td style="font-size: 12px;"><?= $no++; ?></td>
          <td style="font-size: 12px;"><?=$n->no_finger;?></td>
          <td style="font-size: 12px;"><?=$n->nm_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->nm_dept;?></td>
          <td style="font-size: 12px;"><?=$n->nm_jbt;?></td>
          <td style="font-size: 12px;"><?=$n->status_karyawan;?></td>
          <td style="font-size: 12px;"><?=$n->kategori;?></td>
          <td style="font-size: 12px;"><?=number_format($n->gp);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_transport);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_kehadiran);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_jabatan);?></span></td>
          <td style="font-size: 12px;"><?=number_format($n->total_presensi);?></td>
          <td style="font-size: 12px;"><?=number_format($n->gaji_bruto);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->potongan_jamsostek);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->potongan_bpjs_kesehatan);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->p_alpha);?></span></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-danger"><?=number_format($n->p_piutang);?></span></td>
          <td style="font-size: 12px;"><?=number_format($n->total_gaji);?></td>
          <td style="font-size: 15px;"><span class="badge badge-pill badge-success"><?=number_format($n->t_lemburan);?></span></td>
          <td style="font-size: 12px;"><?=number_format($n->week1);?></td>
          <td style="font-size: 12px;"><?=number_format($n->week2);?></td>
          <td style="font-size: 12px; mso-number-format:'\@';" ><?=$n->norek;?></td>
          <td style="font-size: 12px;"><?=$n->bank;?></td>
          <!-- <td style="font-size: 12px;">
              <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $n->id?>" style="color:white;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
              <button class="btn btn-danger btn-sm" onclick="deleteKomponen('<?php echo $n->id; ?>')">Hapus</button>
          </td> -->

        </tr>
      <?php }?>
    </tbody>
  </table>