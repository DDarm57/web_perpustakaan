<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $tittle; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">
    <div class="container">
        <?php if (session()->getFlashdata('pesan_merah')) : ?>
            <div class="swal" data-swal="<?= session()->getFlashdata('pesan_merah'); ?>"></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('pesan_hijau')) : ?>
            <div class="logout" data-logout="<?= session()->getFlashdata('pesan_hijau'); ?>"></div>
        <?php endif; ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Perpustakaan SMPN 3 OMBEN</h1>
                            </div>
                            <div class="text-center">
                                <h2 class="h4 text-gray-900">Login</h2>
                            </div>
                            <form action="<?= site_url('auth/cek_login'); ?>" method="POST" class="user">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Masukan username yang valid">
                                    <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Masukan password">
                                    <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url(); ?>/template/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url(); ?>/template/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url(); ?>/template/js/sb-admin-2.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            const logout = $(".logout").data("logout");
            if (logout) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: logout,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        </script>

        <script>
            const swal = $(".swal").data("swal");
            if (swal) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: swal,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        </script>

</body>

</html>