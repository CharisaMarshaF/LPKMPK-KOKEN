<div class="card card-body shadow p-4">
    <form action="<?= base_url('card/submit_kk') ?>" method="POST" class="row g-3" enctype="multipart/form-data">
        <!-- Data Kartu Keluarga -->
        <h5 class="mb-4">Data Kartu Keluarga</h5>

        <div class="col-md-6">
            <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
            <input type="text" name="no_kk" id="no_kk" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="nama_kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" name="alamat" id="alamat" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="rt" class="form-label">RT</label>
            <input type="text" name="rt" id="rt" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="rw" class="form-label">RW</label>
            <input type="text" name="rw" id="rw" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
            <input type="text" name="desa_kelurahan" id="desa_kelurahan" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="kabupaten_kota" class="form-label">Kabupaten/Kota</label>
            <input type="text" name="kabupaten_kota" id="kabupaten_kota" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" name="provinsi" id="provinsi" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" id="kode_pos" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="tanggal_dikeluarkan" class="form-label">Tanggal Dikeluarkan</label>
            <input type="date" name="tanggal_dikeluarkan" id="tanggal_dikeluarkan" class="form-control">
        </div>

        <div class="form-section">
            <h5 class="mb-4">Data Keluarga</h5>
            <div class="row-form-inputs">
                 <div class="col-input col-input-family-name">
                    <label class="form-label-sub">Nama Lengkap</label>
                    <input type="text" id="anggota_nama" class="form-control-custom">
                </div>
                <div class="col-input col-input-family-father">
                    <label class="form-label-sub">Nama Ayah</label>
                    <input type="text" id="anggota_nama_ayah" class="form-control-custom">
                </div>

                <div class="col-input col-input-family-mother">
                    <label class="form-label-sub">Nama Ibu</label>
                    <input type="text" id="anggota_nama_ibu" class="form-control-custom">
                </div>
            </div>
            <div class="row-form-inputs">
                <div class="col-input col-input-family-nik">
                    <label class="form-label-sub">NIK</label>
                    <input type="text" id="anggota_nik" class="form-control-custom">
                </div>

                <div class="col-input col-input-family-gender">
                    <label class="form-label-sub">Jenis Kelamin</label>
                    <select id="anggota_jenis_kelamin" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="男性">男性 (Laki-Laki)</option>
                        <option value="女性">女性 (Perempuan)</option>
                    </select>
                </div>

                <div class="col-input col-input-family-birthplace">
                    <label class="form-label-sub">Tempat Lahir</label>
                    <input type="text" id="anggota_tempat_lahir" class="form-control-custom">
                </div>

                <div class="col-input col-input-family-birthdate">
                    <label class="form-label-sub">Tanggal Lahir</label>
                    <input type="date" id="anggota_tanggal_lahir" class="form-control-custom">
                </div>
            </div>
            <div class="row-form-inputs">
                <div class="col-input col-input-family-religion">
                    <label class="form-label-sub">Agama</label>
                    <select id="anggota_agama" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="イスラム教">イスラム教 (Islam)</option>
                        <option value="キリスト教">キリスト教 (Kristen)</option>
                        <option value="ヒンドゥー教">ヒンドゥー教 (Hindu)</option>
                        <option value="仏教">仏教 (Buddha)</option>
                        <option value="カトリック">カトリック (Katolik)</option>
                    </select>
                </div>
                <div class="col-input col-input-family-education">
                    <label class="form-label-sub">Pendidikan</label>
                    <select id="anggota_pendidikan" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="学歴なし">学歴なし (Tidak / Belum Sekolah)</option>
                        <option value="小学校未卒">小学校未卒 (Belum Tamat SD)</option>
                        <option value="小学校卒業">小学校卒業 (Tamat SD / Sederajat)</option>
                        <option value="中学校卒業">中学校卒業 (SLTP / Sederajat)</option>
                        <option value="高校卒業">高校卒業 (SLTA / Sederajat)</option>
                        <option value="短大">短大 (Diploma I / II)</option>
                        <option value="専門学校">専門学校 (Akademik / Diploma III / Sarjana Muda)</option>
                        <option value="大学">大学 (Diploma IV / Strata I)</option>
                        <option value="大学院">大学院 (Strata II)</option>
                        <option value="博士課程">博士課程 (Strata III)</option>
                    </select>
                </div>

                <div class="col-input col-input-family-job">
                    <label class="form-label-sub">Jenis Pekerjaan</label>
                    <select id="anggota_jenis_pekerjaan" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="未就労">未就労 (Belum / Tidak Bekerja)</option>
                        <option value="家事">家事 (Mengurus Rumah Tangga)</option>
                        <option value="定年">定年 (Pensiunan)</option>
                        <option value="公務員">公務員 (Pegawai Negeri Sipil)</option>
                        <option value="軍人">軍人 (TNI)</option>
                        <option value="農家">農家 (Petani / Pekebun)</option>
                        <option value="畜産">畜産 (Peternak)</option>
                        <option value="会社員">会社員 (Karyawan Swasta)</option>
                        <option value="アルバイト">アルバイト (Buruh Harian Lepas)</option>
                        <option value="農民">農民 (Buruh Tani / Perkebunan)</option>
                        <option value="家事手伝い">家事手伝い (Pembantu Rumah Tangga)</option>
                        <option value="理容師">理容師 (Tukang Cukur)</option>
                        <option value="電気技師">電気技師 (Tukang Listrik)</option>
                        <option value="石工">石工 (Tukang Batu)</option>
                        <option value="大工">大工 (Tukang Kayu)</option>
                        <option value="記者">記者 (Wartawan)</option>
                        <option value="牧師">牧師 (Ustadz / Mubaligh)</option>
                        <option value="教師">教師 (Guru)</option>
                        <option value="運転手">運転手 (Sopir)</option>
                        <option value="商人">商人 (Pedagang)</option>
                        <option value="役人">役人 (Perangkat Desa)</option>
                        <option value="村長">村長 (Kepala Desa)</option>
                        <option value="自営業">自営業 (Wiraswasta)</option>
                        <option value="その他">その他 (Lainnya)</option>
                    </select>
                </div>
            </div>
            <div class="row-form-inputs">
                <div class="col-input col-input-family-marital">
                    <label class="form-label-sub">Status Pernikahan</label>
                    <select id="anggota_status_pernikahan" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="未婚">未婚 (Belum Menikah)</option>
                        <option value="既婚">既婚 (Sudah Menikah)</option>
                        <option value="離婚">離婚 (Cerai Hidup)</option>
                        <option value="死別">死別 (Cerai Mati)</option>
                    </select>
                </div>
                <div class="col-input col-input-family-relation">
                    <label class="form-label-sub">Status Hubungan</label>
                    <select id="anggota_status_hubungan" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="家長">家長 (Kepala Keluarga)</option>
                        <option value="夫">夫 (suami)</option>
                        <option value="妻">妻 (Istri)</option>
                        <option value="子">子 (Anak)</option>
                        <option value="義理の子">義理の子 (Menantu)</option>
                        <option value="孫">孫 (cucu)</option>
                        <option value="両親">両親 (Orangtua)</option>
                        <option value="義理の親">義理の親 (Mertua)</option>
                        <option value="他の家族">他の家族 (Famili Lain)</option>
                        <option value="使用人">使用人 (Pembantu)</option>
                        <option value="その他">その他 (lainnya)</option>
                    </select>
                </div>
                <div class="col-input col-input-family-citizenship">
                    <label class="form-label-sub">Kewarganegaraan</label>
                    <select id="anggota_kewarganegaraan" class="form-select-custom">
                        <option value="">(選ぶ) Pilih</option>
                        <option value="WNI">WNI</option>
                        <option value="WNA">WNA</option>
                    </select>
                </div>
            </div>
            <div class="row-form-inputs">
                <div class="col-input col-input-family-passport">
                    <label class="form-label-sub">No. Paspor</label>
                    <input type="text" id="anggota_no_paspor" class="form-control-custom">
                </div>

                <div class="col-input col-input-family-kitas">
                    <label class="form-label-sub">No. KITAS/KITAP</label>
                    <input type="text" id="anggota_no_kitas_kitap" class="form-control-custom">
                </div>
            </div>
            <div class="button-row-bottom">
                <button type="button" class="btn-custom btn-success-custom" onclick="tambahAnggotaKeluarga()">Tambah Anggota</button>
            </div>
            <div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Status Hubungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataAnggotaKeluarga"></tbody>
                </table>
            </div>
        </div>

        <!-- Submit Button -->
        <div style="text-align: left; margin-top: 30px;">
            <button type="submit" class="btn-custom btn-primary-custom">Simpan Data Kartu Keluarga</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- Anggota Keluarga Functions ---
    // Fungsi untuk mendapatkan data anggota dari Cookie (tetap pakai cookie untuk sementara)
    function getAnggotaKeluarga() {
        const data = document.cookie.split('; ').find(row => row.startsWith('anggota_keluarga='));
        return data ? JSON.parse(decodeURIComponent(data.split('=')[1])) : [];
    }

    // Fungsi untuk menyimpan data anggota ke Cookie
    function simpanAnggotaKeluarga(data) {
        // Simpan data dalam bentuk JSON string ke dalam cookie
        const jsonString = encodeURIComponent(JSON.stringify(data));
        // Set cookie, misalnya kadaluarsa dalam 1 hari
        document.cookie = `anggota_keluarga=${jsonString}; path=/; max-age=${60*60*24}`; 
    }
    
    // Fungsi untuk menghapus cookie anggota keluarga setelah data berhasil dikirim
    function hapusCookieAnggotaKeluarga() {
        document.cookie = "anggota_keluarga=; path=/; max-age=0";
    }

    function tampilkanAnggotaKeluarga() {
        const data = getAnggotaKeluarga();
        const tbody = document.getElementById("dataAnggotaKeluarga");
        tbody.innerHTML = "";

        data.forEach((item, index) => {
            const jenisKelaminTampil = item.jenis_kelamin.includes(' ') ? item.jenis_kelamin.split(' ')[1].replace(/[()]/g, '') : item.jenis_kelamin;
            const statusHubunganTampil = item.status_hubungan.includes(' ') ? item.status_hubungan.split(' ')[1].replace(/[()]/g, '') : item.status_hubungan;
            
            const row = `
                <tr>
                    <td>${item.nama_lengkap}</td>
                    <td>${item.nik}</td>
                    <td>${jenisKelaminTampil}</td>
                    <td>${item.tempat_lahir}</td>
                    <td>${item.tanggal_lahir}</td>
                    <td>${statusHubunganTampil}</td>
                    <td>
                        <button type="button" class="btn-custom btn-danger-custom" onclick="hapusAnggotaKeluarga(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    /**
     * @description Membersihkan semua input field di bagian Data Keluarga setelah penambahan
     */
    function resetAnggotaKeluargaFields() {
        // Reset input fields
        document.getElementById("anggota_nama").value = "";
        document.getElementById("anggota_nik").value = "";
        document.getElementById("anggota_jenis_kelamin").value = ""; 
        document.getElementById("anggota_tempat_lahir").value = "";
        document.getElementById("anggota_tanggal_lahir").value = "";
        document.getElementById("anggota_agama").value = ""; 
        document.getElementById("anggota_pendidikan").value = ""; 
        document.getElementById("anggota_jenis_pekerjaan").value = ""; 
        document.getElementById("anggota_status_pernikahan").value = ""; 
        document.getElementById("anggota_status_hubungan").value = "";  
        document.getElementById("anggota_kewarganegaraan").value = ""; 
        document.getElementById("anggota_no_paspor").value = "";
        document.getElementById("anggota_no_kitas_kitap").value = "";
        document.getElementById("anggota_nama_ayah").value = "";
        document.getElementById("anggota_nama_ibu").value = "";
        document.getElementById("anggota_nama").focus();
    }


    function tambahAnggotaKeluarga() {
        const nama_lengkap = document.getElementById("anggota_nama").value.trim();
        const nik = document.getElementById("anggota_nik").value.trim();
        const jenis_kelamin = document.getElementById("anggota_jenis_kelamin").value;
        const tempat_lahir = document.getElementById("anggota_tempat_lahir").value.trim();
        const tanggal_lahir = document.getElementById("anggota_tanggal_lahir").value;
        const agama = document.getElementById("anggota_agama").value;
        const pendidikan = document.getElementById("anggota_pendidikan").value;
        const jenis_pekerjaan = document.getElementById("anggota_jenis_pekerjaan").value; 
        const status_pernikahan = document.getElementById("anggota_status_pernikahan").value;
        const status_hubungan = document.getElementById("anggota_status_hubungan").value;
        const kewarganegaraan = document.getElementById("anggota_kewarganegaraan").value;
        const no_paspor = document.getElementById("anggota_no_paspor").value.trim();
        const no_kitas_kitap = document.getElementById("anggota_no_kitas_kitap").value.trim();
        const nama_ayah = document.getElementById("anggota_nama_ayah").value.trim();
        const nama_ibu = document.getElementById("anggota_nama_ibu").value.trim();

        if (nama_lengkap && nik && jenis_kelamin && tempat_lahir && tanggal_lahir && status_hubungan) {
            const data = getAnggotaKeluarga();
            
            data.push({
                nama_lengkap,
                nik,
                jenis_kelamin,
                tempat_lahir,
                tanggal_lahir,
                agama,
                pendidikan,
                jenis_pekerjaan,
                status_pernikahan,
                status_hubungan,
                kewarganegaraan,
                no_paspor,
                no_kitas_kitap,
                nama_ayah,
                nama_ibu
            });
            simpanAnggotaKeluarga(data);
            tampilkanAnggotaKeluarga();

            resetAnggotaKeluargaFields(); 

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data anggota keluarga berhasil ditambahkan.',
                confirmButtonColor: '#16a34a'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Input Kosong!',
                text: 'Harap isi semua kolom yang wajib diisi (Nama, NIK, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Status Hubungan).',
                confirmButtonColor: '#16a34a'
            });
        }
    }

    function hapusAnggotaKeluarga(index) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data anggota keluarga ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const data = getAnggotaKeluarga();
                data.splice(index, 1);
                simpanAnggotaKeluarga(data);
                tampilkanAnggotaKeluarga();
                Swal.fire(
                    'Dihapus!',
                    'Data anggota keluarga berhasil dihapus.',
                    'success'
                );
            }
        });
    }

    // Perbaikan utama: Tambahkan logic untuk mengirim data anggota dalam format JSON
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        // const mainFormFields = form.querySelectorAll("input[name], select[name]"); // Disini tidak ada cache input utama yang perlu dihapus lagi

        // Initial display of dynamic data
        tampilkanAnggotaKeluarga();

        // Modify submit to show SweetAlert confirmation
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const anggotaData = getAnggotaKeluarga();
            if (anggotaData.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Anggota Kosong',
                    text: 'Harap tambahkan minimal satu anggota keluarga.',
                    confirmButtonColor: '#16a34a'
                });
                return;
            }

            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Periksa kembali sebelum disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Periksa Lagi',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    // 🔴 PERBAIKAN: Buat input hidden untuk data JSON yang diharapkan controller
                    const inputJson = document.createElement("input");
                    inputJson.type = "hidden";
                    inputJson.name = "anggota_keluarga"; // Nama input harus 'anggota_keluarga'
                    inputJson.value = JSON.stringify(anggotaData); // Nilai adalah string JSON
                    form.appendChild(inputJson);

                    // Hapus input hidden yang lama (jika ada)
                    const oldHidden = form.querySelector('input[name^="anggota["]');
                    if (oldHidden) oldHidden.remove();
                    
                    // Hapus cookie setelah submit agar data tidak tersimpan jika kembali ke halaman
                    hapusCookieAnggotaKeluarga(); 

                    form.submit();
                }
            });
        });
    });
</script>