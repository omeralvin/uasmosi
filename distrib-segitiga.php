<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triangular Distribution</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

    <!-- link font awesome cdn -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <div class="jumbotron content">
        <div class="container">
            <h1 class="my-4">Distribusi Segitiga</h1>
            <h3>Contoh Soal </h3>
            <p> Diketahui:</p>
            <p>Cari distribusi bilangan 10, 20, 30, 40, 50 dan 60 (inputan program), dengan ketentuan jumlah trial = 20 (inputan program) menggunakan distribusi segitiga.</p>
            <form method="post" class="my-4">
                <div class="form-group">
                    <label for="inputData">Masukan Data (comma-separated):</label>
                    <input type="text" class="form-control" id="inputData" name="inputData" placeholder="e.g. 10, 20, 30, 40, 50, 60" required>
                </div>
                <div class="form-group">
                    <label for="numTrials">Jumlah Trial : </label>
                    <input type="number" class="form-control" id="numTrials" name="numTrials" value="20">
                </div>
                <button type="submit" class="btn btn-primary">Hitung</button>
            </form>

            <?php
            function triangularDistribution($min, $max, $mode, $numTrials)
            {
                $results = array();
                for ($i = 0; $i < $numTrials; $i++) {
                    $random = mt_rand() / mt_getrandmax();
                    $f = ($mode - $min) / ($max - $min);
                    if ($random <= $f) {
                        $results[] = $min + sqrt($random * ($max - $min) * ($mode - $min));
                    } else {
                        $results[] = $max - sqrt((1 - $random) * ($max - $min) * ($max - $mode));
                    }
                }
                return $results;
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $inputData = array_map("intval", explode(",", $_POST["inputData"]));
                $numTrials = intval($_POST["numTrials"]);
            ?>

                <div class="my-4">

                    <div class="alert alert-success" role="alert">
                        <h3>Hasil Distribusi </h3>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Distribution</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($inputData as $data) {
                                $results = triangularDistribution(0, 100, $data, $numTrials);
                                echo '<tr>';
                                echo '<td>' . $data . '</td>';
                                echo '<td>' . implode(", ", array_map(function ($val) {
                                    return number_format($val, 2);
                                }, $results)) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- <a href="javascript:history.back()" id="btn" class="btn ml-5"><i class="fas fa-arrow-left"></i> Kembali</a> -->
    <a href="index.html" id="btn" class="btn ml-5"><i class="fas fa-arrow-left"></i> Kembali</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-WH3J4IS6bUqLMpG8r+7aOXfqLdus3fIP7/JzoYSU35/f4yJxBnZI8jkr2KbTDN7H" crossorigin="anonymous"></script>
</body>

</html>