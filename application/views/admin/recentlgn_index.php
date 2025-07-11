
<div class="intro-y box mt-3">
    <div class="p-5">
        <div class="preview">
            <div class="overflow-x-auto">
                <!-- DataTables Table -->
                <table id="example1" class="table table-report table-report--bordered display datatable w-full">
                    <thead class="bg-gray-100">
                    <tr>
				<th class="border-b-2 whitespace-no-wrap">NO </th>
				<th class="border-b-2 whitespace-no-wrap">username </th>
				<th class="border-b-2 whitespace-no-wrap">recent login</th>
				
			</tr>
		</thead>
		<tbody>
        <?php  $no = 1; foreach ($user as $aa) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
				<td class="text-left border-b"><?= $aa['username'] ?></td>
				<td class="text-left border-b"><?= $aa['recent_login'] ?></td>
				
				
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>