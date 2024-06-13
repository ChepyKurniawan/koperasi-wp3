<?php
$active = "dashboard";
$title = "Dashboard | Koperasi";
include "../../layout/header.php";

// Session ID
$id = $_SESSION['id_user'];

// Saldo Pinjaman
$saldo_pinjaman_u = mysqli_query($koneksi, "SELECT jumlah_pinjam FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user WHERE (tbl_pinjam.id_user = '$id' OR tbl_pinjam.status_pinjam = 'konfirmasi' AND tbl_pinjam.status_pinjam = 'pengembalian' AND tbl_pinjam.status_pinjam = 'selesai')");
$saldo_pinjaman_a = mysqli_query($koneksi, "SELECT jumlah_pinjam FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user");
// Akhir Saldo Pinjaman

// Saldo Simpanan
$saldo_simpanan_u = mysqli_query($koneksi, "SELECT jumlah_simpan FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.status_simpan = 'konfirmasi'  AND tbl_simpan.id_user = '$id'");
$saldo_simpanan_a = mysqli_query($koneksi, "SELECT jumlah_simpan FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user");
// Akhir Saldo Simpanan

$user = mysqli_num_rows($koneksi->query("SELECT nama FROM tbl_user"));

?>

<div class="container pt-5">
    <?php if ($_SESSION['level'] == 'admin') : ?>
        <div class="mb-3 row d-flex justify-content-center">
            <div class="col-md-3">
                <div class="text-white card bg-danger" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="text-center col-2">
                            <i class='bx bx-credit-card fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">User</h5>
                            <span class="fw-bold"><?= $user ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="text-white card bg-success" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="text-center col-2">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <?php
                        $total_simpanan_a = 0;
                        while ($tampil_simpanan_a = mysqli_fetch_array($saldo_simpanan_a)) {
                            $total_simpanan_a += $tampil_simpanan_a['jumlah_simpan'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_simpanan_a) ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="text-white card bg-warning" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="text-center col-2">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <?php
                        $total_pinjaman_a = 0;
                        while ($tampil_pinjaman_a = mysqli_fetch_array($saldo_pinjaman_a)) {
                            $total_pinjaman_a += $tampil_pinjaman_a['jumlah_pinjam'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_pinjaman_a) ?> </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?php include "../../components/chart_simpanan.php"; ?>
            </div>
            <div class="mb-3 col-6">
                <?php include "../../components/chart_pinjaman.php"; ?>
            </div>
            <div class="mb-5 col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="p-2 d-flex justify-content-between">
                            <h3>Method Payment</h3>
                            <button class="btn btn-sm btn-primary">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-sm table-striped table-bordered d-md-block d-lg-table overflow-sm-auto">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Payment</th>
                                    <th scope="col">Metode Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-3 mb-sm-2">
                <div class="text-white card bg-success" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="text-center col-2">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <?php
                        $total_simpanan_u = 0;
                        while ($tampil_simpanan_u = mysqli_fetch_array($saldo_simpanan_u)) {
                            $total_simpanan_u += $tampil_simpanan_u['jumlah_simpan'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_simpanan_u) ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="text-white card bg-warning" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="text-center col-2">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <?php
                        $tota_pinjaman_u = 0;
                        while ($tampil_pinjaman_u = mysqli_fetch_array($saldo_pinjaman_u)) {
                            $tota_pinjaman_u += $tampil_pinjaman_u['jumlah_pinjam'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp. <?= number_format($tota_pinjaman_u) ?> </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>

<!-- Footer -->
<?php include "../../layout/footer.php" ?>