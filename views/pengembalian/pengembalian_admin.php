<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT id_user, tbl_pinjam.id_pinjam, nama, jumlah_pinjam, bulan, MAX(pengembalian_ke) as sisa_tenor, DATE_FORMAT(tgl_pinjam, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_pinjam LEFT JOIN tbl_user USING(id_user) LEFT JOIN konfirmasi_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) LEFT JOIN tbl_pengembalian ON (tbl_pengembalian.id_konfirmasi_pinjam = konfirmasi_pinjam.id_konfirmasi_pinjam) LEFT JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) GROUP BY tbl_pinjam.id_pinjam");

?>
<div class="pt-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 4%;" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Tenor Bulan</th>
                            <th class="text-center" scope="col">Tanggal Pinjam</th>
                            <th class="text-center" scope="col">Sisa Tenor</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($confirmQuery as $kembali) {
                        ?>
                            <tr>
                                <td class="text-end"><?= $no++ ?></td>
                                <td><?= $kembali['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($kembali['jumlah_pinjam'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $kembali['bulan'] ?> Bulan</td>
                                <td class="text-center"><?= $kembali['tgl'] ?></td>
                                <?php if ($kembali['bulan'] - $kembali['sisa_tenor'] == 0) { ?>
                                    <td class="text-center">
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Lunas</span>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center"><?= $kembali['bulan'] - $kembali['sisa_tenor'] ?> Bulan</td>
                                <?php } ?>
                                <td class="text-center">
                                    <a class="rounded btn-sm btn fw-bold text-uppercase btn-outline-primary view_more" href="detail_pengembalian_admin.php?id_pinjam=<?= $kembali['id_pinjam'] ?>">Lihat Selengkapnya</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>