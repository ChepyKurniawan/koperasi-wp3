<?php

// Chart
$chart = mysqli_query($koneksi, "SELECT MONTHNAME(tgl_simpan) as monthname_simpan, SUM(jumlah_simpan) as jumlah_simpan FROM tbl_simpan GROUP BY monthname_simpan ORDER BY tgl_simpan");

foreach ($chart as $data) {
    $month[] = $data['monthname_simpan'];
    $jumlah[] = $data['jumlah_simpan'];
}

$chart_pinjaman = mysqli_query($koneksi, "SELECT MONTHNAME(tgl_pinjam) as monthname_pinjam, SUM(jumlah_pinjam) as jumlah_pinjam FROM tbl_pinjam GROUP BY monthname_pinjam ORDER BY tgl_pinjam");

foreach ($chart_pinjaman as $data_pinjaman) {
    $month_pinjaman[] = $data_pinjaman['monthname_pinjam'];
    $jumlah_pinjaman[] = $data_pinjaman['jumlah_pinjam'];
}



?>
<div class="gap-1 mb-2 d-flex flex-md-row flex-column">
    <div class="p-2 shadow-sm w-100 card">
        <canvas style="height: 400px;" id="chartSimpanan"></canvas>
    </div>
    <div class="p-2 shadow-sm w-100 card">
        <canvas style="height: 400px;" id="chartPinjaman"></canvas>
    </div>
</div>
<script>
    const labelsSimpanan = <?= json_encode($month) ?>;
    const dataSimpanan = {
        labels: labelsSimpanan,
        datasets: [{
            label: 'Saldo Simpanan',
            data: <?= json_encode($jumlah) ?>,
            backgroundColor: [
                'rgba(255, 205, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const configSimpanan = {
        type: 'bar',
        data: dataSimpanan,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const chartSimpanan = new Chart(
        document.getElementById('chartSimpanan'),
        configSimpanan
    );

    const labelsPinjaman = <?= json_encode($month_pinjaman) ?>;
    const dataPinjaman = {
        labels: labelsPinjaman,
        datasets: [{
            label: 'Saldo Pinjaman',
            data: <?= json_encode($jumlah_pinjaman) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const configPinjaman = {
        type: 'bar',
        data: dataPinjaman,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const chartPinjaman = new Chart(
        document.getElementById('chartPinjaman'),
        configPinjaman
    );
</script>