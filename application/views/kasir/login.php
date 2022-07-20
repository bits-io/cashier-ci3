<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("template/head") ?>

  <style type="text/css">
    .card{
      background-color: #000000 ;
      color:#ffffff;
    }
    .login-page{
      background: url('<?= base_url()?>assets/img/batik.jpeg');
    }
    .card-header{
      background-color: #ffffff ;
      color:#000000;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-secondary">
      <div class="card-header text-center">
        <a href="<?= base_url() ?>assets/index2.html" class="h1"><b>RE</b> LP3I</a>
      </div>
      <div class="card-body">
        <?php if(isset($_GET['msg'])&&$_GET['msg']=="gagal"){?>
          <p class="login-box-msg text-danger">Username atau Password salah!</p>
        <?php }else if(isset($_GET['msg'])&&$_GET['msg']=="logout"){?>
          <p class="login-box-msg text-success">Berhasil logout!</p>
        <?php }else { ?>
          <p class="login-box-msg">Sign in to start your session</p>
        <?php } ?>
        <form action="<?= base_url() ?>Auth/login" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-13">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
      </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- botstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/botstrap/js/botstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
</body>

</html>