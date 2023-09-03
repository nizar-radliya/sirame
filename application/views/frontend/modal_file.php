<table class="table table-bordered" style="margin-bottom: 0">
	<thead>
	<tr>
		<th style="width: 10px">#</th>
		<th width="5%"><span class="fa fa-download"></span></th>
		<th>Nama File</th>
		<th>Tanggal</th>
		<th style="display: none">Keterangan</th>
	</tr>
	</thead>
	<tbody>
	<?php $n=1; foreach ($file as $field) { ?>
		<tr>
			<td><?php echo $n++; ?></td>
			<td>
				<a href="<?php echo base_url(); ?>file/unduh/?file=<?php echo $field->file; ?>" target="_blank">
					<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
						<span class="fa fa-download"></span>
					</button>
				</a>
			</td>
			<td><?php echo $field->nama; ?></td>
			<td><?php echo datetime($field->tgl); ?></td>
			<td style="display: none"><?= $field->keterangan; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
