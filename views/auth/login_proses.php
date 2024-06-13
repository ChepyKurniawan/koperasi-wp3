<?php

include("../../apps/koneksi.php");

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email'");

    $row = mysqli_fetch_array($data);

    if (mysqli_num_rows($data) == 1) {
        if ($password == $row['password']) {
            if ($row['level'] == "admin") {
                // berfungsi membuat session
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['nama'] =  $row['nama'];
                $_SESSION['email'] =  $row['email'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['img'] = $row['img'];
                $_SESSION['info'] = "Berhasil";
                //berfungsi mengalihkan ke halaman admin
                header("Location: ../dashboard/dashboard_admin.php");
                // berfungsi mengecek jika user login sebagai moderator
            } else if ($row['level'] == "user") {
                // berfungsi membuat session
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['nama'] =  $row['nama'];
                $_SESSION['email'] =  $row['email'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['img'] = $row['img'];
                $_SESSION['info'] = "Berhasil";
                // berfungsi mengalihkan ke halaman moderator
                header("Location: ../dashboard/dashboard_user.php");
            }
        } else {
            $_SESSION['info'] = 'Kosong';
            header("Location: login.php");
        }
    } else {
        $_SESSION['info'] = 'Kosong';
        header("Location: login.php");
    }
}
