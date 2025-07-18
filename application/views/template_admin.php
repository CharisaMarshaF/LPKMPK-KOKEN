<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link href="<?= base_url('assets/assets/img/logo.png'); ?>" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="LEFT4CODE">
	<title>Dashboard</title>

	<!-- CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/app.css'); ?>" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

	<!-- JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="py-5 md:py-0">
	<!-- BEGIN: Top Bar -->
	<div
		class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
		<div class="h-full flex items-center">
			<!-- BEGIN: Logo -->
			<a href="<?= base_url('/'); ?>" class="logo -intro-x hidden md:flex xl:w-[180px] block">
				<img alt="Binco App Logo" class="logo__image w-16"
					src="<?= base_url('assets/assets/img/logo_outline.png'); ?>">
				<span class="logo__text text-white text-xl ml-3"> LPK MPKKOKEN </span>
			</a>
			<!-- END: Logo -->
			<!-- BEGIN: Breadcrumb -->
			<nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
				<ol class="breadcrumb breadcrumb-light">
					<li class="breadcrumb-item"><a href="#">Application</a></li>
					<li class="breadcrumb-item" aria-current="page"><?= $judul_halaman ?></li>
				</ol>
			</nav>
			<!-- END: Breadcrumb -->
			<!-- BEGIN: Account Menu -->
			<div class="intro-x dropdown w-8 h-8">
				<div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
					role="button" aria-expanded="false" data-tw-toggle="dropdown">
					<img alt="Midone - HTML Admin Template" src="<?= base_url('assets/') ?>/assets/img/logo.png    ">
				</div>
				<div class="dropdown-menu w-56">
					<ul
						class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
						<li class="p-2">
							<div class="font-medium"><?= $this->session->userdata('nama') ?></div>
							<div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
								<?= $this->session->userdata('level') ?></div>
						</li>
						<li>
							<hr class="dropdown-divider border-white/[0.08]">
						</li>

						<li>
							<a href="<?= base_url('auth/logout') ?>" class="dropdown-item hover:bg-white/5"> <i
									data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
						</li>
					</ul>
				</div>
			</div>
			<!-- END: Account Menu -->
		</div>
	</div>
	<!-- END: Top Bar -->
	<div class="flex overflow-hidden ">
		<!-- BEGIN: Side Menu -->
		<?php $menu = $this->uri->segment(2);?>

		<nav class="side-nav">
			<ul>
				<li>
					<a href="<?= site_url('admin/home') ?>"
						class="side-menu <?php if($menu=='home'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="layout-dashboard"></i></div>
						<div class="side-menu__title"> Dashboard </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/caraousel') ?>"
						class="side-menu <?php if($menu=='caraousel'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="image-plus"></i></div>
						<div class="side-menu__title"> Carousel </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/testimoni') ?>"
						class="side-menu <?php if($menu=='testimoni'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="message-circle"></i></div>
						<div class="side-menu__title"> Testimoni </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/faq') ?>"
						class="side-menu <?php if($menu=='faq'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="help-circle"></i></div>
						<div class="side-menu__title"> FAQ </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/galeri') ?>"
						class="side-menu <?php if($menu=='galeri'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="image"></i></div>
						<div class="side-menu__title"> Galeri </div>
					</a>
				</li>
				<li>
					<a href="<?= site_url('admin/dokumentasi') ?>"
						class="side-menu <?php if($menu=='dokumentasi'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="book-open"></i></div>
						<div class="side-menu__title"> Dokumentasi </div>
					</a>
				</li>

				
				<li>
					<a href="<?= site_url('admin/about') ?>"
						class="side-menu <?php if($menu=='about'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="info"></i></div>
						<div class="side-menu__title"> Tentang </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/about_founder') ?>"
						class="side-menu <?php if($menu=='about_founder'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="user-check"></i></div>
						<div class="side-menu__title"> Profil </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/social_media') ?>"
						class="side-menu <?php if($menu=='social_media'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="share-2"></i></div>
						<div class="side-menu__title"> Media Sosial </div>
					</a>
				</li>

				<li class="side-nav__devider my-6"></li>

				<li>
					<a href="<?= site_url('admin/user') ?>"
						class="side-menu <?php if($menu=='user'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="users"></i></div>
						<div class="side-menu__title"> Pengguna </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/konfigurasi') ?>"
						class="side-menu <?php if($menu=='konfigurasi'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="settings-2"></i></div>
						<div class="side-menu__title"> Konfigurasi </div>
					</a>
				</li>

				<li>
					<a href="<?= site_url('admin/recentlgn') ?>"
						class="side-menu <?php if($menu=='recentlgn'){ echo"side-menu--active"; } ?>">
						<div class="side-menu__icon"><i data-lucide="clock-10"></i></div>
						<div class="side-menu__title"> Login Terakhir </div>
					</a>
				</li>
			</ul>

		</nav>
		<!-- END: Side Menu -->
		<!-- BEGIN: Content -->
		<div class="content overflow-y-auto flex-1">
			<?= $contents; ?>

		</div>
		<!-- END: Content -->
	</div>
	<!-- BEGIN: JS Assets-->
	<script src="<?= base_url('assets/dist/js/app.js'); ?>"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).ready(function () {
			$('#example1').DataTable({
				"searching": true,
				"lengthChange": false,
				"language": {
					"search": "Pencarian "
				}
			});
		});
	</script>
	<!-- END: JS Assets-->
</body>

</html>