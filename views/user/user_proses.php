<?php

require("../../apps/koneksi.php");

if (isset($_GET['id_user'])) {
    $id = $_GET['id_user'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user = '$id'");

    header("Location: user.php");
}
