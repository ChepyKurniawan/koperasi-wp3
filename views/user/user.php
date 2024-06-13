<?php
$active = 'user';
$title = "User | Koperasi";
include "../../layout/header.php";


$users = mysqli_query($koneksi, "SELECT * FROM tbl_user");

?>
<div class="pt-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Users
            </span>
            <?php
            // if (isset($_POST['btambah'])) : 
            ?>
            <!-- <form method="POST">
                <button href="" class="text-white btn btn-danger" type="submit" name="bbatal">Kembali</button>
                <button href="" class="text-white btn btn-warning" type="submit" name="btambah" disabled>Tambah Data</button>
            </form> -->
            <?php
            // else : 
            ?>
            <!-- <form method="POST">
                    <button href="" class="text-white btn btn-success" type="submit" name="btambah">Tambah Data</button>
                </form> -->
            <?php
            // endif 
            ?>
        </div>
        <div class="px-3 pt-3 card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <form>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tempat, Tanggal Lahir</label>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-8">
                                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Agama</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Pekerjaan</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Telp</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <div class="overflow-x-scroll table-responsive">
                    <table id="example" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Tempat, Tanggal Lahir</th>
                                <th class="text-center" scope="col">No. Telepon</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($users as $user) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td class="text-center"><?= $user['tempat_lahir'] ?>, <?= $user['tgl_lahir']; ?></td>
                                    <td class="text-center"><?= $user['telp']; ?></td>
                                    <td class="text-center">
                                        <a button class="text-white btn btn-sm btn-info" href="../profile/profile.php?id_user=<?= $user['id_user'] ?>"><i class='bx bx-edit'></i></a>
                                        <!-- <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a> -->
                                        <a button class="btn btn-delete btn-sm btn-danger" href="user_proses.php?id_user=<?= $user['id_user'] ?>"><i class='bx bx-trash'></i></a>
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