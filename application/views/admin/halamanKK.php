<div id="myalert" class="mt-3">
    <?= $this->session->flashdata('notifikasi') ?>
</div>
<!-- <div class="text-right">
    <a href="#" id="export-all-btn" class="btn btn-success mt-5 text-white" target="_blank">
        <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> Ekspor Semua Data
    </a>
</div> -->
<script>
    $(document).ready(function() {
        $("#export-all-btn").click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Jangan terlalu sering melakukan ekspor data. Lanjutkan ekspor semua data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, ekspor!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("<?= base_url('admin/excel/all') ?>", "_blank");
                }
            });
        });
    });
</script>
<div class="intro-y box mt-5">
    <div class="p-5">
        <div class="overflow-x-auto">
            <table id="example1" class="table table-report table-report--bordered w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap">NO</th>
                        <th class="border-b-2 whitespace-no-wrap">NOMOR KK</th>
                        <th class="border-b-2 whitespace-no-wrap">Nama Kepala Keluarga</th>
                        <th class="border-b-2 whitespace-no-wrap">Alamat Lengkap</th>
                        <th class="border-b-2 whitespace-no-wrap">DESA / KELURAHAN</th>
                        <th class="border-b-2 whitespace-no-wrap">TGL. Di Keluarkan</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php $no = 1;
                        if (isset($data_kk)): foreach ($data_kk as $kk): ?>
                                <tr>
                                    <td class="border-b-2 whitespace-no-wrap"><?= $no++ ?></td>
                                    <td class="border-b-2 whitespace-no-wrap"><?= $kk['no_kk'] ?></td>
                                    <td class="border-b-2 whitespace-no-wrap"><?= $kk['nama_kepala_keluarga'] ?></td>
                                    <td class="border-b-2 whitespace-no-wrap"><?= $kk['alamat'] . ' RT' . $kk['rt'] . '/RW' . $kk['rw'] ?></td>
                                    <td class="border-b-2 whitespace-no-wrap"><?= $kk['desa_kelurahan'] . ', ' . $kk['kecamatan'] ?></td>
                                    <td class="border-b-2 whitespace-no-wrap"><?= date('d M Y', strtotime($kk['tanggal_dikeluarkan'])) ?></td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a target="_blank" href="<?= base_url('admin/PdfKK/tampilPdf/'.$kk['no_kk']) ?>" class="flex items-center mr-3 text-blue-500 edit-btn">
                                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Lihat
                                            </a>
                                            <a href="<?= base_url('admin/excelKK/excelKK/'.$kk['no_kk']) ?>" class="flex items-center mr-3 text-green-600">
                                                <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> Export
                                            </a>
                                            <a href="javascript:;" class="flex items-center text-danger delete-btn" data-id="<?= $kk['id_kk'] ?>"">
                                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
  .swal2-confirm { background-color: #3085d6 !important; }
  .swal2-cancel  { background-color: #d33 !important; }
  .swal2-button  { padding: 10px 20px !important; font-size: 16px !important; }
  .swal2-container { z-index: 9999 !important; }
</style>
<script>
    $(document).ready(function() {
        $(".delete-btn").click(function() {
            const id = $(this).data("id");
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data Kartu Keluarga ini dan SEMUA ANGGOTA KELUARGA terkait akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengubah URL delete ke controller yang benar
                    window.location.href = "<?= base_url('admin/HalamanKK/delete_data/') ?>" + id;
                }
            });
        });
        setTimeout(function() {
            $("#myalert").fadeOut("slow");
        }, 3000);
    });
</script>