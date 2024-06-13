<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$queryPinjaman = mysqli_query($koneksi, "SELECT id_user, nama, SUM(jumlah_pinjam) AS total_pinjam FROM tbl_pinjam LEFT JOIN tbl_user USING(id_user) GROUP BY id_user");
$pinjamanArray = mysqli_fetch_array($queryPinjaman);
?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class=" fs-2 fw-bold">
                Pinjaman
            </span>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 4%;" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Pinjaman</th>
                            <th class="text-center" style="width: 20%;" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($queryPinjaman as $pinjam) {
                        ?>
                            <tr>
                                <td class="text-end"><?= $no++ ?></td>
                                <td><?= $pinjam['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($pinjam['total_pinjam'], '0', '.', '.') ?></td>
                                <td class="text-center">
                                    <a class="rounded btn-sm btn fw-bold text-uppercase btn-outline-primary view_more" href="detail_pinjaman.php?id_user=<?= $pinjam['id_user'] ?>">Lihat Selengkapnya</a>
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