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
                  <th>Username</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($get_user as $n ){
                ?>
                <tr style="font-size:small;">
                  <td><?= $no++; ?></td>
                  <td><?= $n->no_finger;?></td>
                  <td><?= $n->username; ?></td>
                  <td><?= str_repeat('*', strlen($n->password)); ?></td>
                  <td><?= $n->role; ?></td>
                  <td style="font-size: 15px;"><?php if($n->status == 1){?>
                    <span class="badge badge-pill badge-success"><?php  echo "Aktif";?></span>
                  <?php }else{ ?>
                    <span class="badge badge-pill badge-danger"><?php echo "Non-Aktif";?></span>
                  <?php } ?>
                  </td>
                
                
                </tr>
                <?php } ?>
              </tbody>
            </table>