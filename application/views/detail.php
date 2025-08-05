<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once('_css.php') ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

</head>

<body>
	<!-- Header START -->
	<?php require_once('_navbar.php') ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- ======================= Page content START -->
		<section class="pt-5">
			<div class="container" data-sticky-container>
				<div class="row g-4 g-sm-5">

					<!-- Left sidebar START -->
					<!-- SLIDER START -->
					<div class="col-xl-4">
						<div class="swiper mySwiper border rounded overflow-hidden shadow-sm"
							style="aspect-ratio: 3 / 4; max-width: 100%; height: auto;">
							<div class="swiper-wrapper">
								<?php if (!empty($fotos)): ?>
								<?php foreach ($fotos as $foto): ?>
								<div class="swiper-slide">
									<img src="<?= base_url('assets/upload/konten/' . $foto['foto']) ?>" alt="Foto"
										style="width: 100%; height: 100%; object-fit: cover;">
								</div>
								<?php endforeach; ?>
								<?php else: ?>
								<div class="swiper-slide">
									<img src="<?= base_url('assets/images/default.jpg') ?>" alt="Default"
										style="width: 100%; height: 100%; object-fit: cover;">
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<!-- SLIDER END -->

					<!-- Left sidebar END -->

					<!-- Main content START -->
					<div class="col-xl-8">

						<!-- Title -->
						<h1 class="mb-3 fw-bold"><?= $konten['judul'] ?></h1>

						<!-- Garis pemisah -->
						<!-- <div class="my-3" style="height: 4px; width: 100px; background: linear-gradient(to right, #198754, #8cd790); border-radius: 2px;"></div> -->

						<!-- Box Harga -->
						<div class="mb-4">
							<div class="bg-primary text-white rounded-3 px-4 py-3 d-inline-block shadow-sm">
								<div class="h5 fw-bold mb-0 text-white">
									<?= 'Rp ' . number_format($konten['harga'], 2, ',', '.'); ?>
								</div>
							</div>
						</div>


						<!-- Content -->
						<h4 class="mt-4 mb-3"></h4>
						<p class="fs-6 text-black" style="line-height: 1.7;">
							<?= nl2br($konten['keterangan']) ?>
						</p>

					</div>

				</div>
		</section>
		<!-- ======================= Page content END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- ======================= Footer START -->
	<?php require_once('_footer.php') ?>
	<!-- ======================= Footer END -->

	<!-- Back to top -->
	<div class="back-top">
		<i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
	</div>
	<!-- Swiper JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script>
		const swiper = new Swiper(".mySwiper", {
			loop: true,
			spaceBetween: 10,
			slidesPerView: 1,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
		});
	</script>

	<?php require_once('_js.php') ?>
</body>

</html>
