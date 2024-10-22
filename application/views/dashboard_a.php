<style type="text/css">
  #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.8);
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .spinner {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>

<!-- edit content start here-->
<div id="loading">
  <div class="spinner"></div>
</div>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row (Menu Android Style with Gradient and Centered Cards) -->
  <div class="row justify-content-center text-center">

    <!-- Data Karyawan Menu -->
    <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #36d1dc, #5b86e5);">
        <a href="<?php echo base_url().'c_karyawan/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-user-tie fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Data Karyawan</h6>
          </div>
        </a>
      </div>
    </div>

    <!-- Presensi Menu -->
    <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #11998e, #38ef7d);">
        <a href="<?php echo base_url().'c_presensi/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-calendar-check fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Presensi</h6>
          </div>
        </a>
      </div>
    </div>
     <!-- Presensi Menu -->
     <!-- <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #667eea, #38ef7d);">
        <a href="<?php echo base_url().'c_presensi/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-calculator fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Hitung Presensi</h6>
          </div>
        </a>
      </div>
    </div> -->
    <!-- Payroll Menu -->
    <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #667eea, #764ba2);">
        <a href="<?php echo base_url().'c_payroll/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-university fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Payroll</h6>
          </div>
        </a>
      </div>
    </div>

     <!-- Resign Menu -->
     <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #ff0000, #ff69b4);" >
        <a href="<?php echo base_url().'c_resign/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-users fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Karyawan Resign</h6>
          </div>
        </a>
      </div>
    </div>
    <!-- Cuti Menu -->
    <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #f2994a, #f2c94c);">
        <a href="<?php echo base_url().'c_cuti/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-suitcase fa-2x mb-2"></i>
            <h6 class="font-weight-bold">Cuti</h6>
          </div>
        </a>
      </div>
    </div>
     <!-- User Menu -->
     <!-- <div class="col-xl-2 col-md-4 col-sm-6 mb-1">
      <div class="card shadow h-100 py-3 card-hover" style="background: linear-gradient(45deg, #bdc3c7, #2c3e50);" >
        <a href="<?php echo base_url().'c_user_manage/'; ?>" class="text-decoration-none text-white">
          <div class="card-body">
            <i class="fas fa-cog fa-2x mb-2"></i>
            <h6 class="font-weight-bold">User Setting</h6>
          </div>
        </a>
      </div>
    </div> -->
    <!-- End Content Row -->
</div>
<!-- /.container-fluid -->
<!-- end of content-->

<div class="row justify-content-center text-center mt-4">
  <!-- First Chart: Total Karyawan Berdasarkan Departemen -->
  <div class="col-xl-6 col-md-6 col-sm-12 mb-4">
    <div class="card shadow h-100 py-3 card-hover chart-card">
      <div class="card-body">
        <h6 class="font-weight-bold text-dark">Total Karyawan Berdasarkan Departemen</h6>
        <canvas id="departmentChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Second Chart: Total Karyawan Resign -->
  <div class="col-xl-6 col-md-6 col-sm-12 mb-4">
    <div class="card shadow h-100 py-3 card-hover chart-card">
      <div class="card-body">
        <h6 class="font-weight-bold text-dark">Total Karyawan Resign Berdasarkan Departemen</h6>
        <canvas id="resignChart"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  // First Chart: Total Karyawan Berdasarkan Departemen
  const departmentData = {
    labels: [<?php 
            foreach($get_karyawan_group_dept as $r) {
                echo "'" . $r->nm_dept . "',";
            }
        ?>],
    datasets: [{
      label: 'Jumlah Karyawan',
      data: [<?php 
            foreach($get_karyawan_group_dept as $r) {
                echo "'" . $r->jumlah . "',";
            }
        ?>],
      backgroundColor: ['#ff9f40', '#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
      borderColor: ['#ff7f31', '#ff5071', '#2f8bcd', '#ffd45a', '#33a9a9'],
      borderWidth: 1
    }]
  };

  // Second Chart: Total Karyawan Resign
  const resignData = {
    labels: [<?php 
            foreach($get_karyawan_group_dept as $r) {
                echo "'" . $r->nm_dept . "',";
            }
        ?>],
    datasets: [{
      label: 'Jumlah Resign',
      data: [<?php 
            foreach($get_karyawan_resign_dept as $r) {
                echo "'" . $r->jumlah . "',";
            }
        ?>],
      backgroundColor: ['#ff9f40', '#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
      borderColor: ['#ff7f31', '#ff5071', '#2f8bcd', '#ffd45a', '#33a9a9'],
      borderWidth: 1
    }]
  };

  // Create the first chart
  window.onload = function() {
    const departmentCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(departmentCtx, {
      type: 'bar',
      data: departmentData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function(tooltipItem) {
                return tooltipItem.label + ': ' + tooltipItem.raw + ' karyawan';
              }
            }
          }
        }
      }
    });

    // Create the second chart
    const resignCtx = document.getElementById('resignChart').getContext('2d');
    new Chart(resignCtx, {
      type: 'bar',
      data: resignData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function(tooltipItem) {
                return tooltipItem.label + ': ' + tooltipItem.raw + ' resign';
              }
            }
          }
        }
      }
    });
  };
</script>


<!-- CSS for Centering Cards and Custom Layout -->
<style>
  .card-hover {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
    border-radius: 10px;
    padding: 10px;
    color: white;
  }

  .card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }

  .card-body i {
    transition: transform 0.3s ease;
  }

  .card-hover:hover i {
    transform: scale(1.1);
  }

  .card-body h6 {
    font-size: 12px;
    margin-top: 5px;
  }

  .text-decoration-none {
    text-decoration: none;
  }

  /* Slightly wider and shorter card size */
  .card {
    max-width: 160px; /* Adjusted to make cards wider */
    max-height: 150px; /* Setting shorter height */
    margin: 0 auto;
  }

  /* Reduce space between cards */
  .row .col-md-4 {
    padding-left: 2px;
    padding-right: 2px;
  }

  /* Adjust font size for icons and text */
  .card-body i {
    font-size: 2em;
  }

  /* Center the row and align the cards to the middle */
  .row {
    display: flex;
    justify-content: center;
  }

  /* Responsive adjustments */
  @media (min-width: 768px) {
    .card {
      max-width: 140px;
      max-height: 140px;
    }
  }

  @media (min-width: 992px) {
    .card {
      max-width: 130px;
      max-height: 130px;
    }
  }

  /* Custom style for the chart card */
  .chart-card {
    background-color: white; /* Set background to white */
    border-radius: 15px; /* Unique border-radius for chart card */
    padding: 20px; /* Add more padding for spacing */
    color: black; /* Change text color to black for contrast */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* More pronounced shadow */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
  }

  .chart-card:hover {
    transform: translateY(-10px); /* Different hover effect for the chart card */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
  }

  /* Adjust the chart title */
  .chart-card .card-body h6 {
    font-size: 16px;
    margin-top: 10px;
    text-align: center;
    font-weight: bold;
  }

  /* Keep card dimensions distinct from others */
  .chart-card {
    max-width: 400px;
    max-height: 280px;
    margin: 0 auto;
  }

  @media (min-width: 768px) {
    .chart-card {
      max-width: 400px;
      max-height: 260px;
    }
  }

  @media (min-width: 992px) {
    .chart-card {
      max-width: 400px;
      max-height: 250px;
    }
  }
</style>
<script>
  // Tampilkan loading saat halaman dimuat
  $(window).on('load', function() {
    // Hilangkan loading setelah halaman selesai dimuat
    $('#loading').fadeOut('slow');
  });
</script>

