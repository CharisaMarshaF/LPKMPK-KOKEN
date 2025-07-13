<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-black text-capitalize ps-3">Konfigurasi Website</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-4">

                <!-- ✅ ALERT -->
                <?php if ($this->session->flashdata('alert')): ?>
                    <?= $this->session->flashdata('alert'); ?>
                <?php endif; ?>

                <form action="<?= base_url('admin/konfigurasi/update') ?>" method="post">
                    						<div class="modal-content">
								<div class="modal-body p-4">
                    <div class="mb-4">
                        <label for="judul_website" class="form-label">Judul Website</label>
                        <input type="text" name="judul_website" id="judul_website" class="form-control"
                            value="<?= $konfig->judul_website ?? '' ?>">
                    </div>

                    <div class="mb-4">
                        <label for="profil_website" class="form-label">Profil Website</label>
                        <textarea name="profil_website" id="profil_website" rows="4" class="form-control"><?= $konfig->profil_website ?? '' ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" class="form-control"
                            value="<?= $konfig->alamat ?? '' ?>">
                    </div>

                    <div class="mb-4">
                        <label for="google_maps_link" class="form-label">Link Google Maps</label>
                        <input type="text" name="google_maps_link" id="google_maps_link" class="form-control"
                            value="<?= $konfig->google_maps_link ?? '' ?>">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
