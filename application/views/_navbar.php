<!-- <header class="navbar-light navbar-sticky header-static">
		<nav class="navbar navbar-expand-xl">
			<div class="container">
				<a class="navbar-brand" href="index-2.html">
					<img class="light-mode-item navbar-brand-item"
						src="<?= base_url('assets/fotobin/')?>logo_text_right.png" alt="logo">
					<img class="dark-mode-item navbar-brand-item"
						src="<?= base_url('assets/fotobin/')?>logo_text_right.png" alt="logo">
				</a>

				<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-animation">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</button>

				<div class="navbar-collapse w-100 collapse" id="navbarCollapse">

					<ul class="navbar-nav navbar-nav-scroll mx-auto">
						<li
							class="<?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('home') ?>"><?= $this->lang->line('home') ?></a>
						</li>
						<li class="<?= ($this->uri->segment(1) == 'home') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('home/about/') ?>"><?= $this->lang->line('about_us') ?></a>
						</li>
						<li
							class="<?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'galeri') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('home/galeri/') ?>"><?= $this->lang->line('gallery') ?></a>
						</li>
						<li
							class="<?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'blog') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('home/blog/') ?>"><?= $this->lang->line('produk') ?></a>
						</li>
						
						<li class="<?= ($this->uri->segment(1) == 'contact') ? 'active' : '' ?>">
							<a class="nav-link" href="https://linktr.ee/sosialmediabi"><?= $this->lang->line('contact_us') ?></a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLanguage" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-globe"></i> <?= $this->lang->line('language') ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownLanguage">
								<a class="dropdown-item" href="<?= base_url('home/set_language/english') ?>">
									<img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg"
										alt="English" style="width: 20px; height: 15px; margin-right: 8px;"> English
								</a>
								<a class="dropdown-item" href="<?= base_url('home/set_language/indonesian') ?>">
									<img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg"
										alt="Indonesian" style="width: 20px; height: 15px; margin-right: 8px;">
									Indonesian
								</a>
							</div>
						</li>

					</ul>


				</div>


			</div>
		</nav>
	</header> -->

<!-- Header START -->
<header class="navbar-light navbar-sticky">
	<nav class="navbar navbar-expand-xl z-index-9">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand" href="index.html">
				<img class="light-mode-item navbar-brand-item" src="<?= base_url('assets/assets/img/logoasli.png'); ?>"
					alt="logo" style="height: 60px;">
				<img class="dark-mode-item navbar-brand-item" src="<?= base_url('assets/assets/img/logoasli.png'); ?>"
					alt="logo" style="height: 60px;">
			</a>

			<!-- Logo END -->

			<!-- Navbar toggler -->
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>

			<!-- Main navbar START -->
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<!-- Nav Main menu START -->
				<ul class="navbar-nav mx-auto text-center">
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : '' ?>"
							href="<?= base_url('home') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'about') ? 'active' : '' ?>"
							href="<?= base_url('home/about/') ?>"><i class="bi bi-person-circle me-2"></i> Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'contact') ? 'active' : '' ?>"
							href="<?= base_url('home/contact/') ?>"><i class="bi bi-envelope-paper-fill me-2"></i>
							Contact</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'faq') ? 'active' : '' ?>"
							href="<?= base_url('home/faq/') ?>"><i class="bi bi-question-circle-fill me-2"></i>
							Pertanyaan (FAQ)</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'galeri') ? 'active' : '' ?>"
							href="<?= base_url('home/galeri/') ?>"><i class="bi bi-images me-2"></i> Gallery</a>
					</li>
				</ul>
				<!-- Nav Main menu END -->

				<!-- Button Daftar -->
				<div class="text-center text-lg-end">
					<a href="#" class="btn btn-primary ms-lg-3 mt-3 mt-lg-0">
						<i class="bi bi-pencil-square me-1"></i> Daftar
					</a>
				</div>
			</div>


		</div>
	</nav>
</header>
<!-- Header END -->
