<?php
include '../../apps/koneksi.php';

$id_bunga = $_POST['id_bunga'];

$query = $koneksi->query("SELECT * FROM tbl_bunga where id_bunga = '$id_bunga'");
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['bulan'] = $row['bulan'];
    $data['bunga'] = $row['bunga'];
    // $data['rek'] = $row['rek'];
}
echo json_encode($data);
