<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_user = $_GET['id_user'];

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT id_pinjam, telp, nama, jumlah_pinjam, riba, bulan, status_pinjam, DATE_FORMAT(tgl_pinjam, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_user = '$id_user' ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);
?>

<div class="py-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pinjaman
            </span>
            <a href="pinjaman_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 4%;" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Pinjaman</th>
                            <th class="text-center" scope="col">Tenor Bulan</th>
                            <th class="text-center" scope="col">Tanggal Pinjam</th>
                            <th class="text-center" style="width: 20%;" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tbl_pinjaman_a as $pinjam) {
                        ?>
                            <tr>
                                <td class="text-end"><?= $no++ ?></td>
                                <td><?= $pinjam['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($pinjam['jumlah_pinjam'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $pinjam['bulan'] ?> Bulan</td>
                                <td class="text-center"><?= $pinjam['tgl'] ?></td>
                                <td class="text-center">
                                    <?php if ($pinjam['status_pinjam'] == 'konfirmasi') { ?>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                            <form action="pinjaman_proses.php" method="POST">
                                                <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                                <input class="btn btn-sm btn-success ms-2" type="submit" name="selesai" value="selesai">
                                            </form>
                                        </div>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pengembalian') { ?>
                                        <div class="me-1">
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">pengembalian</span>
                                        </div>
                                    <?php } else if ($pinjam['status_pinjam'] == 'tolak') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'selesai') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Selesai</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pending') { ?>
                                        <form action="pinjaman_proses.php" method="POST">
                                            <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                            <input type="hidden" name="id_bunga" value="<?= $pinjam['bulan'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                            <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                        </form>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($pinjam['status_pinjam'] == "konfirmasi") : ?>
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=62<?= $pinjam['telp'] ?>&text=Hai%2C%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0APinjaman%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $pinjam['nama'] ?>%0A2.%20Jumlah%20Pinjaman%20%3A%20Rp.%20<?= number_format($pinjam['jumlah_pinjam'] - $pinjam['riba'], '0', '.', '.') ?>%0A3.%20Tenor%20Waktu%20%3A%20<?= $pinjam['bulan'] ?>%20Bulan%0A%0APinjaman%20anda%20telah%20kami%20*Konfirmasi*%2C%20Mohon%20cek%20saldo%20apakah%20sudah%20masuk%20ke%20dalam%20rekening%20anda.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php elseif ($pinjam['status_pinjam'] == "tolak") : ?>
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=62<?= $pinjam['telp'] ?>&text=Hai%2C%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0APinjaman%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $pinjam['nama'] ?>%0A2.%20Jumlah%20Pinjaman%20%3A%20Rp.%20<?= number_format($pinjam['jumlah_pinjam'] - $pinjam['riba'], '0', '.', '.') ?>%0A3.%20Tenor%20Waktu%20%3A%20<?= $pinjam['bulan'] ?>%20Bulan%0A%0APinjaman%20anda%20telah%20kami%20*Tolak*%2C%20Mohon%20cek%20saldo%20apakah%20sudah%20masuk%20ke%20dalam%20rekening%20anda.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php endif ?>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="pinjaman_proses.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>"><i class='bx bx-trash'></i></a>
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