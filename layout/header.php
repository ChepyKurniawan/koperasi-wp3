<?php
session_start();
include "../../apps/koneksi.php";
include "../../apps/config.php";
$id_user = $_SESSION['id_user'];
$queryUser = mysqli_query($koneksi, "SELECT nama, img, level FROM tbl_user WHERE id_user = '$id_user'");
$user = mysqli_fetch_array($queryUser);
if (!isset($_SESSION['login'])) :
    echo "<script>
    document.location.href = '../../views/auth/login.php';
    </script>";
endif;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title><?= $title ?></title>
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
            <span class="text-white me-3">
                Welcome <?= $user['nama'] ?>
            </span>
            <div class="header_img">
                <?php if (empty($user['img'])) { ?>
                    <img src="<?php echo $config; ?>assets/profile/person-circle.svg" alt="">
                <?php } else { ?>
                    <img src="<?php echo $config; ?>assets/profile/<?= $user['img'] ?>" alt="">
                <?php } ?>
            </div>
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
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <a href="<?php echo $config; ?>views/dashboard/dashboard_admin.php" class="nav_link <?= $active == 'dashboard' ? 'l-active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/user/user.php" class="nav_link <?= $active == 'user' ? 'l-active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/simpanan_admin.php" class="nav_link <?= $active == 'simpanan' ? 'l-active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/tarik_simpanan_admin.php" class="nav_link <?= $active == 'tarik_simpanan' ? 'l-active' : '' ?>">
                            <i class='bx bx-credit-card-alt nav_icon'></i>
                            <span class="nav_name">Tarik Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman/pinjaman_admin.php" class="nav_link <?= $active == 'pinjaman' ? 'l-active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pengembalian/pengembalian_admin.php" class="nav_link <?= $active == 'pengembalian' ? 'l-active' : '' ?>">
                            <i class='bx bx-money nav_icon'></i>
                            <span class="nav_name">Pengembalian</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo $config; ?>views/dashboard/dashboard_user.php" class="nav_link <?= $active == 'dashboard' ? 'l-active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon '></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/simpanan_user.php" class="nav_link <?= $active == 'simpanan' ? 'l-active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/tarik_simpanan_user.php" class="nav_link <?= $active == 'tarik_simpanan' ? 'l-active' : '' ?>">
                            <i class='bx bx-credit-card-alt nav_icon'></i>
                            <span class="nav_name">Tarik Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman/pinjaman_user.php" class="nav_link <?= $active == 'pinjaman' ? 'l-active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pengembalian/pengembalian_user.php" class="nav_link <?= $active == 'pengembalian' ? 'l-active' : '' ?>">
                            <i class='bx bx-money nav_icon'></i>
                            <span class="nav_name">Pengembalian</span>
                        </a>
                        <a href="<?php echo $config; ?>views/profile/profile.php" class="nav_link <?= $active == 'profile' ? 'l-active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Profil</span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <a href="<?php echo $config; ?>views/auth/logout_proses.php?level=<?= $user['level'] ?>" class="nav_link btn-logout">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
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