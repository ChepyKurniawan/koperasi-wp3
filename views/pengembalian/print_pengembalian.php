<?php
$active = "pengembalian";
$title = "Print | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$id_pinjam = $_GET['id_pengembalian'];

$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT *, DATE_FORMAT(tgl_pengembalian, '%d %M %Y - %H:%i:%s') as tgl FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) WHERE tbl_pengembalian.id_pengembalian = '$id_pinjam'");

foreach ($tbl_pinjaman_u as $pinjam) {
    $id = $pinjam['id_pengembalian'];
    $nama = $pinjam['nama'];
    $jumlah = $pinjam['jumlah_pengembalian'];
    $tgl = $pinjam['tgl'];
    $pengembalian_ke = $pinjam['pengembalian_ke'];
}
?>

<div class="pt-2 text-black">
    <div class="">
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data">
                <!-- desain struk -->
                <div class="d-flex justify-content-between">
                    <img src="../../assets/images/koperasi.png" alt="" width="90px" style="margin-bottom:10px;">
                    <center>
                        <h4 class="mt-4 ">KOPERASI SIMPAN PINJAM <br /> MAKMUR MANDIRI</h4>
                        <span>Jl. Cicadas, Curugmekar, Kec. Bekasi, Jawa Barat 16234</span><br>
                        <span>fax. (123) 412356.</span>
                    </center>
                    <br>
                </div>
                <div style="margin-top:20;">
                    <span>No. Pengembalian : P-0<?= $id ?></span><br>
                    <span>Nama : <?= $nama ?> </span>
                    <span style="float:right;">Tanggal : <?= $tgl ?></span>
                    <h2 class="pb-4 border-bottom"></h2>
                    <h2 class="mt-4">PENGEMBALIAN</h2>
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">JENIS TRANSAKSI :</span>
                            <span>PENGEMBALIAN</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">Pengembalian Ke</span>
                            <span><?= $pengembalian_ke ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mt-1"></span>
                            <!-- <span>Rp.50.000 </span> -->
                        </div>
                        <!-- total tagihan -->
                        <h2 class="pb-4 border-bottom"></h2>
                        <!-- <div class="d-flex justify-content-between ">
                            <span class="fs-5">Jumlah Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah, '0', '.', '.') ?> </span></b>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fs-5">Bunga Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($bunga, '0', '.', '.') ?> </span></b>
                        </div> -->
                        <div class="mb-4 d-flex justify-content-between">
                            <span class="fs-5">Total Pengembalian</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah, '0', '.', '.') ?> </span></b>
                        </div>
                        <span style="float:right;" class="mt-4 fs-5">Bogor, <?= $tgl ?></span><br><br><br><br><br>
                        <center>
                            <h2>** Terima Kasih **</h2>
                        </center>
                        <a href="" class="btn btn-success btn-fill pull-rightfloat-right ms-2 d-print-none" style="float:right ;" onclick="window.print()">CETAK STRUK</a>
                        <a href="pengembalian_user.php" button type="button" class="mb-5 btn btn-danger d-print-none">Kembali</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>