<?php

session_start();
include "../../apps/koneksi.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telp = $_POST['notelp'];

    $cek_email = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email = '$email'"));

    if ($cek_email > 0) {
        $_SESSION['info'] = 'email sudah di gunakan';
        header("Location: register.php");
    } else {
        $result = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES('','','$nama','$email','$password','','','','','','','$telp','','','user','current_timestamp()')");
        $_SESSION['info'] = 'berhasil di buat';
        header("Location: login.php");
    }
}
