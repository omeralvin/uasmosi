<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

    <!-- link font awesome cdn -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Simulasi Antrean</title>
</head>

<body>
    <div class="jumbotron content">
        <h1>Simulasi Antrean</h1>
        <h3>Contoh Soal </h3>
        <p> Diketahui:</p>
        <p>Diketahui rata-rata waktu kedatangan 40 menit/kedatangan dan rata-rata pelayanan 60 menit/pelayanan. Dengan menggunakan data random m=13, a=7, xo=1. Berapa panjang antrean dan presentase waktu tunggu untuk 10 kedatangan?

            <hr>
        <form method="post" action="">
            <div class="mb-3">
                <label for="rata_rata_kedatangan" class="form-label">Rata-rata Kedatangan (menit/kedatangan)</label>
                <input type="number" class="form-control" step="any" name="rata_rata_kedatangan" required>
            </div>
            <div class="mb-3">
                <label for="rata_rata_pelayanan" class="form-label">Rata-rata Pelayanan (menit/pelayanan) : </label>
                <input type="number" class="form-control" step="any" name="rata_rata_pelayanan" required>
            </div>
            <div class="center">
                <button type="submit" class="btn">Hitung</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rata_rata_kedatangan = $_POST["rata_rata_kedatangan"];
            $rata_rata_pelayanan = $_POST["rata_rata_pelayanan"];

            // Simulasi menggunakan data random m=13, a=7, xo=1
            $m = 13;
            $a = 7;
            $xo = 1;

            // Fungsi untuk menghasilkan data random
            function randomData($n)
            {
                global $m, $a, $xo;
                $data = array();
                for ($i = 0; $i < $n; $i++) {
                    $xo = ($a * $xo) % $m;
                    $data[] = $xo;
                }
                return $data;
            }

            // Jumlah kedatangan
            $jumlah_kedatangan = 10;

            // Data kedatangan dan pelayanan
            $data_kedatangan = randomData($jumlah_kedatangan);
            $data_pelayanan = randomData($jumlah_kedatangan);

            // Menghitung panjang antrean dan presentase waktu tunggu
            $panjang_antrean = 0;
            $total_waktu_tunggu = 0;
            for ($i = 0; $i < $jumlah_kedatangan; $i++) {
                if ($i == 0) {
                    $waktu_tunggu = 0;
                } else {
                    $waktu_tunggu = max(0, $total_waktu_tunggu + $data_pelayanan[$i] - $data_kedatangan[$i]);
                }
                $total_waktu_tunggu += $waktu_tunggu;
                $panjang_antrean += $waktu_tunggu;
            }
            $presentase_waktu_tunggu = ($total_waktu_tunggu / ($jumlah_kedatangan * $rata_rata_kedatangan + $total_waktu_tunggu)) * 100;
        ?>

            <hr>
            <div class="alert alert-success" role="alert">
                <h3>Hasil Simulasi:</h3>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="h5 mb-2 font-weight-bold text-gray-800">Rata-rata Kedatangan</div>
                                    <div class="h1 font-weight-bold text-primary text-uppercase mb-1">
                                        <?php echo $rata_rata_kedatangan; ?>
                                    </div>
                                    <div class="h5 mb-0 text-gray-800">menit/kedatangan</div>
                                </div>
                                <!-- <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="h5 mb-2 font-weight-bold text-gray-800">Rata-rata Pelayanan</div>
                                    <div class="h1 font-weight-bold text-success text-uppercase mb-1">
                                        <?php echo $rata_rata_pelayanan; ?>
                                    </div>
                                    <div class="h5 mb-0 text-gray-800">menit/pelayanan</div>
                                </div>
                                <!-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="h5 mb-2 font-weight-bold text-gray-800">Panjang Antrian</div>
                                    <div class="h1 font-weight-bold text-success text-uppercase mb-1">
                                        <?php echo $panjang_antrean; ?>
                                    </div>
                                    <div class="h5 mb-0 text-gray-800">menit</div>
                                </div>
                                <!-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-center">
                                    <div class="h5 mb-2 font-weight-bold text-gray-800">Presentase Waktu Tunggu</div>
                                    <div class="h1 font-weight-bold text-info text-uppercase mb-1">
                                        <?php echo number_format($presentase_waktu_tunggu, 2); ?> %
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- <a href="javascript:history.back()" id="btn" class="btn ml-5"><i class="fas fa-arrow-left"></i> Kembali</a> -->
    <a href="index.html" id="btn" class="btn ml-5"><i class="fas fa-arrow-left"></i> Kembali</a>
</body>

</html>