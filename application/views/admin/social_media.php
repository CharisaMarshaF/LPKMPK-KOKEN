<div class="row">
	<div class="col-12">
		<div class="card my-4">
			<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
				<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
					<h6 class="text-black text-capitalize ps-3">Pengaturan Media Sosial & Kontak</h6>
				</div>
			</div>
			<div class="card-body px-4 pb-4">
				<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success">
					<?= $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<div class="card-body px-0 pb-2">
					<div class="table-responsive p-0">
						<form action="<?= base_url('admin/social_media/update') ?>" method="post">
							<div class="modal-content">
								<div class="modal-body p-4">

									<div class="mb-4">
										<label for="instagram" class="form-label">Instagram</label>
										<input type="text" name="instagram" id="instagram"
											value="<?= $sosmed->instagram ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="tiktok" class="form-label">TikTok</label>
										<input type="text" name="tiktok" id="tiktok"
											value="<?= $sosmed->tiktok ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="facebook" class="form-label">Facebook</label>
										<input type="text" name="facebook" id="facebook"
											value="<?= $sosmed->facebook ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="email" class="form-label">Email</label>
										<input type="email" name="email" id="email" value="<?= $sosmed->email ?? '' ?>"
											class="form-control">
									</div>

									<div class="mb-4">
										<label for="whatsapp_1" class="form-label">WhatsApp 1</label>
										<input type="text" name="whatsapp_1" id="whatsapp_1"
											value="<?= $sosmed->whatsapp_1 ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="whatsapp_2" class="form-label">WhatsApp 2</label>
										<input type="text" name="whatsapp_2" id="whatsapp_2"
											value="<?= $sosmed->whatsapp_2 ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="whatsapp_3" class="form-label">WhatsApp 3</label>
										<input type="text" name="whatsapp_3" id="whatsapp_3"
											value="<?= $sosmed->whatsapp_3 ?? '' ?>" class="form-control">
									</div>

									<div class="mb-4">
										<label for="active_whatsapp" class="form-label">Nomor WhatsApp Aktif</label>
										<select name="active_whatsapp" id="active_whatsapp" class="form-control">
											<option value="1"
												<?= ($sosmed->active_whatsapp ?? '') == '1' ? 'selected' : '' ?>>
												WhatsApp 1</option>
											<option value="2"
												<?= ($sosmed->active_whatsapp ?? '') == '2' ? 'selected' : '' ?>>
												WhatsApp 2</option>
											<option value="3"
												<?= ($sosmed->active_whatsapp ?? '') == '3' ? 'selected' : '' ?>>
												WhatsApp 3</option>
										</select>
									</div>

									<div class="text-end">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
                                </div>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php
// Cek dan ambil nomor aktif berdasarkan nilai active_whatsapp
$activeKey = 'whatsapp_' . ($sosmed->active_whatsapp ?? '1');
$nomorAktif = $sosmed->$activeKey ?? '-';
?>

<div class="alert alert-info">
    <strong>Nomor WhatsApp Aktif Saat Ini:</strong> <?= $nomorAktif ?>
</div>
