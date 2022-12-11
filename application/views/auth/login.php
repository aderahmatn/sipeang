<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SI-PEANG | Login</title>
    <link rel="icon" href="<?= base_url("assets/images/logo_kabupatentangerang_perda.png") ?>" type="image/jpeg">


    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/dist/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url("assets/dist/css/custom.css") ?>">

    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/sweetalert2/dark.css' ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugins/toastr/toastr.min.css' ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page bg-login">
    <div class="login-box">
        <div class="row  justify-content-center">

            <!-- <img src="<?= base_url() . 'assets/images/logo.png' ?>" alt="AdminLTE Logo" class="brand-image " style="width: 120;"> -->
        </div>
        <div class="login-logo">
            <img src="<?= base_url() . 'assets/images/logo_kabupatentangerang_perda.png' ?>" alt="AdminLTE Logo" class="brand-image mr-2" style="width: 100px;">

            <p style="color: white; font-weight: 400;">Sistem Informasi Penyerapan Anggaran</p>
        </div>
        <!-- /.login-logo -->
        <div class="card ">
            <div class="card-body login-card-body ">
                <p class="login-box-msg">Login untuk memulai sesi anda</p>

                <form action="<?= base_url('auth/process') ?>" method="post" autocomplete="off">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="fusername">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" autocomplete="on" name="fpassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() . 'assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() . 'assets/dist/js/adminlte.min.js' ?>"></script>
    <!-- Sweetalert -->
    <script src="<?= base_url() . 'assets/plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
    <!-- Toastr -->
    <script src="<?= base_url() . 'assets/plugins/toastr/toastr.min.js' ?>"></script>
    <!-- Alert Config -->
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
            });
            <?php if ($this->session->flashdata('success')) { ?>
                Toast.fire({
                    icon: 'success',
                    title: '<?= $this->session->flashdata('success'); ?>'
                });
            <?php } else if ($this->session->flashdata('error')) {  ?>
                Toast.fire({
                    icon: 'error',
                    title: '<?= $this->session->flashdata('error'); ?>'
                });
            <?php } else if ($this->session->flashdata('warning')) {  ?>
                Toast.fire({
                    icon: 'warning',
                    title: '<?= $this->session->flashdata('warning'); ?>'
                });
            <?php } else if ($this->session->flashdata('info')) {  ?>
                Toast.fire({
                    icon: 'info',
                    title: '<?= $this->session->flashdata('info'); ?>'
                });
            <?php } ?>
        });
    </script>

</body>

</html>