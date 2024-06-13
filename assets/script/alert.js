$(".btn-delete").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah kamu yakin?",
    text: "Data ini akan di hapus?",
    type: "warning",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete Records",
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        icon: "success",
        title: "Data berhasil di hapus",
        showConfirmButton: false,
      });
      setTimeout(function () {
        document.location.href = href;
      }, 1200);
    }
  });
});

$(".btn-logout").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Are you sure?",
    text: "Want to leave this website?",
    type: "warning",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Logout",
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        icon: "success",
        title: "Anda berhasil logout",
        showConfirmButton: false,
      });
      setTimeout(function () {
        document.location.href = href;
      }, 1200);
    }
  });
});

const notifikasi = $(".info-data").data("infodata");

if (notifikasi == "Disimpan") {
  Swal.fire({
    icon: "success",
    title: "Data berhasil disimpan",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Gagal") {
  Swal.fire({
    icon: "error",
    title: "Data gagal disimpan",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Kosong") {
  Swal.fire({
    position: "center",
    icon: "warning",
    title: "Warning",
    text: "Username atau password anda salah",
    showConfirmButton: false,
    timer: 2000,
  });
} else if (notifikasi == "Berhasil") {
  Swal.fire({
    icon: "success",
    title: "Anda berhasil login",
    text: "Selamat datang diwebsite koperasi kami",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Konfirmasi") {
  Swal.fire({
    icon: "success",
    title: "Data telah dikonfirmasi",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Tolak") {
  Swal.fire({
    icon: "error",
    title: "Data telah ditolak",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Selesai") {
  Swal.fire({
    icon: "success",
    title: "Data telah selesai",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "berhasil di buat") {
  Swal.fire({
    icon: "success",
    title: "Akun Berhasil di buat",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "email sudah di gunakan") {
  Swal.fire({
    icon: "error",
    title: "Email sudah di gunakan",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "ukuran") {
  Swal.fire({
    icon: "error",
    title: "Gagal",
    text: "Ukuran file terlalu besar, maks 1mb",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "format") {
  Swal.fire({
    icon: "error",
    title: "Gagal",
    text: "Format file tidak sesuai, format file harus png dan jpg",
    showConfirmButton: false,
    timer: 1500,
  });
}
