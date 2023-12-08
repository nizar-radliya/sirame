<table class="table table-bordered" style="text-align: justify; margin-bottom: 0">
	<tr>
		<th style="width: 50%">Jenis Dokumen</th>
		<td><?= $kkpr[0]->jenisdok ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Nomor Dokumen</th>
		<td><?= $kkpr[0]->nomordok ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Tanggal Dokumen</th>
		<td><?= onlydate($kkpr[0]->tgldok) ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Luas Tanah</th>
		<td><?= $kkpr[0]->luasrealisasi ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Pejabat Pengesahan</th>
		<td><?= $kkpr[0]->pejabat ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Status Laporan</th>
		<td><?= $kkpr[0]->statuslaporan ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Tanggal Pelaporan</th>
		<td><?= onlydate($kkpr[0]->tglpelaporan) ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Tanggal Verifikasi</th>
		<td><?php if($kkpr[0]->tglverifikasi != NULL) { echo onlydate($kkpr[0]->tglverifikasi); } ?></td>
	</tr>
	<tr>
		<th style="width: 50%">Catatan</th>
		<td><?= $kkpr[0]->catatan ?></td>
	</tr>
</table>
