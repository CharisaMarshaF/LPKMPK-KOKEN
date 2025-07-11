<div class="text-left mt-8">
    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview"
       class="btn btn-primary">Tambah Produk</a>
</div>
<div id="myalert" style="margin-top: 10px;">
    <?php echo $this->session->flashdata('notifikasi', true) ?>
</div>

<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <table id="example1" class="table table-report table-report--bordered display datatable w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">NO</th>
                            <th class="border-b-2 whitespace-no-wrap">Produk</th>
                            <th class="border-b-2 whitespace-no-wrap">Deskripsi</th>
                            <th class="border-b-2 whitespace-no-wrap">Harga</th>
                            <th class="border-b-2 whitespace-no-wrap">Tanggal</th>
                            <th class="border-b-2 whitespace-no-wrap">Kreator</th>
                            <th class="border-b-2 whitespace-no-wrap">Foto</th>
                            <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($konten as $kk) { ?>
                        <tr>
                            <td class="text-left border-b"><?= $no; ?></td>
                            <td class="text-left border-b"><?= $kk['judul']; ?></td>
                            <td class="text-left border-b"><?= $kk['keterangan']; ?></td>
                            <td class="text-left border-b"><?= "Rp " . number_format($kk['harga'], 0, ',', '.'); ?></td>
                            <td class="text-left border-b"><?= $kk['tanggal']; ?></td>
                            <td class="text-left border-b"><?= $kk['username']; ?></td>
                            <td class="text-left border-b">
                                <?php if (!empty($kk['fotos'])) { ?>
                                    <?php foreach ($kk['fotos'] as $foto) { ?>
                                        <img src="<?= base_url('assets/upload/konten/' . $foto['foto']); ?>" alt="Foto" width="50" class="inline-block m-1">
                                    <?php } ?>
                                <?php } else { ?>
                                    No Photo
                                <?php } ?>
                            </td>

                            <td class="border-b w-5">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 text-blue-500 edit-btn" href="javascript:;" 
                                       data-id="<?= $kk['id_konten']; ?>" 
                                       data-judul="<?= $kk['judul']; ?>" 
                                       data-keterangan="<?= $kk['keterangan']; ?>" 
                                       data-harga="<?= $kk['harga']; ?>"
                                       data-tw-toggle="modal" 
                                       data-tw-target="#edit-modal">
                                        <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-danger delete-btn" href="javascript:;" 
                                       data-id_konten="<?= $kk['id_konten']; ?>">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="edit-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">EDIT PRODUK</h2>
            </div>
            <form action="<?= base_url('admin/konten/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <input type="hidden" name="id_konten" id="edit-id">
                    
                    <div class="col-span-12">
                        <label class="form-label"><p>Produk</p></label>
                        <input name="judul" id="edit-judul" type="text" class="form-control" required>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="keterangan" id="edit-keterangan" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Harga</label>
                        <input name="harga" id="edit-harga" type="number" class="form-control" required>
                    </div>
                    
                    <div class="col-span-12">
                        <label class="form-label">Foto Saat Ini</label>
                        <div id="current-photos-container" class="flex flex-wrap">
                            </div>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Tambah Foto Baru</label>
                        <input name="foto[]" id="edit-foto" type="file" class="form-control" accept="image/*" multiple>
                        <div id="new-photos-preview" class="flex flex-wrap mt-2">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                    <button type="submit" class="btn btn-primary w-20">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">TAMBAH PRODUK</h2>
            </div>
            <form action="<?= base_url('admin/konten/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Nama Produk</label>
                        <input name="judul" id="modal-form-nama" type="text" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="keterangan" id="modal-form-keterangan" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Harga</label>
                        <input name="harga" id="modal-form-harga" type="number" class="form-control" required>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Foto Produk (Bisa Pilih Lebih Dari Satu)</label>
                        <input name="foto[]" id="modal-form-foto" type="file" class="form-control" accept="image/*" multiple required>
                        <div id="add-photos-preview" class="flex flex-wrap mt-2">
                            </div>
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
    .photo-preview {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    .photo-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    .photo-preview .remove-photo {
        position: absolute;
        top: 0;
        right: 0;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // EDIT BUTTON
    $(".edit-btn").click(function () {
        const id = $(this).data("id");
        const judul = $(this).data("judul");
        const keterangan = $(this).data("keterangan");
        const harga = $(this).data("harga");

        $("#edit-id").val(id);
        $("#edit-judul").val(judul);
        $("#edit-keterangan").val(keterangan);
        $("#edit-harga").val(harga);

        // Clear existing previews
        $('#current-photos-container').empty();
        $('#new-photos-preview').empty();

        // Fetch existing photos for the content
        $.ajax({
            url: "<?= base_url('admin/konten/get_konten_by_id_ajax/') ?>" + id, // Create a new AJAX endpoint in controller
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.fotos && response.fotos.length > 0) {
                    response.fotos.forEach(function(foto) {
                        const photoDiv = `
                            <div class="photo-preview" id="photo-${foto.id}">
                                <img src="<?= base_url('assets/upload/konten/') ?>${foto.foto}" alt="Foto">
                                <span class="remove-photo" data-photo-id="${foto.id}" data-photo-name="${foto.foto}">x</span>
                            </div>
                        `;
                        $('#current-photos-container').append(photoDiv);
                    });
                } else {
                    $('#current-photos-container').html('<p>No photos uploaded yet.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching photos:", error);
            }
        });

        // Event listener for removing individual photos
        $(document).on('click', '.remove-photo', function() {
            const photoId = $(this).data('photo-id');
            const photoName = $(this).data('photo-name');
            const photoElement = $(this).closest('.photo-preview');

            Swal.fire({
                title: "Hapus Foto?",
                text: "Anda yakin ingin menghapus foto ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin/konten/delete_single_photo/') ?>" + photoId,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.status === 'success') {
                                photoElement.remove();
                                Swal.fire("Dihapus!", "Foto berhasil dihapus.", "success");
                            } else {
                                Swal.fire("Gagal!", "Gagal menghapus foto: " + response.message, "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Terjadi kesalahan saat menghapus foto.", "error");
                            console.error("AJAX Error:", error);
                        }
                    });
                }
            });
        });
    });

    // FOTO UPLOAD PREVIEW for Edit Modal
    $("#edit-foto").change(function (event) {
        $('#new-photos-preview').empty(); // Clear previous new photo previews
        const files = event.target.files;
        if (files) {
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const photoDiv = `
                        <div class="photo-preview">
                            <img src="${e.target.result}" alt="Preview Foto">
                        </div>
                    `;
                    $('#new-photos-preview').append(photoDiv);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });

    // DELETE BUTTON for main table
    $(".delete-btn").click(function () {
        var id_konten = $(this).data("id_konten");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen, termasuk semua fotonya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/konten/delete_data/') ?>" + id_konten;
            }
        });
    });

    // TAMPILKAN PREVIEW FOTO UNTUK TAMBAH PRODUK
    document.getElementById('modal-form-foto').addEventListener('change', function(event) {
        $('#add-photos-preview').empty(); // Clear previous previews
        const files = event.target.files;
        if (files) {
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoDiv = `
                        <div class="photo-preview">
                            <img src="${e.target.result}" alt="Preview Foto">
                        </div>
                    `;
                    $('#add-photos-preview').append(photoDiv);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });

    // MENYEMBUNYIKAN ALERT
    setTimeout(function() {
        $("#myalert").fadeOut("slow");
    }, 3000);
});
</script>