<div class="card card-body shadow p-4">
    <h5 class="mb-4">Form Pendaftaran</h5>
    <form action="<?= base_url('daftar/submit') ?>" method="POST" class="row g-3" enctype="multipart/form-data">
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
            <input name="alamat" id="alamat"  class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                <option value="">Pilih</option>
                <option value="男">男 (Laki-Laki)</option>
                <option value="女">女 (Perempuan)</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="menikah" class="form-label">Status Menikah</label>
            <select name="menikah" id="menikah" class="form-select">
                <option value="未婚">未婚 (Belum Menikah)</option>
                <option value="既婚">既婚 (Sudah Menikah)</option>
                <option value="離婚">離婚 (Cerai)</option>
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
                <option value="無">無 (Tidak)</option>  <!-- "Tidak" in Japanese -->
                <option value="有">有 (Ya)</option>  <!-- "Ya" in Japanese -->
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
                <option value="右">右 (Kanan)</option>
                <option value="左">左 (Kiri)</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="tangan_dominan" class="form-label">Kekuatan Mata Kanan</label>
            <input type="number" name="kanan" id="kekuatan_mata_kanan" class="form-control" step="0.1" placeholder="Contoh: 1.0">
        </div>
        <div class="col-md-6">
            <label for="kekuatan_mata_kiri" class="form-label">Kekuatan Mata Kiri</label>
            <input type="number" name="kiri" id="kekuatan_mata_kiri" class="form-control" step="0.1" placeholder="Contoh: 1.0">
        </div>

        <div class="col-md-6">
            <label for="operasi" class="form-label">Pernah Operasi</label>
            <select name="operasi" id="operasi" class="form-select">
                <option value="無">無 (Tidak)</option>  <!-- "Tidak" in Japanese -->
                <option value="有">有 (Ya)</option>  <!-- "Ya" in Japanese -->
            </select>
        </div>

        <div class="col-md-6">
            <label for="alkohol" class="form-label">Konsumsi Alkohol</label>
            <select name="alkohol" id="alkohol" class="form-select">
                <option value="無">無 (Tidak)</option>  <!-- "Tidak" in Japanese -->
                <option value="有">有 (Ya)</option>  <!-- "Ya" in Japanese -->
            </select>
        </div>

        <div class="col-md-6">
            <label for="merokok" class="form-label">Merokok</label>
            <select name="merokok" id="merokok" class="form-select">
                <option value="無">無 (Tidak)</option>  <!-- "Tidak" in Japanese -->
                <option value="有">有 (Ya)</option>  <!-- "Ya" in Japanese -->
            </select>
        </div>

        <div class="col-md-6">
            <label for="tato" class="form-label">Memiliki Tato</label>
            <select name="tato" id="tato" class="form-select">
                <option value="無">無 (Tidak)</option>  <!-- "Tidak" in Japanese -->
                <option value="有">有 (Ya)</option>  <!-- "Ya" in Japanese -->
            </select>
        </div>

        <div class="col-md-6">
            <label for="agama" class="form-label">Agama</label>
            <select name="agama" id="agama" class="form-select">
                <option value="イスラム">イスラム (Islam)</option>
                <option value="クリスト">クリスト (Kristen)</option>
                <option value="ヒンドゥー教">ヒンドゥー教 (Hindu)</option>
                <option value="仏教">仏教 (Buddha)</option>
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
            <label for="promosi" class="form-label">Promosi Diri</label>
            <input type="text" name="promosi" id="promosi" class="form-control">
        </div>

        <div class="col-md-12">
            <label for="motivasi" class="form-label">Motivasi Mengikuti Pelatihan</label>
            <input name="motivasi" id="motivasi" class="form-control">
        </div>

        <div class="col-md-12">
            <label for="kelebihan" class="form-label">Kelebihan</label>
            <input name="kelebihan" id="kelebihan" class="form-control">
        </div>

        <div class="col-md-12">
            <label for="kekurangan" class="form-label">Kekurangan</label>
            <input name="kekurangan" id="kekurangan" class="form-control">
        </div>
        <div class="col-md-12">
            <label for="kekurangan" class="form-label">Pernah Belajar Bahasa Jepang Berapa Tahun?</label>
            <select name="bahasa_jepang" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="form-section">
            <h5 class="mb-4">Riwayat Pendidikan</h5>
            <div class="row-form-inputs">
                <div class="col-input col-input-education-jenjang">
                    <label class="form-label-sub">Jenjang</label>
                    <select id="jenjang" class="form-select-custom">
                        <option value="">Pilih Jenjang</option><!-- "Pilih Jenjang" in Japanese -->
                        <option value="小学校">小学校 (SD)</option> <!-- "Sekolah Dasar" in Japanese -->
                        <option value="中学校">中学校 (SMP)</option> <!-- "Sekolah Menengah Pertama" in Japanese -->
                        <option value="高校">高校 (SMA/SMK)</option> <!-- "Sekolah Menengah Atas" in Japanese -->
                        <option value="大学">大学 (Perguruan Tinggi)</option> <!-- "Perguruan Tinggi" in Japanese -->
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
                    <label class="form-label-sub">Bulan</label>
                    <select name="bulan_awal" id="bulan_awal" class="form-control">
                        <option value="1">1月（いちがつ）</option>
                        <option value="2">2月（にがつ）</option>
                        <option value="3">3月（さんがつ）</option>
                        <option value="4">4月（しがつ）</option>
                        <option value="5">5月（ごがつ）</option>
                        <option value="6">6月（ろくがつ）</option>
                        <option value="7">7月（しちがつ）</option>
                        <option value="8">8月（はちがつ）</option>
                        <option value="9">9月（くがつ）</option>
                        <option value="10">10月（じゅうがつ）</option>
                        <option value="11">11月（じゅういちがつ）</option>
                        <option value="12">12月（じゅうにがつ）</option>
                    </select>
                </div>
                <div class="col-input col-input-work-year">
                    <label class="form-label-sub">Tahun Awal</label>
                    <input type="text" id="kerja_awal" class="form-control-custom" placeholder="Contoh: 2018">
                </div>
                <div class="col-input col-input-work-year">
                    <label class="form-label-sub">Bulan</label>
                    <select name="bulan_akhir" id="bulan_akhir" class="form-control">
                        <option value="1">1月（いちがつ）</option>
                        <option value="2">2月（にがつ）</option>
                        <option value="3">3月（さんがつ）</option>
                        <option value="4">4月（しがつ）</option>
                        <option value="5">5月（ごがつ）</option>
                        <option value="6">6月（ろくがつ）</option>
                        <option value="7">7月（しちがつ）</option>
                        <option value="8">8月（はちがつ）</option>
                        <option value="9">9月（くがつ）</option>
                        <option value="10">10月（じゅうがつ）</option>
                        <option value="11">11月（じゅういちがつ）</option>
                        <option value="12">12月（じゅうにがつ）</option>
                    </select>
                </div>
                <div class="col-input col-input-work-year">
                    <label class="form-label-sub">Tahun Berakhir</label>
                    <input type="text" id="kerja_akhir" class="form-control-custom" placeholder="Contoh: 2022">
                </div>
                <div class="col-input col-input-work-field">
                    <label class="form-label-sub">Tempat (Nama Perusahaan)</label>
                    <input type="text" id="kerja_tempat" class="form-control-custom" placeholder="Contoh: PT Maju">
                </div>
                <div class="col-input col-input-work-field">
                    <label class="form-label-sub">Sebagai</label>
                    <input type="text" id="kerja_sebagai" class="form-control-custom" placeholder="Contoh: Operator">
                </div>
                <div class="col-input col-input-work-salary">
                    <label class="form-label-sub">Gaji</label>
                    <input type="number" id="kerja_gaji" class="form-control-custom" placeholder="0-10, 1 = 1 juta">
                </div>
            </div>
            <div class="button-row-bottom">
                <button type="button" class="btn-custom btn-success-custom" onclick="tambahKerja()">Tambah</button>
            </div>

            <div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tahun Awal</th>
                            <th>Bulan</th>
                            <th>Tahun Berakhir</th>
                            <th>Tempat</th>
                            <th>Sebagai</th>
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
                    <label class="form-label-sub">関係 (Kankei)</label>
                    <select id="keluarga_hubungan" name="keluarga_hubungan" class="form-control-custom">
                        <option value="父">父 (Chichi - Ayah)</option>
                        <option value="母">母 (Haha - Ibu)</option>
                        <option value="兄">兄 (Ani - Kakak Laki-laki)</option>
                        <option value="姉">姉 (Ane - Kakak Perempuan)</option>
                        <option value="弟">弟 (Otōto - Adik Laki-laki)</option>
                        <option value="妹">妹 (Imōto - Adik Perempuan)</option>
                        <option value="祖父">祖父 (Sofu - Kakek)</option>
                        <option value="祖母">祖母 (Sobo - Nenek)</option>
                        <option value="夫">夫 (Otto - Suami)</option>
                        <option value="妻">妻 (Tsuma - Istri)</option>
                    </select>
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
                        <option value="同居">同居 (Ya)</option>  
                        <option value="別居">別居 (Tidak)</option>  
                    </select>
                </div>
                <div class="col-input col-input-family-job">
                    <label class="form-label-sub">Pekerjaan</label>
                    <input type="text" id="keluarga_pekerjaan" class="form-control-custom">
                </div>
                <div class="col-input col-input-family-job">
                    <label class="form-label-sub">Gaji</label>
                    <input type="number" id="keluarga_gaji" class="form-control-custom" placeholder="0-10, 1 = 1 juta">
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
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataKeluarga"></tbody>
                </table>
            </div>
        </div>
        <div class="form-section">
            <div class="mb-3">
                <label for="foto" class="form-label">Unggah Foto</label>
                <input type="file" name="foto" id="foto" accept=".jpg" class="form-control" required>
            </div>
            <p>Pastikan foto Anda berformat .jpg dan berukuran 3x4.</p>
              <p id="warning" class="mt-2 text-sm text-red-600 hidden">
                ⚠️ Ukuran file terlalu besar. Maksimal 1 MB.
            </p>
        </div>
        <!-- Tambahkan SweetAlert2 CDN di head atau sebelum penutup </body> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        const fileInput = document.getElementById('foto');
        const warning = document.getElementById('warning');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.size > 1000 * 1024) { // 1 MB
            // Tampilkan SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Ukuran File Terlalu Besar',
                text: 'Ukuran maksimal yang diperbolehkan adalah 1 MB.',
                confirmButtonColor: '#16a34a'
            });

            warning.classList.remove('hidden');
            this.value = ''; // Reset input
            } else {
            warning.classList.add('hidden');
            }
        });
        </script>

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
                    <td>${item.bulan_awal}</td>
                    <td>${item.awal}</td>
                    <td>${item.bulan_akhir}</td>
                    <td>${item.akhir}</td>
                    <td>${item.tempat}</td>
                    <td>${item.sebagai}</td>
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
        const bulan_awal = document.getElementById("bulan_awal").value.trim();
        const bulan_akhir = document.getElementById("bulan_akhir").value.trim();
        const awal = document.getElementById("kerja_awal").value.trim();
        const akhir = document.getElementById("kerja_akhir").value.trim();
        const tempat = document.getElementById("kerja_tempat").value.trim();
        const sebagai = document.getElementById("kerja_sebagai").value.trim();
        const gaji = document.getElementById("kerja_gaji").value.trim();

        if (awal && akhir && tempat && sebagai && gaji) {
            const data = getKerja();
            data.push({ bulan_awal,bulan_akhir, awal, akhir, tempat, sebagai, gaji });
            simpanKerja(data);
            tampilkanKerja();

            // Reset input fields
            document.getElementById("bulan_awal").value = "";
            document.getElementById("bulan_akhir").value = "";
            document.getElementById("kerja_awal").value = "";
            document.getElementById("kerja_akhir").value = "";
            document.getElementById("kerja_tempat").value = "";
            document.getElementById("kerja_sebagai").value = "";
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
        const pekerjaan = document.getElementById("keluarga_pekerjaan").value.trim();
        const gaji = document.getElementById("keluarga_gaji").value.trim();

        if (hubungan && nama && usia && serumah && pekerjaan && gaji) {
            const data = getKeluarga();
            data.push({ hubungan, nama, usia, serumah, pekerjaan });
            simpanKeluarga(data);
            tampilkanKeluarga();

            // Reset input fields
            document.getElementById("keluarga_hubungan").value = "";
            document.getElementById("keluarga_nama").value = "";
            document.getElementById("keluarga_usia").value = "";
            document.getElementById("keluarga_pekerjaan").value = "";
            document.getElementById("keluarga_gaji").value = "";
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