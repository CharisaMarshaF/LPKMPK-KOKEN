<!DOCTYPE html>
<html lang="en">
<head>

</head>
<?php require_once('_css.php')?>

<body>

	<!-- Header START -->
	<?php require_once('_navbar.php')?>

	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Gallery START-->
<style>
	.masonry-grid {
    column-count: 3; /* jumlah kolom di desktop */
    column-gap: 1.5rem;
}

@media (max-width: 992px) {
    .masonry-grid {
        column-count: 2;
    }
}
@media (max-width: 576px) {
    .masonry-grid {
        column-count: 1;
    }
}

.masonry-item {
    break-inside: avoid;
    margin-bottom: 1.5rem;
}

</style>

		<!-- =======================
Gallery START-->
		<section class="pt-0 pt-md-5">
			<div class="container">
				<!-- Title -->
				<div class="row mb-3 mb-sm-4">
					<div class="col-12 mx-auto text-center">
						<h2 class="fs-1 fw-bold">
							<span class="position-relative z-index-9"><?= $this->lang->line('gallery') ?></span>
							<span class="position-relative z-index-1">Pendaftaran Peserta LPKMPK KOKEN
								<!-- SVG START -->
								<span
									class="position-absolute top-50 start-50 translate-middle z-index-n1 d-none d-sm-block">
									<svg class="fill-primary" width="250" height="86" viewBox="0 0 303 86">
										<path
											d="M288.197 19.3999C281.599 15.6998 273.654 13.03 265.424 10.926C256.533 8.64794 247.263 6.92124 237.946 5.4267C218.461 2.249 198.384 0.406219 178.237 0.0579769C158.609 -0.275755 138.888 0.8125 119.733 3.49686C108.17 5.10748 96.8189 7.2985 85.8466 10.0264C81.4955 11.0131 77.168 12.0723 72.9115 13.2331C56.382 17.7022 40.5146 23.4192 26.3972 30.355C12.9182 36.9861 0.716203 46.0404 0.999971 57.2131C1.14185 62.2772 4.16871 67.051 9.98595 70.693C15.4721 74.1319 22.6846 76.3809 29.9679 78.0206C38.7647 80.0085 48.0345 81.3289 57.257 82.4026C67.1179 83.5489 77.0734 84.2889 87.0762 84.6807C107.413 85.4642 127.892 84.7968 148.063 83.0266C168.399 81.2418 188.429 78.3543 208.127 74.8139C227.399 71.3459 246.436 67.2976 265.141 62.8285C278.927 59.5348 294.227 55.0802 300.446 46.2435C307.091 36.812 299.949 25.973 288.197 19.3999ZM298.862 46.7804C295.48 50.9593 289.592 54.0935 283.207 56.4876C276.633 58.9543 269.468 60.7391 262.279 62.4077C252.915 64.5843 243.503 66.6737 234.044 68.6616C215.174 72.6083 196.019 76.0762 176.534 78.7171C157.191 81.3289 137.54 83.0991 117.747 83.6505C97.9304 84.2019 77.9957 83.5634 58.4866 81.3289C49.5243 80.2987 40.5146 79.0363 31.907 77.1645C24.5764 75.5829 17.3403 73.4499 11.6649 70.1126C5.49296 66.4561 2.15869 61.5226 2.22963 56.2555C2.32422 50.7417 5.72943 45.489 10.9555 41.0489C16.1106 36.6959 22.7319 33.0974 29.6842 29.8472C36.2108 26.8145 43.0213 24.0141 50.0918 21.4748C48.4601 22.1278 46.8521 22.7953 45.2678 23.4772C37.7716 26.684 30.4409 30.1664 23.9615 34.1131C17.695 37.9438 12.1615 42.3839 9.30018 47.5785C6.55709 52.5554 6.10779 58.1853 9.77313 63.0462C13.0838 67.4427 19.303 70.7655 26.279 72.8985C34.6974 75.4813 44.2036 76.2358 53.497 76.381C63.8309 76.5406 74.2357 76.1488 84.5696 75.757C95.0454 75.3652 105.497 74.7993 115.926 74.0884C136.783 72.6664 157.545 70.6204 178.071 67.9361C187.956 66.6447 197.817 65.2227 207.583 63.6411C208.269 63.525 208.718 62.3642 208.009 62.4658C188.358 65.629 168.447 68.2118 148.394 70.2142C128.435 72.202 108.312 73.624 88.1404 74.4366C78.0666 74.8429 67.9219 75.1911 57.8008 75.2056C48.3419 75.2201 38.6465 74.7558 29.8261 72.5068C22.5427 70.6785 15.8032 67.6169 11.8777 63.3509C7.33745 58.4175 7.52663 52.4393 10.6481 47.2302C13.7695 41.9776 19.7523 37.581 26.3263 33.8084C32.7583 30.1083 39.8289 26.7855 47.1359 23.7529C59.2197 18.7034 72.2257 14.4955 85.7756 11.1292C90.7889 9.99737 95.8494 8.98167 100.981 8.08205C117.96 5.07846 135.553 3.32274 153.218 2.88744C161.754 2.66979 170.315 2.78587 178.851 3.19215C179.537 3.22117 180.128 2.06037 179.277 2.01684C167.69 1.45094 156.032 1.47996 144.468 2.06037C145.745 1.97331 146.999 1.88625 148.275 1.8137C167.879 0.6674 187.696 1.04466 207.157 2.78587C226.075 4.46904 245.111 7.25497 262.894 11.608C278.714 15.4677 294.085 21.6635 299.808 32.0092C302.456 36.812 302.574 42.1662 298.862 46.7804Z" />
									</svg>
								</span>
								<!-- SVG END -->
							</span>
						</h2>
                        <p class="mb-0">Silakan isi formulir di bawah ini dengan lengkap dan benar. Data yang Anda berikan akan digunakan untuk keperluan administrasi dan pelatihan.</p>
					</div>
					<div class="row g-4">						
						<div class="masonry-grid">
							<form action="proses_pendaftaran.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
  <!-- Kolom Kiri -->
  <div class="space-y-4">
    <div>
      <label for="id" class="block font-medium mb-1">ID</label>
      <input type="text" name="id" id="id" class="w-full border rounded-lg p-2" required>
    </div>

    <div>
      <label for="nama" class="block font-medium mb-1">Nama</label>
      <input type="text" name="nama" id="nama" class="w-full border rounded-lg p-2" required>
    </div>

    <div>
      <label for="alamat" class="block font-medium mb-1">Alamat</label>
      <textarea name="alamat" id="alamat" rows="2" class="w-full border rounded-lg p-2" required></textarea>
    </div>

    <div>
      <label for="jenis_kelamin" class="block font-medium mb-1">Jenis Kelamin</label>
      <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border rounded-lg p-2">
        <option value="">Pilih</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>

    <div>
      <label for="tanggal_lahir" class="block font-medium mb-1">Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="menikah" class="block font-medium mb-1">Status Menikah</label>
      <select name="menikah" id="menikah" class="w-full border rounded-lg p-2">
        <option value="Belum">Belum</option>
        <option value="Sudah">Sudah</option>
      </select>
    </div>

    <div>
      <label for="tinggi_badan" class="block font-medium mb-1">Tinggi Badan (cm)</label>
      <input type="number" name="tinggi_badan" id="tinggi_badan" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="berat_badan" class="block font-medium mb-1">Berat Badan (kg)</label>
      <input type="number" name="berat_badan" id="berat_badan" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="buta_warna" class="block font-medium mb-1">Buta Warna</label>
      <select name="buta_warna" id="buta_warna" class="w-full border rounded-lg p-2">
        <option value="Tidak">Tidak</option>
        <option value="Parsial">Parsial</option>
        <option value="Total">Total</option>
      </select>
    </div>

    <div>
      <label for="golongan_darah" class="block font-medium mb-1">Golongan Darah</label>
      <select name="golongan_darah" id="golongan_darah" class="w-full border rounded-lg p-2">
        <option value="">Pilih</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
        <option value="O">O</option>
      </select>
    </div>
  </div>

  <!-- Kolom Kanan -->
  <div class="space-y-4">
    <div>
      <label for="tangan_dominan" class="block font-medium mb-1">Tangan Dominan</label>
      <select name="tangan_dominan" id="tangan_dominan" class="w-full border rounded-lg p-2">
        <option value="Kanan">Kanan</option>
        <option value="Kiri">Kiri</option>
        <option value="Keduanya">Keduanya</option>
      </select>
    </div>

    <div>
      <label for="operasi" class="block font-medium mb-1">Pernah Operasi</label>
      <select name="operasi" id="operasi" class="w-full border rounded-lg p-2">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
      </select>
    </div>

    <div>
      <label for="alkohol" class="block font-medium mb-1">Konsumsi Alkohol</label>
      <select name="alkohol" id="alkohol" class="w-full border rounded-lg p-2">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
      </select>
    </div>

    <div>
      <label for="merokok" class="block font-medium mb-1">Merokok</label>
      <select name="merokok" id="merokok" class="w-full border rounded-lg p-2">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
      </select>
    </div>

    <div>
      <label for="tato" class="block font-medium mb-1">Memiliki Tato</label>
      <select name="tato" id="tato" class="w-full border rounded-lg p-2">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
      </select>
    </div>

    <div>
      <label for="agama" class="block font-medium mb-1">Agama</label>
      <select name="agama" id="agama" class="w-full border rounded-lg p-2">
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Katolik">Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>

    <div>
      <label for="tempat_lahir" class="block font-medium mb-1">Tempat Lahir</label>
      <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="no_telp" class="block font-medium mb-1">No. Telepon</label>
      <input type="text" name="no_telp" id="no_telp" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="no_ktp" class="block font-medium mb-1">No. KTP</label>
      <input type="text" name="no_ktp" id="no_ktp" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="motivasi" class="block font-medium mb-1">Motivasi Mengikuti Pelatihan</label>
      <textarea name="motivasi" id="motivasi" rows="2" class="w-full border rounded-lg p-2"></textarea>
    </div>

    <div>
      <label for="promosi" class="block font-medium mb-1">Tahu dari mana?</label>
      <input type="text" name="promosi" id="promosi" class="w-full border rounded-lg p-2">
    </div>

    <div>
      <label for="kelebihan" class="block font-medium mb-1">Kelebihan</label>
      <textarea name="kelebihan" id="kelebihan" rows="2" class="w-full border rounded-lg p-2"></textarea>
    </div>

    <div>
      <label for="kekurangan" class="block font-medium mb-1">Kekurangan</label>
      <textarea name="kekurangan" id="kekurangan" rows="2" class="w-full border rounded-lg p-2"></textarea>
    </div>

    <div>
      <label for="hobi" class="block font-medium mb-1">Hobi</label>
      <input type="text" name="hobi" id="hobi" class="w-full border rounded-lg p-2">
    </div>
  </div>

  <!-- Tombol -->
  <div class="col-span-1 md:col-span-2 text-center mt-6">
    <button type="submit" class="bg-green-700 text-white font-semibold px-8 py-2 rounded-lg hover:bg-green-800 transition">
      Daftar Sekarang
    </button>
  </div>
</form>

						</div>
					</div>
			</div>
		</section>
		<!-- =======================
Gallery START-->
	</main>

	<?php require_once('_footer.php')?>

	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<?php require_once('_js.php')?>


</body>


</html>