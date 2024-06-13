<?php

session_start();

require("../../apps/koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

if (isset($_GET['id_pengembalian'])) {
    $id = $_GET['id_pengembalian'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pengembalian WHERE id_pengembalian= '$id'");

    header("Location: pengembalian_admin.php");
}

if (isset($_POST['bpengembalian'])) {

    if (isset($_POST['denda'])) {
        $id = $_POST['id_pinjam'];
        $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
        // $id_pembayaran = $_POST['id_pembayaran'];
        $jumlah = $_POST['jumlah'];
        $denda = $_POST['denda'];
        $pengembalian_ke = $_POST['pengembalian_ke'];
        $total = $jumlah + $denda;

        $ekstensi_diperbolehkan = array('png', 'jpg');
        $bukti = $_FILES['bukti']['name'];

        $x = explode('.', $new_img);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['bukti']['size'];
        $file_tmp = $_FILES['bukti']['tmp_name'];

        $folder = '../../assets/bukti_pengembalian/';

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //boleh upload file
            //uji jika ukuran file dibawah 1mb
            if ($ukuran < 1044070) {
                //jika ukuran sesuai
                //PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
                move_uploaded_file($file_tmp, $folder . $bukti);

                //simpan data ke dalam database
                $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
                $result = mysqli_query($koneksi, $select);
                $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '', '$total', '$pengembalian_ke', '$bukti', '$today', 'pending');");
                if ($sql) {
                    $_SESSION['info'] = 'Disimpan';
                    echo "<script>document.location='pengembalian_user.php'</script>";
                } else {
                    $_SESSION['info'] = 'Gagal';
                    echo "<script>document.location='pengembalian_user.php'</script>";
                }
            } else {
                //ukuran tidak sesuai
                $_SESSION['info'] = "ukuran";
                echo "<script>document.location='pengembalian_user.php'</script>";
            }
        } else {
            //ektensi file yang di upload tidak sesuai
            $_SESSION['info'] = "format";
            echo "<script>document.location='pengembalian_user.php'</script>";
        }
    } else {
        $id = $_POST['id_pinjam'];
        $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
        $id_pembayaran = $_POST['id_pembayaran'];
        $jumlah = $_POST['jumlah'];
        $pengembalian_ke = $_POST['pengembalian_ke'];

        $ekstensi_diperbolehkan = array('png', 'jpg');
        $bukti = $_FILES['bukti']['name'];

        $x = explode('.', $bukti);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['bukti']['size'];
        $file_tmp = $_FILES['bukti']['tmp_name'];

        $folder = '../../assets/bukti_pengembalian/';

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //boleh upload file
            //uji jika ukuran file dibawah 1mb
            if ($ukuran < 1044070) {
                //jika ukuran sesuai
                //PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
                move_uploaded_file($file_tmp, $folder . $bukti);

                //simpan data ke dalam database
                $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
                $result = mysqli_query($koneksi, $select);
                $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$id_pembayaran', '$jumlah', '$pengembalian_ke', '$bukti', '$today', 'pending');");
                $id_baru = $koneksi->insert_id;
                if ($sql) {
                    $_SESSION['info'] = 'Disimpan';
                    echo "<script>document.location='print_pengembalian.php?id_pengembalian=$id_baru'</script>";
                } else {
                    $_SESSION['info'] = 'Gagal';
                    echo "<script>document.location='pengembalian_user.php'</script>";
                }
            } else {
                //ukuran tidak sesuai
                $_SESSION['info'] = "ukuran";
                echo "<script>document.location='pengembalian_user.php'</script>";
            }
        } else {
            //ektensi file yang di upload tidak sesuai
            $_SESSION['info'] = "format";
            echo "<script>document.location='pengembalian_user.php'</script>";
        }
    }
}

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_pinjam'];
    $konfirmasi = "UPDATE konfirmasi_pinjam SET tgl_konfirmasi = '$today' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $konfirmasi);
    $select_pinjam = "UPDATE tbl_pinjam SET status_pinjam = 'konfirmasi' WHERE id_pinjam = '$id'";
    $select_pengembalian = "UPDATE tbl_pengembalian SET status_pengembalian = 'konfirmasi' WHERE id_pengembalian = '$_POST[id_pengembalian]'";
    $result_select = mysqli_query($koneksi, $select_pinjam);
    $result_select = mysqli_query($koneksi, $select_pengembalian);
    $_SESSION['info'] = 'Konfirmasi';
    header("Location: ../pengembalian/pengembalian_admin.php");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_pinjam'];
    $select_pengembalian = "UPDATE tbl_pengembalian SET status_pengembalian = 'tolak' WHERE id_pengembalian = '$_POST[id_pengembalian]'";
    $result_select = mysqli_query($koneksi, $select_pengembalian);
    $_SESSION['info'] = 'Tolak';
    header("Location: ../pengembalian/pengembalian_admin.php");
}
