<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* General Form Styling */
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        background-color: #fff;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control,
    .form-select,
    .form-control-custom,
    .form-select-custom {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus,
    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    textarea.form-control {
        resize: vertical;
    }

    .row.g-3 {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1rem;
    }

    /* Custom Form Section Styling */
    .form-section {
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }

    .form-label-section {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #0056b3;
        display: block;
    }

    .form-label-sub {
        font-weight: 500;
        margin-bottom: 0.25rem;
        color: #555;
        font-size: 0.9rem;
    }

    /* Flexbox for input rows - modified for full width with padding */
    .row-form-inputs {
        display: flex;
        flex-wrap: nowrap; /* Prevent wrapping */
        gap: 1rem; /* Adjust gap between inputs */
        align-items: flex-end; /* Aligns items to the bottom */
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        overflow-x: auto; /* For responsiveness on smaller screens if needed */
        width: 100%; /* Ensure the container takes full width */
    }

    /* Input column sizing for full width distribution */
    .col-input {
        flex-grow: 1; /* Allow inputs to grow and fill available space */
        flex-shrink: 0; /* Prevent inputs from shrinking too much */
        flex-basis: 0; /* Important for even distribution with flex-grow */
        min-width: 80px; /* Minimum width for very small screens */
    }

    /* Specific adjustments for input widths, if needed, but flex-grow should handle most */
    .col-input-education-jenjang { flex-basis: 15%; min-width: 100px; }
    .col-input-education-year { flex-basis: 12%; min-width: 80px; }
    .col-input-education-school { flex-basis: 35%; min-width: 150px; }

    .col-input-work-year { flex-basis: 10%; min-width: 70px; }
    .col-input-work-field { flex-basis: 18%; min-width: 120px; }
    .col-input-work-address { flex-basis: 20%; min-width: 120px; }
    .col-input-work-salary { flex-basis: 12%; min-width: 90px; }

    .col-input-family-relation { flex-basis: 15%; min-width: 100px; }
    .col-input-family-name { flex-basis: 20%; min-width: 120px; }
    .col-input-family-age { flex-basis: 8%; min-width: 50px; }
    .col-input-family-serumah { flex-basis: 10%; min-width: 70px; }
    .col-input-family-address { flex-basis: 20%; min-width: 120px; }
    .col-input-family-job { flex-basis: 17%; min-width: 100px; }

    /* Button Row Styling */
    .button-row-bottom {
        display: flex;
        justify-content: flex-end; /* Aligns content to the right */
        margin-top: 1rem; /* Space above the button */
        width: 100%; /* Ensure the button row takes full width */
    }

    /* Button Styling */
    .btn-custom {
        display: inline-block;
        font-weight: 500;
        line-height: 1.5;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        border-radius: 0.375rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-primary-custom {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary-custom:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-success-custom {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success-custom:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-danger-custom {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }

    .btn-danger-custom:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Table Styling */
    .table-custom {
        width: 100%;
        margin-top: 1.5rem;
        border-collapse: collapse;
    }

    .table-custom thead tr {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table-custom th,
    .table-custom td {
        padding: 0.75rem 1rem;
        text-align: left;
        border: none;
    }

    .table-custom th {
        font-weight: 700;
        color: #495057;
        font-size: 0.9rem;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid #e9ecef;
    }

    .table-custom tbody tr:last-child {
        border-bottom: none;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    .table-custom tbody tr:hover {
        background-color: #e9ecef;
    }

    /* Responsive adjustments for columns */
    @media (max-width: 768px) {
        .row-form-inputs {
            flex-wrap: wrap; /* Allow wrapping on small screens */
            gap: 1rem;
        }
        .col-input,
        .col-input-education-jenjang,
        .col-input-education-year,
        .col-input-education-school,
        .col-input-work-year,
        .col-input-work-field,
        .col-input-work-address,
        .col-input-work-salary,
        .col-input-family-relation,
        .col-input-family-name,
        .col-input-family-age,
        .col-input-family-serumah,
        .col-input-family-address,
        .col-input-family-job {
            flex-basis: 100%; /* Full width on small screens */
            min-width: unset;
            margin-left: 0;
        }
        .button-row-bottom {
            justify-content: center; /* Center button on small screens */
            width: 100%;
        }
        .btn-custom.w-full-responsive {
            width: 100% !important;
        }
    }
</style>

<div class="card card-body shadow p-4">
    <h5 class="mb-4">Form Pendaftaran</h5>
    <form action="<?= base_url('daftar/submit') ?>" method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" rows="2" class="form-control" required></textarea>
        </div>

        <div class="col-md-6">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="menikah" class="form-label">Status Menikah</label>
            <select name="menikah" id="menikah" class="form-select">
                <option value="Belum">Belum</option>
                <option value="Sudah">Sudah</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
            <input type="number" name="tinggi_badan" id="tinggi_badan" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
            <input type="number" name="berat_badan" id="berat_badan" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="buta_warna" class="form-label">Buta Warna</label>
            <select name="buta_warna" id="buta_warna" class="form-select">
                <option value="Tidak">Tidak</option>
                <option value="Parsial">Parsial</option>
                <option value="Total">Total</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="golongan_darah" class="form-label">Golongan Darah</label>
            <select name="golongan_darah" id="golongan_darah" class="form-select">
                <option value="">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tangan_dominan" class="form-label">Tangan Dominan</label>
            <select name="tangan_dominan" id="tangan_dominan" class="form-select">
                <option value="Kanan">Kanan</option>
                <option value="Kiri">Kiri</option>
                <option value="Keduanya">Keduanya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="operasi" class="form-label">Pernah Operasi</label>
            <select name="operasi" id="operasi" class="form-select">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="alkohol" class="form-label">Konsumsi Alkohol</label>
            <select name="alkohol" id="alkohol" class="form-select">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="merokok" class="form-label">Merokok</label>
            <select name="merokok" id="merokok" class="form-select">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tato" class="form-label">Memiliki Tato</label>
            <select name="tato" id="tato" class="form-select">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="agama" class="form-label">Agama</label>
            <select name="agama" id="agama" class="form-select">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="hobi" class="form-label">Hobi</label>
            <input type="text" name="hobi" id="hobi" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="promosi" class="form-label">Tahu dari mana?</label>
            <input type="text" name="promosi" id="promosi" class="form-control">
        </div>

        <div class="col-md-12">
            <label for="motivasi" class="form-label">Motivasi Mengikuti Pelatihan</label>
            <textarea name="motivasi" id="motivasi" rows="2" class="form-control"></textarea>
        </div>

        <div class="col-md-12">
            <label for="kelebihan" class="form-label">Kelebihan</label>
            <textarea name="kelebihan" id="kelebihan" rows="2" class="form-control"></textarea>
        </div>

        <div class="col-md-12">
            <label for="kekurangan" class="form-label">Kekurangan</label>
            <textarea name="kekurangan" id="kekurangan" rows="2" class="form-control"></textarea>
        </div>

        <div class="form-section">
                <h5 class="mb-4">Riwayat Pendidikan</h5>

            <div class="row-form-inputs">
                <div class="col-input col-input-education-jenjang">
                    <label class="form-label-sub">Jenjang</label>
                    <select id="jenjang" class="form-select-custom">
                        <option value="">Pilih Jenjang</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="Universitas">Universitas</option>
                    </select>
                </div>
                <div class="col-input col-input-education-year">
                    <label class="form-label-sub">Tahun Mulai</label>
                    <input type="text" id="tahun_mulai" class="form-control-custom" placeholder="Contoh: 2010">
                </div>
                <div class="col-input col-input-education-year">
                    <label class="form-label-sub">Tahun Berakhir</label>
                    <input type="text" id="tahun_berakhir" class="form-control-custom" placeholder="Contoh: 2016">
                </div>
                <div class="col-input col-input-education-school">
                    <label class="form-label-sub">Nama Sekolah</label>
                    <input type="text" id="sekolah" class="form-control-custom" placeholder="Contoh: SMK Negeri 1">
                </div>
            </div>
            <div class="button-row-bottom">
                <button type="button" class="btn-custom btn-success-custom" onclick="tambahPendidikan()">Tambah</button>
            </div>

            <div>
                <table class="table-custom" id="tabelPendidikan">
                    <thead>
                        <tr>
                            <th>Jenjang</th>
                            <th>Tahun Mulai</th>
                            <th>Tahun Berakhir</th>
                            <th>Sekolah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataPendidikan">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-section">
            <h5 class="mb-4">Riwayat Pengalaman Kerja</h5>

            <div class="row-form-inputs">
                <div class="col-input col-input-work-year">
                    <label class="form-label-sub">Tahun Awal</label>
                    <input type="text" id="kerja_awal" class="form-control-custom" placeholder="Contoh: 2018">
                </div>
                <div class="col-input col-input-work-year">
                    <label class="form-label-sub">Tahun Berakhir</label>
                    <input type="text" id="kerja_akhir" class="form-control-custom" placeholder="Contoh: 2022">
                </div>
                <div class="col-input col-input-work-field">
                    <label class="form-label-sub">Tempat</label>
                    <input type="text" id="kerja_tempat" class="form-control-custom" placeholder="Contoh: PT Maju">
                </div>
                <div class="col-input col-input-work-field">
                    <label class="form-label-sub">Sebagai</label>
                    <input type="text" id="kerja_sebagai" class="form-control-custom" placeholder="Contoh: Operator">
                </div>
                <div class="col-input col-input-work-address">
                    <label class="form-label-sub">Alamat</label>
                    <input type="text" id="kerja_alamat" class="form-control-custom">
                </div>
                <div class="col-input col-input-work-salary">
                    <label class="form-label-sub">Gaji</label>
                    <input type="number" id="kerja_gaji" class="form-control-custom">
                </div>
            </div>
            <div class="button-row-bottom">
                <button type="button" class="btn-custom btn-success-custom" onclick="tambahKerja()">Tambah</button>
            </div>

            <div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Tahun Awal</th>
                            <th>Tahun Berakhir</th>
                            <th>Tempat</th>
                            <th>Sebagai</th>
                            <th>Alamat</th>
                            <th>Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataKerja"></tbody>
                </table>
            </div>
        </div>
        <div class="form-section">
            <h5 class="mb-4">Data Keluarga</h5>

            <div class="row-form-inputs">
                <div class="col-input col-input-family-relation">
                    <label class="form-label-sub">Hubungan</label>
                    <input type="text" id="keluarga_hubungan" class="form-control-custom" placeholder="Contoh: Ayah">
                </div>
                <div class="col-input col-input-family-name">
                    <label class="form-label-sub">Nama</label>
                    <input type="text" id="keluarga_nama" class="form-control-custom">
                </div>
                <div class="col-input col-input-family-age">
                    <label class="form-label-sub">Usia</label>
                    <input type="number" id="keluarga_usia" class="form-control-custom">
                </div>
                <div class="col-input col-input-family-serumah">
                    <label class="form-label-sub">Serumah</label>
                    <select id="keluarga_serumah" class="form-select-custom">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="col-input col-input-family-address">
                    <label class="form-label-sub">Tempat Tinggal</label>
                    <input type="text" id="keluarga_tempat" class="form-control-custom">
                </div>
                <div class="col-input col-input-family-job">
                    <label class="form-label-sub">Pekerjaan</label>
                    <input type="text" id="keluarga_pekerjaan" class="form-control-custom">
                </div>
            </div>
            <div class="button-row-bottom">
                <button type="button" class="btn-custom btn-success-custom" onclick="tambahKeluarga()">Tambah</button>
            </div>

            <div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Hubungan</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Serumah</th>
                            <th>Tempat Tinggal</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataKeluarga"></tbody>
                </table>
            </div>
        </div>

        <div style="text-align: left; margin-top: 30px;">
            <button type="submit" class="btn-custom btn-primary-custom">Daftar Sekarang</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const mainFormFields = form.querySelectorAll("input[name], textarea[name], select[name]");

        // Load data from localStorage for main form fields
        mainFormFields.forEach(field => {
            const savedValue = localStorage.getItem(field.name);
            if (savedValue !== null) {
                field.value = savedValue;
            }

            // Save changes to localStorage on input/change
            field.addEventListener("input", () => {
                localStorage.setItem(field.name, field.value);
            });

            if (field.tagName.toLowerCase() === "select") {
                field.addEventListener("change", () => {
                    localStorage.setItem(field.name, field.value);
                });
            }
        });

        // Initial display of dynamic data
        tampilkanPendidikan();
        tampilkanKerja();
        tampilkanKeluarga();

        // Modify submit to show SweetAlert confirmation
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Periksa kembali sebelum dikirim.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim',
                cancelButtonText: 'Periksa Lagi',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Clear localStorage for main form fields
                    mainFormFields.forEach(field => localStorage.removeItem(field.name));
                    // Clear cookies for dynamic tables
                    document.cookie = "pendidikan=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "kerja=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "keluarga=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

                    // Append dynamic table data as hidden inputs before submitting
                    appendDynamicDataToForm();
                    form.submit(); // Submit the form
                }
            });
        });

        // Function to append dynamic table data as hidden inputs
        function appendDynamicDataToForm() {
            const pendidikanData = getPendidikan();
            pendidikanData.forEach((item, index) => {
                for (const key in item) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = `pendidikan[${index}][${key}]`;
                    input.value = item[key];
                    form.appendChild(input);
                }
            });

            const kerjaData = getKerja();
            kerjaData.forEach((item, index) => {
                for (const key in item) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = `kerja[${index}][${key}]`;
                    input.value = item[key];
                    form.appendChild(input);
                }
            });

            const keluargaData = getKeluarga();
            keluargaData.forEach((item, index) => {
                for (const key in item) {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = `keluarga[${index}][${key}]`;
                    input.value = item[key];
                    form.appendChild(input);
                }
            });
        }
    });
</script>


<script>
    // --- Riwayat Pendidikan Functions ---
    function getPendidikan() {
        const data = document.cookie.split('; ').find(row => row.startsWith('pendidikan='));
        return data ? JSON.parse(decodeURIComponent(data.split('=')[1])) : [];
    }

    function simpanPendidikan(data) {
        document.cookie = `pendidikan=${encodeURIComponent(JSON.stringify(data))}; path=/`;
    }

    function tampilkanPendidikan() {
        const data = getPendidikan();
        const tbody = document.getElementById("dataPendidikan");
        tbody.innerHTML = ""; // Clear existing rows

        data.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.jenjang}</td>
                    <td>${item.tahun_mulai}</td>
                    <td>${item.tahun_berakhir}</td>
                    <td>${item.sekolah}</td>
                    <td>
                        <button type="button" class="btn-custom btn-danger-custom" onclick="hapusPendidikan(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    function tambahPendidikan() {
        const jenjang = document.getElementById("jenjang").value.trim();
        const tahunMulai = document.getElementById("tahun_mulai").value.trim();
        const tahunBerakhir = document.getElementById("tahun_berakhir").value.trim();
        const sekolah = document.getElementById("sekolah").value.trim();

        if (jenjang && tahunMulai && tahunBerakhir && sekolah) {
            const data = getPendidikan();
            data.push({
                jenjang,
                tahun_mulai: tahunMulai,
                tahun_berakhir: tahunBerakhir,
                sekolah
            });
            simpanPendidikan(data);
            tampilkanPendidikan();

            // Reset input fields
            document.getElementById("jenjang").value = "";
            document.getElementById("tahun_mulai").value = "";
            document.getElementById("tahun_berakhir").value = "";
            document.getElementById("sekolah").value = "";
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Input Kosong!',
                text: 'Harap isi semua kolom Riwayat Pendidikan.',
            });
        }
    }

    function hapusPendidikan(index) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data pendidikan ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const data = getPendidikan();
                data.splice(index, 1);
                simpanPendidikan(data);
                tampilkanPendidikan();
                Swal.fire(
                    'Dihapus!',
                    'Data pendidikan berhasil dihapus.',
                    'success'
                );
            }
        });
    }

    // --- Riwayat Pengalaman Kerja Functions ---
    function getKerja() {
        const data = document.cookie.split('; ').find(row => row.startsWith('kerja='));
        return data ? JSON.parse(decodeURIComponent(data.split('=')[1])) : [];
    }

    function simpanKerja(data) {
        document.cookie = `kerja=${encodeURIComponent(JSON.stringify(data))}; path=/`;
    }

    function tampilkanKerja() {
        const data = getKerja();
        const tbody = document.getElementById("dataKerja");
        tbody.innerHTML = ""; // Clear existing rows

        data.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.awal}</td>
                    <td>${item.akhir}</td>
                    <td>${item.tempat}</td>
                    <td>${item.sebagai}</td>
                    <td>${item.alamat}</td>
                    <td>${item.gaji}</td>
                    <td>
                        <button type="button" class="btn-custom btn-danger-custom" onclick="hapusKerja(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    function tambahKerja() {
        const awal = document.getElementById("kerja_awal").value.trim();
        const akhir = document.getElementById("kerja_akhir").value.trim();
        const tempat = document.getElementById("kerja_tempat").value.trim();
        const sebagai = document.getElementById("kerja_sebagai").value.trim();
        const alamat = document.getElementById("kerja_alamat").value.trim();
        const gaji = document.getElementById("kerja_gaji").value.trim();

        if (awal && akhir && tempat && sebagai && alamat && gaji) {
            const data = getKerja();
            data.push({ awal, akhir, tempat, sebagai, alamat, gaji });
            simpanKerja(data);
            tampilkanKerja();

            // Reset input fields
            document.getElementById("kerja_awal").value = "";
            document.getElementById("kerja_akhir").value = "";
            document.getElementById("kerja_tempat").value = "";
            document.getElementById("kerja_sebagai").value = "";
            document.getElementById("kerja_alamat").value = "";
            document.getElementById("kerja_gaji").value = "";
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Input Kosong!',
                text: 'Harap isi semua kolom Riwayat Pengalaman Kerja.',
            });
        }
    }

    function hapusKerja(index) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data pengalaman kerja ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const data = getKerja();
                data.splice(index, 1);
                simpanKerja(data);
                tampilkanKerja();
                Swal.fire(
                    'Dihapus!',
                    'Data pengalaman kerja berhasil dihapus.',
                    'success'
                );
            }
        });
    }

    // --- Data Keluarga Functions ---
    function getKeluarga() {
        const data = document.cookie.split('; ').find(row => row.startsWith('keluarga='));
        return data ? JSON.parse(decodeURIComponent(data.split('=')[1])) : [];
    }

    function simpanKeluarga(data) {
        document.cookie = `keluarga=${encodeURIComponent(JSON.stringify(data))}; path=/`;
    }

    function tampilkanKeluarga() {
        const data = getKeluarga();
        const tbody = document.getElementById("dataKeluarga");
        tbody.innerHTML = ""; // Clear existing rows

        data.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.hubungan}</td>
                    <td>${item.nama}</td>
                    <td>${item.usia}</td>
                    <td>${item.serumah}</td>
                    <td>${item.tempat}</td>
                    <td>${item.pekerjaan}</td>
                    <td>
                        <button type="button" class="btn-custom btn-danger-custom" onclick="hapusKeluarga(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    function tambahKeluarga() {
        const hubungan = document.getElementById("keluarga_hubungan").value.trim();
        const nama = document.getElementById("keluarga_nama").value.trim();
        const usia = document.getElementById("keluarga_usia").value.trim();
        const serumah = document.getElementById("keluarga_serumah").value;
        const tempat = document.getElementById("keluarga_tempat").value.trim();
        const pekerjaan = document.getElementById("keluarga_pekerjaan").value.trim();

        if (hubungan && nama && usia && serumah && tempat && pekerjaan) {
            const data = getKeluarga();
            data.push({ hubungan, nama, usia, serumah, tempat, pekerjaan });
            simpanKeluarga(data);
            tampilkanKeluarga();

            // Reset input fields
            document.getElementById("keluarga_hubungan").value = "";
            document.getElementById("keluarga_nama").value = "";
            document.getElementById("keluarga_usia").value = "";
            document.getElementById("keluarga_serumah").value = "Ya"; // Reset to default
            document.getElementById("keluarga_tempat").value = "";
            document.getElementById("keluarga_pekerjaan").value = "";
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Input Kosong!',
                text: 'Harap isi semua kolom Data Keluarga.',
            });
        }
    }

    function hapusKeluarga(index) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data keluarga ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const data = getKeluarga();
                data.splice(index, 1);
                simpanKeluarga(data);
                tampilkanKeluarga();
                Swal.fire(
                    'Dihapus!',
                    'Data keluarga berhasil dihapus.',
                    'success'
                );
            }
        });
    }
</script>