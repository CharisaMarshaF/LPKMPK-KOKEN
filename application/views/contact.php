
	<?php require_once('_css.php')?>


<body>

	<?php require_once('_navbar.php')?>

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="pt-5 pb-0"
style="background-image:url('<?= base_url('assets/assets/images/element/map.svg') ?>'); background-position: center left; background-size: cover;">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-xl-6 text-center mx-auto">
						<!-- Title -->
						<h6 class="text-primary">Hubungi Kami</h6>
						<h1 class="mb-4">Kami siap membantu Anda!</h1>
					</div>
				</div>

				<!-- Contact info box -->
				<div class="row g-4 g-md-5 mt-0 mt-lg-3 justify-content-center">

					<!-- Box item: Kontak -->
					<div class="col-lg-5 mt-lg-0">
						<div class="card card-body bg-primary shadow py-5 text-center h-100">
							<h5 class="text-white mb-3">Informasi Kontak</h5>
							<ul class="list-inline mb-0">
								<li class="list-item mb-3">
									<span class="text-white">
										<i class="fas fa-fw fa-map-marker-alt me-2 mt-1"></i>
										Jl. Depok No. 1, Manahan, Banjarsari, Surakarta, Jawa Tengah
									</span>
								</li>
								<li class="list-item mb-3">
									<a href="https://wa.me/6285647523100" class="text-white">
										<i class="fas fa-fw fa-phone-alt me-2"></i>
										0856-4752-3100 (Ninik)
									</a>
								</li>
								<li class="list-item mb-0">
									<a href="mailto:Nratnasari21@gmail.com" class="text-white">
										<i class="far fa-fw fa-envelope me-2"></i>
										Nratnasari21@gmail.com
									</a>
								</li>
							</ul>
						</div>
					</div>

					<!-- Box item: Jam Operasional -->
					<div class="col-lg-5 mt-lg-0">
						<div class="card card-body shadow py-5 text-center h-100">
							<h5 class="mb-3">Jam Operasional</h5>
							<ul class="list-inline mb-0">
								<li class="list-item mb-3 h6 fw-light">
									<i class="fas fa-clock me-2"></i>Senin – Jumat: 08.00 - 16.00
								</li>
								<li class="list-item mb-3 h6 fw-light">
									<i class="fas fa-clock me-2"></i>Sabtu: 08.00 - 13.00
								</li>
								<li class="list-item mb-0 h6 fw-light">
									<i class="fas fa-times-circle me-2"></i>Minggu & Hari Libur: Tutup
								</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->


		<!-- =======================
Image and contact form START -->
		<section>
			<div class="container">
				<div class="row g-4 g-lg-0 align-items-center">

					<div class="col-md-6 align-items-center text-center">
						<!-- Image -->
						<img src="<?= base_url('assets/assets/images/element/contact.svg') ?>" class="h-400px" alt="">

						<!-- Social media button -->
						<div class="d-sm-flex align-items-center justify-content-center mt-2 mt-sm-4">
							<h5 class="mb-0">Follow us on:</h5>
							<ul class="list-inline mb-0 ms-sm-2">
								<li class="list-inline-item">
									<a class="fs-5 me-1 text-facebook"
										href="https://www.facebook.com/lpkmpkkoken?mibextid=wwXIfr" target="_blank">
										<i class="fab fa-fw fa-facebook-square"></i>
									</a>
								</li>
								<li class="list-inline-item">
									<a class="fs-5 me-1 text-instagram"
										href="https://www.instagram.com/lpkmpk_koken?igsh=ZHI4Y3M0Y3Bpamoz"
										target="_blank">
										<i class="fab fa-fw fa-instagram"></i>
									</a>
								</li>
								<li class="list-inline-item">
									<a class="fs-5 me-1 text-dark"
										href="https://www.tiktok.com/@lpkmpk_koken?_t=ZS-8xbpaFofPD5&_r=1"
										target="_blank">
										<i class="fab fa-fw fa-tiktok"></i>
									</a>
								</li>
							</ul>

						</div>
					</div>

					<!-- Contact form START -->
					<div class="col-md-6">
						<!-- Title -->
						<h2 class="mt-4 mt-md-0">Hubungi Kami</h2>
						<p>Isi formulir di bawah ini, pesan Anda akan langsung terkirim melalui WhatsApp.</p>

						<form id="contactForm">
							<!-- Name -->
							<div class="mb-4 bg-light-input">
								<label for="yourName" class="form-label">Nama Anda *</label>
								<input type="text" class="form-control form-control-lg" id="yourName" required>
							</div>
							<!-- Message -->
							<div class="mb-4 bg-light-input">
								<label for="textareaBox" class="form-label">Pesan *</label>
								<textarea class="form-control" id="textareaBox" rows="4" required></textarea>
							</div>
							<!-- Button -->
							<div class="d-grid">
								<button class="btn btn-lg btn-primary mb-0" type="submit">Kirim via WhatsApp</button>
							</div>
						</form>
					</div>

					<!-- Script WhatsApp -->
					<script>
						document.getElementById('contactForm').addEventListener('submit', function (e) {
							e.preventDefault();

							var name = document.getElementById('yourName').value.trim();
							var message = document.getElementById('textareaBox').value.trim();

							if (name && message) {
								var phone = '6285647523100'; // Ganti dengan nomor WA tujuan (tanpa +, gunakan 62)
								var url = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(
									'Halo, saya ' + name + '.\n\n' + message
								);
								window.open(url, '_blank');
							} else {
								alert('Silakan isi nama dan pesan terlebih dahulu.');
							}
						});
					</script>

					<!-- Contact form END -->
				</div>
			</div>
		</section>
		<!-- =======================
Image and contact form END -->

		<!-- =======================
Map START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<iframe class="w-100 h-400px grayscale rounded"
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1879075537036!2d110.80730327404562!3d-7.554479274591765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a169dc8843541%3A0x3dc77ad84aeac215!2sJl.%20Depok%20No.1%2C%20Manahan%2C%20Kec.%20Banjarsari%2C%20Kota%20Surakarta%2C%20Jawa%20Tengah%2057139!5e0!3m2!1sen!2sid!4v1751615449147!5m2!1sen!2sid"
							height="500" style="border:0;" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Map END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<?php require_once('_footer.php')?>

	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<?php require_once('_js.php')?>

