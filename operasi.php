<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data - Profile Matching</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Input Data</h1>
    <form id="profileForm" action="../fungsi/process.php" method="POST">
        <!-- Step 1: Input jumlah karyawan -->
        <div id="step1" class="step">
            <div class="mb-3 row">
                <label for="jumlah_karyawan" class="col-sm-2 col-form-label">Jumlah Karyawan:</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan" required>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="next_to_step2">Next</button>
                </div>
            </div>
        </div>

        <!-- Step 2: Input nama karyawan -->
        <div id="step2" class="step d-none">
            <div id="karyawan-container" class="mb-3 row">
                <!-- Nama karyawan input fields will be dynamically added here -->
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary" id="next_to_step3">Next</button>
            </div>
        </div>

        <!-- Step 3: Input jumlah preferensi -->
        <div id="step3" class="step d-none">
            <div class="mb-3 row">
                <label for="jumlah_preferensi" class="col-sm-2 col-form-label">Jumlah Preferensi:</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="jumlah_preferensi" name="jumlah_preferensi" required>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="next_to_step4">Next</button>
                </div>
            </div>
        </div>

        <!-- Step 4: Input nama preferensi dan nilai aspek -->
        <div id="step4" class="step d-none">
            <div id="preferensi-container">
                <!-- Preferensi inputs will be dynamically added here -->
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </div>
    </form>
</div>

<script>
document.getElementById('next_to_step2').addEventListener('click', function() {
    const jumlahKaryawan = document.getElementById('jumlah_karyawan').value;
    if (jumlahKaryawan > 0) {
        const container = document.getElementById('karyawan-container');
        container.innerHTML = ''; // Clear previous inputs
        for (let i = 1; i <= jumlahKaryawan; i++) {
            const karyawanHtml = `
                <label for="karyawan_${i}" class="col-sm-2 col-form-label">Nama Karyawan ${i}:</label>
                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control" id="karyawan_${i}" name="karyawan[]" placeholder="Karyawan ${i}">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', karyawanHtml);
        }
        document.getElementById('step1').classList.add('d-none');
        document.getElementById('step2').classList.remove('d-none');
    }
});

document.getElementById('next_to_step3').addEventListener('click', function() {
    document.getElementById('step2').classList.add('d-none');
    document.getElementById('step3').classList.remove('d-none');
});

document.getElementById('next_to_step4').addEventListener('click', function() {
    const jumlahPreferensi = document.getElementById('jumlah_preferensi').value;
    if (jumlahPreferensi > 0) {
        const container = document.getElementById('preferensi-container');
        container.innerHTML = ''; // Clear previous inputs
        for (let i = 1; i <= jumlahPreferensi; i++) {
            const preferensiHtml = `
                <div class="row mb-3">
                    <label for="preferensi_${i}" class="col-sm-2 col-form-label">Nama Preferensi:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="preferensi_${i}" name="preferensi[]" required>
                    </div>
                    <label for="jumlah_aspek_${i}" class="col-sm-2 col-form-label">Jumlah Aspek:</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="jumlah_aspek_${i}" name="jumlah_aspek[]" required>
                    </div>
                    <label for="nilai_min_${i}" class="col-sm-1 col-form-label">Nilai Min:</label>
                    <div class="col-sm-1">
                        <input type="number" step="0.01" class="form-control" id="nilai_min_${i}" name="nilai_min[]" required>
                    </div>
                    <label for="nilai_max_${i}" class="col-sm-1 col-form-label">Nilai Max:</label>
                    <div class="col-sm-1">
                        <input type="number" step="0.01" class="form-control" id="nilai_max_${i}" name="nilai_max[]" required>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', preferensiHtml);
        }
        document.getElementById('step3').classList.add('d-none');
        document.getElementById('step4').classList.remove('d-none');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
