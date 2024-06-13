<?php
$active = 'Home';
$title = "Home | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
?>

<style>
  @import url("https://fonts.googleapis.com/css?family=Poppins:400,700");

  .lines {
    margin: auto;
    width: 70px;
    position: relative;
    border-top: 2px solid #2192ff;
    margin-top: 15px;
  }

  .btn-common {
    border: 1px solid #2192ff;
    background: #2192ff;
    position: relative;
    color: #fff;
    z-index: 1;
    border-radius: 30px;
  }

  .btn-common:hover {
    color: #fff;
    background: #1484ec;
    border-color: #1484ec;
    transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
  }

  p {
    font-size: 20px;
    line-height: 26px;
  }

  span {
    font-size: 14px;
    line-height: 26px;
  }

  .section-header {
    color: #fff;
    margin-bottom: 40px;
    text-align: center;
  }

  .section-header .section-title {
    font-size: 42px;
    margin-top: 0;
    text-transform: uppercase;
    font-weight: 700;
    color: #333;
    position: relative;
  }
</style>

<div class="container-fluid">
  <section class="mb-3">
    <div class="">
      <div class="text-center section-header">
        <h2 class="section-title">Tentang Kami</h2>
        <hr class="mb-3 lines" />
      </div>
      <div class="row">
        <div class="order-2 order-md-1 col-12 col-md-6" style="text-align: justify;">
          <p class="">Dengan semangat perubahan dan visi menjadi koperasi terkini dan inovatif di Indonesia, Koperasi Namastra bertekad untuk menjadi koperasi yang modern, profesional dan antusias dalam membangun perekonomian rakyat. Perwujudan keseriusan para pendiri terlihat dalam penempatan pengelola yang sudah memiliki banyak pengalaman di Perbankan dan Koperasi.</p>
          <a href="<?php echo $config ?>views/simpanan/simpanan_user.php" class="btn btn-common">Simpan Sekarang</a>
        </div>
        <div class="order-1 mb-2 order-md-2 col-12 col-md-6">
          <img src="../../assets/landing-page/img/tentang-kami.jpg" width="100%" class="shadow">
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="">
      <div class="row">
        <div class="mt-2 mb-2 text-center section-header">
          <h2 class="section-title">Visi & Misi</h2>
          <hr class="mb-3 lines" />
        </div>
        <div class="mb-3 col-12">
          <div class="shadow-sm card">
            <div class="card-header">
              <h4>VISI</h4>
            </div>
            <div class="card-body">
              <span>Meningkatkan peran serta anggota dalam berkoperasi untuk mendukung terbentunya dunia usaha yang produktif sehingga dapat mewujudkan kesejahteraan dan keadilan Ekonomi serta Kemandirian Usaha bagi Anggota Koperasi “Makmur Mandiri”.</span>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="shadow-sm card">
            <div class="card-header">
              <h4>MISI</h4>
            </div>
            <div class="card-body">
              <ul>
                <li>Mengoptimalkan dan memberdayakan aset-aset ekonomi para anggota koperasi untuk disinergikan dalam suatu pemberdayaan ekonomi Koperasi sehingga membentuk sistem perekonomian yang kuat dan tangguh dalam memenangi persaingan dunia usaha.</li>
                <li>Meningkatkan kesadaran seluruh anggota akan manfaat bersama pentingnya koperasi melalui pendidikan perkoperasian.</li>
                <li>Membentuk unit – unit usaha produktif yangsehat dan mandiri dalam upaya meningkatkan kesejahteraan bagi seluruh anggota Koperasi “Makmur Mandiri”.</li>
                <li>Meningkatkan pruduktivitas dan daya saing yang tinggi dengan mengembangkan sinergi dan partisipasi seluruh anggota dalam mengelola unit -unit usaha Koperasi “Makmur Mandiri”.</li>
                <li>Membuktikan bahwa sistem perekonomian koperasi adalah sistem ekonomi pemberdayaan masyarakat yang terbaik sehingga koperasi dapat memberikan citra yang positif bagi kendala keterbatasan multidimensi untuk meningkatkan pendapatan yang pada akhirnya dapat memperbaiki kesejahteraan anggota koperasi yang lebih baik.</li>
                <li>Memantapkan Koperasi “Makmur Mandiri” sebagai sebuah perusahaan dengan jati diri koperasi melalui penyelenggaraan sistem ekonomi kerakyatan.</li>
                <li>Berperan serta membantu Pemerintah untuk menjalankan program – program pemberdayaan sehingga koperasi berperan aktif dalam meningkatkan kesejahteraan masyarakat.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include "../../layout/footer.php" ?>