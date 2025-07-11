<div class="row">
		<div class="col-12">
			<div class="card my-4">
				<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-black text-capitalize ps-3">Konfigurasi</h6>
					</div>
				</div>
				<div class="card-body px-0 pb-2">
					<div class="table-responsive p-0">
						<table class="table align-items-center mb-0">
                            <form id="formTambahUser" action="<?= base_url('admin/konfigurasi/update') ?>" method="post" enctype='multipart/form-data'>
                                <div class="modal-content">
                                        <!-- <div class="modal-header">
                                            <h5 class="modal-title" id="tambahUserModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div> -->
                                    <div class="modal-body p-4">
                                    <div class="mb-4">
                                            <label for="judul_website" class="block text-sm font-medium text-gray-700">judul_website</label>
                                            <input type="text" id="judul_website" name="judul_website" value="<?= $konfig->judul_website; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <label for="profil_website" class="block text-sm font-medium text-gray-700">profil_website</label>
                                            <input type="text" id="profil_website" name="profil_website" value="<?= $konfig->profil_website; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                       
                                       
                                        <div class="mb-4">
                                            <label for="instagram" class="block text-sm font-medium text-gray-700">instagram</label>
                                            <input type="text" id="instagram" name="instagram" value="<?= $konfig->instagram; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <label for="facebook" class="block text-sm font-medium text-gray-700">facebook</label>
                                            <input type="text" id="facebook" name="facebook" value="<?= $konfig->facebook; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <label for="tiktok" class="block text-sm font-medium text-gray-700">tiktok</label>
                                            <input type="text" id="tiktok" name="tiktok" value="<?= $konfig->tiktok; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <label for="whatsapp" class="block text-sm font-medium text-gray-700">whatsapp</label>
                                            <input type="text" id="whatsapp" name="whatsapp" value="<?= $konfig->whatsapp; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-4">
                                            <label for="alamat" class="block text-sm font-medium text-gray-700">alamat</label>
                                            <input type="text" id="alamat" name="alamat" value="<?= $konfig->alamat; ?>" 
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                
                                       

                                    </div>
                                    <div class="modal-footer p-4">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

                        