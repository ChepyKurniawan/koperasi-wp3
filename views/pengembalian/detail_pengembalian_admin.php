<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT *, DATE_FORMAT(tgl_pengembalian, '%d %M %Y - %H:%i:%s') as tgl FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_pinjam = '$_GET[id_pinjam]'");

?>
<div class="pt-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
            <a href="pengembalian_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 4%;" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Pengembalian Ke</th>
                            <th class="text-center" scope="col">Tanggal Pengembalian</th>
                            <th class="text-center" scope="col">Bukti</th>
                            <th class="text-center" scope="col">Status</th>
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
                                <td class="text-center">Rp. <?= number_format($kembali['jumlah_pengembalian'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $kembali['pengembalian_ke'] ?></td>
                                <td class="text-center"><?= $kembali['tgl'] ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bimg<?= $no ?>">
                                        <i class='bx bx-show'></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <?php if ($kembali['status_pengembalian'] == "pending") : ?>
                                        <form action="pengembalian_proses.php" method="POST">
                                            <input type="hidden" name="id_pinjam" value="<?= $kembali['id_pinjam'] ?>">
                                            <input type="hidden" name="id_pengembalian" value="<?= $kembali['id_pengembalian'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                            <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                        </form>
                                    <?php elseif ($kembali['status_pengembalian'] == "konfirmasi") : ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Lunas</span>
                                    <?php endif  ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($kembali['status_pengembalian'] == "konfirmasi") : ?>
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=62<?= $kembali['telp'] ?>&text=Hai,%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0APengembalian%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $kembali['nama'] ?>%0A2.%20Jumlah%20Pengembalian%20%3A%20Rp.%20<?= number_format($kembali['jumlah_pengembalian'], '0', '.', '.') ?>%0A%0APengembalian%20anda%20telah%20kami%20*Konfirmasi*%2C%20Saldo%20sudah%20masuk%20ke%20dalam%20rekening%20kami.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php elseif ($kembali['status_pengembalian'] == "tolak") : ?>
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=62<?= $kembali['telp'] ?>&text=Hai,%20kami%20admin%20dari%20Koperasi%20Makmur%20Mandiri%0A%0APengembalian%20anda%20dengan%20data%20berikut%20%0A1.%20Nama%20%3A%20<?= $kembali['nama'] ?>%0A2.%20Jumlah%20Pengembalian%20%3A%20Rp.%20<?= number_format($kembali['jumlah_pengembalian'], '0', '.', '.') ?>%0A%0APengembalian%20anda%20telah%20kami%20*Tolak*%2C%20Mohon%20dicek%20kembali%20data%20yang%20anda%20masukan%20seperti%20rekening%20dan%20bukti%20pembayaran.%0A%0ATerimakasih."><i class='bx bxl-whatsapp'></i></a>
                                    <?php endif  ?>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="pengembalian_proses.php?id_pengembalian=<?= $kembali['id_pengembalian'] ?>"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="bimg<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="../../assets/bukti_pengembalian/<?= $kembali['bukti_pengembalian'] ?>" class="w-100" alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>