<!-- BEGIN: Modal Toggle -->
<div class="text-left mt-8">
	<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview"
		class="btn btn-primary">Tambah User</a>
</div>
<!-- END: Modal Toggle -->


<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y box mt-3">
	<div class="p-5">
		<div class="preview">
			<div class="overflow-x-auto">
				<!-- DataTables Table -->
				<table id="example1" class="table table-report table-report--bordered display datatable w-full">
					<thead class="bg-gray-100">
						<tr>
							<th class="border-b-2 whitespace-no-wrap">NO </th>
							<th class="border-b-2 whitespace-no-wrap">Nama </th>
							<th class="border-b-2 whitespace-no-wrap">Username</th>
							<th class="border-b-2 whitespace-no-wrap">Level</th>
							<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<?php  $no = 1; foreach ($user as $kk) {?>
						<tr>
							<td class="text-left border-b"><?= $no; ?></td>
							<td class="text-left border-b"><?= $kk['nama']; ?></td>
							<td class="text-left border-b"><?= $kk['username']; ?></td>
							<td class="text-left border-b"><?= $kk['level']; ?></td>


							<td class="border-b w-5">
								<div class="flex justify-center items-center">
									<a class="flex items-center mr-3 text-blue-500 edit-btn" href="javascript:;"
										data-id="<?= $kk['id_user']; ?>" data-nama="<?= $kk['nama']; ?>"
										data-username="<?= $kk['username']; ?>" data-level="<?= $kk['level']; ?>"
										data-tw-toggle="modal" data-tw-target="#edit-modal">
										<i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
									</a>
									<a class="flex items-center text-danger delete-btn" href="javascript:;"
										data-id="<?= $kk['id_user']; ?>">
										<i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
									</a>
								</div>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>

			<!-- END: EDIT Confirmation Modal -->
			<!-- BEGIN: Delete Confirmation Modal -->
			<!-- BEGIN: Modal Edit Supplier -->
			<div id="edit-modal" class="modal" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- BEGIN: Modal Header -->
						<div class="modal-header">
							<h2 class="font-medium text-base mr-auto">EDIT User</h2>
						</div>
						<!-- END: Modal Header -->
						<!-- BEGIN: Modal Body -->
						<form action="<?= base_url('admin/user/update') ?>" method="post" enctype="multipart/form-data">
							<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
								<input type="hidden" name="id_user" id="edit-id">
								<div class="col-span-12">
									<label class="form-label">
										<P>Nama</P>
									</label>
									<input name="nama" id="edit-nama" type="text" class="form-control" required>
								</div>
								<div class="col-span-12">
									<label class="form-label">Username</label>
									<input name="username" id="edit-username" type="text" class="form-control" readonly>
								</div>

							</div>
							<!-- END: Modal Body -->
							<!-- BEGIN: Modal Footer -->
							<div class="modal-footer">
								<button type="button" data-tw-dismiss="modal"
									class="btn btn-outline-secondary w-20 mr-1">Batal</button>
								<button type="submit" class="btn btn-primary w-20">Update</button>
							</div>
							<!-- END: Modal Footer -->
						</form>
					</div>
				</div>
			</div>
			<!-- END: Modal Edit Supplier -->
			<!-- BEGIN: Modal Content -->
			<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- BEGIN: Modal Header -->
						<div class="modal-header">
							<h2 class="font-medium text-base mr-auto">TAMBAH USER</h2>
						</div> <!-- END: Modal Header -->
						<form action="<?= base_url('admin/user/simpan') ?>" method="post" enctype="multipart/form-data">
							<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
								<div class="col-span-12">
									<label class="form-label">Nama</label>
									<input name="nama" id="modal-form-nama" type="text" class="form-control"
										placeholder="Nama Produk" required>
								</div>
								<div class="col-span-12">
									<label class="form-label">Username</label>
									<input name="username" id="modal-form-keterangan" type="text" class="form-control"
										required>
								</div>
								<div class="col-span-12">
									<label class="form-label">Password</label>
									<input name="password" id="modal-form-keterangan" type="text" class="form-control"
										required>
								</div>
								<div class="col-span-12">
									<label class="form-label">Level</label>
									<select name="level" id="modal-form-level" class="form-control" required>
										<option value="admin">Admin</option>
										<option value="kontributor">Kontributor</option>
									</select>
								</div>



							</div>
							<!-- BEGIN: Modal Footer -->
							<div class="modal-footer">
								<button type="button" data-tw-dismiss="modal"
									class="btn btn-outline-secondary w-20 mr-1">Batal</button>
								<button type="submit" class="btn btn-primary w-20">Simpan</button>
							</div>
							<!-- END: Modal Footer -->
						</form>
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
			</style>d
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

			<script>
				$(document).ready(function () {
					$(".edit-btn").click(function () {
						var id = $(this).data("id");
						var nama = $(this).data("nama");
						var username = $(this).data("username");

						$("#edit-id").val(id);
						$("#edit-nama").val(nama);
						$("#edit-username").val(username);


					});



					$(".delete-btn").click(function () {
						var id = $(this).data("id");

						Swal.fire({
							title: "Apakah Anda yakin?",
							text: "Data ini akan dihapus secara permanen!",
							icon: "warning",
							showCancelButton: true,
							confirmButtonColor: "#d33",
							cancelButtonColor: "#3085d6",
							confirmButtonText: "Ya, hapus!",
							cancelButtonText: "Batal"
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "<?= base_url('admin/user/delete_data/') ?>" + id;
							}
						});

					});
				});
			</script>

			<script>
				$(document).ready(function () {
					setTimeout(function () {
						$("#myalert").fadeOut("slow");
					}, 3000);
				});
			</script>