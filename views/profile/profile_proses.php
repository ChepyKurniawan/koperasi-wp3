<?php

session_start();

include("../../apps/koneksi.php");

if ($_SESSION['level'] == 'admin') {
}

if (isset($_POST['bsimpanuser'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tempat = $_POST['tempat'];
    $tgl = $_POST['tgl'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $ekstensi_diperbolehkan = array('png', 'jpg');
    $new_img = $_FILES['img_new']['name'];
    $old_img = $_POST['img_old'];

    $x = explode('.', $new_img);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['img_new']['size'];
    $file_tmp = $_FILES['img_new']['tmp_name'];

    $folder = '../../assets/profile/';

    if ($new_img == '') {
        $update_filename = $old_img;
        $query = mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama',email='$email', password='$password', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', agama='$agama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat', img='$update_filename', level='user' WHERE id_user = $id_user");
        if ($query) {
            $_SESSION['info'] = 'Disimpan';
            echo "<script>document.location='profile.php'</script>";
        } else {
            $_SESSION['info'] = 'Gagal';
            echo "<script>document.location='profile.php'</script>";
        }
    } else {
        $update_filename = $_FILES['img_new']['name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //boleh upload file
            //uji jika ukuran file dibawah 1mb
            if ($ukuran < 1044070) {
                //jika ukuran sesuai
                //PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
                move_uploaded_file($file_tmp, $folder . $new_img);

                //simpan data ke dalam database
                $query = mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama',email='$email', password='$password', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', agama='$agama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat', img='$update_filename', level='user' WHERE id_user = $id_user");
                if ($query) {
                    $_SESSION['info'] = 'Disimpan';
                    echo "<script>document.location='profile.php'</script>";
                } else {
                    $_SESSION['info'] = 'Gagal';
                    echo "<script>document.location='profile.php'</script>";
                }
            } else {
                //ukuran tidak sesuai
                $_SESSION['info'] = "ukuran";
                echo "<script>document.location='profile.php'</script>";
            }
        } else {
            //ektensi file yang di upload tidak sesuai
            $_SESSION['info'] = "format";
            echo "<script>document.location='profile.php'</script>";
        }
    }
}

if (isset($_POST['bsimpanadmin'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tempat = $_POST['tempat'];
    $tgl = $_POST['tgl'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $ekstensi_diperbolehkan = array('png', 'jpg');
    $new_img = $_FILES['img_new']['name'];
    $old_img = $_POST['img_old'];

    $x = explode('.', $new_img);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['img_new']['size'];
    $file_tmp = $_FILES['img_new']['tmp_name'];

    $folder = '../../assets/profile/';

    if ($new_img == '') {
        $update_filename = $old_img;
        $query = mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama',email='$email', password='$password', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', agama='$agama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat', img='$update_filename', level='user' WHERE id_user = $id_user");
        if ($query) {
            $_SESSION['info'] = 'Disimpan';
            echo "<script>document.location='../user/user.php'</script>";
        } else {
            $_SESSION['info'] = 'Gagal';
            echo "<script>document.location='../user/user.php'</script>";
        }
    } else {
        $update_filename = $_FILES['img_new']['name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //boleh upload file
            //uji jika ukuran file dibawah 1mb
            if ($ukuran < 1044070) {
                //jika ukuran sesuai
                //PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
                move_uploaded_file($file_tmp, $folder . $new_img);

                //simpan data ke dalam database
                $query = mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama',email='$email', password='$password', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', agama='$agama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat', img='$update_filename', level='user' WHERE id_user = $id_user");
                if ($query) {
                    $_SESSION['info'] = 'Disimpan';
                    echo "<script>document.location='../user/user.php'</script>";
                } else {
                    $_SESSION['info'] = 'Gagal';
                    echo "<script>document.location='../user/user.php'</script>";
                }
            } else {
                //ukuran tidak sesuai
                $_SESSION['info'] = "ukuran";
                echo "<script>document.location='../user/user.php'</script>";
            }
        } else {
            //ektensi file yang di upload tidak sesuai
            $_SESSION['info'] = "format";
            echo "<script>document.location='../user/user.php'</script>";
        }
    }
}

if (isset($_POST['bkembaliuser'])) {
    header("Location: profile.php");
}

if (isset($_POST['bkembaliadmin'])) {
    header("Location: ../user/user.php");
}
