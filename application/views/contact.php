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
											<?= $konfig->alamat ?>
										</span>
									</li>
									<?php
										$row = $this->db->get_where('social_media', ['id' => 1])->row();
										for ($i = 1; $i <= 3; $i++) {
											$wa = "whatsapp_$i";
											$nama = "nama_wa$i";
											if (!empty($row->$wa)) {
												$number = preg_replace('/[^0-9]/', '', $row->$wa);
												echo '<li class="list-item mb-3">
													<a href="https://wa.me/' . $number . '" class="text-white" target="_blank">
														<i class="fas fa-fw fa-phone-alt me-2"></i>
														' . htmlspecialchars($row->$nama) . ' - ' . $row->$wa . '
													</a>
												</li>';
											}
										}
										?>

									<li class="list-item mb-0">
										<a href="mailto:<?= $sosmed->email ?>" class="text-white">
											<i class="far fa-fw fa-envelope me-2"></i>
											<?= $sosmed->email ?>
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
										<a class="fs-5 me-1 text-facebook" href="<?= $sosmed->facebook ?>" target="_blank">
											<i class="fab fa-fw fa-facebook-square"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a class="fs-5 me-1 text-instagram" href="<?= $sosmed->instagram ?>"
											target="_blank">
											<i class="fab fa-fw fa-instagram"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a class="fs-5 me-1 text-dark" href="<?= $sosmed->tiktok ?>" target="_blank">
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
									var phone = "<?= preg_replace('/[^0-9]/', '', $active_wa) ?>";
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
							<iframe class="w-100 h-400px grayscale rounded" src="<?= $konfig->google_maps_link ?>"
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