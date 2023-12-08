<table class="table table-bordered" style="margin-bottom: 0">
	<tr>
		<th>Nomor Registrasi</th>
		<td><?= $permohonan[0]->nopermohonan ?></td>
	</tr>
	<tr>
		<th>Kategori</th>
		<td><?= $permohonan[0]->kategori ?></td>
	</tr>
	<tr>
		<th>Kepemilikan</th>
		<td><?= $permohonan[0]->kepemilikan ?></td>
	</tr>
	<tr>
		<th>Kebutuhan</th>
		<td><?= $permohonan[0]->kebutuhan ?></td>
	</tr>
	<tr>
		<th>Pemanfaatan</th>
		<td><?= $permohonan[0]->pemanfaatan ?></td>
	</tr>
	<tr>
		<th>Status</th>
		<td><?= $permohonan[0]->statuspermohonan ?></td>
	</tr>
	<tr>
		<th>No KTP Pemohon</th>
		<td><?= $permohonan[0]->noktp ?></td>
	</tr>
	<tr>
		<th>Nama Pemohon</th>
		<td><?= $permohonan[0]->namapemohon ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php if (menu(24)) { ?>
			<a href="<?php echo base_url(); ?>permohonan-adm/detil/<?= $permohonan[0]->nopermohonan; ?>" target="_blank">
			<button type="button" class="btn bg-yellow btn-flat margin pull-right" style="margin: 0">
				<span class="fa fa-file-text-o" style="margin-right: 5px"></span>
				Detil
			</button>
			</a>
			<?php } ?>
		</td>
	</tr>
</table>
