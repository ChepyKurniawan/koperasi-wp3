<?php

$active = "tarik_simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-i H:i:s");


$id = $_SESSION['id_user'];

$tbl_user = $koneksi->query("SELECT * FROM tbl_user Where id_user = '$id'");

$tbl_simpanan = $koneksi->query("SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_simpan.id_user = tbl_user.id_user Where tbl_simpan.id_user = '$id'");
$data = mysqli_fetch_array($tbl_simpanan);
$cek = mysqli_num_rows($tbl_simpanan);

$tbl_ambil_simpanan = $koneksi->query("SELECT * FROM tbl_ambil_simpan JOIN tbl_user ON tbl_ambil_simpan.id_user = tbl_user.id_user Where tbl_ambil_simpan.id_user = '$id'");
$data_ambil = mysqli_fetch_array($tbl_ambil_simpanan);
$cek_ambil = mysqli_num_rows($tbl_ambil_simpanan);

$jumlah = 0;
foreach ($tbl_simpanan as $simpan) {
    $jumlah += $simpan['jumlah_simpan'];
}

?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <?php if (isset($_POST['btambah'])) : ?>
                <span class="fs-2 fw-bold">
                    Tarik Simpanan
                </span>
                <form method="POST">
                    <button href="" class="btn btn-danger" name="bkembali">Kembali</button>
                </form>
            <?php else : ?>
                <span class="fs-2 fw-bold">
                    Tarik Simpanan
                </span>
                <form method="POST">
                    <button href="" class="btn btn-success" name="btambah">Tarik Simpanan</button>
                </form>
            <?php endif ?>
        </div>
        <div class="card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <?php if ($cek > 0) : ?>
                    <form action="simpanan_proses.php" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah-pinjaman" class="form-label">Jumlah Tarik Sinjaman</label>
                                <input type="number" min="0" max="10000000" class="form-control" name="jumlah" id="jumlah-pinjaman">
                                <?php
                                if ($cek_ambil > 0) {
                                    $total = 0;
                                    $total += $data_ambil['jumlah_ambil'];

                                ?>
                                    <span class="form-text">Saldo Simpanan Anda (Rp. <?= number_format($data['jumlah_simpan'] - $total, '0', '.', '.') ?>)</span>
                                <?php } else { ?>
                                    <span class="form-text">Saldo Simpanan Anda (Rp. <?= number_format($jumlah, '0', '.', '.') ?>)</span>
                                <?php } ?>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="btn-tambah" type="submit" class="btn btn-primary" name="tarik_simpanan">Tarik</button>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="text-center">
                        <span class="fw-bold text-uppercase fs-3">Maaf anda belum memiliki saldo simpanan, silahkan menabung terlebih dahulu <a href="simpanan_user.php">disini</a></span>
                    </div>
                <?php endif ?>
            <?php else : ?>
                <div class="overflow-x-scroll table-responsive">
                    <table id="example" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 4%;" scope="col">No</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Jumlah</th>
                                <th class="text-center" scope="col">Hari dan Tanggal</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tbl_ambil_simpanan as $simpan) {
                            ?>
                                <tr>
                                    <td class="text-end"><?= $no++ ?></td>
                                    <td><?= $simpan['nama'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($simpan['jumlah_ambil'], '0', '.', '.') ?></td>
                                    <td class="text-center"><?= $simpan['tgl_ambil'] ?></td>
                                    <td class="text-center">
                                        <?php if ($simpan['status_ambil'] == 'konfirmasi') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                        <?php } else if ($simpan['status_ambil'] == 'tolak') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                        <?php } else if ($simpan['status_ambil'] == 'pending') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">Pending</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a type="submit" href="print_tarik.php?id_ambil_simpan=<?= $simpan['id_ambil_simpan'] ?>" class="text-white btn btn-sm btn-info">
                                            <i class='bx bx-printer'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>