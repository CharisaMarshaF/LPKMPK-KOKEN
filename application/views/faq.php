
	<?php require_once('_css.php')?>


<body>

	<?php require_once('_navbar.php')?>

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<!-- =======================
Page Banner START -->
		<section class="bg-light py-5">
			<div class="container">
				<div class="row g-4 g-md-5 position-relative">
					<!-- SVG decoration -->
					<figure class="position-absolute top-0 start-0 d-none d-sm-block">
						<svg width="22px" height="22px" viewBox="0 0 22 22">
							<polygon class="fill-primary"
								points="22,8.3 13.7,8.3 13.7,0 8.3,0 8.3,8.3 0,8.3 0,13.7 8.3,13.7 8.3,22 13.7,22 13.7,13.7 22,13.7 ">
							</polygon>
						</svg>
					</figure>

					<!-- Title and Search -->
					<div class="col-lg-10 mx-auto text-center position-relative">
						<!-- SVG dekorasi -->
						<figure class="position-absolute top-50 end-0 translate-middle-y">
							<svg width="27px" height="27px">
								<path class="fill-danger"
									d="M13.122,5.946 L17.679,-0.001 L17.404,7.528 L24.661,5.946 L19.683,11.533 L26.244,15.056 L18.891,16.089 L21.686,23.068 L15.400,19.062 L13.122,26.232 L10.843,19.062 L4.557,23.068 L7.352,16.089 L-0.000,15.056 L6.561,11.533 L1.582,5.946 L8.839,7.528 L8.565,-0.001 L13.122,5.946 Z">
								</path>
							</svg>
						</figure>

						<!-- Judul -->
												<h1 class="display-6">Halo, ada yang bisa kami bantu?</h1>

						<!-- Formulir pertanyaan -->
						<div class="col-lg-8 mx-auto text-center mt-4">
							<form class="bg-body shadow rounded p-2" onsubmit="kirimKeWhatsapp(); return false;">
								<div class="input-group">
									<input id="wa-question" class="form-control border-0 me-1" type="text"
										placeholder="Tulis pertanyaan Anda di sini..." required>
									<button type="submit" class="btn btn-blue mb-0 rounded">Kirim</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- JavaScript -->
				<script>
					function kirimKeWhatsapp() {
						const nomor = "<?= preg_replace('/[^0-9]/', '', $active_whatsapp) ?>";
						const pertanyaan = document.getElementById("wa-question").value;
						const pesan = `Halo admin, saya ingin bertanya: ${pertanyaan}`;
						const url = `https://wa.me/${nomor}?text=${encodeURIComponent(pesan)}`;
						window.open(url, '_blank');
					}
				</script>



				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->


<!-- =======================
Faqs START -->
<section class="position-relative overflow-hidden pt-0 pt-sm-5">
  <div class="container">

    <!-- Title -->
    <div class="row position-relative z-index-9">
      <div class="col-12 text-center mx-auto">
        <h2 class="mb-0">Pertanyaan yang Sering Diajukan</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-10 col-xl-8 mx-auto text-center position-relative">

        <!-- SVG Decoration Top Left -->
        <figure class="position-absolute top-0 start-0 translate-middle ms-8">
          <svg width="140" height="140" viewBox="0 0 141.7 143.9" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-primary" fill="#0C65FF" d="M137.7,53.1c9.6,29.3,1.8,64.7-20.2,80.7s-58.1,12.6-83.5-5.8C8.6,109.5-6.1,76.1,2.4,48.7 C10.8,21.1,42.2-0.7,71.5,0S128.1,23.8,137.7,53.1z"/>
          </svg>
        </figure>

        <!-- SVG Decoration Bottom Right -->
        <figure class="position-absolute bottom-0 end-0 me-n9 rotate-193">
          <svg width="297.5px" height="295.9px" viewBox="0 0 297.5 295.9">
            <path stroke="#0C065C" fill="none" stroke-width="13"
              d="M286.2,165.5c-9.8,74.9-78.8,128.9-153.9,120.4c-76-8.6-131.4-78.2-122.8-154.2C18.2,55.8,87.8,0.3,163.7,9" />
          </svg>
        </figure>

        <!-- FAQ START -->
<div class="accordion accordion-icon accordion-shadow mt-4 text-start position-relative" id="accordionFAQ">
          <?php if (!empty($faq)) : ?>
            <?php foreach ($faq as $index => $item) : ?>
              <div class="accordion-item mb-3">
                <h6 class="accordion-header font-base" id="heading<?= $index ?>">
                  <button class="accordion-button fw-bold rounded collapsed pe-5" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse<?= $index ?>" aria-expanded="false">
                    <?= $item['question'] ?>
                  </button>
                </h6>
                <div id="collapse<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                  <div class="accordion-body mt-3">
                    <?= $item['answer'] ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p class="text-center">Belum ada data FAQ.</p>
          <?php endif; ?>
        </div>
        <!-- FAQ END -->
      </div>
    </div>
  </div>
</section>
<!-- =======================
Faqs END -->


	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<?php require_once('_footer.php')?>

	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<?php require_once('_js.php')?>

