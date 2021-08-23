<?php
if ($this->session->userdata('id') != null) {
  $data['title'] = 'Dashboard';
  redirect('Admin');
  //$this->session->sess_destroy();
  die;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
  <!-- https://fonts.google.com/specimen/Open+Sans -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.min.css" />
  <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
  <!-- https://getbootstrap.com/ -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/templatemo-style.css">
  <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="index.php">
          <h1 class="tm-site-title mb-0">Login Admin</h1>
        </a>
        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>

      </div>
    </nav>
  </div>

  <div class="container tm-mt-big tm-mb-big">
    <div class="row">
      <div class="col-12 mx-auto tm-login-col">
        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="tm-block-title mb-4">Selamat Datang, Silahkan Login</h2>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <form action="<?= base_url() ?>Auth" method="post" class="tm-login-form">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input name="username" type="text" class="form-control validate" id="username" value="" required />
                </div>
                <div class="form-group mt-3">
                  <label for="password">Password</label>
                  <input name="password" type="password" class="form-control validate" id="password" value="" required />
                </div>
                <div class="form-group mt-4">
                  <input type="submit" class="btn btn-primary btn-block text-uppercase" value="LOGIN">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
  <!-- https://jquery.com/download/ -->
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
  <!-- https://getbootstrap.com/ -->
</body>

</html>