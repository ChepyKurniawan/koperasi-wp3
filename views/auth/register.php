<?php
require_once("../../apps/config.php");
include_once("../../apps/koneksi.php");
session_start();

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/output.css" />

</head>

<body class="overflow-hidden">
    <!-- Alert -->
    <?php if (isset($_SESSION['info'])) : ?>
        <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
    <?php
        session_destroy();
    // unset($_SESSION['info']);
    endif;
    ?>

    <section class="flex items-center justify-center min-h-screen bg-gradient-to-tl from-[#5D69BE] to-[#C89FEB]">
        <!-- Login Container -->
        <div class="flex items-center w-10/12 bg-white shadow-lg rounded-2xl">
            <!-- Image -->
            <div class="md:block hidden w-1/2 rounded-tl-2xl rounded-bl-2xl bg-[#FFCAD4]">
                <div class="flex items-center justify-center py-36">
                    <img src="<?php echo $config; ?>assets/images/undraw_online_collaboration_re_bkpm.svg" class="w-11/12 py-24" />
                </div>
            </div>
            <!-- Form -->
            <div class="md:w-1/2 rounded-tl-2xl rounded-bl-2xl">
                <form action="register-process.php" method="POST">
                    <div class="flex flex-col justify-center gap-2 px-20 py-6">
                        <span class="text-3xl font-bold text-center">Register</span>
                        <span class="mb-3 text-sm text-center">Create an Account</span>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukan Password" class="form-control-register" />
                        </div>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">Email Address</label>
                            <input type="email" name="email" placeholder="Masukan Email" class="form-control-register" />
                        </div>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" name="password" placeholder="Masukan Password" class="form-control-register" />
                        </div>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">No. Telepon</label>
                            <input type="number" name="notelp" placeholder="Masukan Password" class="form-control-register" />
                        </div>
                        <button type="submit" name="submit" class="w-full p-2 text-white rounded-md bg-[#5D69BE] shadow-sm">
                            Login
                        </button>
                        <span>Sudah mempunyai akun?
                            <a href="<?php echo $config; ?>views/auth/login.php" class="text-[#5D69BE]">Masuk Disini</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="<?php echo $config; ?>assets/script/jquery.js"></script>

    <script src="<?php echo $config; ?>assets/script/sweetalert.js"></script>

    <script src="<?php echo $config; ?>assets/script/alert.js"></script>
</body>

</html>