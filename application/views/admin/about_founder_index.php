<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div id="myalert" style="margin-top: 10px;">
		<?= $this->session->flashdata('notifikasi') ?>
	</div>
	<div class="col-12">
		<div class="card my-4">
			<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
				<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
					<h6 class="text-black text-capitalize ps-3">Tentang Founder</h6>
				</div>
			</div>
			<div class="card-body px-0 pb-2">
				<div class="table-responsive p-0">
					<table class="table align-items-center mb-0">
						<form action="<?= base_url('admin/about_founder/update') ?>" method="post"
							enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-body p-4">
									<div class="mb-3">
										<label class="form-label">Judul</label>
										<input type="text" name="title" class="form-control"
											value="<?= isset($about) ? $about->title : '' ?>" required>
									</div>
									<div class="mb-3">
										<label class="form-label">Sub Judul</label>
										<input type="text" name="subtitle" class="form-control"
											value="<?= isset($about) ? $about->subtitle : '' ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Deskripsi</label>
										<textarea name="description" rows="4" class="form-control"
											required><?= isset($about) ? $about->description : '' ?></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">Paragraf 1</label>
										<textarea name="paragraph_1" rows="3"
											class="form-control"><?= isset($about) ? $about->paragraph_1 : '' ?></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">Paragraf 2</label>
										<textarea name="paragraph_2" rows="3"
											class="form-control"><?= isset($about) ? $about->paragraph_2 : '' ?></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">Foto Founder</label>
										<input type="file" name="image" class="form-control">
										<?php if (!empty($about->image)) : ?>
										<img src="<?= base_url('assets/upload/about/' . $about->image) ?>" width="150"
											class="mt-2 rounded">
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
				<form action="<?= base_url('admin/about_founder/add_feature') ?>" method="post">
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
							<th  class="border-b-2 whitespace-no-wrap">Fitur</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($features as $f): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td class="text-left border-b"><?= $f['text'] ?></td>
							<td class="border-b-2 w-5">
								<a href="javascript:;" data-id="<?= $f['id'] ?>" class="flex items-center text-danger delete-btn">
									<i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Delete
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="myalert">
	<?= $this->session->flashdata('notifikasi', true) ?>
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
		padding: 10px 20px !important;
		font-size: 16px !important;
		border-radius: 5px !important;
	}

	.swal2-container {
		z-index: 9999 !important;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function () {
		$('.delete-btn').click(function () {
			var id = $(this).data('id');
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: 'Fitur ini akan dihapus secara permanen!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href =
						"<?= base_url('admin/about_founder/delete_feature/') ?>" + id;
				}
			});
		});

		setTimeout(function () {
			$('#myalert').fadeOut('slow');
		}, 3000);
	});
</script>
