<?php
$active = "pinjaman";
$title = "Print | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$id_pinjam = $_GET['id_pinjam'];

$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT nama, jumlah_pinjam, status_pinjam, tbl_pinjam.id_pinjam, riba, DATE_FORMAT(tgl_pinjam, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_pinjam JOIN tbl_user USING(id_user) WHERE tbl_pinjam.id_pinjam = '$id_pinjam'");

foreach ($tbl_pinjaman_u as $pinjam) {
    $id = $pinjam['id_pinjam'];
    $nama = $pinjam['nama'];
    $jumlah = $pinjam['jumlah_pinjam'];
    $status = $pinjam['status_pinjam'];
    $tgl = $pinjam['tgl'];
    $bunga = $pinjam['riba'];
}
$jumlah_pinjam = $jumlah - $bunga;
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
                    <span>No. Pinjaman : P-0<?= $id ?></span><br>
                    <span>Nama : <?= $nama ?> </span>
                    <span style="float:right;">Tanggal : <?= $tgl ?></span>
                    <h2 class="pb-4 border-bottom"></h2>
                    <h2 class="mt-4">PINJAMAN</h2>
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">JENIS TRANSAKSI :</span>
                            <span>PINJAMAN</span>
                        </div>
                        <!-- <div class="d-flex justify-content-between">
                            <span class="mt-1"></span>
                            <h2></h2>
                            <span>Rp.50.000 </span>
                        </div> -->
                        <!-- <div class="d-flex justify-content-between">
                            <span class="mt-1">
                            </span>
                            <span>Rp.50.000 </span>
                        </div> -->
                        <!-- total tagihan -->
                        <h2 class="pb-4 border-bottom"></h2>
                        <div class="d-flex justify-content-between ">
                            <span class="fs-5">Jumlah Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah_pinjam, '0', '.', '.') ?> </span></b>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fs-5">Bunga Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($bunga, '0', '.', '.') ?> </span></b>
                        </div>
                        <div class="mb-4 d-flex justify-content-between">
                            <span class="fs-5">Total Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah, '0', '.', '.') ?> </span></b>
                        </div>
                        <span style="float:right;" class="mt-4 fs-5">Bogor, <?= $tgl ?></span><br><br><br><br><br>
                        <center>
                            <h2>** Terima Kasih **</h2>
                        </center>
                        <a href="" class="btn btn-success btn-fill pull-rightfloat-right ms-2 d-print-none" style="float:right ;" onclick="window.print()">CETAK STRUK</a>
                        <a href="pinjaman_user.php" button type="button" class="mb-5 btn btn-danger d-print-none">Kembali</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>