<?php
function hitung_profile_matching($alternatif, $preferensi) {
    $hasil_matching = [];

    foreach ($alternatif as $karyawan => $nilai_aspek) {
        $total_skor = 0;

        foreach ($nilai_aspek as $aspek => $faktor) {
            if ($preferensi[$aspek] == 'max') {
                $skor_aspek = array_sum($faktor);
            } else {
                $skor_aspek = count($faktor) - array_sum($faktor);
            }

            $total_skor += $skor_aspek;
        }

        $hasil_matching[$karyawan] = $total_skor;
    }

    return $hasil_matching;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_karyawan = $_POST['jumlah_karyawan'];
    $jumlah_preferensi = $_POST['jumlah_preferensi'];
    $karyawan = $_POST['karyawan'];
    $preferensi = [];
    $jumlah_aspek = [];
    $nilai_min = [];
    $nilai_max = [];

    for ($i = 0; $i < $jumlah_preferensi; $i++) {
        $preferensi["Preferensi " . ($i + 1)] = $_POST['preferensi'][$i];
        $jumlah_aspek["Preferensi " . ($i + 1)] = $_POST['jumlah_aspek'][$i];
        $nilai_min["Preferensi " . ($i + 1)] = $_POST['nilai_min'][$i];
        $nilai_max["Preferensi " . ($i + 1)] = $_POST['nilai_max'][$i];
    }

    // Membuat data karyawan dan nilai-nilai faktor secara acak
    $alternatif = [];
    for ($i = 0; $i < $jumlah_karyawan; $i++) {
        $nama_karyawan = !empty($karyawan[$i]) ? $karyawan[$i] : "Karyawan " . ($i + 1);
        $alternatif[$nama_karyawan] = [];

        for ($j = 1; $j <= $jumlah_preferensi; $j++) {
            $alternatif[$nama_karyawan]["Preferensi $j"] = [];
            for ($k = 0; $k < $jumlah_aspek["Preferensi $j"]; $k++) {
                $alternatif[$nama_karyawan]["Preferensi $j"][] = mt_rand($nilai_min["Preferensi $j"] * 100, $nilai_max["Preferensi $j"] * 100) / 100;
            }
        }
    }

    // Menghitung profile matching
    $hasil_profile_matching = hitung_profile_matching($alternatif, $preferensi);

    // Menampilkan hasil dalam bentuk tabel
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Hasil Profile Matching</title>";
    echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container mt-5'>";
    echo "<h1 class='text-center'>Hasil Profile Matching</h1>";
    echo "<table class='table table-striped table-hover'>";
    echo "<thead class='table-dark'><tr><th>Nama Karyawan</th>";
    for ($i = 1; $i <= $jumlah_preferensi; $i++) {
        echo "<th>{$_POST['preferensi'][$i-1]}</th>";
    }
    echo "<th>Hasil Akhir</th></tr></thead><tbody>";

    foreach ($alternatif as $karyawan => $nilai_aspek) {
        echo "<tr><td>$karyawan</td>";
        $total_skor = 0;

        foreach ($nilai_aspek as $aspek => $faktor) {
            $skor_aspek = array_sum($faktor);
            echo "<td>$skor_aspek</td>";
            $total_skor += $skor_aspek;
        }

        echo "<td>$total_skor</td></tr>";
    }

    echo "</tbody></table>";
    echo "<a href='index.php' class='btn btn-primary'>Kembali</a>";
    echo "</div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>";
    echo "</body></html>";
}
?>
