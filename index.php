<?php
session_start();
include "apps/koneksi.php";
include "apps/config.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Home | Koperasi</title>
    <link href="<?php echo $config; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/sidebar.css">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/datatables.min.css">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/boxicons/css/boxicons.css">
    <script src="<?php echo $config; ?>assets/script/chart.js"></script>
    <script src="<?php echo $config; ?>assets/boxicons/dist/boxicons.js"></script>
</head>


<body id="body-pd">
    <header class="header d-print-none" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="d-flex align-items-center">
            <a href="views/auth/login.php" class="btn btn-dark">Login</a>
        </div>
    </header>
    <div class="l-navbar d-print-none" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="<?php echo $config; ?>views/home/index.php" class="nav_logo">
                    <img src="<?php echo $config; ?>assets/images/koperasi.png" alt="" width="25px" height="25px">
                    <span class="nav_logo-name">Koperasi</span>
                </a>
                <div class="nav_list">

                </div>
            </div>
        </nav>
    </div>
    <!-- Container Main start -->
    <div class="container-fluid">

        <?php if (isset($_SESSION['info'])) : ?>
            <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
        <?php
            unset($_SESSION['info']);
        endif;
        ?>

        <style>
            @import url("https://fonts.googleapis.com/css?family=Poppins:400,700");

            .lines {
                margin: auto;
                width: 70px;
                position: relative;
                border-top: 2px solid #2192ff;
                margin-top: 15px;
            }

            .btn-common {
                border: 1px solid #2192ff;
                background: #2192ff;
                position: relative;
                color: #fff;
                z-index: 1;
                border-radius: 30px;
            }

            .btn-common:hover {
                color: #fff;
                background: #1484ec;
                border-color: #1484ec;
                transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -webkit-transition: all 0.5s ease-in-out;
            }

            p {
                font-size: 20px;
                line-height: 26px;
            }

            span {
                font-size: 14px;
                line-height: 26px;
            }

            .section-header {
                color: #fff;
                margin-bottom: 40px;
                text-align: center;
            }

            .section-header .section-title {
                font-size: 42px;
                margin-top: 0;
                text-transform: uppercase;
                font-weight: 700;
                color: #333;
                position: relative;
            }
        </style>

        <div class="container-fluid">
            <section class="mb-3">
                <div class="">
                    <div class="text-center section-header">
                        <h2 class="section-title">Tentang Kami</h2>
                        <hr class="mb-3 lines" />
                    </div>
                    <div class="row">
                        <div class="order-2 order-md-1 col-12 col-md-6" style="text-align: justify;">
                            <p class="">Dengan semangat perubahan dan visi menjadi koperasi terkini dan inovatif di Indonesia, Koperasi Namastra bertekad untuk menjadi koperasi yang modern, profesional dan antusias dalam membangun perekonomian rakyat. Perwujudan keseriusan para pendiri terlihat dalam penempatan pengelola yang sudah memiliki banyak pengalaman di Perbankan dan Koperasi.</p>
                            <a href="<?php echo $config ?>views/auth/register.php" class="btn btn-common">Daftar Sekarang</a>
                        </div>
                        <div class="order-1 mb-2 order-md-2 col-12 col-md-6">
                            <img src="assets/landing-page/img/tentang-kami.jpg" width="100%" class="shadow">
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <div class="">
                    <div class="row">
                        <div class="mt-2 mb-2 text-center section-header">
                            <h2 class="section-title">Visi & Misi</h2>
                            <hr class="mb-3 lines" />
                        </div>
                        <div class="mb-3 col-12">
                            <div class="shadow-sm card">
                                <div class="card-header">
                                    <h4>VISI</h4>
                                </div>
                                <div class="card-body">
                                    <span style="font-size: 18px;">Meningkatkan peran serta anggota dalam berkoperasi untuk mendukung terbentunya dunia usaha yang produktif sehingga dapat mewujudkan kesejahteraan dan keadilan Ekonomi serta Kemandirian Usaha bagi Anggota Koperasi “Makmur Mandiri”.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="shadow-sm card">
                                <div class="card-header">
                                    <h4>MISI</h4>
                                </div>
                                <div class="card-body">
                                    <ul style="font-size: 18px;">
                                        <li>Mengoptimalkan dan memberdayakan aset-aset ekonomi para anggota koperasi untuk disinergikan dalam suatu pemberdayaan ekonomi Koperasi sehingga membentuk sistem perekonomian yang kuat dan tangguh dalam memenangi persaingan dunia usaha.</li>
                                        <li>Meningkatkan kesadaran seluruh anggota akan manfaat bersama pentingnya koperasi melalui pendidikan perkoperasian.</li>
                                        <li>Membentuk unit – unit usaha produktif yangsehat dan mandiri dalam upaya meningkatkan kesejahteraan bagi seluruh anggota Koperasi “Makmur Mandiri”.</li>
                                        <li>Meningkatkan pruduktivitas dan daya saing yang tinggi dengan mengembangkan sinergi dan partisipasi seluruh anggota dalam mengelola unit -unit usaha Koperasi “Makmur Mandiri”.</li>
                                        <li>Membuktikan bahwa sistem perekonomian koperasi adalah sistem ekonomi pemberdayaan masyarakat yang terbaik sehingga koperasi dapat memberikan citra yang positif bagi kendala keterbatasan multidimensi untuk meningkatkan pendapatan yang pada akhirnya dapat memperbaiki kesejahteraan anggota koperasi yang lebih baik.</li>
                                        <li>Memantapkan Koperasi “Makmur Mandiri” sebagai sebuah perusahaan dengan jati diri koperasi melalui penyelenggaraan sistem ekonomi kerakyatan.</li>
                                        <li>Berperan serta membantu Pemerintah untuk menjalankan program – program pemberdayaan sehingga koperasi berperan aktif dalam meningkatkan kesejahteraan masyarakat.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="<?php echo $config; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo $config; ?>assets/script/jquery.js"></script>

    <script src="<?php echo $config; ?>assets/script/sidebar.js"></script>

    <script src="<?php echo $config; ?>assets/script/datatables.min.js"></script>

    <script src="<?php echo $config; ?>assets/script/custom.js"></script>

    <script src="<?php echo $config; ?>assets/script/sweetalert.js"></script>

    <script src="<?php echo $config; ?>assets/script/alert.js"></script>

</body>

</html>