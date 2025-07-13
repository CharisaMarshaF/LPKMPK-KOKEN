<!-- BEGIN: Tambah FAQ -->
<div class="text-left mt-8">
    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#tambah-modal" class="btn btn-primary">Tambah FAQ</a>
</div>

<div id="myalert" class="mt-3">
    <?= $this->session->flashdata('notifikasi') ?>
</div>

<!-- BEGIN: Table FAQ -->
<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="overflow-x-auto">
            <table id="example1" class="table table-report table-report--bordered w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap">NO</th>
                        <th class="border-b-2 whitespace-no-wrap">Pertanyaan</th>
                        <th class="border-b-2 whitespace-no-wrap">Jawaban</th>
                        <th class="border-b-2 whitespace-no-wrap">Status</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($faq as $f): ?>
                    <tr>
                        <td class="text-left border-b"><?= $no++ ?></td>
                        <td class="text-left border-b"><?= htmlspecialchars($f['question']) ?></td>
                        <td class="text-left border-b"><?= nl2br(htmlspecialchars($f['answer'])) ?></td>
                        <td class="text-left border-b"><?= $f['status'] ? 'Publish' : 'Draft' ?></td>
                        <td class="border-b w-5">
                            <div class="flex justify-center items-center">
                                <a href="javascript:;" class="flex items-center mr-3 text-blue-500 edit-btn"
                                   data-id="<?= $f['id'] ?>"
                                   data-question="<?= htmlspecialchars($f['question'], ENT_QUOTES) ?>"
                                   data-answer="<?= htmlspecialchars($f['answer'], ENT_QUOTES) ?>"
                                   data-status="<?= $f['status'] ?>"
                                   data-tw-toggle="modal"
                                   data-tw-target="#edit-modal">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a href="javascript:;" class="flex items-center text-danger delete-btn" data-id="<?= $f['id'] ?>">
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
            <form action="<?= base_url('admin/faq/simpan') ?>" method="post">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Tambah FAQ</h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Pertanyaan</label>
                        <input name="question" type="text" class="form-control" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Jawaban</label>
                        <textarea name="answer" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
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
            <form action="<?= base_url('admin/faq/update') ?>" method="post">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Edit FAQ</h2>
                </div>
                <input type="hidden" name="id_faq" id="edit-id">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label class="form-label">Pertanyaan</label>
                        <input name="question" id="edit-question" type="text" class="form-control" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Jawaban</label>
                        <textarea name="answer" id="edit-answer" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit-status" class="form-control" required>
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
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

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $(".edit-btn").click(function () {
        $("#edit-id").val($(this).data("id"));
        $("#edit-question").val($(this).data("question"));
        $("#edit-answer").val($(this).data("answer"));
        $("#edit-status").val($(this).data("status"));
    });

    $(".delete-btn").click(function () {
        const id = $(this).data("id");
        Swal.fire({
  title: "Apakah Anda yakin?",
  text: "Data akan dihapus secara permanen!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Ya, hapus!",
  cancelButtonText: "Batal",
  customClass: {
    confirmButton: 'btn btn-danger bg-red-600 text-white px-4 py-2 rounded',
    cancelButton: 'btn btn-secondary bg-gray-300 text-black px-4 py-2 rounded'
  },
  buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/faq/delete/') ?>" + id;
            }
        });
    });

    setTimeout(function () {
        $("#myalert").fadeOut("slow");
    }, 3000);
});
</script>
