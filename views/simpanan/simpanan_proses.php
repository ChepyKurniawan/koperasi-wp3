<?php

session_start();

require("../../apps/koneksi.php");

if (isset($_GET['id_simpan'])) {
    $id = $_GET['id_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_simpan WHERE id_simpan= '$id'");

    header("Location: simpanan_admin.php");
}

if (isset($_GET['id_ambil_simpan'])) {
    $id = $_GET['id_ambil_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_ambil_simpan WHERE id_ambil_simpan= '$id'");

    header("Location: tarik_simpanan_admin.php");
}

if (isset($_POST['bUser'])) {

    $id = $_SESSION['id_user'];
    $id_pembayaran = $_POST['id_pembayaran'];
    $jumlah = $_POST['jumlah'];

    $ekstensi_diperbolehkan = array('png', 'jpg');
    $bukti = $_FILES['bukti']['name'];

    $x = explode('.', $bukti);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['bukti']['size'];
    $file_tmp = $_FILES['bukti']['tmp_name'];

    $folder = '../../assets/bukti_simpan/';

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        //boleh upload file
        //uji jika ukuran file dibawah 1mb
        if ($ukuran < 1044070) {
            //jika ukuran sesuai
            //PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
            move_uploaded_file($file_tmp, $folder . $bukti);

            //simpan data ke dalam database
            $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$id_pembayaran', '$jumlah', '$bukti', current_timestamp(), 'pending');");
            $id_simpan = $koneksi->insert_id;
            if ($sql) {
                $_SESSION['info'] = 'Disimpan';
                echo "<script>document.location='print_simpanan.php?id_simpan=$id_simpan'</script>";
            } else {
                $_SESSION['info'] = 'Gagal';
                echo "<script>document.location='simpanan_user.php'</script>";
            }
        } else {
            //ukuran tidak sesuai
            $_SESSION['info'] = "ukuran";
            echo "<script>document.location='simpanan_user.php'</script>";
        }
    } else {
        //ektensi file yang di upload tidak sesuai
        $_SESSION['info'] = "format";
        echo "<script>document.location='simpanan_user.php'</script>";
    }
}

if (isset($_POST['tarik_simpanan'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_ambil_simpan VALUES (NULL, '$id', '$jumlah', 'pending', current_timestamp());");
    $id_tarik = $koneksi->insert_id;
    if ($sql) {
        $_SESSION['info'] = 'Disimpan';
        echo "<script>document.location='print_tarik.php?id_ambil_simpan=$id_tarik'</script>";
    } else {
        $_SESSION['info'] = 'Gagal';
        echo "<script>document.location='tarik_simpanan_user.php'</script>";
    }
}


if (isset($_POST['konfirmasi_tarik'])) {
    $id = $_POST['id_ambil'];

    $select = "UPDATE tbl_ambil_simpan SET status_ambil = 'konfirmasi' WHERE id_ambil_simpan = '$id'";
    $result_select = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Konfirmasi';
    header("Location: tarik_simpanan_admin.php");
}

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_simpan'];

    $select = "UPDATE tbl_simpan SET status_simpan = 'konfirmasi' WHERE id_simpan = '$id'";
    $result_select = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Konfirmasi';
    header("Location: simpanan_admin.php");
}

if (isset($_POST['tolak_tarik'])) {
    $id = $_POST['id_ambil'];

    $select = "UPDATE tbl_ambil_simpan SET status_ambil = 'tolak' WHERE id_ambil_simpan = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Tolak';
    header("Location: tarik_simpanan_admin.php");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_simpan'];

    $select = "UPDATE tbl_simpan SET status_simpan = 'tolak' WHERE id_simpan = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Tolak';
    header("Location: simpanan_admin.php");
}
