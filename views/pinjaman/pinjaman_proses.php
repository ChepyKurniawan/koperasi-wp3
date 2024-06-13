<?php

session_start();

require("../../apps/koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");


if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_pinjam'];
    if ($_POST['id_bunga'] == '1') {
        $expires = strtotime('+30 days', strtotime($today));
        $expired = date('Y-m-d H:i:s', $expires);
        $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired')";
        $result_confirm = mysqli_query($koneksi, $confirm);
    } else if ($_POST['id_bunga'] == '3') {
        $expires = strtotime('+90 days', strtotime($today));
        $expired = date('Y-m-d H:i:s', $expires);
        $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired')";
        $result_confirm = mysqli_query($koneksi, $confirm);
    } else if ($_POST['id_bunga'] == '6') {
        $expires = strtotime('+180 days', strtotime($today));
        $expired = date('Y-m-d H:i:s', $expires);
        $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired')";
        $result_confirm = mysqli_query($koneksi, $confirm);
    } else if ($_POST['id_bunga'] == '12') {
        $expires = strtotime('+365 days', strtotime($today));
        $expired = date('Y-m-d H:i:s', $expires);
        $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired')";
        $result_confirm = mysqli_query($koneksi, $confirm);
    }
    $select = "UPDATE tbl_pinjam SET tgl_pinjam = '$today', status_pinjam = 'konfirmasi' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Konfirmasi';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status_pinjam = 'tolak' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Tolak';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['pengembalian'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Disimpan';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status_pinjam = 'selesai' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Selesai';
    header("Location: pinjaman_admin.php");
}

// if (isset($_POST['bpinjamadmin'])) {
//     $id = $_POST['nama'];
//     $id_bunga = $_POST['selectBulan'];
//     $bunga = $_POST['valueBunga'];
//     $jumlah = $_POST['jumlah'];
//     $tgl_pinjam = $_POST['tgl_pinjam'];

//     $total = $jumlah * ($bunga / 10);
//     $grand_total = $jumlah + $total;

//     $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$id_bulan', '$grand_total', '$total', '$tgl_pinjam', 'pending');");
//     if ($sql == true) {

//         $_SESSION['info'] = 'Disimpan';
//         header("Location: pinjaman_admin.php");
//     } else {
//         $_SESSION['info'] = 'Gagal';
//         header("Location: pinjaman_admin.php");
//     }
// }

if (isset($_POST['bpinjamuser'])) {

    $id = $_SESSION['id_user'];
    $id_bunga = $_POST['selectBulan'];
    $bunga = $_POST['valueBunga'];
    $jumlah = $_POST['jumlah'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $total = $jumlah * ($bunga / 10);
    $grand_total = $jumlah + $total;

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$id_bunga', '$grand_total', '$total', '$tgl_pinjam', 'pending');");
    $id_baru = $koneksi->insert_id;
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: print_pinjaman.php?id_pinjam=$id_baru");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: pinjaman_user.php");
    }
}

if (isset($_GET['id_pinjam'])) {
    $id = $_GET['id_pinjam'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pinjam WHERE id_pinjam= '$id'");

    header("Location: pinjaman_admin.php");
}
