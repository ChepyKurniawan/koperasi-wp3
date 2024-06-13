<?php
$active = "tarik_simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";


$id_simpanan = $_SESSION['id_user'];

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT id_user, nama, SUM(jumlah_ambil) AS total_ambil FROM tbl_ambil_simpan LEFT JOIN tbl_user USING(id_user) GROUP BY id_user");
// $data_a = mysqli_fetch_array($tbl_simpanan_a);

?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Tarik Simpanan
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
                            <th class="text-center" style="width: 20%;" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tbl_simpanan_a as $simpan) {
                        ?>
                            <tr>
                                <td class="text-end"><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($simpan['total_ambil'], '0', '.', '.') ?></td>
                                <td class="text-center">
                                    <a class="rounded btn-sm btn fw-bold text-uppercase btn-outline-primary view_more" href="detail_tarik_simpanan.php?id_user=<?= $simpan['id_user'] ?>">Lihat Selengkapnya</a>
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