<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>APP NAME</title>
  <!-- Custom fonts for this template-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="shortcut icon" href="<?php echo base_url('assets/foto/favicon.ico'); ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url('assets/foto/favicon.ico'); ?>" type="image/x-icon">

  <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
 <!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- jQuery (DataTables requires jQuery) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-0">
          <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $this->session->userdata('role'); ?></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url().'dashboard';?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php
        switch ($this->session->userdata('role')) {
            case 'SuperAdmin':
                echo '<div class="sidebar-heading">
                        Menu
                      </div>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fas fa-fw fa-folder-open"></i>
                          <span>Menu Utama</span>
                        </a>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                          <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu</h6>
                            <a class="collapse-item" href="' . base_url() . 'c_presensi">Data Presensi</a>
                            <a class="collapse-item" href="' . base_url() . 'c_karyawan">Data Karyawan</a>
                            <a class="collapse-item" href="' . base_url() . 'c_shift">Atur Shift Karyawan</a>
                          </div>
                        </div>
                      </li>';
                break;

            case 'Admin':
                    echo '<div class="sidebar-heading">
                    Menu
                  </div>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <i class="fas fa-fw fa-folder-open"></i>
                      <span>Menu Utama</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu</h6>
                        <a class="collapse-item" href="' . base_url() . 'c_presensi">Data Presensi</a>
                        <a class="collapse-item" href="' . base_url() . 'c_karyawan">Data Karyawan</a>
                        <a class="collapse-item" href="' . base_url() . 'c_shift">Atur Shift Karyawan</a>
                      </div>
                    </div>
                  </li>';
                break;

            case 'Pegawai':
                // Kode untuk Pegawai
                break;

            default:
                // Kode untuk peran lain atau jika tidak ada peran yang cocok
                break;
        }
        ?>


      <!-- Heading -->
      

      <?php 
        switch ($this->session->userdata('role')) {
            case 'SuperAdmin':
                echo '<li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-folder-open "></i>
                            <span>Master-Data</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">' . $this->session->userdata('role') . ' Menu</h6>
                                <a class="collapse-item" href="' . base_url() . 'c_department">Data Department</a>
                                <a class="collapse-item" href="' . base_url() . 'c_jabatan">Data Jabatan</a>
                                <a class="collapse-item" href="' . base_url() . 'c_master_shift">Data Shift</a>
                                <!-- <a class="collapse-item" href="' . base_url() . 'c_tunjangan">Data Tunjangan</a>
                                <a class="collapse-item" href="' . base_url() . 'c_potongan">Data Potongan</a> -->
                            </div>
                        </div>
                      </li>';
                break;

            case 'Admin':
                // Kode untuk Admin
                break;

            case 'Pegawai':
                // Kode untuk Pegawai
                break;

            default:
                // Kode untuk peran lain atau jika tidak ada peran yang cocok
                break;
        }
        ?>


      <!-- Nav Item - Data Collapse Menu -->
      

      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-database "></i>
          <span>Files</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Your Custome Pages</h6>
            <a class="collapse-item" href="#">File-1</a>
            <a class="collapse-item" href="#">File-2</a>
            <a class="collapse-item" href="#">File-3</a>
            <a class="collapse-item" href="#">File-4</a>
          </div>
        </div>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
	  <?php if($this->session->userdata('role')==='administrator'){ ?>
      <div class="sidebar-heading">
        Options <!-- visible only for admin -->
      </div>

      <!-- Nav Item - User Management -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-user"></i>
          <span>User Setting</span></a>
      </li>

      <!-- Nav Item - Activity Log -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-list"></i>
          <span>Activity Log</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
	  <?php } else { } ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="navbar-brand mx-auto d-none d-lg-block">
            <!-- <h4 class="text-center font-weight-bold">HRMS - PT. Arkanindoplast Utama</h4> -->
          </div>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('nm_karyawan'); ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/foto/'.$this->session->userdata('photo_path')); ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url().'c_karyawan/v_detail/'. $this->session->userdata('no_finger'); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        <script>
    $(document).ready(function() {
        $('#Datatables').DataTable(); // Inisialisasi DataTables
    });
    </script>