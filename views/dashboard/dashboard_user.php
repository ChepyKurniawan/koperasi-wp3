<?php
$active = "dashboard";
$title = "Dashboard | Koperasi";
include "../../layout/header.php";

// Session ID
$id = $_SESSION['id_user'];

// Saldo Pinjaman
$saldo_pinjaman = mysqli_query($koneksi, "SELECT jumlah_pinjam FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user WHERE (tbl_pinjam.id_user = '$id' OR tbl_pinjam.status_pinjam = 'konfirmasi' AND tbl_pinjam.status_pinjam = 'pengembalian' AND tbl_pinjam.status_pinjam = 'selesai')");
// Akhir Saldo Pinjaman

// Saldo Simpanan
$saldo_simpanan = mysqli_query($koneksi, "SELECT jumlah_simpan FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.status_simpan = 'konfirmasi'  AND tbl_simpan.id_user = '$id'");
// Akhir Saldo Simpanan

$query_simpanan = $koneksi->query("SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_simpan.id_user = tbl_user.id_user Where tbl_simpan.id_user = '$id'");

$query_ambil = $koneksi->query("SELECT * FROM tbl_ambil_simpan JOIN tbl_user ON tbl_ambil_simpan.id_user = tbl_user.id_user Where status_ambil = 'konfirmasi' and tbl_ambil_simpan.id_user = '$id'");

$cek_ambil = mysqli_num_rows($query_ambil);

$total_ambil = 0;
while ($ambil_simpan = mysqli_fetch_array($query_ambil)) {
    $total_ambil += $ambil_simpan['jumlah_ambil'];
}

?>

<style>

</style>

<div class="pt-3 container-fluid">
    <div class="gap-3 mb-3 d-md-flex align-items-center">
        <div class="mb-3 bg-opacity-75 shadow-sm card w-100 mb-md-0 bg-success">
            <div class=" card-body text-end">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="bx bx-wallet icon-i"></i>
                    <div class="mb-3 d-flex flex-column">
                        <span class="mb-1 text-white fz-1">Saldo Simpanan</span>
                        <?php
                        $total_simpanan = 0;
                        while ($tampil_simpanan = mysqli_fetch_array($saldo_simpanan)) {
                            $total_simpanan += $tampil_simpanan['jumlah_simpan'];
                        } ?>
                        <?php if ($cek_ambil > 0) { ?>
                            <span class="mb-2 text-white fz-2">Rp. <?= number_format($total_simpanan - $total_ambil) ?></span>
                        <?php } else { ?>
                            <span class="mb-2 text-white fz-2">Rp. <?= number_format($total_simpanan) ?></span>
                        <?php } ?>
                        <div class="">
                            <a href="../simpanan/simpanan_user.php" class="text-white btn btn-sm btn-info">Tambah</a>
                            <a href="../simpanan/tarik_simpanan_user.php" class="btn btn-sm btn-danger">Tarik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-opacity-75 shadow-sm card w-100 bg-info">
            <div class="card-body text-end">
                <div class="d-flex justify-content-between align-items-center ">
                    <i class="bx bx-money-withdraw icon-i"></i>
                    <div class="mb-3 d-flex flex-column">
                        <span class="mb-1 text-white fz-1">Saldo Pinjaman</span>
                        <?php
                        $tota_pinjaman = 0;
                        while ($tampil_pinjaman = mysqli_fetch_array($saldo_pinjaman)) {
                            $tota_pinjaman += $tampil_pinjaman['jumlah_pinjam'];
                        } ?>
                        <span class="mb-2 text-white fz-2">Rp. <?= number_format($tota_pinjaman) ?> </span>
                        <div class="d-flex d-md-block flex-column align-items-end">
                            <a href="../pinjaman/pinjaman_user.php" class="mb-1 btn mb-md-0 btn-sm btn-success">Pinjam</a>
                            <a href="../pengembalian/pengembalian_user.php" class="btn btn-sm btn-danger">Pengembalian</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow-sm card">
        <div class="card-header">
            <span class="fs-4 fw-bold">
                Aktivitas Bulanan
            </span>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-sm table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 4%;" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Hari dan Tanggal</th>
                            <th class="text-center" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($query_simpanan as $simpan) {
                        ?>
                            <tr>
                                <td class="text-end"><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($simpan['jumlah_simpan'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $simpan['tgl_simpan'] ?></td>
                                <td class="text-center">
                                    <?php if ($simpan['status_simpan'] == 'konfirmasi') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                    <?php } else if ($simpan['status_simpan'] == 'tolak') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                    <?php } else if ($simpan['status_simpan'] == 'pending') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">Pending</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include "../../layout/footer.php" ?>