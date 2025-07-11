<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- BEGIN: Modal Tambah -->
<div class="text-left mt-8">
    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#tambah-modal" class="btn btn-primary">Tambah Testimoni</a>
</div>

<div id="myalert" class="mt-3">
    <?= $this->session->flashdata('notifikasi') ?>
</div>

<!-- BEGIN: Datatable -->
<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="overflow-x-auto">
            <table id="example1" class="table table-report table-report--bordered w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap">NO</th>
                        <th class="border-b-2 whitespace-no-wrap">Nama</th>
                        <th class="border-b-2 whitespace-no-wrap">Isi</th>
                        <th class="border-b-2 whitespace-no-wrap">Status</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($testimoni as $t): ?>
                    <tr>
                        <td class="text-left border-b"><?= $no++ ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['nama']) ?></td>
                        <td class="text-left border-b"><?= nl2br(htmlspecialchars($t['isi'])) ?></td>
                        <td class="text-left border-b"><?= ucfirst($t['status']) ?></td>
                        <td class="border-b w-5">
                            <div class="flex justify-center items-center">
                                <a href="javascript:;" class="flex items-center mr-3 text-blue-500 edit-btn"
                                   data-id="<?= $t['id'] ?>"
                                   data-nama="<?= htmlspecialchars($t['nama'], ENT_QUOTES) ?>"
                                   data-isi="<?= htmlspecialchars($t['isi'], ENT_QUOTES) ?>"
                                   data-status="<?= $t['status'] ?>"
                                   data-tw-toggle="modal"
                                   data-tw-target="#edit-modal">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a href="javascript:;" class="flex items-center text-danger delete-btn" data-id="<?= $t['id'] ?>">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div id="tambah-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/testimoni/simpan') ?>" method="post">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Tambah Testimoni</h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
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

<!-- Modal Edit -->
<div id="edit-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/testimoni/update') ?>" method="post">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Edit Testimoni</h2>
                </div>
                <input type="hidden" name="id_testimoni" id="edit-id">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Nama</label>
                        <input name="nama" id="edit-nama" type="text" class="form-control" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Isi</label>
                        <textarea name="isi" id="edit-isi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit-status" class="form-control" required>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
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

<!-- Style SweetAlert -->
<style>
  .swal2-confirm { background-color: #3085d6 !important; }
  .swal2-cancel  { background-color: #d33 !important; }
  .swal2-button  { padding: 10px 20px !important; font-size: 16px !important; }
  .swal2-container { z-index: 9999 !important; }
</style>

<!-- Script Edit/Delete -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $(".edit-btn").click(function () {
        $("#edit-id").val($(this).data("id"));
        $("#edit-nama").val($(this).data("nama"));
        $("#edit-isi").val($(this).data("isi"));
        $("#edit-status").val($(this).data("status"));
    });

    $(".delete-btn").click(function () {
        const id = $(this).data("id");
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/testimoni/delete_data/') ?>" + id;
            }
        });
    });

    setTimeout(function () {
        $("#myalert").fadeOut("slow");
    }, 3000);
});
</script>
