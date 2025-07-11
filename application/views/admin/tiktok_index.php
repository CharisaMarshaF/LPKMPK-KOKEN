<!-- BEGIN: Modal Toggle -->
<div class="text-left mt-8">
	<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-tambah-tiktok"
 		class="btn btn-primary">Tambah Video TikTok</a>
</div>
<!-- END: Modal Toggle -->

<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>

<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <table id="example1" class="table table-report table-report--bordered display datatable w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">NO</th>
                            <th class="border-b-2 whitespace-no-wrap">Video URL</th>
                            
                            <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($tiktok_videos as $vid): ?>
                        <tr>
                            <td class="text-left border-b"><?= $no++; ?></td>
                            <td class="text-left border-b">
                              <a href="<?= $vid['video_url'] ?>" target="_blank"><?= $vid['video_url'] ?></a>
                            </td>
                            
                            <td class="border-b w-5">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-danger delete-btn" href="javascript:;" 
                                       data-id="<?= $vid['id_tiktok'] ?>">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- BEGIN: Modal Content -->
            <div id="modal-tambah-tiktok" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">Tambah Video TikTok</h2>
                        </div>
                        <form action="<?= base_url('admin/tiktok/simpan') ?>" method="post">
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                <div class="col-span-12">
                                    <label class="form-label">Video URL</label>
                                    <input name="video_url" type="url" class="form-control" placeholder="https://www.tiktok.com/..." required>
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
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
                window.location.href = "<?= base_url('admin/tiktok/delete/') ?>" + id;
            }
        });
    });
</script>

<script>
$(document).ready(function() {
    setTimeout(function() {
        $("#myalert").fadeOut("slow");
    }, 3000); 
});
</script>
