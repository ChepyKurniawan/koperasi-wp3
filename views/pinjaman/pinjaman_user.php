<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
// $expires = date("Y-m-d H:i:s");

$id_user = $_SESSION['id_user'];

// Cek pinjam
$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT nama, jumlah_pinjam, status_pinjam, bulan, tbl_pinjam.id_pinjam, DATE_FORMAT(tgl_pinjam, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_pinjam JOIN tbl_user USING(id_user) JOIN tbl_bunga USING(id_bunga) WHERE tbl_pinjam.id_user = '$id_user' GROUP BY tbl_pinjam.id_pinjam");

$cek_pinjam = mysqli_num_rows($tbl_pinjaman_u);

// Query Simpanan
$querySimpan = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.status_simpan = 'konfirmasi' AND tbl_simpan.id_user = '$id_user'");
$cek = mysqli_num_rows($querySimpan);

// Query konfirmasi
$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user = '$id_user'");
$confirmArray = mysqli_fetch_array($confirmQuery);
$cekConfirm = mysqli_num_rows($confirmQuery);

// bunga
$id_bunga = 0;
$bunga = "";
$bulan = "";
$queryBulan = $koneksi->query("SELECT * FROM tbl_bunga");

// limit pinjaman
$limitQuery = mysqli_query($koneksi, "SELECT jumlah_simpan FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user ORDER BY tgl_simpan DESC");
$limit1 = mysqli_fetch_array($limitQuery);

// Cek limit
if (empty($limit['jumlah_simpan'])) {
    $total = 0;
}

// Perulangan limit simpan
$total = 0;
while ($total_simpan = mysqli_fetch_array($querySimpan)) {
    $total += $total_simpan['jumlah_simpan'];
    $grand_total = $total * 25 / 100;
}

// Perulangan limit pinjam
$queryPinjaman = mysqli_query($koneksi, "SELECT jumlah_pinjam, status_pinjam, riba FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) WHERE tbl_pinjam.status_pinjam = 'konfirmasi' AND tbl_pinjam.status_pinjam = 'pengembalian' AND tbl_pinjam.status_pinjam = 'selesai' OR tbl_pinjam.id_user = '$id_user'");
$total_bunga = 0;
while ($total_tampil = mysqli_fetch_array($queryPinjaman)) {
    $total_bunga += $total_tampil['riba'];
}

// Cek ambil simpanan
$tbl_ambil_simpanan = $koneksi->query("SELECT jumlah_ambil FROM tbl_ambil_simpan JOIN tbl_user ON tbl_ambil_simpan.id_user = tbl_user.id_user WHERE status_ambil = 'konfirmasi' AND tbl_ambil_simpan.id_user = '$id_user'");
$cek_ambil = mysqli_num_rows($tbl_ambil_simpanan);

$total_ambil = 0;
while ($total_ambil_simpan = mysqli_fetch_array($tbl_ambil_simpanan)) {
    $total_ambil += $total_ambil_simpan['jumlah_ambil'];
    $grand_ambil = $total_ambil * 25 / 100;
}

// Limit Pengembalian
if (isset($confirmArray['tgl_konfirmasi'])) {
    $expires = strtotime('+0 days', strtotime($confirmArray['tgl_konfirmasi']));
    $expired = date('Y-m-d H:i:s', $expires);
}

?>
<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header">
            <div class="d-md-flex justify-content-md-between align-items-md-center">
                <?php if (isset($_POST['btambah'])) : ?>
                    <span class="fs-2 fw-bold">
                        Tambah Pinjaman
                    </span>
                    <form method="POST">
                        <button type="submit" name="bkembali" class="btn btn-danger">Kembali</button>
                    </form>
                <?php elseif (isset($_POST['bpengembalian'])) : ?>
                    <span class="fs-2 fw-bold">
                        Pengembalian
                    </span>
                    <form method="POST">
                        <button type="submit" name="bkembali" class="btn btn-danger">Kembali</button>
                    </form>
                <?php else : ?>
                    <span class="fs-2 fw-bold">
                        Pinjaman
                    </span>
                    <form method="POST">
                        <button type="submit" name="btambah" class="mt-2 mt-md-0 btn btn-success">Tambah Pinjaman</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
        <div class="card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <?php if ($cek > 0) : ?>
                    <form action="pinjaman_proses.php" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-2">
                                <?php if ($cek_pinjam > 0 and $cek_ambil > 0) : ?>
                                    <label for="jumlah" class="form-label">Jumlah Pinjaman
                                        <small class="form-text fst-italic">* (Maks Pinjaman Rp. <?= number_format($grand_total + $total_bunga - $grand_ambil, '0', '.', '.') ?>)</small>
                                    </label>
                                    <input type="number" min="0" max="<?= $grand_total + $total_bunga ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php elseif ($cek_pinjam > 0) : ?>
                                    <label for="jumlah" class="form-label">Jumlah Pinjaman
                                        <small class="form-text fst-italic">* (Maks Pinjaman Rp. <?= number_format($grand_total + $total_bunga, '0', '.', '.') ?>)</small>
                                    </label>
                                    <input type="number" min="0" max="<?= $grand_total + $total_bunga ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php else : ?>
                                    <label for="jumlah" class="form-label">Jumlah Pinjaman <small class="form-text fst-italic">* (Maks Pinjaman Rp. <?= number_format($grand_total, '0', '.', '.') ?>)</small></label>
                                    <input type="number" min="0" max="<?= $grand_total ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php endif ?>
                                <small class="form-text fst-italic">* Harap masukan nominal terlebih dahulu, setelah itu pilih tempo bulan yang anda inginkan</small>
                            </div>
                            <div class="mb-2">
                                <label for="selectBulan" class="form-label">Tenor Bulan</label>
                                <select class="form-select" name="selectBulan" id="selectBulan" required>
                                    <option value="" hidden>
                                        -- Pilih Bulan --
                                    </option>
                                    <?php $no = 1;
                                    foreach ($queryBulan as $pay) {
                                        if ($payment == $pay['id_bunga']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                        <option value="<?= $pay['id_bunga'] ?>" <?= $selected ?>> <?= $pay['bulan'] ?> Bulan</option>
                                    <?php } ?>
                                </select>
                                <small class="form-text fst-italic">* Harap masukan tenor bulan yang anda inginkan</small>
                            </div>
                            <span name="bunga" id="bunga" class="d-none"></span>
                            <input type="hidden" id="valueBunga" name="valueBunga">
                            <span name="bulan" id="bulan" class="d-none"></span>
                            <div class="mb-3">
                                <label for="riba" class="form-label">Bunga Uang</label>
                                <span name="riba" id="subtotal" class="form-control input">0</span>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Pinjaman yang harus di bayar</label>
                                <span id="total" class="form-control">0</span>
                            </div>
                            <div class="mb-3">
                                <label for="perbulan" class="form-label">Bayar per bulan</label>
                                <input type="number" class="form-control" id="perbulan" value="0" readonly>
                            </div>
                            <div class="mb-3 d-none">
                                <input type="datetime" class="form-control" name="tgl_pinjam" value="<?= $today ?>">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" name="bpinjamuser">Pinjam</button>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="text-center">
                        <span class="fw-bold text-uppercase fs-3">Maaf Anda Blm Menanam Modal Di koperasi kami</span>
                    </div>
                <?php endif ?>
            <?php else : ?>
                <div class="overflow-x-scroll table-responsive">
                    <table id="example" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 4%;" scope="col">No</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Pinjaman</th>
                                <th class="text-center" scope="col">Tenor Bulan</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tbl_pinjaman_u as $pinjam) {
                                // $sisa_tenor = $pinjam['bulan'] -;
                            ?>
                                <tr>
                                    <td class="text-end"><?= $no++ ?></td>
                                    <td><?= $pinjam['nama'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($pinjam['jumlah_pinjam'], '0', '.', '.') ?></td>
                                    <td class="text-center"><?= $pinjam['bulan'] ?> Bulan</td>
                                    <td class="text-center"><?= $pinjam['tgl'] ?></td>
                                    <td class="text-center">
                                        <?php if ($pinjam['status_pinjam'] == 'konfirmasi') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                        <?php } else if ($pinjam['status_pinjam'] == 'tolak') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                        <?php } else if ($pinjam['status_pinjam'] == 'pengembalian') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">pengembalian</span>
                                        <?php } else if ($pinjam['status_pinjam'] == 'selesai') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Selesai</span>
                                        <?php } else if ($pinjam['status_pinjam'] == 'pending') { ?>
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">pending</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($cekConfirm > 0) : ?>
                                            <?php if ($today >= $expired) : ?>
                                                <div class="d-flex justify-content-center">
                                                    <a type="submit" href="print_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-info me-2">
                                                        <i class='bx bx-printer fs-5'></i>
                                                    </a>
                                                    <form method="POST">
                                                        <a type="submit" href="../pengembalian/pengembalian.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-success">Pengembalian</a>
                                                    </form>
                                                </div>
                                            <?php else : ?>
                                                <a type="submit" href="print_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-info">
                                                    <i class='bx bx-printer'></i>
                                                </a>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <a type="submit" href="print_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-info">
                                                <i class='bx bx-printer'></i>
                                            </a>
                                        <?php endif ?>
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
<script>
    $(document).ready(function() {
        $("#selectBulan").click(function() {
            $.ajax({
                url: 'bunga.php',
                type: 'post',
                data: {
                    id_bunga: $("#selectBulan").val()
                },
                dataType: "JSON",
                success: function(data) {
                    $(".form-group").show();
                    // $("#fee").text(data.fee);
                    $("#bunga").text(data.bunga);
                    $("#bulan").text(data.bulan);
                    var jumlah = parseInt(document.getElementById('jumlah').value);
                    let bunga = parseInt($('span[name="bunga"]').html())
                    let bulan = parseInt($('span[name="bulan"]').html())
                    let subtotal = parseInt(jumlah * (bunga / 10))
                    let total = parseInt(jumlah + subtotal)
                    let perbulan = parseInt(total / bulan)

                    $('#valueBunga').html(bunga)
                    document.querySelector('#valueBunga').value = bunga
                    $('#subtotal').html(subtotal)
                    document.querySelector('#subtotal').value = subtotal
                    $('#perbulan').html(perbulan)
                    document.querySelector('#perbulan').value = perbulan
                    $('#total').html(total)
                    document.querySelector('#total').value = total
                }
            });
        });
    });
</script>