


<!-- BEGIN: Modal Toggle -->
<div class="text-left mt-8">
	<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview"
 		class="btn btn-primary">Tambah Galeri</a>
</div>
<!-- END: Modal Toggle -->


<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('notifikasi', true)?>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <!-- DataTables Table -->
                <table id="example1" class="table table-report table-report--bordered display datatable w-full">
                    <thead class="bg-gray-100">
                    <tr>
				<th class="border-b-2 whitespace-no-wrap">NO </th>
				<th class="border-b-2 whitespace-no-wrap">Foto</th>
				
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($galeri as $cc) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
				<td class="text-left border-b">
					<img src="../assets/upload/galeri/<?= $cc['foto']; ?>" alt="Foto" width="100">
				</td>

				<td class="border-b w-5">
					<div class="flex justify-center items-center">
						
						<a class="flex items-center text-danger delete-btn" href="javascript:;" 
							data-foto="<?= $cc['foto']; ?>">
							<i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
						</a>
					</div>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">TAMBAH CARAOUSEL</h2>
            </div> <!-- END: Modal Header -->
<!-- Modal Upload Galeri -->
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
        var foto = $(this).data("foto"); 
        
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
                window.location.href = "<?= base_url('admin/galeri/delete_data/') ?>" + foto;
            }
        });

    });
</script>
<script>
    document.getElementById('modal-form-foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $("#myalert").fadeOut("slow");
    }, 3000); 
});
</script>