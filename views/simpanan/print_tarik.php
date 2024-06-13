<?php
$active = "tarik_simpanan";
$title = "Print | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$id_simpan = $_GET['id_ambil_simpan'];

$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_ambil_simpan JOIN tbl_user ON tbl_ambil_simpan.id_user = tbl_user.id_user Where tbl_ambil_simpan.id_ambil_simpan = '$id_simpan'");

foreach ($tbl_pinjaman_u as $pinjam) {
    $id = $pinjam['id_ambil_simpan'];
    $nama = $pinjam['nama'];
    $jumlah = $pinjam['jumlah_ambil'];
    $tgl = $pinjam['tgl_ambil'];
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
                    <span>No. Simpanan : T-0<?= $id ?></span><br>
                    <span>Nama : <?= $nama ?> </span>
                    <span style="float:right;">Tanggal : <?= $tgl ?></span>
                    <h2 class="pb-4 border-bottom"></h2>
                    <h2 class="mt-4">TARIK SIMPANAN</h2>
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">JENIS TRANSAKSI :</span>
                            <span>TARIK SIMPANAN</span>
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
                            <span class="fs-5">Total Tarik Simpanan</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah, '0', '.', '.') ?> </span></b>
                        </div>
                        <!-- <div class="d-flex justify-content-between">
                            <span class="fs-5">Bunga Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($bunga, '0', '.', '.') ?> </span></b>
                        </div>
                        <div class="mb-4 d-flex justify-content-between">
                            <span class="fs-5">Total Pinjaman</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($jumlah + $bunga, '0', '.', '.') ?> </span></b>
                        </div> -->
                        <span style="float:right;" class="mt-4 fs-5">Bogor, <?= $tgl ?></span><br><br><br><br><br>
                        <center>
                            <h2>** Terima Kasih **</h2>
                        </center>
                        <a href="" class="btn btn-success btn-fill pull-rightfloat-right ms-2 d-print-none" style="float:right ;" onclick="window.print()">CETAK STRUK</a>
                        <a href="tarik_simpanan_user.php" button type="button" class="mb-5 btn btn-danger d-print-none">Kembali</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>