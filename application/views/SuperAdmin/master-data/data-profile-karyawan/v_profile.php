<link href="<?php echo base_url('assets/DataTables/datatables.min.css'); ?>" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">
<?php
$success = $this->session->flashdata('success');
$error = $this->session->flashdata('error');

// Hapus flashdata secara manual
$this->session->unset_userdata('success');
$this->session->unset_userdata('error');
?>
<!-- Cek apakah flashdata 'success' ada dan tidak kosong -->
<?php if(!empty($success)): ?>
							<script>
								Swal.fire({
									icon: 'success',
									title: 'Berhasil!',
									text: '<?php echo $success; ?>',
									showConfirmButton: true
								});
							</script>
						<?php endif; ?>

						<!-- Cek apakah flashdata 'error' ada dan tidak kosong -->
						<?php if(!empty($error)): ?>
							<script>
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: '<?php echo $error; ?>',
									showConfirmButton: true
								});
							</script>
	<?php endif; ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Karyawan</h1>
    </div>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url().'dashboard/index'; ?>">
                <i class="fa fa-home" aria-hidden="true"></i>&nbsp;Dashboard
            </a>
        </li>
        <li class="breadcrumb-item"><a href="#">Data Karyawan</a></li>
        <li class="breadcrumb-item"><a href="#">Detail Karyawan</a></li>
    </ol>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
                Detail Karyawan
            </a>
        </li>
    </ul>

    <br>

    <div class="row mb-3">
        <div class="col">
            <a class="btn btn-outline-primary" href="<?php echo base_url().'c_karyawan/index'; ?>">Kembali</a>
        </div>
    </div>

    <div class="row">
        <!-- Foto Profile -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-user"></i> Foto Profile</h6>
                </div>
                <div class="card-body text-center">
                    <?php foreach ($get_data_diri as $r) { ?>
                    <form action="<?php echo base_url().'c_karyawan/edit_photo_karyawan/'.$r->no_finger; ?>" method="post" enctype="multipart/form-data">
                        <?php if ($r->photo_path == NULL) { ?>
                        <img src="<?php echo base_url().'assets/foto/null-profile.jpg'; ?>" alt="" class="img-fluid border border-primary rounded-lg" style="max-width: 180px;">
                        <?php } else { ?>
                        <img src="<?php echo base_url().'assets/foto/'.$r->photo_path; ?>" alt="" class="img-fluid border border-primary rounded-lg" style="max-width: 180px;">
                        <?php } ?>
                        <br>
                        <input type="file" class="form-control mt-2" name="photo_path" id="photo_path" required>
                        <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Simpan</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-id-card"></i> Informasi Karyawan</h6>
                </div>
                <div class="card-body">
                <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                        <tr>
                                <td>
                                    <span>Nama :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_nama_karyawan/'.$r->no_finger; ?>" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" name="nm_karyawan" class="form-control" placeholder="Nama Karyawan" value="<?php echo $r->nm_karyawan; ?>" aria-label="Nama Karyawan" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" type="submit" id="button-addon2">Simpan</button>
                                    </div>
                                </div>
                            </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Jabatan :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_jabatan_karyawan/'.$r->no_finger; ?>" method="post">
                                <div class="input-group mb-3">
                                    <select name="kd_jbt" id="kd_jbt" class="form-control select2">
                                        <option value="<?php echo $r->kd_jbt;?>"><?php echo $r->nm_jbt;?></option>
                                        <?php foreach($get_jabatan as $gj){ ?>
                                        <option value="<?php echo $gj->kd_jbt;?>"><?php echo $gj->nm_jbt;?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Departemen :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_dept_karyawan/'.$r->no_finger; ?>" method="post">
                                <div class="input-group mb-3">
                                    <select name="kd_dept" id="kd_dept" class="form-control select2">
                                        <option value="<?php echo $r->kd_dept;?>"><?php echo $r->nm_dept;?></option>
                                        <?php foreach($get_department as $gd){ ?>
                                        <option value="<?php echo $gd->kd_dept;?>"><?php echo $gd->nm_dept;?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Status Karyawan :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_status_karyawan/'.$r->no_finger; ?>" method="post">
                                <div class="input-group mb-3">
                                    <select name="status_karyawan" id="status_karyawan" class="form-control select2">
                                        <option value="<?php echo $r->status_karyawan;?>"><?php echo $r->status_karyawan;?></option>
                                        <option value="KARYAWAN TETAP">KARYAWAN TETAP</option>
                                        <option value="KONTRAK">KONTRAK</option>
                                        <option value="HARIAN">HARIAN</option>
                                        <option value="RESIGN">RESIGN</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Kontrak Ke :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_kontrak_karyawan/'.$r->no_finger; ?>" method="post">
                                <div class="input-group mb-3">
                                    <input type="number" name="kontrak" class="form-control" value="<?php echo $r->kontrak; ?>" placeholder="Masa Kontrak">
                                </div>
                                <span>Masa Jabatan :</span>
                                <!-- Input Masa Jabatan -->
                                <div class="input-group mb-3">
                                    <input type="date" name="start_date" class="form-control" value="<?php echo $r->start_date; ?>" placeholder="Tanggal Mulai">
                                    <span class="input-group-text">s/d</span>
                                    <input type="date" name="end_date" class="form-control" value="<?php echo $r->end_date; ?>" placeholder="Tanggal Selesai">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>
                                </td>
                            </tr>
                        </thead>
                </table>
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#jabatan" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-id-card" aria-hidden="true"></i> Data Diri
                        </button>
                    </h2>
                    </div>

                    <div id="jabatan" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                    <?php foreach ($get_data_diri as $r) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <!-- <tr>
                                <th>Nama</th>
                                <td>
                                    <form action="<?php echo base_url().'c_karyawan/edit_nama_karyawan/'.$r->no_finger; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="nm_karyawan" class="form-control" value="<?php echo $r->nm_karyawan; ?>">
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr> -->
                            <tr>
                              
                                <td>
                                <span>Nomor KTP :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_no_ktp_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" name="no_ktp" class="form-control" value="<?php echo $r->no_ktp; ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Agama :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_agama_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <select name="agama" id="agama" class="form-control select2">
                                            <option value="<?php echo $r->agama;?>"><?php echo $r->agama;?></option>
                                            <option value="ISLAM">ISLAM</option>
                                            <option value="KRISTEN">KRISTEN</option>
                                            <option value="HINDU">HINDU</option>
                                            <option value="BUDHA">BUDHA</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                           <tr>
                                <td> 
                                <span>Jenis Kelamin :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_jk_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <select name="jk" id="jk" class="form-control select2">
                                            <option value="<?php echo $r->jk;?>"><?php echo $r->jk;?></option>
                                            <option value="PRIA">PRIA</option>
                                            <option value="WANITA">WANITA</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                             </tr>
                            <tr>
                                <td>
                                <span>Status Menikah :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_status_menikah_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <select name="status_menikah" id="status_menikah" class="form-control select2">
                                            <option value="<?php echo $r->status_menikah;?>"><?php echo $r->status_menikah;?></option>
                                            <option value="K0">K0</option>
                                            <option value="K1">K1</option>
                                            <option value="K2">K2</option>
                                            <option value="K3">K3</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>
                                <span>Tanggal Lahir :</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_tgl_lahir_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $r->tgl_lahir; ?>" placeholder="Tanggal Lahir">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Tempat Lahir</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_tmp_lahir_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" name="tmp_lahir" class="form-control" value="<?php echo $r->tmp_lahir; ?>" placeholder="Tempat Lahir">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Alamat</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_alamat_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <textarea name="alamat" class="form-control" rows="3"><?php echo $r->alamat; ?></textarea>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                <span>Email</span>
                                <form action="<?php echo base_url().'c_karyawan/edit_email_karyawan/'.$r->no_finger; ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control" value="<?php echo $r->email; ?>" required>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <form action="<?php echo base_url().'c_karyawan/edit_file_karyawan/'.$r->no_finger; ?>" method="post" enctype="multipart/form-data">
                                        <img src="<?php echo base_url().'assets/foto/'.$r->attachment_file; ?>" alt="File Pendukung" class="img-fluid" style="max-width: 150px;">
                                        <div class="row mt-2">
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="file" class="form-control" name="attachement_file" id="attachement_file" required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <?php } ?>                    
                    </div>
                    </div>
                </div>
                </div>
                <div class="card">
                <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fa fa-history" aria-hidden="true"></i> Histori Kontrak
                    </button>
                </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <table id="example" class="table table-bordered Datatables">
                            <thead>
                                <th>Kontrak Ke-</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </thead>
                            <tbody>
                                <?php foreach($get_kontrak_temp as $gkt){?>
                                <td>
                                    <?php if($gkt->kontrak != 0){?>
                                    <?php echo $gkt->kontrak;?>
                                    <?php }else{
                                       echo 'RESIGN';
                                    }?>
                                
                                </td>
                                <td><?php echo date('d F Y', strtotime($gkt->start_date)); ?></td>
                                <td><?php echo date('d F Y', strtotime($gkt->end_date));?></td>
                                
                            </tbody>
                            <?php }?>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>

       
    
</div>

<!-- DataTables Scripts -->
<script src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
<script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>

<script>
    new DataTable('#example');
</script>

<script>
    $(document).ready(function(){
        $('#uploadImage').submit(function(event){
            if ($('#uploadFile').val()) {
                event.preventDefault();
                $('#loader-icon').show();
                $('#targetLayer').hide();
                $(this).ajaxSubmit({
                    target: '#targetLayer',
                    beforeSubmit: function(){
                        $('.progress-bar').width('50%');
                    },
                    uploadProgress: function(event, position, total, percentageComplete){
                        $('.progress-bar').animate({
                            width: percentageComplete + '%'
                        }, {
                            duration: 1000
                        });
                    },
                    success: function(){
                        $('#loader-icon').hide();
                        $('#targetLayer').show();
                    },
                    resetForm: true
                });
            }
            return false;
        });
    });
</script>
