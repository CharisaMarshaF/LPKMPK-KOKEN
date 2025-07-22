<div class="card card-body shadow p-4">
    <h5 class="mb-4">Form Pendaftaran</h5>
    <form action="<?= base_url('daftar/submit') ?>" method="POST" class="row g-3">
        <!-- Kolom Kiri -->
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
            <textarea name="alamat" id="alamat" rows="2" class="form-control"
                required></textarea>
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
            <textarea name="kekurangan" id="kekurangan" rows="2"
                class="form-control"></textarea>
        </div>
        <div class="col-12">
            <label class="form-label">Riwayat Pendidikan</label>
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label>Jenjang</label>
                    <select id="jenjang" class="form-select">
                        <option value="">Pilih Jenjang</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="Universitas">Universitas</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Tahun Mulai</label>
                    <input type="text" id="tahun_mulai" class="form-control"
                        placeholder="Contoh: 2010">
                </div>
                <div class="col-md-2">
                    <label>Tahun Berakhir</label>
                    <input type="text" id="tahun_berakhir" class="form-control"
                        placeholder="Contoh: 2016">
                </div>
                <div class="col-md-3">
                    <label>Nama Sekolah</label>
                    <input type="text" id="sekolah" class="form-control"
                        placeholder="Contoh: SMK Negeri 1">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success mt-2 w-100"
                        onclick="tambahPendidikan()">Tambah</button>
                </div>
            </div>

            <!-- Tabel Riwayat Pendidikan -->
            <div class="mt-3">
                <table class="table table-bordered" id="tabelPendidikan">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Jenjang</th>
                            <th class="text-center">Tahun Mulai</th>
                            <th class="text-center">Tahun Berakhir</th>
                            <th class="text-center">Sekolah</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataPendidikan">
                        <!-- Data akan ditampilkan dari cookies -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 mt-4">
            <label class="form-label">Riwayat Pengalaman Kerja</label>
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label>Tahun Awal</label>
                    <input type="text" id="kerja_awal" class="form-control" placeholder="Contoh: 2018">
                </div>
                <div class="col-md-2">
                    <label>Tahun Berakhir</label>
                    <input type="text" id="kerja_akhir" class="form-control" placeholder="Contoh: 2022">
                </div>
                <div class="col-md-2">
                    <label>Tempat</label>
                    <input type="text" id="kerja_tempat" class="form-control" placeholder="Contoh: PT Maju">
                </div>
                <div class="col-md-2">
                    <label>Sebagai</label>
                    <input type="text" id="kerja_sebagai" class="form-control" placeholder="Contoh: Operator">
                </div>
                <div class="col-md-2">
                    <label>Alamat</label>
                    <input type="text" id="kerja_alamat" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Gaji</label>
                    <input type="number" id="kerja_gaji" class="form-control">
                </div>
                <div class="col-md-2 mt-2">
                    <button type="button" class="btn btn-success w-100" onclick="tambahKerja()">Tambah</button>
                </div>
            </div>

            <div class="mt-3">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
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
        <div class="col-12 mt-4">
            <label class="form-label">Data Keluarga</label>
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label>Hubungan</label>
                    <input type="text" id="keluarga_hubungan" class="form-control" placeholder="Contoh: Ayah">
                </div>
                <div class="col-md-2">
                    <label>Nama</label>
                    <input type="text" id="keluarga_nama" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Usia</label>
                    <input type="number" id="keluarga_usia" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Serumah</label>
                    <select id="keluarga_serumah" class="form-select">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Tempat Tinggal</label>
                    <input type="text" id="keluarga_tempat" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Pekerjaan</label>
                    <input type="text" id="keluarga_pekerjaan" class="form-control">
                </div>
                <div class="col-md-1 mt-2">
                    <button type="button" class="btn btn-success w-100" onclick="tambahKeluarga()">Tambah</button>
                </div>
            </div>

            <div class="mt-3">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
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
        <div class="col-12 text-left mt-3">
            <button type="submit" class="btn btn-primary px-4 py-2">Daftar Sekarang</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form"); // Pastikan form ini satu-satunya atau gunakan ID jika perlu
    const fields = form.querySelectorAll("input[name], textarea[name], select[name]");

    // Ambil dari localStorage
    fields.forEach(field => {
        const savedValue = localStorage.getItem(field.name);
        if (savedValue !== null) {
            field.value = savedValue;
        }

        // Simpan perubahan ke localStorage
        field.addEventListener("input", () => {
            localStorage.setItem(field.name, field.value);
        });

        // Untuk select
        if (field.tagName.toLowerCase() === "select") {
            field.addEventListener("change", () => {
                localStorage.setItem(field.name, field.value);
            });
        }
    });

    // Modifikasi submit → tampilkan SweetAlert konfirmasi
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Jangan submit dulu

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
                // Bersihkan localStorage sebelum submit
                fields.forEach(field => localStorage.removeItem(field.name));
                form.submit(); // Submit form
            }
        });
    });
});
</script>


<script>
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
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            const row = `
            <tr>
                <td>${item.jenjang}</td>
                <td>${item.tahun_mulai}</td>
                <td>${item.tahun_berakhir}</td>
                <td>${item.sekolah}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusPendidikan(${index})">Hapus</button></td>
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

            // Reset input
            document.getElementById("jenjang").value = "";
            document.getElementById("tahun_mulai").value = "";
            document.getElementById("tahun_berakhir").value = "";
            document.getElementById("sekolah").value = "";
        } else {
            alert("Harap isi semua kolom pendidikan.");
        }
    }

    function hapusPendidikan(index) {
        const data = getPendidikan();
        data.splice(index, 1);
        simpanPendidikan(data);
        tampilkanPendidikan();
    }

    document.addEventListener("DOMContentLoaded", tampilkanPendidikan);

</script>
<!-- Pengalaman Kerja -->
<script>
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
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.awal}</td>
                    <td>${item.akhir}</td>
                    <td>${item.tempat}</td>
                    <td>${item.sebagai}</td>
                    <td>${item.alamat}</td>
                    <td>${item.gaji}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusKerja(${index})">Hapus</button></td>
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

            document.getElementById("kerja_awal").value = "";
            document.getElementById("kerja_akhir").value = "";
            document.getElementById("kerja_tempat").value = "";
            document.getElementById("kerja_sebagai").value = "";
            document.getElementById("kerja_alamat").value = "";
            document.getElementById("kerja_gaji").value = "";
        } else {
            alert("Harap isi semua kolom pengalaman kerja.");
        }
    }

    function hapusKerja(index) {
        const data = getKerja();
        data.splice(index, 1);
        simpanKerja(data);
        tampilkanKerja();
    }

    document.addEventListener("DOMContentLoaded", tampilkanKerja);
</script>
<!-- Data Keluarga -->
<script>
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
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.hubungan}</td>
                    <td>${item.nama}</td>
                    <td>${item.usia}</td>
                    <td>${item.serumah}</td>
                    <td>${item.tempat}</td>
                    <td>${item.pekerjaan}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusKeluarga(${index})">Hapus</button></td>
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

            document.getElementById("keluarga_hubungan").value = "";
            document.getElementById("keluarga_nama").value = "";
            document.getElementById("keluarga_usia").value = "";
            document.getElementById("keluarga_serumah").value = "Ya";
            document.getElementById("keluarga_tempat").value = "";
            document.getElementById("keluarga_pekerjaan").value = "";
        } else {
            alert("Harap isi semua kolom data keluarga.");
        }
    }

    function hapusKeluarga(index) {
        const data = getKeluarga();
        data.splice(index, 1);
        simpanKeluarga(data);
        tampilkanKeluarga();
    }

    document.addEventListener("DOMContentLoaded", tampilkanKeluarga);
</script>
