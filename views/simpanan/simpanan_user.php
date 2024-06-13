<?php

$active = "simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-i H:i:s");


$id_simpanan = $_SESSION['id_user'];

$tbl_user = $koneksi->query("SELECT * FROM tbl_user Where id_user = '$id_simpanan'");
$tbl_simpanan_u = $koneksi->query("SELECT *, DATE_FORMAT(tgl_simpan, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_simpan JOIN tbl_user ON tbl_simpan.id_user = tbl_user.id_user Where tbl_simpan.id_user = '$id_simpanan'");
$data_u = mysqli_fetch_array($tbl_user);
$cek = mysqli_num_rows($tbl_simpanan_u);
?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header">
            <?php if (isset($_POST['btambah'])) : ?>
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                    <span class="fs-2 fw-bold">
                        Tambah Simpanan
                    </span>
                    <form method="POST">
                        <button href="" class="btn btn-danger" name="bkembali">Kembali</button>
                    </form>
                </div>
            <?php else : ?>
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                    <span class="fs-2 fw-bold">
                        Simpanan
                    </span>
                    <form method="POST">
                        <button href="" class="btn btn-success" name="btambah">Tambah Simpanan</button>
                    </form>
                </div>
            <?php endif ?>
        </div>
        <div class="card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <?php
                if (empty($data_u['tempat_lahir'])) :
                ?>
                    <div class="text-center">
                        <span class="fw-bold text-uppercase fs-3">Maaf Data Diri Anda Belum Lengkap, harap isi data diri anda <a href="../profile/profile.php">disini</a></span>
                    </div>
                <?php
                else :
                ?>
                    <form action="simpanan_proses.php" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah-pinjaman" class="form-label">Jumlah Simpanan</label>
                                <input type="number" min="0" max="10000000" class="form-control" name="jumlah" id="jumlah-pinjaman">
                            </div>
                            <div class="mb-3">
                                <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" aria-label="Default select example" required name="id_pembayaran">
                                    <option value="" hidden>-- Pilih Pembayaran --</option>
                                    <?php
                                    $query_pembayaran = mysqli_query($koneksi, "SELECT * FROM tbl_pembayaran");
                                    foreach ($query_pembayaran as $pembayaran) { ?>
                                        <option value="<?= $pembayaran['id_pembayaran'] ?>"><?= $pembayaran['no_pembayaran'] ?> (<?= $pembayaran['method_pembayaran'] ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Bukti Pembayaran</label>
                                <input class="form-control" name="bukti" type="file" id="formFile">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="btn-tambah" type="submit" class="btn btn-primary" name="bUser">Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php
                endif
                ?>
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
                            foreach ($tbl_simpanan_u as $simpan) {
                            ?>
                                <tr>
                                    <td class="text-end"><?= $no++ ?></td>
                                    <td><?= $simpan['nama'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($simpan['jumlah_simpan'], '0', '.', '.') ?></td>
                                    <td class="text-center"><?= $simpan['tgl'] ?></td>
                                    <td class="text-center">
                                        <?php if ($simpan['status_simpan'] == 'konfirmasi') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                        <?php } else if ($simpan['status_simpan'] == 'tolak') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                        <?php } else if ($simpan['status_simpan'] == 'pending') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">Pending</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a type="submit" href="print_simpanan.php?id_simpan=<?= $simpan['id_simpan'] ?>" class="text-white btn btn-sm btn-info">
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