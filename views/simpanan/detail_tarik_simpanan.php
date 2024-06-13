<?php
$active = "tarik_simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";


$id_user = $_GET['id_user'];

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT id_ambil_simpan, telp, nama, jumlah_ambil, status_ambil, DATE_FORMAT(tgl_ambil, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_ambil_simpan JOIN tbl_user ON tbl_user.id_user = tbl_ambil_simpan.id_user WHERE tbl_ambil_simpan.id_user = '$id_user'");
$data_a = mysqli_fetch_array($tbl_simpanan_a);

?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Tarik Simpanan
            </span>
            <a href="simpanan_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Tanggal Simpan</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tbl_simpanan_a as $simpan) {
                            $total = 0;
                            $total += $simpan['jumlah_ambil'];
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($total, '0', '.', '.') ?></td>
                                <td class="text-center"><?= $simpan['tgl'] ?></td>
                                <td class="text-center">
                                    <?php if ($simpan['status_ambil'] == 'konfirmasi') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                    <?php } else if ($simpan['status_ambil'] == 'tolak') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                    <?php } else if ($simpan['status_ambil'] == 'pending') { ?>
                                        <form action="simpanan_proses.php" method="POST">
                                            <input type="hidden" name="id_ambil" value="<?= $simpan['id_ambil_simpan'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="konfirmasi_tarik" value="Konfirmasi">
                                            <input class="btn btn-sm btn-danger" type="submit" name="tolak_tarik" value="Tolak">
                                        </form>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($simpan['status_ambil'] == 'konfirmasi') { ?>
                                        <a button class="btn btn-sm btn-success me-1" href="https://api.whatsapp.com/send?phone=62<?= $simpan['telp'] ?>&text=Hai%2C%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0ATarik%20Simpanan%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $simpan['nama'] ?>%0A2.%20Jumlah%20Tarik%20Simpanan%20%3A%20Rp.%20<?= number_format($simpan['jumlah_ambil'], '0', '.', '.') ?>%0A%0ASimpanan%20anda%20telah%20kami%20*Konfirmasi*%2C%20Saldo%20sudah%20masuk%20dan%20disimpan%20dalam%20koperasi%20kami.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php } else if ($simpan['status_ambil'] == 'tolak') { ?>
                                        <a button class="btn btn-sm btn-success me-1" href="https://api.whatsapp.com/send?phone=62<?= $simpan['telp'] ?>&text=Hai%2C%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0ATarik%20Simpanan%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $simpan['nama'] ?>%0A2.%20Jumlah%20Tarik%20Simpanan%20%3A%20Rp.%20<?= number_format($simpan['jumlah_ambil'], '0', '.', '.') ?>%0A%0ASimpanan%20anda%20telah%20kami%20*Tolak*%2C%20Mohon%20cek%20kembali%20apakah%20data%20sudah%20benar%20dan%20sesuai%20dengan%20no%20rekening%20kami.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php } ?>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="simpanan_proses.php?id_ambil_simpan=<?= $simpan['id_ambil_simpan'] ?>"><i class='bx bx-trash'></i></a>
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