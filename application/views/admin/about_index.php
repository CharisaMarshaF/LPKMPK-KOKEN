<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
	<div id="myalert" style="margin-top: 10px;">
		<?= $this->session->flashdata('notifikasi') ?>
	</div>

	<div class="col-12">
		<div class="card my-4">
			<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
				<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
					<h6 class="text-black text-capitalize ps-3">Tentang Kami (About)</h6>
				</div>
			</div>
			<div class="card-body px-0 pb-2">
				<div class="table-responsive p-0">
					<table class="table align-items-center mb-0">
						<form action="<?= base_url('admin/about/update') ?>" method="post"
							enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-body p-4">

									<div class="mb-3">
										<label for="title" class="form-label">Judul</label>
										<input type="text" name="title" id="title" class="form-control"
											value="<?= isset($about) && $about ? $about->title : '' ?>" required>
									</div>
									<div class="mb-3">
										<label for="description" class="form-label">Deskripsi</label>
										<textarea name="description" id="description" rows="4" class="form-control"
											required><?= isset($about) && $about ? $about->description : '' ?></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">Gambar Utama 2:3</label><br>
										<input type="file" name="image_main" class="form-control">
										<?php if (isset($about) && !empty($about->image_main)) : ?>
										<img src="<?= base_url('assets/upload/about/' . $about->image_main) ?>"
											class="mt-2 rounded" width="150">
										<?php endif; ?>
									</div>
									<div class="mb-3">
										<label class="form-label">Gambar Sekunder 3:2</label><br>
										<input type="file" name="image_secondary" class="form-control">
										<?php if (isset($about) && !empty($about->image_secondary)) : ?>
										<img src="<?= base_url('assets/upload/about/' . $about->image_secondary) ?>"
											class="mt-2 rounded" width="150">
										<?php endif; ?>
									</div>
									<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
								</div>
							</div>
						</form>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-4">
	<div class="col-12">
		<div class="card">
			<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
				<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
					<h6 class="text-black text-capitalize ps-3">Fitur tambahan (About)</h6>
				</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url('admin/about/add_feature') ?>" method="post">
					<div class="input-group mb-3 p-3">
						<input type="text" name="text" class="form-control" placeholder="Tulis fitur baru..." required>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</form>

				<div class="intro-y box mt-3">
					<div class="p-5">
						<div class="preview">
							<div class="overflow-x-auto">
								<!-- DataTables Table -->
								<table id="example1"
									class="table table-report table-report--bordered display datatable w-full">
									<thead class="bg-gray-100">
										<tr>
											<th class="border-b-2 w-5">#</th>
											<th class="border-b-2 whitespace-no-wrap">Fitur</th>
											<th class="border-b-2 text-center whitespace-no-wrap">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($features)) : $no = 1; foreach ($features as $f) : ?>
										<tr>
											<td class="text-left border-b"><?= $no++ ?></td>
											<td class="text-left border-b"><?= $f['text'] ?></td>
											<td class="border-b w-5">
  <a href="javascript:;" 
     class="flex items-center text-danger delete-btn" 
     data-id="<?= $f['id'] ?>">
    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
  </a>
</td>


										</tr>
										<?php endforeach; else: ?>
										<tr>
											<td colspan="3" class="text-center">Belum ada fitur tambahan.</td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                <style>
  .swal2-confirm {
    background-color: #3085d6 !important;
    border: none;
    box-shadow: none;
  }

  .swal2-cancel {
    background-color: #d33 !important;
    border: none;
    box-shadow: none;
  }

  .swal2-button {
    display: inline-block !important;
    padding: 10px 20px !important;
    font-size: 16px !important;
    border-radius: 5px !important;
    text-transform: none !important;
    outline: none !important;
  }

  .swal2-container {
    z-index: 9999 !important;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();

  $(document).ready(function () {
    // Hapus fitur dengan SweetAlert
    $(".delete-btn").click(function () {
      var id = $(this).data("id");

      Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Fitur ini akan dihapus secara permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('admin/about/delete_feature/') ?>" + id;
        }
      });
    });

    // Notifikasi flashdata fade out
    setTimeout(function () {
      $("#myalert").fadeOut("slow");
    }, 3000);
  });
</script>
