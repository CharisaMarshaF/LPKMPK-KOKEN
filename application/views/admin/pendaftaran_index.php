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
                        <th class="border-b-2 whitespace-no-wrap">NIK</th>
                        <th class="border-b-2 whitespace-no-wrap">Nama</th>
                        <th class="border-b-2 whitespace-no-wrap">Alamat</th>
                        <th class="border-b-2 whitespace-no-wrap">Jenis Kelamin</th>
                        <th class="border-b-2 whitespace-no-wrap">No. Telp</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($cv as $t): ?>
                    <tr>
                        <td class="text-left border-b"><?= $no++ ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['nik']) ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['nama']) ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['alamat']) ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['jenis_kelamin']) ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($t['no_telp']) ?></td>
                        <td class="border-b w-5">
                            <div class="flex justify-center items-center">
                                <a href="<?= base_url('admin/pendaftaran/lihat/'.$t['nik']) ?>" class="flex items-center mr-3 text-blue-500 edit-btn">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Lihat
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
                window.location.href = "<?= base_url('admin/pendaftaran/delete_data/') ?>" + id;
            }
        });
    });
    setTimeout(function () {
        $("#myalert").fadeOut("slow");
    }, 3000);
});
</script>
