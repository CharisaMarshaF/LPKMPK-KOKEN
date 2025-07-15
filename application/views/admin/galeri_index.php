<!-- Tombol Tambah Galeri -->
<div class="text-left mt-8">
    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview"
       class="btn btn-primary">Tambah Galeri</a>
</div>

<!-- Alert Flash -->
<div id="myalert" style="margin-top: 10px;">
    <?= $this->session->flashdata('alert', true) ?>
</div>

<!-- Galeri Grid -->
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <?php foreach ($galeri as $cc) { ?>
        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
            <!-- Header Kosong -->
           

            <!-- Gambar -->
            <div class="p-5">
                <div class="h-40 2xl:h-56 image-fit">
                    <img alt="Galeri" class="rounded-md object-cover w-full h-full"
                         src="<?= base_url('assets/upload/galeri/' . $cc['foto']) ?>">
                </div>
            </div>

            <!-- Action -->
            <div class="flex items-center px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400 justify-end">
                <a href="javascript:;" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-danger text-white ml-2 tooltip delete-btn"
                   data-foto="<?= $cc['foto']; ?>" title="Hapus">
                    <i data-lucide="trash" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal Upload Galeri -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">TAMBAH GALERI</h2>
            </div>
            <form action="<?= base_url('admin/galeri/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Upload Foto Galeri (1 : 3)</label>
                        <input name="foto[]" type="file" class="form-control" multiple accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                    <button type="submit" class="btn btn-primary w-20">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 & Lucide -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

<!-- Alert Fade -->
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $("#myalert").fadeOut("slow");
        }, 3000);
    });
</script>
<style>
    .btn-confirm {
        background-color: #dc2626; /* red-600 */
        color: white;
        padding: 8px 20px;
        border-radius: 0.375rem;
        font-weight: 600;
    }

    .btn-confirm:hover {
        background-color: #b91c1c; /* red-700 */
    }

    .btn-cancel {
        background-color: #e5e7eb; /* gray-200 */
        color: #111827; /* gray-900 */
        padding: 8px 20px;
        border-radius: 0.375rem;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background-color: #d1d5db; /* gray-300 */
    }
</style>

<!-- Delete Button -->
<script>
    $(document).on('click', '.delete-btn', function () {
        var foto = $(this).data("foto");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            customClass: {
                confirmButton: 'swal2-confirm btn-confirm',
                cancelButton: 'swal2-cancel btn-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/galeri/delete_data/') ?>" + foto;
            }
        });
    });
</script>

