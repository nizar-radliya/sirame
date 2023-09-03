<table class="table table-bordered" style="margin-bottom: 0">
	<tr>
		<th>Zona / Sub Zona</th>
		<td><?= $polaruang[0]->nama ?></td>
	</tr>
	<tr>
		<th>Kawasan</th>
		<td><?= $polaruang[0]->kawasan ?></td>
	</tr>
	<?php $deskripsi = read($polaruang[0]->nama,'deskripsi','subzona'); ?>
	<tr>
		<th colspan="2">Deskripsi Zona / Sub Zona</th>
	</tr>
	<tr>
		<td colspan="2" style="text-align: justify"><?= $deskripsi[0]->deskripsi_subzona ?></td>
	</tr>
	<tr>
		<th colspan="2">Deskripsi Kawasan</th>
	</tr>
	<tr>
		<td colspan="2" style="text-align: justify"><?= $deskripsi[0]->deskripsi_kawasan ?></td>
	</tr>
</table>
