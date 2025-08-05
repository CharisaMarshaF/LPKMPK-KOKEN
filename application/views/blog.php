<!DOCTYPE html>
<html lang="en">


<head>
	<?php require_once('_css.php')?>

</head>

<body>

	<!-- Header START -->
	<?php require_once('_navbar.php')?>

	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="py-4">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bg-light p-4 text-center rounded-3">
							<h1 class="m-0">Produk Binco Ran Nusantara</h1>
							<!-- Breadcrumb -->
							<div class="d-flex justify-content-center">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb breadcrumb-dots mb-0">
										<li class="breadcrumb-item"><a href="#">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->
		<!-- =======================
Page content START -->
		<section class="pt-0">
			<div class="container">

				<form action="<?= base_url('home/blog') ?>"
					class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative" method="GET">
					<div class="row g-3">
						<div class="col-xl-11">
							<input class="form-control me-1" type="text" placeholder="Search for products"
								aria-label="Search" name="search"
								value="<?= html_escape($this->input->get('search')) ?>">
						</div>
						<div class="col-xl-1">
							<button type="submit" class="btn btn-primary mb-0 rounded z-index-1 w-100">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</form>

				<!-- Filter bar END -->

				<!-- =======================
Page content START -->
<style>
	.card.shadow {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e6e6e6;
    background: #fff;
}
.card.shadow:hover {
    transform: translateY(-5px) scale(1.01);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
}
.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    aspect-ratio: 3 / 4;
    object-fit: cover;
}
.card-title {
    font-size: 1.1rem;
    font-weight: 600;
}
.card-body p {
    font-size: 0.9rem;
    color: #555;
}
.badge.harga-badge {
    background-color: #eafbe7;
    color: #2e7d32;
    font-weight: 500;
}

</style>
				<section class="pt-0">
					<div class="container">

						<!-- Filter bar START -->

						<div class="row mt-3">
							<!-- Main content START -->
							<div class="col-12">

								<!-- Course Grid START -->
								<div class="row g-4">

									<!-- Card item START -->
									<div class="row g-4" id="konten-list">
										<?php if (empty($konten)): ?>
										<div class="col-12 text-center">
											<div class="alert alert-warning">
												<strong>Tidak ada produk</strong> yang ditemukan.
											</div>
										</div>
										<?php else: ?>
										<?php foreach ($konten as $uu): ?>
										<div class="col-sm-6 col-lg-4 col-xl-3">
											<div class="card shadow h-100">
												<!-- Ambil gambar pertama -->
												<?php
													$gambar = (!empty($uu['fotos']) && isset($uu['fotos'][0]['foto']))
														? base_url('assets/upload/konten/' . $uu['fotos'][0]['foto'])
														: base_url('assets/images/default.jpg');
												?>
												<img src="<?= $gambar ?>" class="card-img-top" style="aspect-ratio: 3 / 4; object-fit: cover;" alt="course image">

												<div class="card-body pb-0">
													<h5 class="card-title">
														<a href="<?= base_url('home/detail/' . $uu['slug']) ?>"
															class="stretched-link">
															<?= $uu['judul'] ?>
														</a>
													</h5>
													<hr>
													<p class="mb-0"><?= substr($uu['keterangan'], 0, 100) . '...'; ?>
													</p>
												</div>
												<div class="card-footer pt-0 pb-3">
													<hr>
													<div class="d-flex justify-content-between">
														<span class="h6 fw-light mb-0">
															<i class="fas fa-tag text-success me-2"></i>
															<?= 'Rp ' . number_format($uu['harga'], 2, ',', '.'); ?>
														</span>
													</div>
												</div>
											</div>
										</div>
										<?php endforeach; ?>
										<?php endif; ?>
									</div>

								</div>
								
								<div class="col-12">
									<nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
										<?= $pagination ?>
									</nav>
								</div>

								<!-- Pagination END -->
								<!-- Pagination END -->
							</div>
							<!-- Main content END -->
						</div><!-- Row END -->
					</div>
				</section>
				<!-- =======================
Page content END -->



	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================

	Footer START -->
	<?php require_once('_footer.php')?>

	<!-- =======================
Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<?php require_once('_js.php')?>


</body>


</html>