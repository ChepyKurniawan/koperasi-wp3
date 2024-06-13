<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');

$id = $_GET['id_pinjam'];
$id_user = $_SESSION['id_user'];

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_pinjam='$id'");
$confirmArray = mysqli_fetch_array($confirmQuery);

$pQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_pinjam.id_pinjam = '$id' ORDER BY tgl_pengembalian DESC LIMIT 1");
$pArray = mysqli_fetch_array($pQuery);
$pRows = mysqli_num_rows($pQuery);

$today = date("Y-m-d H:i:s");

$expires = strtotime('+30 days', strtotime($confirmArray['tgl_konfirmasi']));
$expired = date('Y-m-d H:i:s', $expires);

$expires1 = strtotime('+7 days', strtotime($today));
$expired1 = date('Y-m-d H:i:s', $expires1);

$expires2 = strtotime('+14 days', strtotime($today));
$expired2 = date('Y-m-d H:i:s', $expires2);

$expires3 = strtotime('+21 days', strtotime($today));
$expired3 = date('Y-m-d H:i:s', $expires3);

$total_bayar = $confirmArray['jumlah_pinjam'] / $confirmArray['bulan'];
?>
<div class="pt-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
            <form method="POST">
                <a type="submit" href="../pinjaman/pinjaman_user.php" class="btn btn-danger">Kembali</a>
            </form>
        </div>
        <div class="card-body">
            <form action="pengembalian_proses.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="mb-3">
                        <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                        <input type="hidden" name="id_pinjam" value="<?= $confirmArray['id_pinjam'] ?>">
                        <input type="hidden" name="pengembalian" value="pengembaiian">
                        <input type="hidden" class="form-control" name="id_konfirmasi_pinjam" value="<?= $confirmArray['id_konfirmasi_pinjam'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-pinjaman" class="form-label">Jumlah Pengembalian</label>
                        <input type="number" class="form-control" id="jumlah-pinjaman" name="jumlah" value="<?= round($total_bayar) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <?php if ($pRows > 0) : ?>
                            <label for="pengembalian_ke" class="form-label">Pengembalian Ke</label>
                            <input type="number" class="form-control" id="pengembalian_ke" name="pengembalian_ke" value="<?= $pArray['pengembalian_ke'] + 1 ?>" readonly>
                        <?php else : ?>
                            <label for="pengembalian_ke" class="form-label">Pengembalian Ke</label>
                            <input type="number" class="form-control" id="pengembalian_ke" name="pengembalian_ke" value="1" readonly>
                        <?php endif ?>
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
                    <?php
                    if ($expired1  >= $expired) :
                    ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="20000" readonly>
                        </div>
                    <?php
                    elseif ($expired2  >= $expired) :
                    ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="50000" readonly>
                        </div>
                    <?php
                    elseif ($expired3  >= $expired) :
                    ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="100000" readonly>
                        </div>
                    <?php
                    endif
                    ?>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Bukti Pembayaran</label>
                        <input class="form-control" name="bukti" type="file" id="formFile" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal-bayar" class="form-label">Tanggal Bayar</label>
                        <input type="datetime" class="form-control" id="tanggal-bayar" name="tanggal_bayar" value="<?= $today ?>" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="bpengembalian">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>