<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Login Page</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('assets/foto/favicon.ico'); ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url('assets/foto/favicon.ico'); ?>" type="image/x-icon">


    <style>
        body {
            background: 
                        url('<?php echo base_url('assets/foto/bg_hr.png'); ?>') no-repeat center center fixed;
            background-size: cover; /* Ensures the image covers the whole background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .form-signin {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            position: relative;
            z-index: 1; /* Ensure form is on top */
            max-width: 400px; /* Limit form width for larger screens */
            width: 90%; /* Make form width responsive */
        }

        .form-label-group input {
            border-radius: 25px;
            transition: all 0.3s;
        }

        .form-label-group input:focus {
            box-shadow: 0 0 5px rgba(255, 105, 180, 0.8);
            border-color: #ff69b4; /* Pink color */
        }

        button {
            border-radius: 25px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkbox label {
            color: #333;
        }

        .text-muted {
            color: #777;
        }
    </style>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
  $success = $this->session->flashdata('success');
  $error = $this->session->flashdata('error');
  $this->session->unset_userdata('success');
  $this->session->unset_userdata('error');
  ?>
<!-- Flash Messages -->
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
  
    <form class="form-signin" method="post" action="<?php echo site_url('Login/masuk'); ?>">
        <div class="text-center mb-4">
            <img class="mb-4" src="<?php echo base_url('assets/foto/logo2.png'); ?>" alt="Logo" >
            <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
            <label for="username">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">HRMS - PT. Arkanindoplast Utama 2024 <br>&copy; Kurniawan</p>
    </form>
</body>
</html>
