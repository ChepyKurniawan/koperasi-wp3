<?php

session_start();

require("../../apps/koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

if (isset($_POST['tambah_pembayaran'])) {

    $no = $_POST['no_pembayaran'];
    $metode = $_POST['metode_pembayaran'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pembayaran VALUES (NULL, '$no', '$metode')");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: dashboard_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: dashboard_admin.php");
    }
}

if (isset($_POST['tambah_bunga'])) {

    $bunga = $_POST['bunga'];
    $bulan = $_POST['bulan'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_bunga VALUES (NULL, '$bunga', '$bulan')");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: dashboard_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: dashboard_admin.php");
    }
}

if (isset($_POST['simpan_pembayaran'])) {

    $id_bunga = $_POST['id_bunga'];
    $bunga = $_POST['bunga'];
    $bulan = $_POST['bulan'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_bunga VALUES (NULL, '$bunga', '$bulan')");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: dashboard_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: dashboard_admin.php");
    }
}

if (isset($_POST['simpan_pembayaran'])) {

    $id_pembayaran = $_POST['id_pembayaran'];
    $no = $_POST['no_pembayaran'];
    $metode = $_POST['metode_pembayaran'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pembayaran VALUES (NULL, '$no', '$metode')");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: dashboard_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: dashboard_admin.php");
    }
}

if (isset($_GET['id_pembayaran'])) {
    $id = $_GET['id_pembayaran'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pembayaran WHERE id_pembayaran= '$id'");

    header("Location: dashboard_admin.php");
}

if (isset($_GET['id_bunga'])) {
    $id = $_GET['id_bunga'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_bunga WHERE id_bunga= '$id'");

    header("Location: dashboard_admin.php");
}
